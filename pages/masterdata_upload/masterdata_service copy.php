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

            $ServiceSection = isset($row[0]) ? $row[0] : '&nbsp;';
            $FileNo         = isset($row[1]) ? $row[1] : '&nbsp;';
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
                if ($strTemp == "x") {
                    $WeekNo .= ($i + 1) . ","; // Ensured proper concatenation
                }
            }
            $WeekNo = rtrim($WeekNo, ",");
           
            $repListOfMachinery     = str_replace(["'", "<", ">", "'", "/"], " ", $ListOfMachinery);
            $repResponciblePerson     = str_replace(["'", "<", ">", "'", "/"], " ", $ResponciblePerson);

            $output .= "<tr>
                            <td>$strServerDateTime</td>
                            <td>$ServiceSection</td>
                            <td>$FileNo</td>
                            <td>$repListOfMachinery</td>
                            <td>$Quantity</td>
                            <td>$TypeOfService</td>
                            <td>$repResponciblePerson</td>
                            <td>$Contractor</td>
                            <td>$TimeFrequency</td>
                            <td>$PreArrangement</td>
                            <td>$WeekNo</td>
                        </tr>";
            
            //$sql = "INSERT INTO tblwo_masterdata_service (Site, Location, Building, IssueType, IssueDescriptionMain, IssueDescriptionSub) "
            //     . "VALUES ('$Site', '$Location', '$Building', '$IssueType', '$repIssueDescriptionMain', '$repIssueDescriptionSub')";
            
            //mysqli_query($conn2, $sql);
        }
    } else {
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
                        <table class="table table-bordered">
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
</body>
</html>
