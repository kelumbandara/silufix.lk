<?php
    session_start();
    // Check if the user is logged in
    if (!isset($_SESSION["user_name"]))
    {
        // If not logged in, redirect to the login page
        header("Location: index.php");
        exit();
    }
    // Display the authenticated user's information
    $username = $_SESSION["user_name"];
?>
<?php

$responseMessage = array();

$responseMessage[0] = " ";
$i = 0;

use Shuchkin\SimpleXLSX;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once __DIR__.'../../../src/SimpleXLSX.php';
require '../../dbconnection/dbConnection.php';   

if (isset($_FILES['file'])) 
{
    echo 'Test -3 ';
    if ($xlsx = SimpleXLSX::parse($_FILES['file']['tmp_name'])) 
    {
        echo 'Test -4 ';
        //------------- Delete All Rows ----------------------------
        try 
        {
            $sql2 = "TRUNCATE TABLE tblwo_errorlevel_redtag";
            $truncatetable = mysqli_query($conn2, $sql2);
            if($truncatetable !== FALSE)
            {
               echo("All rows have been deleted.");
            }
            else
            {
               echo("No rows have been deleted.");
            }
        }
        catch(PDOException $e) 
        {
            echo "Connection failed: " . $e->getMessage();
        } 
        echo '<h2>Update new data..</h2>';
        //echo '<table border="1" cellpadding="3" style="border-collapse: collapse">';
        //------------- Read Excel File --------------------------
        //$dim = $xlsx->dimension();
        //$cols = $dim[0];
        foreach ($xlsx->readRows() as $k => $row) 
	{
            if ($k == 0) continue; // skip first row
            //echo '<tr>';
            //------------ Read One Row --------------------------
        
            $Site           = isset($row[0]) ? $row[0] : '&nbsp;' ;
            $Building       = isset($row[1]) ? $row[1] : '&nbsp;' ;
            $IssueType      = isset($row[2]) ? $row[2] : '&nbsp;' ;
            $IssueDescriptionMain   = isset($row[3]) ? $row[3] : '&nbsp;' ;
            $IssueDescriptionSub    = isset($row[4]) ? $row[4] : '&nbsp;' ;
         
            //$Level4 = "1";
            
            // $repProduct = str_replace(chr(39), chr(32),$Product);
            //$repProduct2 = str_replace(chr(96), chr(32),$repProduct);
            
            $repIssueDescriptionMain = str_replace(["'", "<", ">", "'", "/"]," ", $IssueDescriptionMain);
            //$repDesignDescription = str_replace(["'", "<", ">", "'"]," ", $DesignDescription);
            
            echo  $Site . '&nbsp;' . $Building . '&nbsp;' . $IssueType . '&nbsp;'. $repIssueDescriptionMain. '&nbsp;' .$IssueDescriptionSub;                       
            echo '<BR>';
            echo '<BR>';  
                       
            //INSERT INTO tblerrorlevel (ID, Department, McCategory, Level1, Level2, Level3, Level4) VALUES (NULL, 'dep', 'mc', 'l1', 'l2', 'l3', 'l4');

            $sql = "INSERT INTO tblwo_errorlevel_redtag (Site, Building, IssueType, IssueDescriptionMain, IssueDescriptionSub) "
                    . "VALUES ('" .$Site. "','" . $Building . "','" . $IssueType . "','" . $repIssueDescriptionMain. "','" .$IssueDescriptionSub. "')";
             
            //$sql = "INSERT INTO tblsmsevent (ServerDateTime, UnitId, UnitModel, MfmID, Region, Province, Area, ECSC, SinNo, FederNo, Status, V1N, V2N, V3N, I1A, I2A, I3A,TotalkW, TotalkVA, kWh, kVAh) "
            //        . "VALUES ('".$server_date."','".$UnitId."','SMS-1470B','".$MfmID."', 'R1', 'CP', 'Kegalle', 'ECSC1', 'SIN1', 'F1_Rotuwa', '".$Status."', '".$V1N."','".$V2N."', '".$V3N."', '".$I1A."', '".$I2A."', '".$I3A."', '".$TotalkW."', '".$TotalkVA."', '".$kWh."', '".$kVAh."')";
            if (mysqli_query($conn2, $sql)) 
            {
                //echo "New record created successfully";
            }
            else
            {
                echo '<BR>';
                echo "Error: " . $sql . "<br>" . mysqli_error($conn2);
                break 1;
            }
            //echo '</tr>';
        }
        //echo '</table>';
    } 
    else 
    {
        echo SimpleXLSX::parseError();
    }
}
 
?>
<?php
    require_once('../../headers/header.php');
?>
<?php
    require '../../dbconnection/dbConnection.php';  
?>
<body >
    <div id="layout-wrapper">
        <!-- ========== Page TOP bar Start ========== -->
        <?php
            include '../../headers/top-menu.php'
        ?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php
            include '../../headers/left-sidebar.php'
        ?> 
        <!-- Left Sidebar End -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">                                        
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                                <h4 class="mb-sm-0">Day Plan Upload</h4>

                                                <div class="page-title-right">
                                                    <ol class="breadcrumb m-0">
                                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                                        <li class="breadcrumb-item active">Day Plan Upload</li>
                                                    </ol>
                                                </div>
                                            </div>
                                            <div class="border-top my-2"></div>
                                            <br>
                                            *.XLSX <input type="file" name="file"  />
                                            <input type="submit" value="Read and Upload" />    
                                            
                                        </form>
                                    </div> 
                                </div>
                            </div>
                            <!-- end card -->
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                    <!-- Display the response from PHP -->
                    <div id="responseMessage2">
                        <table border="1" cellpadding="5" style="border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th style="font-weight: bold !important;">ID</th>
                                    <th style="font-weight: bold !important;">Line No</th>
                                    <th style="font-weight: bold !important;">Resp Employee</th>
                                    <th style="font-weight: bold !important;">Buyer</th>
                                    <th style="font-weight: bold !important;">Style</th>
                                    <th style="font-weight: bold !important;">GG</th>
                                    <th style="font-weight: bold !important;">SMV</th>
                                    <th style="font-weight: bold !important;">Display WH</th>
                                    <th style="font-weight: bold !important;">Actual WH</th>
                                    <th style="font-weight: bold !important;">PlanTgtPcs</th>
                                    <th style="font-weight: bold !important;">Per_Hour_Pcs</th>
                                    <th style="font-weight: bold !important;">Available Cader</th>
                                    <th style="font-weight: bold !important;">Present Linkers</th>
                                    <th style="font-weight: bold !important;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    // Loop through the array and echo each item in a table row
                                    foreach ($responseMessage as $message) {
                                        // Explode the stored data into cells based on '&nbsp;' (or any delimiter you use)
                                        $data = explode(':', $message); 
                                        echo "<tr>";
                                        // Loop through each element of the exploded data and create table cells
                                        foreach ($data as $cell) {
                                            echo "<td>" . htmlspecialchars($cell) . "</td>";  // htmlspecialchars to avoid XSS vulnerabilities
                                        }
                                        echo "</tr>";
                                    }                    
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div> <!-- container-fluid -->
            </div>
            
            <!-- End Page-content -->
            <?php
            include '../../headers/footer-bar.php'
            ?>

        </div>
        <!-- end main content-->

    </div>
   
    </body>
</html>
