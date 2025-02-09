<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_name"])) {
    header("Location: index.php");
    exit();
}
$username = $_SESSION["user_name"];

use Shuchkin\SimpleXLSX;
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
require_once __DIR__ . '../../../src/SimpleXLSX.php';
require '../../dbconnection/dbConnection.php';

$output = "";

if (isset($_FILES['file'])) 
{
    if ($xlsx = SimpleXLSX::parse($_FILES['file']['tmp_name'])) 
    {
        try {
            $sql2 = "TRUNCATE TABLE tblwo_masterdata_service";
            $truncatetable = mysqli_query($conn2, $sql2);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        //----------- Set TimeZone ----------------------------
        date_default_timezone_set('Asia/Kolkata');
        $strServerDateTime = date("Y-m-d H:i:s");  

        foreach ($xlsx->readRows() as $k => $row) 
        {
            if ($k == 0) continue; // Skip the first row (headers)

            $FileNo         = isset($row[0]) ? $row[0] : '&nbsp;';
            $ServiceSection = isset($row[1]) ? $row[1] : '&nbsp;';            
            $ListOfMachinery = isset($row[2]) ? $row[2] : '&nbsp;';
            $Quantity       = isset($row[3]) ? $row[3] : '&nbsp;';
            $TypeOfService  = isset($row[4]) ? $row[4] : '&nbsp;';
            $ResponciblePerson = isset($row[5]) ? $row[5] : '&nbsp;';

            $Contractor     = isset($row[6]) ? $row[6] : '&nbsp;';
            $TimeFrequency  = isset($row[7]) ? $row[7] : '&nbsp;';
            $PreArrangement = isset($row[8]) ? $row[8] : '&nbsp;';
            $WeekNo = "";

            for ($i = 0; $i < 52; $i++) 
            {
                $strTemp = isset($row[9 + $i]) ? $row[9 + $i] : '&nbsp;'; 
                if ($strTemp == "x")
                {
                    $WeekNo = ($i + 1);

                    $year = date("Y"); // Get the current year
                    //$WeekNo = 10; // Example week number (change this dynamically)
                    
                    // Get the first day (Monday) of the given week number
                    $date = new DateTime();
                    $date->setISODate($year, $WeekNo); 
                    
                    // Get start and end date of the week
                    $startOfWeek = $date->format('Y-m-d'); // Monday of the week
                    $date->modify('+6 days');
                    $endOfWeek = $date->format('Y-m-d'); // Sunday of the week
                    
                    $repListOfMachinery     = str_replace(["'", "<", ">", "'", "/"], " ", $ListOfMachinery);
                    $repResponciblePerson     = str_replace(["'", "<", ">", "'", "/"], ",", $ResponciblePerson);

                    $output .= "<tr>
                                    <td>$strServerDateTime</td>                            
                                    <td>$FileNo</td>
                                    <td>$ServiceSection</td>
                                    <td>$repListOfMachinery</td>
                                    <td>$Quantity</td>
                                    <td>$TypeOfService</td>
                                    <td>$repResponciblePerson</td>
                                    <td>$Contractor</td>
                                    <td>$TimeFrequency</td>
                                    <td>$PreArrangement</td>
                                    <td>$WeekNo</td>
                                    <td>$startOfWeek</td>
                                    
                                </tr>";
                                          
                    $sql = "INSERT INTO tblwo_masterdata_service 
                                (ServerDateTime, FileNo, ServiceSection, ListOfMachinery, Quantity, TypeOfService, 
                                ResponciblePerson, Contractor, TimeFrequency, PreArrangement, WeekNo, PlannedDateTime, State) 
                            VALUES 
                                ('$strServerDateTime', '$FileNo', '$ServiceSection', '$repListOfMachinery', '$Quantity', 
                                '$TypeOfService', '$repResponciblePerson', '$Contractor', '$TimeFrequency', '$PreArrangement', '$WeekNo', '$startOfWeek', '0')";

                    mysqli_query($conn2, $sql);

                    //$sql = "INSERT INTO tblwo_masterdata_service (Site, Location, Building, IssueType, IssueDescriptionMain, IssueDescriptionSub) "
                    //     . "VALUES ('$Site', '$Location', '$Building', '$IssueType', '$repIssueDescriptionMain', '$repIssueDescriptionSub')";
                    
                    //mysqli_query($conn2, $sql);
                    
                }
            }

           
            
        }
    }
    else 
    {
        echo SimpleXLSX::parseError();
    }
}
?>

<?php include_once '../../headers/header.php'; ?>
<?php include '../../headers/top-menu.php'; ?>
<?php include '../../headers/left-sidebar.php'; ?>

<div class="content-wrapper pt-3">
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h2 class="card-title">Master Data Update - Service Schedule</h2>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <input type="file" name="file" />
                        <input type="submit" value="Read and Upload" />
                    </form>
                </div>
            </div>

            <?php if (!empty($output)): ?>
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">Uploaded Data</h3>
                </div>
                <div class="card-body">
                    <div style="overflow-x: auto; white-space: nowrap;">
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ServerDateTime</th>
                                    <th>FileNo</th>
                                    <th>ServiceSection</th>                                
                                    <th>repListOfMachinery</th>
                                    <th>Quantity</th>
                                    <th>TypeOfService</th>
                                    <th>repResponciblePerson</th>
                                    <th>Contractor</th>
                                    <th>TimeFrequency</th>
                                    <th>PreArrangement</th>
                                    <th>WeekNo</th>
                                    <th>PlannedDateTime</th>
                                    
                            </thead>
                            <tbody>
                                <?php echo $output; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php include '../../headers/footer-bar.php'; ?>
    </section>
</div>

<!-- DataTables Scripts -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        "paging": true,       
        "lengthMenu": [10, 20, 50, 100], 
        "searching": true,     
        "ordering": true,      
        "info": true,          
        "responsive": true     
    });
});
</script>
</body>
</html>
