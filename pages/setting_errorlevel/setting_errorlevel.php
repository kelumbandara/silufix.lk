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
            $sql2 = "TRUNCATE TABLE tblwo_errorlevel_breakdown";
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
                      
            $Department     = isset($row[0]) ? $row[0] : '&nbsp;' ;
            $MC_Category    = isset($row[1]) ? $row[1] : '&nbsp;' ;
            $FaultType      = isset($row[2]) ? $row[2] : '&nbsp;' ;
            $Level1         = isset($row[3]) ? $row[3] : '&nbsp;' ;
            $Level2         = isset($row[4]) ? $row[4] : '&nbsp;' ;
            $Level3         = isset($row[5]) ? $row[5] : '&nbsp;' ;
            $Level4         = isset($row[6]) ? $row[6] : '&nbsp;' ;
            //$Level4 = "1";
            
            //if($FaultType == ""){ $FaultType = "NA";}
            //if($Level1 == "")   { $Level1 = "NA";}
            //if($Level2 == "")   { $Level2 = "NA";}
            //if($Level3 == "")   { $Level3 = "NA";}
            //if($Level4 == "")   { $Level4 = "NA";}
            //if($BodyCode == "")     { $BodyCode = " Blank ";}
            
            // $repProduct = str_replace(chr(39), chr(32),$Product);
            //$repProduct2 = str_replace(chr(96), chr(32),$repProduct);
            
            $repMC_Category = str_replace(["'", "<", ">", "'", "/"]," ", $MC_Category);
            //$repDesignDescription = str_replace(["'", "<", ">", "'"]," ", $DesignDescription);
            
            echo  $Department . '&nbsp;' . $repMC_Category . '&nbsp;' . $FaultType . '&nbsp;'. $Level1. '&nbsp;' .$Level2. '&nbsp;' . $Level3;                       
            echo '<BR>';
            echo '<BR>';  
                       
            //INSERT INTO tblerrorlevel (ID, Department, McCategory, Level1, Level2, Level3, Level4) VALUES (NULL, 'dep', 'mc', 'l1', 'l2', 'l3', 'l4');

            $sql = "INSERT INTO tblwo_errorlevel_breakdown (Department, McCategory, FaultType, Level1, Level2, Level3, Level4) "
                    . "VALUES ('" .$Department. "','" . $repMC_Category . "','" . $FaultType . "','" . $Level1. "','" .$Level2. "','" .$Level3. "','" .$Level4. "')";
             
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
                            <h2 class="card-title">Fault Level Master Data Update</h2>
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
       funViewReport();
   });
   //--------------- Print Report function ------------------------------------------
   function funPrintReport() 
   {                
       window.print();		
   }
   //--------------- View Report function ------------------------------------------
   function funViewReport() 
   {
       //const AryDepartmentNames = ["a","b","c"];
       //const AryDepartmentDT = [12,15,85,45,65];
       //alert("View button Clicked"); 
       //var vblSendPara = "1234";  
       var vbl_sdate = document.getElementById("id_sdate");
       var vbl_edate = document.getElementById("id_edate");		
       var vbl_shift = document.getElementById("id_shift");

       var vblSendPara =  [vbl_sdate.value, vbl_edate.value, vbl_shift.value]; 
       $.post('class/getData_AndonChart.php', { userpara: vblSendPara }, function(json_data2) 
       {
           //alert(json_data2);           
           var res = $.parseJSON(json_data2);
           //alert(res);           
           //AryDepartmentNames = res.FaultType_Name_Ary;                
           //alert(res.FaultType_Name_Ary);
           //alert(res.FaultType_Dt_Ary);
           //alert(res.CategoryColorAry);

           //------------------------------------------------------------
           //- 1. DONUT CHART - Department Wise Total Downtime 
           //------------------------------------------------------------    
           //--- Refres the Canvas DIV -----------------------------------------------   
           document.getElementById("Id_DivDonutChart").innerHTML = '&nbsp;';
           //document.getElementById("Id_DivDonutChart").innerHTML = '<canvas id="donutChart" style="height: 400px;"></canvas>';
           document.getElementById("Id_DivDonutChart").innerHTML = '<canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>';

           var donutChartCanvas = $('#donutChart').get(0).getContext('2d');               
           var donutData = {
             labels: res.FaultType_DtName_Ary,
             datasets: [
               {
                 data: res.FaultType_Dt_Ary,
                 backgroundColor : res.CategoryColorAry
               }]};
           var donutOptions = {maintainAspectRatio : false, responsive : true};
           new Chart(donutChartCanvas, 
           {
               options: 
               {  
                   plugins: 
                   {
                       // Change options for ALL labels of THIS CHART
                       datalabels: {color: '#000000', anchor: 'center', display: 'auto', rotation:'90'}
                   }
               },  
               type: 'doughnut',
               data: donutData,
               //options: donutOptions
           });
           //------------------------------------------------------------
           //- 2. PIE CHART - Fault Type Occuarance 
           //------------------------------------------------------------  
           document.getElementById("Id_DivPieChart").innerHTML = '&nbsp;';
           document.getElementById("Id_DivPieChart").innerHTML = '<canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>';

           var pieChartCanvas = $('#pieChart').get(0).getContext('2d');                
           //var pieData        = donutData;
            var pieData = {
             labels: res.FaultType_OccName_Ary,
             datasets: [
               {
                 data: res.FaultType_Occ_Ary ,
                 backgroundColor : res.CategoryColorAry
               }]};
           var pieOptions  = {maintainAspectRatio : false, responsive : true};
           //Create pie or douhnut chart
           // You can switch between pie and douhnut using the method below.
           new Chart(pieChartCanvas, 
           {
               options: 
               {
                   plugins: 
                   {
                       // Change options for ALL labels of THIS CHART
                       datalabels: {color: '#000000', anchor: 'center', display: 'auto', rotation:'90'}
                   }
               }, 
               type: 'pie',
               data: pieData,
               //options: pieOptions
           });
           //-------------------------------------------------------------
           //- 3. BAR CHART:1 - Machine Category Wise Downtime Summary  
           //-------------------------------------------------------------
           document.getElementById("Id_DivBarChart_1").innerHTML = '&nbsp;';
           document.getElementById("Id_DivBarChart_1").innerHTML = '<canvas id="id_barChart_1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>';

           var barChartCanvas = $('#id_barChart_1').get(0).getContext('2d');
           var barChart1_Data2 = 
           {
               labels  : res.McCategory_DtName_Ary,
               datasets: [
               {
                   label               : 'Downtime (Min)',
                   backgroundColor     : 'rgba(60,141,188,0.9)',
                   borderColor         : 'rgba(60,141,188,0.8)',
                   pointRadius          : false,
                   pointColor          : '#3b8bba',
                   pointStrokeColor    : 'rgba(60,141,188,1)',
                   pointHighlightFill  : '#fff',
                   pointHighlightStroke: 'rgba(60,141,188,1)',
                   data                : res.McCategory_Dt_Ary
               }]
           };
           var barChartData = $.extend(true, {}, barChart1_Data2);
           var temp0 = barChart1_Data2.datasets[0];
           //var temp1 = barChart1_Data2.datasets[1];
           barChartData.datasets[0] = temp0;
           //barChartData.datasets[1] = temp1;

           var barChartOptions = 
           {
             responsive              : true,
             maintainAspectRatio     : false,
             datasetFill             : false
           };
           new Chart(barChartCanvas, 
           {
               options: 
               {
                   plugins: 
                   {
                       // Change options for ALL labels of THIS CHART
                       datalabels: {color: '#000000', anchor: 'end', rotation:'0'}
                   }
               }, 
               type: 'bar',
               data: barChartData,
               //options: barChartOptions
           });
           //-------------------------------------------------------------
           //- 4. BAR CHART:2 - Machine Category Wise Occurance Summary  
           //-------------------------------------------------------------
           document.getElementById("Id_DivBarChart_2").innerHTML = '&nbsp;';
           document.getElementById("Id_DivBarChart_2").innerHTML = '<canvas id="id_barChart_2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>';

           var barChartCanvas = $('#id_barChart_2').get(0).getContext('2d');
           var barChart2_Data2 = 
           {
               labels  : res.McCategory_OccName_Ary,
               datasets: [
               {
                   label               : 'Occurance',
                   backgroundColor     : 'rgba(60,141,188,0.9)',
                   borderColor         : 'rgba(60,141,188,0.8)',
                   pointRadius          : false,
                   pointColor          : '#3b8bba',
                   pointStrokeColor    : 'rgba(60,141,188,1)',
                   pointHighlightFill  : '#fff',
                   pointHighlightStroke: 'rgba(60,141,188,1)',
                   data                : res.McCategory_Occ_Ary
               }]
           };
           var barChartData = $.extend(true, {}, barChart2_Data2);
           var temp0 = barChart2_Data2.datasets[0];
           //var temp1 = barChart1_Data2.datasets[1];
           barChartData.datasets[0] = temp0;
           //barChartData.datasets[1] = temp1;

           var barChartOptions = 
           {
             responsive              : true,
             maintainAspectRatio     : false,
             datasetFill             : false
           };
           new Chart(barChartCanvas, 
           {
               options: 
               {
                   plugins: 
                   {
                       // Change options for ALL labels of THIS CHART
                       datalabels: {color: '#000000', anchor: 'center', rotation:'0'}
                   }
               }, 
               type: 'bar',
               data: barChartData,
               //options: barChartOptions
           });
           //-----------------------------------------------------------------------------------
           //- 5. STACKED BAR CHART 1 - Line and Category Wise Downtime Stacked Chart
           //-----------------------------------------------------------------------------------
           document.getElementById("Id_DivStackedBarChart_1").innerHTML = '&nbsp;';
           document.getElementById("Id_DivStackedBarChart_1").innerHTML = '<canvas id="id_stackedBarChart_1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>';

           var stackedBarChartCanvas = $('#id_stackedBarChart_1').get(0).getContext('2d');

           var stackedBarChart1_Data = 
           {
               labels  : res.DateWise_DtName_Ary,
               datasets: [
               {
                   label               : 'Lable 1',
                   backgroundColor     : res.CategoryColorAry[0],
                   borderColor         : res.CategoryColorAry[0],
                   pointRadius          : false,
                   pointColor          : '#3b8bba',
                   pointStrokeColor    : 'rgba(60,141,188,1)',
                   pointHighlightFill  : '#fff',
                   pointHighlightStroke: 'rgba(60,141,188,1)',
                   data                : res.DateWise_AttnDt_Ary
               },
               {
                   label               : 'lable 2',
                   backgroundColor     : res.CategoryColorAry[1],
                   borderColor         : res.CategoryColorAry[1],
                   pointRadius         : false,
                   pointColor          : 'rgba(210, 214, 222, 1)',
                   pointStrokeColor    : '#c1c7d1',
                   pointHighlightFill  : '#fff',
                   pointHighlightStroke: 'rgba(220,220,220,1)',
                   data                : res.DateWise_McRepDt_Ary
               }]
           };
           var tmp_stackedBarChart1 = $.extend(true, {}, stackedBarChart1_Data);
           var temp10 = stackedBarChart1_Data.datasets[0];
           var temp11 = stackedBarChart1_Data.datasets[1];
          // var temp12 = stackedBarChart1_Data.datasets[2];
          // var temp13 = stackedBarChart1_Data.datasets[3];
          // var temp14 = stackedBarChart1_Data.datasets[4];
          // var temp15 = stackedBarChart1_Data.datasets[5];

           tmp_stackedBarChart1.datasets[0] = temp10;
           tmp_stackedBarChart1.datasets[1] = temp11;
          // tmp_stackedBarChart1.datasets[2] = temp12;
          // tmp_stackedBarChart1.datasets[3] = temp13;
         //  tmp_stackedBarChart1.datasets[4] = temp14;
         //  tmp_stackedBarChart1.datasets[5] = temp15;

           var load_stackedBarChart1_Data = $.extend(true, {}, tmp_stackedBarChart1);

           var stackedBarChartOptions = 
           {
             responsive              : true,
             maintainAspectRatio     : false,
             scales: {
               xAxes: [{
                 stacked: true
               }],
               yAxes: [{
                 stacked: true
               }]
             }
           };

           new Chart(stackedBarChartCanvas, 
           {
               options: 
               {
                   responsive              : true,
                   maintainAspectRatio     : false,
                   scales: {
                     xAxes: [{
                       stacked: true
                     }],
                     yAxes: [{
                       stacked: true
                     }]
                   },
                   plugins: 
                   {
                       // Change options for ALL labels of THIS CHART
                       datalabels: {color: '#000000', anchor: 'center', display: 'auto', rotation:'90'}
                   }
               },  
               type: 'bar',
               data: load_stackedBarChart1_Data,
               //options: stackedBarChartOptions
           });
           //-----------------------------------------------------------------------------------
           //- STACKED BAR CHART 2 - Line and Category Wise Occurance Stacked Chart
           //-----------------------------------------------------------------------------------
           document.getElementById("Id_DivStackedBarChart_2").innerHTML = '&nbsp;';
           document.getElementById("Id_DivStackedBarChart_2").innerHTML = '<canvas id="id_stackedBarChart_2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>';

           var stackedBarChartCanvas = $('#id_stackedBarChart_2').get(0).getContext('2d');

           var stackedBarChart2_Data = 
           {
               labels  : res.WorkCenterAry,
               datasets: [
               {
                   label               : res.CategoryNameAry[0],
                   backgroundColor     : res.CategoryColorAry[0],
                   borderColor         : res.CategoryColorAry[0],
                   pointRadius          : false,
                   pointColor          : '#3b8bba',
                   pointStrokeColor    : 'rgba(60,141,188,1)',
                   pointHighlightFill  : '#fff',
                   pointHighlightStroke: 'rgba(60,141,188,1)',
                   data                : res.LineWiseOccuranceCategory1_Ary
               },
               {
                   label               : res.CategoryNameAry[1],
                   backgroundColor     : res.CategoryColorAry[1],
                   borderColor         : res.CategoryColorAry[1],
                   pointRadius         : false,
                   pointColor          : 'rgba(210, 214, 222, 1)',
                   pointStrokeColor    : '#c1c7d1',
                   pointHighlightFill  : '#fff',
                   pointHighlightStroke: 'rgba(220,220,220,1)',
                   data                : res.LineWiseOccuranceCategory2_Ary
               },
               {
                   label               : res.CategoryNameAry[2],
                   backgroundColor     : res.CategoryColorAry[2],
                   borderColor         : res.CategoryColorAry[2],
                   pointRadius         : false,
                   pointColor          : 'rgba(210, 214, 222, 1)',
                   pointStrokeColor    : '#c1c7d1',
                   pointHighlightFill  : '#fff',
                   pointHighlightStroke: 'rgba(220,220,220,1)',
                   data                : res.LineWiseOccuranceCategory3_Ary
               },
               {
                   label               : res.CategoryNameAry[3],
                   backgroundColor     : res.CategoryColorAry[3],
                   borderColor         : res.CategoryColorAry[3],
                   pointRadius         : false,
                   pointColor          : 'rgba(210, 214, 222, 1)',
                   pointStrokeColor    : '#c1c7d1',
                   pointHighlightFill  : '#fff',
                   pointHighlightStroke: 'rgba(220,220,220,1)',
                   data                : res.LineWiseOccuranceCategory4_Ary
               },
               {
                   label               : res.CategoryNameAry[4],
                   backgroundColor     : res.CategoryColorAry[4],
                   borderColor         : res.CategoryColorAry[4],
                   pointRadius         : false,
                   pointColor          : 'rgba(210, 214, 222, 1)',
                   pointStrokeColor    : '#c1c7d1',
                   pointHighlightFill  : '#fff',
                   pointHighlightStroke: 'rgba(220,220,220,1)',
                   data                : res.LineWiseOccuranceCategory5_Ary
               },
               {
                   label               : res.CategoryNameAry[5],
                   backgroundColor     : res.CategoryColorAry[5],
                   borderColor         : res.CategoryColorAry[5],
                   pointRadius         : false,
                   pointColor          : 'rgba(210, 214, 222, 1)',
                   pointStrokeColor    : '#c1c7d1',
                   pointHighlightFill  : '#fff',
                   pointHighlightStroke: 'rgba(220,220,220,1)',
                   data                : res.LineWiseOccuranceCategory6_Ary
               }]
           };
           var tmp_stackedBarChart2 = $.extend(true, {}, stackedBarChart2_Data);
           var temp20 = stackedBarChart2_Data.datasets[0];
           var temp21 = stackedBarChart2_Data.datasets[1];
           var temp22 = stackedBarChart2_Data.datasets[2];
           var temp23 = stackedBarChart2_Data.datasets[3];
           var temp24 = stackedBarChart2_Data.datasets[4];
           var temp25 = stackedBarChart2_Data.datasets[5];

           tmp_stackedBarChart2.datasets[0] = temp20;
           tmp_stackedBarChart2.datasets[1] = temp21;
           tmp_stackedBarChart2.datasets[2] = temp22;
           tmp_stackedBarChart2.datasets[3] = temp23;
           tmp_stackedBarChart2.datasets[4] = temp24;
           tmp_stackedBarChart2.datasets[5] = temp25;

           var load_stackedBarChart2_Data = $.extend(true, {}, tmp_stackedBarChart2);

           var stackedBarChartOptions = 
           {
             responsive              : true,
             maintainAspectRatio     : false,
             scales: {
               xAxes: [{
                 stacked: true
               }],
               yAxes: [{
                 stacked: true
               }]
             }
           };

           new Chart(stackedBarChartCanvas, 
           {
               options: 
               {      
                   responsive              : true,
                   maintainAspectRatio     : false,
                   scales: {
                     xAxes: [{
                       stacked: true
                     }],
                     yAxes: [{
                       stacked: true
                     }]
                   },
                   plugins: 
                   {
                       // Change options for ALL labels of THIS CHART
                       datalabels: {color: '#000000', anchor: 'center', display: 'auto', rotation:'90'}
                       //datalabels: {display: 'false'}
                   }
               },
               type: 'bar',
               data: load_stackedBarChart2_Data,
               //options: stackedBarChartOptions
           });
       });

       //alert("DepWiseTotalDowntimeAry-0");
       //alert(DepWiseTotalDowntimeAry[0]);

       //--------------
       //- AREA CHART -
       //--------------
       // Get context with jQuery - using jQuery's .get() method.
       var areaChartCanvas = $('#areaChart').get(0).getContext('2d');
       var areaChartData = 
       {
           labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
           datasets: [
           {
               label               : 'Digital Goods',
               backgroundColor     : 'rgba(60,141,188,0.9)',
               borderColor         : 'rgba(60,141,188,0.8)',
               pointRadius          : false,
               pointColor          : '#3b8bba',
               pointStrokeColor    : 'rgba(60,141,188,1)',
               pointHighlightFill  : '#fff',
               pointHighlightStroke: 'rgba(60,141,188,1)',
               data                : [28, 100, 40, 19, 86, 27, 90]
           },
           {
               label               : 'Electronics',
               backgroundColor     : 'rgba(210, 214, 222, 1)',
               borderColor         : 'rgba(210, 214, 222, 1)',
               pointRadius         : false,
               pointColor          : 'rgba(210, 214, 222, 1)',
               pointStrokeColor    : '#c1c7d1',
               pointHighlightFill  : '#fff',
               pointHighlightStroke: 'rgba(220,220,220,1)',
               data                : [65, 100, 80, 81, 56, 55, 40]
           }]
       };
       var areaChartOptions = 
       {
         maintainAspectRatio : false,
         responsive : true,
         legend: {
           display: false
         },
         scales: {
           xAxes: [{
             gridLines : {
               display : false
             }
           }],
           yAxes: [{
             gridLines : {
               display : false
             }
           }]
         }
       };
       // This will get the first returned node in the jQuery collection.
       new Chart(areaChartCanvas, 
       {
         type: 'line',
         data: areaChartData,
         options: areaChartOptions
       });

       //-------------
       //- LINE CHART -
       //--------------
       var lineChartCanvas = $('#lineChart').get(0).getContext('2d');
       var lineChartOptions = $.extend(true, {}, areaChartOptions);
       var lineChartData = $.extend(true, {}, areaChartData);
       lineChartData.datasets[0].fill = false;
       lineChartData.datasets[1].fill = false;
       lineChartOptions.datasetFill = false;

       var lineChart = new Chart(lineChartCanvas, 
       {
         type: 'line',
         data: lineChartData,
         options: lineChartOptions
       });
   }
</script>
</body>
</html>
