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

use Shuchkin\SimpleXLSX;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once __DIR__.'../../../src/SimpleXLSX.php';

 require '../../dbconnection/dbConnection.php';   

//echo '<h1>Upload Excel File (XLSX)</h1>';
//echo '<h2>Upload your file</h2>
//		<form method="post" enctype="multipart/form-data">
//			*.XLSX <input type="file" name="file"  />&nbsp;&nbsp;<input type="submit" value="Read and Upload" />
//		</form>';

if (isset($_FILES['file'])) 
{
    echo 'Test -3 ';
    if ($xlsx = SimpleXLSX::parse($_FILES['file']['tmp_name'])) 
    {
        echo 'Test -4 ';
        //------------- Delete All Rows ----------------------------
        try 
        {
            $sql2 = "TRUNCATE TABLE tblwo_issuetype_redtag";
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
            //$Department     = isset($row[0]) ? $row[0] : '&nbsp;' ;
            //$MC_Category    = isset($row[1]) ? $row[1] : '&nbsp;' ;
            //$FaultType      = isset($row[2]) ? $row[2] : '&nbsp;' ;
            $IssueType          = isset($row[0]) ? $row[0] : '&nbsp;' ;
            $ResponsiblePerson  = isset($row[1]) ? $row[1] : '&nbsp;' ;
            $TeamMembers        = isset($row[2]) ? $row[2] : '&nbsp;' ;
          
            //$Level4 = "1";            
            //if($FaultType == ""){ $FaultType = "NA";}
            //if($BodyCode == "")     { $BodyCode = " Blank ";}
            // $repProduct = str_replace(chr(39), chr(32),$Product);
            //$repProduct2 = str_replace(chr(96), chr(32),$repProduct);
            
            //$repIssueDescriptionMain = str_replace(["'", "<", ">", "'", "/"]," ", $IssueDescriptionMain);
            //$repDesignDescription = str_replace(["'", "<", ">", "'"]," ", $DesignDescription);
            
            echo  $IssueType . '&nbsp;' . $ResponsiblePerson . '&nbsp;' . $TeamMembers;                       
            echo '<BR>';
            echo '<BR>';  
                       
            //INSERT INTO tblerrorlevel (ID, Department, McCategory, Level1, Level2, Level3, Level4) VALUES (NULL, 'dep', 'mc', 'l1', 'l2', 'l3', 'l4');

            $sql = "INSERT INTO tblwo_issuetype_redtag (IssueType, ResponsiblePerson, TeamMembers) "
                    . "VALUES ('" .$IssueType. "','" . $ResponsiblePerson . "','" . $TeamMembers . "')";
             
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
    include_once'../../headers/header.php';
    //include_once'../../dbconnection/dbConnection.php';
?>
<?php
    require '../../dbconnection/dbConnection.php';  
?>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="myimg/favicon-16x16.png" alt="Sky Logo" height="60" width="60">
        </div>
        <!-- Navbar -->
        <?php
              include '../../headers/top-menu.php'
        ?>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <?php
             include '../../headers/left-sidebar.php'
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper pt-3">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- /.card-header -->                    
                    <div class="card card-default" >
                        <div class="card-header">
                            <h2 class="card-title">Issue Type Update - Redtag</h2>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>                                
                            </div>
                        </div>
                        
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        
                                        <form method="post" enctype="multipart/form-data">	*.XLSX 
                                            <input type="file" name="file"  />
                                            <input type="submit" value="Read and Upload" />    
                                        </form>
                                    </div> 
                                </div>                             
                               
                            </div>                            
                        </div>
                    </div>
                    
                    <div class="border-top my-1"></div>  
                    
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
                <!-- Include Footer -->
                <?php
                     include '../../headers/footer-bar.php'
                ?> 
            </section>
        </div>    
    </section>   
</div>    
  <!-- Page specific script -->
<script>
    //var vblSec;
   var intTmp;
   var i;
   //--------------- Load when document is ready ------------------------------------------
   $(function() 
   {      
       //alert("Execute Reports..");
       //funViewReport();
       document.getElementById('id_sdate').valueAsDate = new Date();
       document.getElementById('id_edate').valueAsDate = new Date(Date.now() + ( 3600 * 1000 * 24));
       //funViewReport();
   });
   //--------------- Print Report function ------------------------------------------
   function funPrintReport() 
   {                
       window.print();		
   }
</script>
</body>
</html>