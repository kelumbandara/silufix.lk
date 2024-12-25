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
    //$all_section   = $_SESSION["user_roll_sections"];
    $roll_areas     = $_SESSION["user_roll_areas"];
    $roll_other     = $_SESSION["user_roll_other"];
?>

<?php
    require_once('../../headers/header.php');
?>
<body class="hold-transition sidebar-mini layout-fixed">
   
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../../myimg/favicon-16x16.png" alt="Sky Logo" height="60" width="60">
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
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- /.Andon Dashboard ---------------->
                        <div class="row">
                            <div class="col-md-2">
                                <div id="id_AndonDashboard_head">
                                    <!-- Cards will be dynamically added here -->
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div id="id_AndonDashboard">
                                    <!-- Cards will be dynamically added here -->
                                </div>
                            </div>                        
                        </div>                        
                        <div class="border-top my-2" id="id_AndonDashboard_line"></div> 
                        <!-- /.Mechanic Dashboard -------------->
                        <div class="row pt-0" id="id_McDashboard">  
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner text-center">
                                        <h4 id="id_McDashboard_NoOfAsgnJob_value">-</h4>                                            
                                        <h5>No of Assign Jobs</h5>                                            
                                    </div>
                                    <a href="#" class="small-box-footer" onclick="funNoOfAsgnJob()">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- small box -->
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-success">
                                    <div class="inner text-center">
                                        <h4 id="id_McDashboard_NoOfCmplt_value">-</h4>                                            
                                        <h5>No of Completed Jobs</h5> 
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="#" class="small-box-footer" onclick="funNoOfCmpltJob()">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner text-center">
                                        <h4 id="id_McDashboard_TotChkTime_value">-</h4>                                            
                                        <h5>Total Checking Time for Shift</h5> 
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                    <a href="../../pages/mechanic_performance/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                              <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner text-center">
                                         <h4 id="id_McDashboard_CheckInWoNo_value">-</h4>                                            
                                        <h5>Current CheckIn Work Order</h5> 
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                    <a href="#" class="small-box-footer" onclick="funCurrCheckInWo()">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>                     
                        </div>                         
                        <div class="border-top my-0" id="id_McDashboard_line"></div> 
                        <div class="row my-1" id="id_homeDetails">   
                            <div class="col-md-3">                            
                                <!-- <p class="text-center"><strong>Work Order Details</strong></p> -->
                                <p class="text-center"><strong>Last 7 Day Summary</strong></p>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="width:70%;">No Of Breakdown</td>
                                            <td style="width:5%;"></td>            
                                            <td style="width:25%;" id="id_Home_NoOfTotBreakDown_30day">: -</td>            
                                        </tr>
                                        <tr>
                                            <td style="width:70%;">Total Breakdown Duration</td>
                                            <td style="width:5%;"></td>   
                                            <td style="width:25%;" id="id_Home_TotBreakDownDuration_30day">: - Min</td>   
                                        </tr> 
                                        <tr>
                                            <td style="width:70%;">Average Breakdown Time</td>
                                            <td style="width:5%;"></td>   
                                            <td style="width:25%;" id="id_Home_AveBreakDownTime_30day">: - Min</td>   
                                        </tr> 
                                        <tr>
                                            <td style="width:70%;">Total Attending Delay</td>
                                            <td style="width:5%;"></td>   
                                            <td style="width:25%;" id="id_Home_TotAttnDelay_30day">: - Min</td>   
                                        </tr> 
                                        <tr>
                                            <td style="width:70%;">Average Attending Time</td>
                                            <td style="width:5%;"></td>   
                                            <td style="width:25%;" id="id_Home_AveAttnTime_30day">: - Min</td>   
                                        </tr> 
                                        <tr>
                                            <td style="width:70%;">Total Work Orders Placed</td>
                                            <td style="width:5%;"></td>   
                                            <td style="width:25%;" id="id_Home_TotWoPlaced_30day">: - </td>   
                                        </tr> 
                                        <tr>
                                            <td style="width:70%;">Completed Work Orders</td>
                                            <td style="width:5%;"></td>   
                                            <td style="width:25%;" id="id_Home_TotCmpltdWo_30day">: - </td>   
                                        </tr> 
                                    </tbody>               
                                </table>                                                                                
                            </div>  
                            <div class="col-md-3">                            
                                <!-- <p class="text-center"><strong>Work Order Details</strong></p> -->
                                <p class="text-center"><strong>Today Summary</strong></p>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="width:70%;">No Of Breakdown</td>
                                            <td style="width:5%;"></td>            
                                            <td style="width:25%;" id="id_Home_NoOfTotBreakDown_Today">: -</td>            
                                        </tr>
                                        <tr>
                                            <td style="width:70%;">Total Breakdown Duration</td>
                                            <td style="width:5%;"></td>   
                                            <td style="width:25%;" id="id_Home_TotBreakDownDuration_Today">: - Min</td>   
                                        </tr> 
                                        <tr>
                                            <td style="width:70%;">Average Breakdown Time</td>
                                            <td style="width:5%;"></td>   
                                            <td style="width:25%;" id="id_Home_AveBreakDownTime_Today">: - Min</td>   
                                        </tr> 
                                        <tr>
                                            <td style="width:70%;">Total Attending Delay</td>
                                            <td style="width:5%;"></td>   
                                            <td style="width:25%;" id="id_Home_TotAttnDelay_Today">: - Min</td>   
                                        </tr> 
                                        <tr>
                                            <td style="width:70%;">Average Attending Time</td>
                                            <td style="width:5%;"></td>   
                                            <td style="width:25%;" id="id_Home_AveAttnTime_Today">: - Min</td>   
                                        </tr> 
                                        <tr>
                                            <td style="width:70%;">Total Work Orders Placed</td>
                                            <td style="width:5%;"></td>   
                                            <td style="width:25%;" id="id_Home_TotWoPlaced_Today">: - </td>   
                                        </tr> 
                                        <tr>
                                            <td style="width:70%;">Completed Work Orders</td>
                                            <td style="width:5%;"></td>   
                                            <td style="width:25%;" id="id_Home_TotCmpltdWo_Today">: - </td>   
                                        </tr> 
                                    </tbody>               
                                </table>                                                                                
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                
                                <div class="card card-success">                                    
                                    <div class="card-body" id="Id_DivBarChart_1">                                    
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                    </div>                        
                    <div class="border-top my-1" id="id_homeDetails_line"></div>                        
                    <div class="row">  
                        <div class="col-lg-6">
                            <p class="text-center"><strong>List of all work orders</strong></p>                        
                        </div>
                        
                        <div class="col-lg-3">
                            <input type="text" id="myCustomSearchBox" class="form-control" placeholder="Search Anything here">
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <select class="form-control" onchange="funHome_SelDepartmentFilter()" id="id_funHome_SelDepartmentFilter" style="width:100%">
                                    <option value="Department-1">Department-1</option>
                                    <option value="Department-2">Department-2</option>                                      
                                </select>                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-12 connectedSortable">
                            <!-- Custom tabs (Charts with tabs)-->
                           <table id="example1" class="table table-bordered table-striped display compact">
                                <thead class="bg-info">
                                    <tr>
                                        <th>#</th>
                                        <th>WO</th>
                                        <th>Time</th>                                        
                                        <th>Department</th>    
                                        <th>By</th>
                                        <th>Category</th>
                                        <th>Description</th>                                                  
                                        <th>Status</th>
                                        <th><center>ReOpen</center></th>
                                    </tr>
                                </thead>
                                <tbody>                                       
                                </tbody>               
                            </table>
                        </section>
                    </div>
                    <div class="border-top my-1"></div>
                    <div class="row"> 
                        <div class="col-lg-7 mt-1">
                            <button type="button" class="btn btn-primary" onclick="funModCreateBreakDownClicked()" style="width:32.5%;" <?php echo (in_array('10019', $roll_areas) ? '' : 'disabled'); ?>><i class="fas fa-exclamation-triangle"></i> Break Down</button>
                            <button type="button" class="btn btn-primary" onclick="funModelPlannedMaintenanceClicked()" style="width:32.5%;" <?php echo (in_array('10020', $roll_areas) ? '' : 'disabled'); ?>><i class="far fa-bell"></i> Planned Maintenance</button>
                            <button type="button" class="btn btn-primary" onclick="funModRedTagCreateClicked()" style="width:32.5%;" <?php echo (in_array('10021', $roll_areas) ? '' : 'disabled'); ?>><i class="fas fa-bullhorn"></i> Red Tag</button>
                    
                        </div>
                        <div class="col-lg-5 mt-1">
                            <button type="button" class="btn btn-primary" onclick="funModBuildMntCreateClicked()" style="width:48%;" <?php echo (in_array('10022', $roll_areas) ? '' : 'disabled'); ?>><i class="fas fa-tools"></i> Building Maintenance</button>
                            <button type="button" class="btn btn-primary" onclick="funModOtherProjectCreateClicked()" style="width:48%;" <?php echo (in_array('10023', $roll_areas) ? '' : 'disabled'); ?>><i class="fas fa-recycle"></i> Other</button>
                        </div>                        
                    </div>
                    
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
                <!-- Include Footer -->
                <br/>
                <?php
                    include '../../headers/footer-bar.php'
                ?> 
            </section>
        </div>    
</div>    
 
<!-- Navbar -->
<?php
    include './model-pages/mod_BreakDownCreate.php'; 
    include './model-pages/mod_WoDetails.php'; 
    include './model-pages/mod_WoClose.php'; 
    include './model-pages/mod_WoAllocate.php'; 
    include './model-pages/mod_WoCheckIn.php'; 
 
    include './model-pages/mod_PlannedMaintenanceCreate.php';
    include './model-pages/mod_RedTagCreate.php';
    include './model-pages/mod_BuildingMaintenanceCreate.php';
    include './model-pages/mod_OtherProjectCreate.php';
  
    include './model-pages/mod_WoChat.php';         
    include './model-pages/mod_CheckUser.php';

?>    

<!-- Page specific script -->
<script src="js/mod_BreakDownCreate.js"></script>
<script src="js/mod_WoDetails.js"></script>
<script src="js/mod_WoClose.js"></script>
<script src="js/mod_WoAllocate.js"></script>
<script src="js/mod_WoCheckIn.js"></script>
<script src="js/mod_PlannedMaintenanceCreate.js"></script>
<script src="js/mod_RedTagCreate.js"></script>
<script src="js/mod_BuildingMaintenanceCreate.js"></script>
<script src="js/mod_OtherProjectCreate.js"></script>
<script src="js/mod_CheckUser.js"></script>
<script src="js/mod_WoVerify.js"></script>
<script src="js/mod_WoReOpen.js"></script>
<script src="js/mod_WoChat.js"></script>
<script src="js/mod_WoDelete.js"></script>

<script>    
    var i;
    var j;
    
    var dtbl1;
    var dtbl2;
    var dtbl3;
    var strReceiptNo    = "0";
    //var intDebugEnable  = "1";
    //------------- MQTT Settings ------------------
    var mqtt;
    var reconnectTimeout = 2000;
    //var host="178.128.30.122";       // Noyon PORT 9001
    var host="mmsnoyon.com";       // Noyon PORT 9001
    var strPublishTopic = "TST/SVR1760A";
    //var host="localhost";
    //var port=9001;
    var port=8883;
    var intMqttState = 0;
    
    //------------- PHP Session Variable to JS variables ---------------------     
    var SESSION_CurrentUserName     = "<?php echo htmlspecialchars($_SESSION["user_name"]); ?>";
    var SESSION_CurrentUserEPF      = "<?php echo htmlspecialchars($_SESSION["user_epf"]); ?>";
    var SESSION_CurrentUserContact      = "<?php echo htmlspecialchars($_SESSION["user_contactno"]); ?>";
    var SESSION_CurrentUserDepartment   = "<?php echo htmlspecialchars($_SESSION["user_department"]); ?>";      
    var SESSION_CurrentUserType   = "<?php echo htmlspecialchars($_SESSION["user_type"]); ?>";
          
          
    var roll_areas_ary      = <?php echo json_encode($roll_areas); ?>;
    var roll_other_ary      = <?php echo json_encode($roll_other); ?>;
           
    var strNextModelID = "NA";
    //alert(roll_areas_ary);
    //alert(roll_other_ary);
    var JS_SessionArry = [];
    var tmpDataAry  =   {
                            WorkOrderNo: 'NA',
                            LoggingUserName: SESSION_CurrentUserName,
                            LoggingUserEPF: SESSION_CurrentUserEPF,
                            LoggingUserContact: SESSION_CurrentUserContact,
                            LoggingUserDepartment: SESSION_CurrentUserDepartment,
                            LoggingUserType: SESSION_CurrentUserType,                            
                            CurrentUserName: SESSION_CurrentUserName,
                            CurrentUserEPF: SESSION_CurrentUserEPF,
                            CurrentUserContact: SESSION_CurrentUserContact,
                            CurrentUserDepartment: SESSION_CurrentUserDepartment,
                            CurrentUserType: SESSION_CurrentUserType,
                            WorkOrderDepartment: "NA",
                            WorkOrderCategory: "NA",
                            NextModelID: 'NA',
                            NextFunctionName: 'NA',
                            WorkOrderStatus: 'NA',
                            WorkOrderVerify: 'NA'
                        };
    JS_SessionArry.push(tmpDataAry);
    
    //alert(JS_SessionArry[0].CurrentUserName);
    //-------- Other Variables ---------------------------
    let employeeData = [];          // use for Allocate/Deallocate tables
    // JavaScript code for automatic scrolling of the dashboard
    const scrollSpeed = 30; // Adjust scrolling speed as needed
    const cardContainer = document.getElementById('id_AndonDashboard');

    $(function () 
    {        
        // Start automatic scrolling Andon Dashboard 
        autoScroll();  
        //Date and time picker
        $('#ModOtherProjectCre_dtmDateTime').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            icons: { time: 'far fa-clock' } 
        });
        //------------ Hide home Details, When MC Login -----------------------
        if(roll_other_ary.includes("90012"))
        {
            //alert("90012 Available");
            //var hiddenDiv = document.getElementById('id_homeDetails');
            //hiddenDiv.style.display = 'none';
            document.getElementById('id_homeDetails').style.display         = 'none';
            document.getElementById('id_homeDetails_line').style.display    = 'none';
            document.getElementById('id_AndonDashboard_line').style.display = 'none';
        }
        else 
        {
            //alert("90012 not Available");
        }
        //
        //----------------------------------------------------------------------
        //Initialize Select2 Elements
        $('.select2').select2({ closeOnSelect: true});
        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4', closeOnSelect: true
        });  
         //alert("Hooi");
        //------------ Home DataTable Initialize -------------------
        let intTableHeight = 160;
        if(roll_other_ary.includes("90012")){intTableHeight = 400;}

        $("#example1").DataTable({
            "columnDefs": [
                { "width": "2%", "targets": 0 }, // No
                { "width": "9%", "targets": 1 }, // WO
                { "width": "10%", "targets": 2 }, // Time
                { "width": "10%", "targets": 3 }, // Department
                { "width": "12%", "targets": 4 }, // By 
                { "width": "10%", "targets": 5 }, // Category
                { "width": "33%", "targets": 6 }, // Description (set width to 20%)
                { "width": "7%", "targets": 7 }, // Status               
                { "width": "7%", "targets": 8 }   // ReOpen
            ],
            "paging": false,
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false, 
            "scrollX": true,
            "scrollY": intTableHeight,
            "info": false, 
            "rowCallback" : funCellCreated,
            "dom": "lrti",
            "order": [[0, 'desc']]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        //--------- Make Descendin order -----------------------
         //$('#example1').DataTable({ "order": [[0, 'desc']] });
        //$("#example1").DataTable({
        //    "responsive": true, "lengthChange": false, "autoWidth": false,
        //    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        //}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        dtbl1 = $('#example1').DataTable();    
        
        //--- Load Tables --------------------------------------   
        funLoad_WoTableFilterDepData();
        funRefresh_DowntimeDashboard();
        funRefresh_MechanicDashboard();        
        funRefresh_Last30DaySummary();
        funRefresh_TodaySummary();
        funRefresh_Chart();
        //funRefresh_WoTable();
        MQTTconnect();
        funAutoVerifyWo();
    }); 
    $('#myCustomSearchBox').keyup(function() 
    {
        dtbl1.search($(this).val()).draw(); // this  is for customized searchbox with datatable search feature.
    });
    $('[data-widget="pushmenu"]').PushMenu("collapse");    
    function funCellCreated(row, data, index) 
    {     
        //alert("Test cell created");
        var strCellStatus  = data[7];
        if (strCellStatus === "New")                {$(row).css('background-color', 'orange');}
        else if (strCellStatus === "Inprogress")    {$(row).css('background-color', 'lightblue');}
        else       {$(row).css('background-color', 'lightgreen');}                     

        //$(row).find('td:eq(4)').css('background-color', data[1]);
        //$(row).find('td:eq(5)').css('background-color', data[2]);
        //$(row).find('td:eq(6)').css('background-color', data[3]);        
        //if(data[3]> 420)    $(row).find('td:eq(3)').css('background-color', data[4]);       
    }
    $('#example1 tbody').on('click', 'tr', function () 
    {        
        const table2 = new DataTable('#example1');
        table2.on('click', 'tbody tr', (e) => 
        {
            
            let classList = e.currentTarget.classList;
            //if (classList.contains('selected')) 
            //{
            //    //classList.remove('selected');
           // }
           // else 
           // {
                table2.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
                classList.add('selected');          
                funWoTableRowClicked();
            //}            
        });        
    });
    // Function to automatically scroll the dashboard container
    function autoScroll() 
    {
        if (cardContainer.scrollWidth > cardContainer.clientWidth) 
        {
            const cardWidth = 150; // Adjust as needed
            const totalWidth = cardContainer.scrollWidth;
            const remainingWidth = totalWidth - cardContainer.scrollLeft - cardContainer.clientWidth;
            if (remainingWidth > 0) 
            {
                cardContainer.scrollLeft += 1; // Adjust scrolling direction and speed as needed
                setTimeout(autoScroll, scrollSpeed); // Repeat the scrolling process
            }
            else 
            {
                // Reset scroll position to the beginning to create continuous scrolling effect
                cardContainer.scrollLeft = 0;
                setTimeout(autoScroll, 1000); // Wait for 1 second before restarting scrolling
            }
        }
        else 
        {
            // No scrolling needed, wait for 1 second before checking again
            setTimeout(autoScroll, 1000);
        }
    }
    //$('#button').click(function () 
    //{
    //    var table = $('#example1').DataTable();
    //    alert(table.rows('.selected').data().length + ' row(s) selected');
    //});
    // Update the count down every 1 second
    var x = setInterval(function() 
    {
        //alert("Timer running..");
        //-------------- Show Time -------------------------------------------------
        //var today = new Date();
        //var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        //var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        //document.getElementById("id_datetime").innerHTML = date+' '+time;
        //--------------- Update Data ----------------------------------------------
        //------------ Refresh Home Page Parts ----------------------
        if(roll_other_ary.includes("90013"))
        {
            //alert("Location : 90013");  
            if(roll_other_ary.includes("9001311"))
            {
                //alert("Location : 9001311"); 
                funRefresh_DowntimeDashboard();
            }
            if(roll_other_ary.includes("9001312"))
            {
                //alert("Location : 9001312"); 
                funRefresh_MechanicDashboard();  
            }
            if(roll_other_ary.includes("9001313"))
            {
                //alert("Location : 9001313"); 
                funRefresh_Last30DaySummary();
            }
            if(roll_other_ary.includes("9001314"))
            {
                //alert("Location : 9001314"); 
                funRefresh_TodaySummary();
            }
            if(roll_other_ary.includes("9001315"))
            {
                //alert("Location : 9001315"); 
                funRefresh_Chart();
            }
            if(roll_other_ary.includes("9001316"))
            {
                //alert("Location : 9001316"); 
                funRefresh_WoTable();
            }
        }     

        //alert(JS_SessionArry[0].CurrentUserType);  
        //if(JS_SessionArry[0].CurrentUserType === "productionuser")   
        //{
        //    funRefresh_WoTable();
        //}
        
    }, 5000); 
    
    //function showAlert(button)
    //{
    //    alert("Test");
    //}
     //-------------------- Refresh Home Chart -------------------
    function funRefresh_Chart() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("funRefresh_Chart");     
        //const DataAry = [];
        //-------------- Update Home page Chart ---------------------------------------------
        var vblSendPara =  "1234"; 
        $.post('class/getData_HomeChart.php', { userpara: vblSendPara }, function(json_data2) 
        {
            if(intDebugEnable === 1)    alert("json_data2" + json_data2);           
            var res = $.parseJSON(json_data2);        
            //const varDate = ["08/12/2023", "09/12/2023", "10/12/2023","12/12/2023", "14/12/2023", "16/12/2023","17/12/2023", "19/12/2023", "20/12/2023"];
            //const varWoCount = [10,18,11,20,23,19,16,21,11];  
            
            var varDate           = new Array();
            var varWoCount  = new Array();
            
            varDate      = res.Date_Ary;          
            varWoCount   = res.TotPlacedWorkOrders_Ary;              
            //-------------------------------------------------------------
            //- BAR CHART:1 - Line Wise Downtime Summary  
            //-------------------------------------------------------------     
            document.getElementById("Id_DivBarChart_1").innerHTML = '&nbsp;';
            document.getElementById("Id_DivBarChart_1").innerHTML = '<canvas id="id_barChart_1" style="height: 200px; max-width: 120%;"></canvas>';
            var barChartCanvas = document.getElementById('id_barChart_1').getContext('2d');

            var barChart1_Data = {
                labels: res.Date_Ary,
                datasets: [
                {
                    label: 'Placed Work Orders',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: res.TotPlacedWorkOrders_Ary
                }, 
                {
                    label: 'Completed Work Orders',
                    backgroundColor: 'rgba(210, 44, 44, 0.9)',
                    borderColor: 'rgba(210, 44, 44, 0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(210, 44, 44, 1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(210, 44, 44, 1)',
                    data: res.CompletedWorkOrders_Ary
                }, 
                {
                    label: 'Placed Breakdown',
                    backgroundColor: 'rgba(255, 153, 0, 0.9)',
                    borderColor: 'rgba(255, 153, 0, 0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(255, 153, 0, 1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(255, 153, 0, 1)',
                    data: res.TotPlacedBreakDown_Ary
                },                 
                {
                    label: 'Completed Breakdown',
                    backgroundColor: 'rgba(0, 128, 0, 0.9)', // Adjust color as needed
                    borderColor: 'rgba(0, 128, 0, 0.8)', // Adjust color as needed
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(0, 128, 0, 1)', // Adjust color as needed
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(0, 128, 0, 1)', // Adjust color as needed
                    data: res.CompletedBreakDown_Ary
                },                 
                {
                    label: 'Total Breakdown Duration',
                    backgroundColor: 'rgba(128, 0, 128, 0.9)', // Adjust color as needed
                    borderColor: 'rgba(128, 0, 128, 0.8)', // Adjust color as needed
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(128, 0, 128, 1)', // Adjust color as needed
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(128, 0, 128, 1)', // Adjust color as needed
                    data: res.TotalBreakDownDuration_Ary
                }
             
                ]    
            };

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false,
                chartArea: { backgroundColor: 'rgba(255, 0, 0, 0.1)' }, // Change the background color of the chart area
                scales: {
                    yAxes: [{
                        ticks: {
                            fontSize: 8 // Adjust the font size for y-axis ticks
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            fontSize: 8 // Adjust the font size for x-axis ticks
                        }
                    }]
                }    
            };

            new Chart(barChartCanvas, {
                type: 'line',
                data: barChart1_Data,
                options: barChartOptions
            });
        });
    }
    //-------------------- Refresh Home Downtime Summary -----------------
    function funRefresh_Last30DaySummary() 
    {
        //alert("Refresh Downtime Summary");
        //var formattedTime; 
        const DataAry = []; 
        //----------------- Home Downtime Summary-----------------------------------        
        DataAry[0] = "funGet_Summary_Last30";        // Function Name    
        DataAry[1] = "NA";
        //alert(DataAry);    
        $.post('class/getData_HomeSummary.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2); 
            var res = $.parseJSON(json_data2);   
            
            if(res.Status_Ary[0] === "true")
            {
                document.getElementById("id_Home_NoOfTotBreakDown_30day").innerHTML     = " :   " + res.Data_Ary[0];
                document.getElementById("id_Home_TotBreakDownDuration_30day").innerHTML = " :   " + convertMinutesToTime(res.Data_Ary[1]); 
                document.getElementById("id_Home_AveBreakDownTime_30day").innerHTML     = " :   " + convertMinutesToTime((parseInt(res.Data_Ary[1])/parseInt(res.Data_Ary[0])).toFixed(0));
                document.getElementById("id_Home_TotAttnDelay_30day").innerHTML         = " :   " + convertMinutesToTime(res.Data_Ary[2]);
                document.getElementById("id_Home_AveAttnTime_30day").innerHTML          = " :   " + convertMinutesToTime((parseInt(res.Data_Ary[2])/parseInt(res.Data_Ary[0])).toFixed(0));
                document.getElementById("id_Home_TotWoPlaced_30day").innerHTML          = " :   " + res.Data_Ary[3];
                document.getElementById("id_Home_TotCmpltdWo_30day").innerHTML          = " :   " + res.Data_Ary[4];
            }                  
        });
    }
    //-------------------- Refresh Home Work Order Summary -----------------
    function funRefresh_TodaySummary() 
    {
        const DataAry = []; 
        //----------------- Home Downtime Summary-----------------------------------        
        DataAry[0] = "funGet_Summary_Today";        // Function Name    
        DataAry[1] = "NA";
        //alert(DataAry);    
        $.post('class/getData_HomeSummary.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2); 
            var res = $.parseJSON(json_data2);   
            if(res.Status_Ary[0] === "true")
            {
                document.getElementById("id_Home_NoOfTotBreakDown_Today").innerHTML     = " :   " + res.Data_Ary[0];
                document.getElementById("id_Home_TotBreakDownDuration_Today").innerHTML = " :   " + convertMinutesToTime(res.Data_Ary[1]);
                if(parseInt(res.Data_Ary[0]) !== 0)
                {
                    document.getElementById("id_Home_AveBreakDownTime_Today").innerHTML     = " :   " + convertMinutesToTime((parseInt(res.Data_Ary[1])/parseInt(res.Data_Ary[0])).toFixed(0));
                    document.getElementById("id_Home_TotAttnDelay_Today").innerHTML         = " :   " + convertMinutesToTime(res.Data_Ary[2]);
                    document.getElementById("id_Home_AveAttnTime_Today").innerHTML          = " :   " + convertMinutesToTime((parseInt(res.Data_Ary[2])/parseInt(res.Data_Ary[0])).toFixed(0));
                
                }
               else
               {
                    document.getElementById("id_Home_AveBreakDownTime_Today").innerHTML  = " : - ";
                    document.getElementById("id_Home_TotAttnDelay_Today").innerHTML      = " :   " + convertMinutesToTime(res.Data_Ary[2]);
                    document.getElementById("id_Home_AveAttnTime_Today").innerHTML       = " : - ";
               }
                
                document.getElementById("id_Home_TotWoPlaced_Today").innerHTML          = " :   " + res.Data_Ary[3];
                if(res.Data_Ary[4] !== null)
                {
                    document.getElementById("id_Home_TotCmpltdWo_Today").innerHTML          = " :   " + res.Data_Ary[4];
                }
                else
                {
                    document.getElementById("id_Home_TotCmpltdWo_Today").innerHTML          = " : - ";
                }
                
            }                     
        });  
    }
    //-------------------- Refresh Home Table -------------------
    function funRefresh_WoTable() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("funRefresh_WoTable");
        
        //alert("Refresh page..");      
        const DataAry = []; 
        DataAry[0] = "funGetFilteredData";        // Function Name    
        //DataAry[1] = "1";
        DataAry[2] = "WoDepartment";
        DataAry[3] = JS_SessionArry[0].CurrentUserDepartment;       //"pneumatic";  
        //alert("Current User Dep :" + DataAry[3]);
        document.getElementById("id_funHome_SelDepartmentFilter").value = DataAry[3];
        if(DataAry[3] === "Engineering")
        {
            DataAry[1] = "0";       // All data
        }
        else
        {
            DataAry[1] = "1";       // Filtered Data
        }
        if(intDebugEnable === 1)    alert("DataAry : " + DataAry);
        //-------------- Update Home page WO Table ---------------------------------------------
        $.post('class/getData_HomeTable.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1)    alert("json_data2 : " + json_data2); 
            var res = $.parseJSON(json_data2);   
            if(res.Status_Ary[0] === "true")
            {
                let intRecCount     = res.Data_Ary.length; 
                let strWoDepartment = "";
                //alert(intRecCount);     
                dtbl1.clear().draw();            
                for(i=0; i<intRecCount; i++)
                {       
                    //if(intDebugEnable === 1)    alert("intRecCount : " + intRecCount);
                    let intX = i+1;
                    let strWoCategory   = res.Data_Ary[i][4];
                    let strDescription  = "";
                    
                    if(strWoCategory === "BreakDown")
                    {
                        //alert("Breakdown");
                        strDescription = res.Data_Ary[i][6] + " (" +res.Data_Ary[i][7] + ")";
                    }
                    else if(strWoCategory === "PlanMaintenance")
                    {
                        //alert("PlanMaintenance");
                        strDescription = res.Data_Ary[i][6] + " (" +res.Data_Ary[i][9] + ")";
                        //strDescription = res.Data_Ary[i][9];
                    }  
                    else if(strWoCategory === "RedTag")
                    {
                        //alert("RedTag");
                        strDescription = res.Data_Ary[i][6] + " (" +res.Data_Ary[i][9] + ")";
                        //strDescription = res.Data_Ary[i][9];
                    }  
                    else if(strWoCategory === "BuildingMaintenance")
                    {
                        //alert("BuildingMaintenance");
                        strDescription = res.Data_Ary[i][9];
                    }  
                    else if(strWoCategory === "OtherProject")
                    {
                        //alert("OtherProject");
                        strDescription = res.Data_Ary[i][5] + " (" +res.Data_Ary[i][9] + ")";
                    }
                    else        // Error Wo CAtegory not found
                    {
                        alert("Wo Category not found");
                        writeToLogFile("Home Table: Wo Category not found");
                    }  
                    //------------------ Chat and Department ----------------------
                    //if(intDebugEnable === 1)    alert("res.Data_Ary[i][13] : " + res.Data_Ary[i][13]);
                    if(Number(res.Data_Ary[i][13]) === 0) 
                    {
                        strWoDepartment = res.Data_Ary[i][2];
                    }
                    else 
                    {
                        strWoDepartment = '<i class="far fa-envelope"></i> ' + res.Data_Ary[i][2];
                    }
                    //alert(strDescription); 
                    //dtbl1.row.add([IDAry[i], WorkOrderNoAry[i], WoDepartmentAry[i] , CreatedDateTimeAry[i], WorkOrderCategoryAry[i], WoDescriptionAry[i], CreatedUserAry[i], WoStatusAry[i],WoVerifyAry[i], WoReOpenAry[i]]).draw(false);
                   
                    dtbl1.row.add([
                        intX, 
                        res.Data_Ary[i][1],
                        res.Data_Ary[i][3].substring(2, 16), 
                        strWoDepartment, 
                        res.Data_Ary[i][8],
                        res.Data_Ary[i][4], 
                        strDescription, 
                        res.Data_Ary[i][10],
                        res.Data_Ary[i][12]
                    ]).draw(false);
                } 
            }
            else
            {
                dtbl1.clear().draw(); 
                //alert("Data not found..");
                // success, error, warning, info, question
                Swal.fire({title: 'Wait.!',text: 'No data found.',icon: 'info', confirmButtonText: 'OK'});
            }
                     
        });
         
        //---------------- Home WorkOrder Summary ------------------------
        
    }       
    //----------- fun Back Button Cliked  ----------------------------------
    function funClickedEditBack()
    {
        setTimeout(window.close, 10);
        window.open("./index.php");
    }
    //----------- fun Refresh All Areas ---------------------------------
    function funRefresh_HomePage()
    {
        funRefresh_DowntimeDashboard();
        funRefresh_MechanicDashboard();        
        funRefresh_Last30DaySummary();
        funRefresh_TodaySummary();
        funRefresh_Chart();
        funRefresh_WoTable();
    }
    //-------------------- Model : Edit Update Clicked -------------------------
    function funClickedModBreakdownStatusUpdate() 
    {
        //alert("Model Breakdown State Change Clicked");   
        const DataAry = []; 
        DataAry[0] = document.getElementById("id_mod_breakdown_WoNo").value;        
        DataAry[1] = document.getElementById("id_mod_breakdown_dt").value;        
        DataAry[2] = document.getElementById("id_mod_breakdown_note").value;
        DataAry[3] = document.getElementById("id_mod_breakdown_WoStatus").value;        
        //alert(DataAry);          
       
        //var vblSendPara =  "1234"; 
        $.post('class/updateData_WoBreakDownState.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2);           
            var res = $.parseJSON(json_data2);
            //alert(res);
            //alert(res[0]); 
            //alert(res[1]);   
            if(intMqttState === 1)
            {
                message = new Paho.MQTT.Message("{\"MacAdd\":\"E8:9F:6D:92:D3:0D\",\"MsgType\":\"BrkdwnEvent\",\"IPAdd\":\"192.168.1.105\",\"UserName\":\"Kelum\",\"ModelNo\":\"DCS-1507A_UI\",\"ManufacDate\":\"16/12/2023\",\"EventNo\":\"1\",\"PwrOnCount\":\"0\",\"RunTime\":\"0\",\"FrameworkVer\":\"DCS-1507A_Frm3\",\"SoftVer\":\"8.0\",\"SigStrength\":\"-36\"}");
                message.destinationName = strPublishTopic;
                mqtt.send(message);
            }
            else
            {
                //alert("Fail Connecting with server");
                Swal.fire({
                            title: 'Alert !!',
                            text: 'Fail Connecting with server.',
                            icon: 'Warning', // success, error, warning, info, question
                            confirmButtonText: 'OK'
                        });
            }    
            //var AryCustomOrder = new Array();
            //AryCustomOrder = res.CustomOrderAry;
            //document.getElementById("id_status").value = res[1];
        }); 
        //alert("Data Updated successfully.");
               
        var varmodbox = document.getElementById("id_mod_breakdown_statechange");
        varmodbox.style.display = "none";        
        funRefresh_WoTable();
        
    }
    function onMqttConnect() 
    {
        // Once a connection has been made, make a subscription and send a message.
        console.log("Connected ");
        //mqtt.subscribe("sensor1");
        //message = new Paho.MQTT.Message("{\"MacAdd\":\"E8:9F:6D:92:D3:0D\",\"MsgType\":\"PwrOn\",\"IPAdd\":\"192.168.1.105\",\"UserName\":\"Kelum\",\"ModelNo\":\"DCS-1507A_UI\",\"ManufacDate\":\"29/04/2022\",\"EventNo\":\"1\",\"PwrOnCount\":\"0\",\"RunTime\":\"0\",\"FrameworkVer\":\"DCS-1507A_Frm3\",\"SoftVer\":\"8.0\",\"SigStrength\":\"-36\"}");
        //message = new Paho.MQTT.Message("{\"MacAdd\":\"E8:9F:6D:92:D3:0D\",\"MsgType\":\"PwrOn\"}");
        message = new Paho.MQTT.Message("{\"MacAdd\":\"E8:9F:6D:92:D3:0D\",\"MsgType\":\"PwrOn\",\"IPAdd\":\"192.168.1.105\",\"UserName\":\"Kelum\",\"ModelNo\":\"DCS-1507A_UI\",\"ManufacDate\":\"29/04/2022\",\"EventNo\":\"1\",\"PwrOnCount\":\"0\",\"RunTime\":\"0\",\"FrameworkVer\":\"DCS-1507A_Frm3\",\"SoftVer\":\"8.0\",\"SigStrength\":\"-36\"}");
        message.destinationName = strPublishTopic;
        mqtt.send(message);
        intMqttState = 1;
    }
    function MQTTconnect()
    {
        console.log("connecting to "+ host +" "+ port);
        var x=Math.floor(Math.random() * 10000); 
        var cname="orderform-"+x;
        mqtt = new Paho.MQTT.Client(host,port,cname);
        //document.write("connecting to "+ host);
        var options = {useSSL: true, timeout: 3,onSuccess: onMqttConnect};  		 
        mqtt.connect(options); //connect
    }
    //--------------------- Downtime Dashboard (100-11) ----------------------   
    function funRefresh_DowntimeDashboard()
    {
        //alert("Update Home Downtime Dashboard");
        if(!roll_areas_ary.includes('10011'))
        {
            //alert("Remove Andon Dashboard");
        }
        else
        {
            //alert("true");              
            var RunDT_IDAry           = new Array();
            var RunDT_MachineNoAry    = new Array();
            var RunDT_DowntimeAry     = new Array();

            var AttnDT_IDAry          = new Array();
            var AttnDT_MachineNoAry   = new Array();
            var AttnDT_DowntimeAry    = new Array();
            var RepDT_DowntimeAry    = new Array();
            var TotDT_DowntimeAry    = new Array();

            //let intRunDtRecCount = 0;
            var strText = "";
            //-------------- Update Home page Running Downtime Dashboard ---------------------------------------------

            var vblSendPara =  "1234"; 
            $.post('class/getData_HomeDtDashboard.php', { userpara: vblSendPara }, function(json_data2) 
            {
                //alert(json_data2);  
                var res = $.parseJSON(json_data2);
                //alert(json_data2); 

                RunDT_IDAry            = res.RunDT_ID_Ary;   
                RunDT_MachineNoAry     = res.RunDT_MachineNo_Ary;
                RunDT_DowntimeAry      = res.RunDT_RunDowntime_Ary;

                AttnDT_IDAry           = res.AttnDT_ID_Ary;   
                AttnDT_MachineNoAry    = res.AttnDT_MachineNo_Ary;
                AttnDT_DowntimeAry     = res.AttnDT_Downtime_Ary;
                RepDT_DowntimeAry      = res.RepDT_Downtime_Ary;
                TotDT_DowntimeAry      = res.TotDT_Downtime_Ary;

                let intRunDtRecCount = RunDT_IDAry.length; 
                let intAttnDtRecCount = AttnDT_IDAry.length; 
                //------------------- New Dashboard ------------------------
                  // Select the element by its ID
                var dashboardElement = document.getElementById('id_AndonDashboard');
                // Add the style attributes
                dashboardElement.style.width = "100%";
                dashboardElement.style.height = "120px";
                dashboardElement.style.overflow = "hidden";
                dashboardElement.style.whiteSpace = "nowrap";
                                
                //const cardContainer = document.getElementById('id_AndonDashboard');
                const cardContainer_head = document.getElementById('id_AndonDashboard_head');
                // Append cards dynamically (replace this with your actual card data)
                cardContainer_head.innerHTML ="<div>" +
                                   "<div style=\"width: 120px; height: 110px \">" +
                                       "<center><h6 id=\"id_mcnumber_"     + i + "\">" + "." + "</h6></center>" +
                                       "<center><h6 id=\"id_mcreptime_"    + i + "\">" + "Repair Time"  + "</h6></center>" +
                                       "<center><h6 id=\"id_mcattntime_"   + i + "\">" + "Attend Time"  + "</h6></center>" +
                                       "<center><h6 id=\"id_mcdowntime_"   + i + "\">" + "Downtime"  + "</h6></center>" +
                                   "</div></div>";
                //alert("intRunDtRecCount" + intRunDtRecCount);
                //alert("intAttnDtRecCount" + intAttnDtRecCount);                
                cardContainer.innerHTML = "";                  
                for (i = 1; i < intRunDtRecCount; i++) 
                {
                    cardContainer.innerHTML += "<div style='width: 150px;height: 110px;display: inline-block; margin-right: 10px; background-color: red; border: 1px solid #ccc;'>" + 
                        "<marquee behavior='scroll' direction='left' scrollamount='3'><center><h6 id=\"id_mcnumber_" + i + "\">" + RunDT_MachineNoAry[i] + "</h6></center></marquee>"  +
                        "<center><h6 id=\"id_mcreptime_"    + i + "\">" + "-"  + "</h6></center>" +
                        "<center><h6 id=\"id_mcattntime_"   + i + "\">" + "-"  + "</h6></center>" +
                        "<center><h6 id=\"id_mcdowntime_"   + i + "\">" + RunDT_DowntimeAry[i]  + "</h6></center>" +
                        "</div>";
                }
                for (i = 1; i < intAttnDtRecCount; i++) 
                {
                    cardContainer.innerHTML += "<div style='width: 150px;height: 110px;display: inline-block; margin-right: 10px; background-color: lightgreen; border: 1px solid #ccc;'>" + 
                        "<marquee behavior='scroll' direction='left' scrollamount='3'><center><h6 id=\"id_mcnumber_" + i + "\">" + AttnDT_MachineNoAry[i] + "</h6></center></marquee>"  +
                        "<center><h6 id=\"id_mcreptime_"    + i + "\">" + RepDT_DowntimeAry[i]  + "</h6></center>" +
                        "<center><h6 id=\"id_mcattntime_"   + i + "\">" + AttnDT_DowntimeAry[i]  + "</h6></center>" +
                        "<center><h6 id=\"id_mcdowntime_"   + i + "\">" + TotDT_DowntimeAry[i]  + "</h6></center>" +
                        "</div>";
                }
                //alert("Update DT Dashboard Finised");
            });
        }
    }
    function funHome_SelDepartmentFilter()
    {
        //alert("Department Filter...");
        const DataAry = []; 
        DataAry[0] = "funGetFilteredData";        // Function Name    
        //DataAry[1] = "1";
        DataAry[2] = "WoDepartment";
        DataAry[3] = document.getElementById("id_funHome_SelDepartmentFilter").value;       //"pneumatic";  
        if(DataAry[3] === "All")
        {
            DataAry[1] = "0";       // All data
        }
        else
        {
            DataAry[1] = "1";       // Filtered Data
        }
        //alert(DataAry);
        //-------------- Update Home page WO Table ---------------------------------------------
        $.post('class/getData_HomeTable.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2); 
            var res = $.parseJSON(json_data2);   
            if(res.Status_Ary[0] === "true")
            {
                let intRecCount     = res.Data_Ary.length; 
                let strWoDepartment = "";
                //alert(intRecCount);     
                dtbl1.clear().draw();            
                for(i=0; i<intRecCount; i++)
                {       
                    let intX = i+1;
                    let strWoCategory   = res.Data_Ary[i][4];
                    let strDescription  = "";
                    if(strWoCategory === "BreakDown")
                    {
                        //alert("Breakdown");
                        strDescription = res.Data_Ary[i][6] + " (" +res.Data_Ary[i][7] + ")";
                    }
                    else if(strWoCategory === "PlanMaintenance")
                    {
                        //alert("PlanMaintenance");
                        strDescription = res.Data_Ary[i][9];
                    }  
                    else if(strWoCategory === "RedTag")
                    {
                        //alert("RedTag");
                        strDescription = res.Data_Ary[i][9];
                    }  
                    else if(strWoCategory === "BuildingMaintenance")
                    {
                        //alert("BuildingMaintenance");
                        strDescription = res.Data_Ary[i][9];
                    }  
                    else if(strWoCategory === "OtherProject")
                    {
                        //alert("OtherProject");
                        strDescription = res.Data_Ary[i][5] + " (" +res.Data_Ary[i][9] + ")";
                    }
                    else        // Error Wo CAtegory not found
                    {
                        alert("Wo Category not found");
                        writeToLogFile("Home Table: Wo Category not found");
                    } 
                    //------------------ Chat and Department ----------------------
                    if(Number(res.Data_Ary[i][13]) === 0) {
                       strWoDepartment = res.Data_Ary[i][2];
                    }
                    else {
                       strWoDepartment = '<i class="far fa-envelope"></i> ' + res.Data_Ary[i][2];
                    }
                    //alert(strDescription); 
                    //dtbl1.row.add([IDAry[i], WorkOrderNoAry[i], WoDepartmentAry[i] , CreatedDateTimeAry[i], WorkOrderCategoryAry[i], WoDescriptionAry[i], CreatedUserAry[i], WoStatusAry[i],WoVerifyAry[i], WoReOpenAry[i]]).draw(false);
                    dtbl1.row.add([intX, res.Data_Ary[i][1],res.Data_Ary[i][3].substring(2, 16), strWoDepartment, res.Data_Ary[i][8], res.Data_Ary[i][4], strDescription, res.Data_Ary[i][10],res.Data_Ary[i][11], res.Data_Ary[i][12]]).draw(false);
                } 
            }
            else
            {
                dtbl1.clear().draw(); 
                Swal.fire({title: 'Wait.!',text: 'No data found.',icon: 'info', confirmButtonText: 'OK'});
                //alert("Data not found..");
            }                     
        });
    }
    //--------------------- Mechanic Dashboard (100-12) ----------------------   
    function funRefresh_MechanicDashboard()
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("funRefresh_MechanicDashboard");
        
        
        //alert("Update Mechanic Dashboard");
        if(!roll_areas_ary.includes('10012'))
        {
            //alert("Remove Mechanic Dashboard");
            document.getElementById('id_McDashboard').style.display         = 'none';
            document.getElementById('id_McDashboard_line').style.display    = 'none';
            //document.getElementById('id_AndonDashboard_line').style.display = 'none';            
        }
        else
        {
            //if(intDebugEnable === 1) alert("Mechanic Dashboard Working");  
            const DataAry = [];
            DataAry[0] = "funGetMcDashboardData";               // Function Name    
            DataAry[1] = JS_SessionArry[0].CurrentUserEPF;      // User EPF
            //DataAry[2] = startTime;            
            //-------------- Find Current Shift ------------------------------------
            // Retrieve the current date and time
            var currentDate = new Date();
            var currentHour = currentDate.getHours();
            if (currentHour >= 7 && currentHour < 19) 
            {
                const startDate = new Date();
                startDate.setHours(7, 0, 0, 0); // Change only the time part to 07:00:00
                startDate.setHours(startDate.getHours() + 5); // Add 5 hours
                startDate.setMinutes(startDate.getMinutes() + 30); // Add 30 minutes

                const endDate = new Date(startDate.getTime() + (12 * 60 * 60 * 1000)); // Add 12 hours  
                DataAry[2] = startDate.toISOString().slice(0, 16);
                DataAry[3] = endDate.toISOString().slice(0, 16);
            }
            else 
            {
                const startDate = new Date();
                startDate.setHours(19, 0, 0, 0); // Change only the time part to 07:00:00
                startDate.setHours(startDate.getHours() + 5); // Add 5 hours
                startDate.setMinutes(startDate.getMinutes() + 30); // Add 30 minutes

                const endDate = new Date(startDate.getTime() + (12 * 60 * 60 * 1000)); // Add 12 hours 
                DataAry[2] = startDate.toISOString().slice(0, 16);
                DataAry[3] = endDate.toISOString().slice(0, 16);
            }
         
            //if(intDebugEnable === 1) alert("DataAry" +DataAry); 
            $.post('class/getData_HomeMcDashboard.php', { userpara: DataAry }, function(json_data2) 
            {
                //alert(json_data2); 
                //if(intDebugEnable === 1) alert("json_data2" + json_data2); 
                var res = $.parseJSON(json_data2);   

                if(res.Status_Ary[0] === "true")
                {
                    if(intDebugEnable === 1) alert("res.Status_Ary[0]" + res.Status_Ary[0]);
                    
                    document.getElementById("id_McDashboard_NoOfAsgnJob_value").innerHTML   = res.Data_Ary[0];
                    document.getElementById("id_McDashboard_NoOfCmplt_value").innerHTML     = res.Data_Ary[1];
                    document.getElementById("id_McDashboard_TotChkTime_value").innerHTML    = res.Data_Ary[2];
                    document.getElementById("id_McDashboard_CheckInWoNo_value").innerHTML    = res.Data_Ary[3];
                }                  
            }); 
                   
        }

    }
    //--------------- Auto Veryfy after 24 Hours of closed WO ------------------------
    function funAutoVerifyWo()
    {
        let intDebugEnable = 0;
        
        if(intDebugEnable === 1)    alert("Ato Verify WOs");
        const DataAry = [];  
        DataAry[0] = "funAutoVerify";
        //DataAry[1] = JS_SessionArry[0].WorkOrderNo;        // Table Name
        //DataAry[2] = JS_SessionArry[0].CurrentUserEPF;                 
        //DataAry[3] = JS_SessionArry[0].CurrentUserName;
        //DataAry[4] = JS_SessionArry[0].CurrentUserContact;
        if(intDebugEnable === 1)    alert(DataAry);
        $.post('class/updateData_WoVerify.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1)    alert(json_data2);           
            var res = $.parseJSON(json_data2); 
            if(intDebugEnable === 1)    alert(res.Status_Ary[0]); 
        }); 
    }
    //--------------- When MC click funNoOfAsgnJob ------------------------
    function funNoOfAsgnJob()
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("funNoOfAsgnJob");
        
        const DataAry = []; 
        DataAry[0] = "funGet_NoOfAsgnJob";        // Function Name    
        DataAry[1] = JS_SessionArry[0].CurrentUserEPF;
        
        if(intDebugEnable === 1)    alert("DataAry" + DataAry);
        //-------------- Update Home page WO Table ---------------------------------------------
        $.post('class/getData_HomeTable.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1)    alert("json_data2" + json_data2);
            var res = $.parseJSON(json_data2);              
            if(res.Status_Ary[0] === "true")
            {
                let intRecCount = res.Data_Ary.length; 
                let strWoDepartment = "";
                //alert(intRecCount);     
                dtbl1.clear().draw();            
                for(i=0; i<intRecCount; i++)
                {       
                    let intX = i+1;
                    let strWoCategory   = res.Data_Ary[i][4];
                    let strDescription  = "";
                    if(strWoCategory === "BreakDown")
                    {
                        //alert("Breakdown");
                        strDescription = res.Data_Ary[i][6] + " (" +res.Data_Ary[i][7] + ")";
                    }
                    else if(strWoCategory === "PlanMaintenance")
                    {
                        //alert("PlanMaintenance");
                        strDescription = res.Data_Ary[i][9];
                    }  
                    else if(strWoCategory === "RedTag")
                    {
                        //alert("RedTag");
                        strDescription = res.Data_Ary[i][9];
                    }  
                    else if(strWoCategory === "BuildingMaintenance")
                    {
                        //alert("BuildingMaintenance");
                        strDescription = res.Data_Ary[i][9];
                    }  
                    else if(strWoCategory === "OtherProject")
                    {
                        //alert("OtherProject");
                        strDescription = res.Data_Ary[i][5] + " (" +res.Data_Ary[i][9] + ")";
                    }
                    else        // Error Wo CAtegory not found
                    {
                        alert("Wo Category not found");
                        writeToLogFile("Home Table: Wo Category not found");
                    }   
                    //------------------ Chat and Department ----------------------
                    if(Number(res.Data_Ary[i][13]) === 0) {
                        strWoDepartment = res.Data_Ary[i][2];
                    }
                    else {
                        strWoDepartment = '<i class="far fa-envelope"></i> ' + res.Data_Ary[i][2];
                    }
                    //alert(strDescription); 
                    //dtbl1.row.add([IDAry[i], WorkOrderNoAry[i], WoDepartmentAry[i] , CreatedDateTimeAry[i], WorkOrderCategoryAry[i], WoDescriptionAry[i], CreatedUserAry[i], WoStatusAry[i],WoVerifyAry[i], WoReOpenAry[i]]).draw(false);
                    dtbl1.row.add([intX, res.Data_Ary[i][1],res.Data_Ary[i][3].substring(2, 16), strWoDepartment, res.Data_Ary[i][8], res.Data_Ary[i][4], strDescription, res.Data_Ary[i][10],res.Data_Ary[i][11], res.Data_Ary[i][12]]).draw(false);
                } 
            }
            else
            {
                dtbl1.clear().draw(); 
                Swal.fire({title: 'Wait.!',text: 'No data found.',icon: 'info', confirmButtonText: 'OK'});
                //alert("Data not found..");
            }
            
        });
    }
    //--------------- When MC click funNoOfCmpltJob ------------------------
    function funNoOfCmpltJob()
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("funNoOfCmpltJob");
        
        const DataAry = []; 
        DataAry[0] = "funGet_NoOfCmpltJob";        // Function Name    
        DataAry[1] = JS_SessionArry[0].CurrentUserEPF;
        
        if(intDebugEnable === 1)    alert("DataAry" + DataAry);
        //-------------- Update Home page WO Table ---------------------------------------------
        $.post('class/getData_HomeTable.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1)    alert("json_data2" + json_data2);
            var res = $.parseJSON(json_data2); 

            if(res.Status_Ary[0] === "true")
            {
                let intRecCount = res.Data_Ary.length; 
                let strWoDepartment = "";
                //alert(intRecCount);     
                dtbl1.clear().draw();            
                for(i=0; i<intRecCount; i++)
                {       
                    let intX = i+1;
                    let strWoCategory   = res.Data_Ary[i][4];
                    let strDescription  = "";
                    if(strWoCategory === "BreakDown")
                    {
                        //alert("Breakdown");
                        strDescription = res.Data_Ary[i][6] + " (" +res.Data_Ary[i][7] + ")";
                    }
                    else if(strWoCategory === "PlanMaintenance")
                    {
                        //alert("PlanMaintenance");
                        strDescription = res.Data_Ary[i][9];
                    }  
                    else if(strWoCategory === "RedTag")
                    {
                        //alert("RedTag");
                        strDescription = res.Data_Ary[i][9];
                    }  
                    else if(strWoCategory === "BuildingMaintenance")
                    {
                        //alert("BuildingMaintenance");
                        strDescription = res.Data_Ary[i][9];
                    }  
                    else if(strWoCategory === "OtherProject")
                    {
                        //alert("OtherProject");
                        strDescription = res.Data_Ary[i][5] + " (" +res.Data_Ary[i][9] + ")";
                    }
                    else        // Error Wo CAtegory not found
                    {
                        alert("Wo Category not found");
                        writeToLogFile("Home Table: Wo Category not found");
                    }   
                    //------------------ Chat and Department ----------------------
                    if(Number(res.Data_Ary[i][13]) === 0) {
                        strWoDepartment = res.Data_Ary[i][2];
                    }
                    else {
                        strWoDepartment = '<i class="far fa-envelope"></i> ' + res.Data_Ary[i][2];
                    }
                    //alert(strDescription); 
                    //dtbl1.row.add([IDAry[i], WorkOrderNoAry[i], WoDepartmentAry[i] , CreatedDateTimeAry[i], WorkOrderCategoryAry[i], WoDescriptionAry[i], CreatedUserAry[i], WoStatusAry[i],WoVerifyAry[i], WoReOpenAry[i]]).draw(false);
                    dtbl1.row.add([intX, res.Data_Ary[i][1],res.Data_Ary[i][3].substring(2, 16), strWoDepartment, res.Data_Ary[i][8], res.Data_Ary[i][4], strDescription, res.Data_Ary[i][10],res.Data_Ary[i][11], res.Data_Ary[i][12]]).draw(false);
                } 
            }
            else
            {
                dtbl1.clear().draw(); 
                Swal.fire({title: 'Wait.!',text: 'No data found.',icon: 'info', confirmButtonText: 'OK'});
                //alert("Data not found..");
            }
        });
    }
    //--------------- When MC click funCurrCheckInWo ------------------------
    function funCurrCheckInWo()
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("funCurrCheckInWo");
        
        const DataAry = []; 
        DataAry[0] = "funGet_CurrCheckInWo";        // Function Name    
        DataAry[1] = document.getElementById("id_McDashboard_CheckInWoNo_value").innerHTML;
        
        if(intDebugEnable === 1)    alert("DataAry" + DataAry);
        //-------------- Update Home page WO Table ---------------------------------------------
        $.post('class/getData_HomeTable.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1)    alert("json_data2" + json_data2);
            var res = $.parseJSON(json_data2); 
            
            if(res.Status_Ary[0] === "true")
            {
                let intRecCount = res.Data_Ary.length; 
                //alert(intRecCount);     
                dtbl1.clear().draw();            
                for(i=0; i<intRecCount; i++)
                {       
                    let intX = i+1;
                    let strWoCategory   = res.Data_Ary[i][4];
                    let strDescription  = "";
                    if(strWoCategory === "BreakDown")
                    {
                        //alert("Breakdown");
                        strDescription = res.Data_Ary[i][6] + " (" +res.Data_Ary[i][7] + ")";
                    }
                    else if(strWoCategory === "PlanMaintenance")
                    {
                        //alert("PlanMaintenance");
                        strDescription = res.Data_Ary[i][9];
                    }  
                    else if(strWoCategory === "RedTag")
                    {
                        //alert("RedTag");
                        strDescription = res.Data_Ary[i][9];
                    }  
                    else if(strWoCategory === "BuildingMaintenance")
                    {
                        //alert("BuildingMaintenance");
                        strDescription = res.Data_Ary[i][9];
                    }  
                    else if(strWoCategory === "OtherProject")
                    {
                        //alert("OtherProject");
                        strDescription = res.Data_Ary[i][5] + " (" +res.Data_Ary[i][9] + ")";
                    }
                    else        // Error Wo CAtegory not found
                    {
                        alert("Wo Category not found");
                        writeToLogFile("Home Table: Wo Category not found");
                    }                    
                    //alert(strDescription); 
                    //dtbl1.row.add([IDAry[i], WorkOrderNoAry[i], WoDepartmentAry[i] , CreatedDateTimeAry[i], WorkOrderCategoryAry[i], WoDescriptionAry[i], CreatedUserAry[i], WoStatusAry[i],WoVerifyAry[i], WoReOpenAry[i]]).draw(false);
                    dtbl1.row.add([intX, res.Data_Ary[i][1],res.Data_Ary[i][3].substring(2, 16), res.Data_Ary[i][2], res.Data_Ary[i][8], res.Data_Ary[i][4], strDescription, res.Data_Ary[i][10],res.Data_Ary[i][11], res.Data_Ary[i][12]]).draw(false);
                } 
            }
            else
            {
                dtbl1.clear().draw(); 
                Swal.fire({title: 'Wait.!',text: 'No data found.',icon: 'info', confirmButtonText: 'OK'});
                //alert("Data not found..");
            }
            
        });
    }
    //------------- Convert Minute to HH:MM --------------------
    function convertMinutesToTime(minutes) 
    {
        // Convert minutes to hours and minutes
        var hours = Math.floor(minutes / 60);
        var remainingMinutes = minutes % 60;
        // Format hours and minutes
        var formattedHours = hours.toString().padStart(2, '0');
        var formattedMinutes = remainingMinutes.toString().padStart(2, '0');
        // Return the formatted time
        return formattedHours + ':' + formattedMinutes;
    }
    //------------- Load Work Order Table Department Filter Data -------------------
    function funLoad_WoTableFilterDepData() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("funLoad_WoTableFilterDepData");
                
        const DataAry = [];         
        //---------------- Load Departments --------------------------------------
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "Department";
        DataAry[2] = "tblwo_errorlevel_breakdown";
        DataAry[3] = "0";
        if(intDebugEnable === 1)    alert("DataAry :" + DataAry);      
        $.post('class/comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("json_data2 : " + json_data2);
            var res = $.parseJSON(json_data2);  
            if(res.Status_Ary[0] === "true")
            {
                AryDepartment = res.Data_Ary;
                if(intDebugEnable === 1) alert("AryDepartment : " + AryDepartment); 
                //------------ Remove All Items in "AryUserType" -----------------------------------
                var options5 = document.querySelectorAll('#id_funHome_SelDepartmentFilter option');
                options5.forEach(o => o.remove());
                                 
                //------------ Fill New Items -------------------------------------
                var sel_UserType = document.getElementById("id_funHome_SelDepartmentFilter");
                var opt4 = "All";
                var el4 = document.createElement("option");
                el4.textContent = opt4;
                el4.value = opt4;
                sel_UserType.appendChild(el4);
                for(var i = 0; i < AryDepartment.length; i++)
                {
                    var opt5 = AryDepartment[i];
                    var el5 = document.createElement("option");
                    el5.textContent = opt5;
                    el5.value = opt5;
                    sel_UserType.appendChild(el5);
                }
                //-------------- Set User Department in Filter ------------------
                //document.getElementById("id_funHome_SelDepartmentFilter").value = JS_SessionArry[0].CurrentUserDepartment; 
                funRefresh_WoTable();
            }
        });
    }
    
</script>
</body>
</html>
