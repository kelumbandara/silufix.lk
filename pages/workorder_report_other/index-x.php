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
    include_once'../../headers/header.php';
    //include_once'../../dbconnection/dbConnection.php';
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
                    <div class="card card-default" >
                        <div class="card-header">
                            <h3 class="card-title">Other Maintenance</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>                                
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">  
                            <div class="row">                                 
                                <div class="col-md-2">    
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <div>
                                            <input class="form-control" type="date" id="id_startdate" onchange="funLoadAllChart()" name="startDate" style="font-size: 15px;"/>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-2">    
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <div>
                                            <input class="form-control" type="date" id="id_enddate" onchange="funLoadAllChart()" name="endDate" style="font-size: 15px;"/>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-2">                   
                                    <label style="font-weight: bolder;" >Department</label>    
                                    <select class="form-control select2" onchange="funLoadAllChart()" id="id_Select_Department" style="width: 100%;">
                                        <option selected="none"></option>                            
                                    </select>
                                </div>
                                <div class="col-md-2">                   
                                    <label style="font-weight: bolder;" >Category</label>    
                                    <select class="form-control select2" onchange="funLoadAllChart()" id="id_Select_Category" style="width: 100%;">
                                        <option value="All">All</option> 
                                        <option value="Fabrication">Fabrication</option> 
                                        <option value="Civil">Civil</option> 
                                        <option value="Plumbing">Plumbing</option> 
                                        <option value="Other">Other</option> 
                                    </select>
                                </div>
                                <div class="col-md-2">                   
                                    <label style="font-weight: bolder;" >Current Status</label>    
                                    <select class="form-control select2" onchange="funLoadAllChart()" id="id_Select_Status" style="width: 100%;">
                                        <option value="All">All</option> 
                                        <option value="New">New</option> 
                                        <option value="Inprogress">Inprogress</option> 
                                        <option value="Closed">Closed</option> 
                                    </select>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="form-group">                                         
                                        <div class="form-group">
                                            <button type="button" class="form-control btn btn-primary" onclick="funLoadAllChart()" id="id_ViewReport" name="viewbutton">View Report</button>
                                        </div>
                                    </div>
                                    <div class="form-group">                                         
                                        <div class="form-group">
                                            <button type="button" class="form-control btn btn-primary" onclick="funViewReport()" id="id_ViewReport" name="viewbutton">Print Report</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"> 
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-default" >                        
                                <div class="card-header">
                                    <h3 class="card-title"> Work Order Category</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>    
                                    </div>
                                </div>
                                <div class="card-body" id="id_divOtherMnt_chart1"> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-default" >  
                                <div class="card-header">
                                    <h3 class="card-title">Work Order Status</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>                                
                                    </div>
                                </div>
                                <div class="card-body" id="id_divOtherMnt_chart2"> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-default" >                        
                                <div class="card-header">
                                    <h3 class="card-title">Other Maintenance Request by Departments</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>    
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" id="id_divOtherMnt_chart3">  
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="content">
                        <div class="container-fluid">                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-danger">  
                                        <div class="card-header">
                                            <h3 class="card-title"><b>Other Maintenance W/O Details</b></h3>                                    
                                        </div> 
                                    </div>
                                    <div class="card-body" id="id_class1">
                                        <table id="id_table1" class="table table-bordered table-striped display compact">
                                            <thead class="bg-info">
                                                <tr>
                                                    <th>#</th>
                                                    <th>WorkOrderNo</th>
                                                    <th>Category</th>
                                                    <th>SubCategory</th>
                                                    <th>Department</th>
                                                    <th>CreatedDateTime</th>
                                                    <th>CreatedUser</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>RespondDateTime</th>
                                                    <th>AllocatedMechanic</th>
                                                    <th>CheckInMechanic</th>
                                                    <th>ClosedDateTime</th>
                                                    <th>ClosedUser</th>
                                                    <th>Time Duration</th>
                                                    <th>ReOpenedDateTime</th>
                                                    <th>ReOpenedUser</th>
                                                    <th>VerifiedDateTime</th>
                                                    <th>VerifiedUser</th>  
                                                </tr>
                                            </thead>
                                            <tbody>                                          
                                            </tbody>
                                        </table>	
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- Include Footer -->
                <?php
                    include '../../headers/footer-bar.php'
                ?> 
            </section>
        </div>    
    </div>    
 
<!-- Page specific script -->
<!-- ChartJS -->
    <script src="../../plugins/chart.js/Chart.min.js"></script>
    <script src="../../plugins/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script> 
<script>

    //--------------- Admin Panel Minimize ----------------------
    $('[data-widget="pushmenu"]').PushMenu("collapse");
    
    $(function () 
    {      
        //-------------- Load Datetime box ----------------------------------------
        //document.getElementById('id_startdate').valueAsDate = new Date();
        document.getElementById('id_startdate').valueAsDate = new Date(Date.now() - (3600 * 1000 * 24 * 7));
        document.getElementById('id_enddate').valueAsDate   = new Date(Date.now() + ( 3600 * 1000 * 24));         
               
        //$("#example2").DataTable({
        //    "responsive": true, "lengthChange": false, "autoWidth": false,
        //    "buttons": ["copy", "csv", "excel", "pdf", "print"]
        //}).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
        
        $('#id_table1').DataTable({ 
           scrollX: true, // Enable horizontal scroll
           scrollY: "400px", // Set vertical scroll height
           scrollCollapse: true, // Collapse table height when less than scrollY
           paging: true, // Enable paging
           pageLength: 10, // Set the number of rows per page
           dom: 'Bfrtip',
           buttons: [
               { extend: 'copyHtml5', footer: true },
               { extend: 'excelHtml5', footer: true },
               { extend: 'csvHtml5', footer: true },
               { extend: 'pdfHtml5', footer: true },
               { extend: 'print', footer: true }
           ]
        });   
        funLoad_Departments();
        //funLoad_Categories();
        
    });

    //-------------------- ViewReport Function --------------------------------------------
    function funLoadPieChart() 
    { 
        let intDebugEnable = 0;

        //alert("View reportButton clicked!");
        //- 1. get data from php page
        const DataAry = [];     
        
        //-------------- Chart1 ------------------------------
        DataAry[0] = "funGetData_PieChart1";        // Table Name
        DataAry[1] = document.getElementById("id_startdate").value;
        DataAry[2] = document.getElementById("id_enddate").value;
        DataAry[3] = document.getElementById("id_Select_Department").value;
        DataAry[4] = document.getElementById("id_Select_Category").value;
        DataAry[5] = document.getElementById("id_Select_Status").value;

        if(intDebugEnable === 1) alert("DataAry :" + DataAry);
        $.post('getData_OtherReport.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("json_data2 :" + json_data2);           
            var res = $.parseJSON(json_data2);                 
            if(res.Status_Ary[0] === "true")   // No data found, insert new record
            {
                if(intDebugEnable === 1) alert("data available");
                //--- Refres the Canvas DIV -----------------------------------------------   
                document.getElementById("id_divOtherMnt_chart1").innerHTML = '&nbsp;';
                document.getElementById("id_divOtherMnt_chart1").innerHTML = '<canvas id="id_canOtherMnt_chart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>';
                                
                const AryCheckIn_Lable      = ["Repair", "Maintenance", "Machine Spare Part Order","Service", "Other"];
                const AryCheckIn_Colors   = ["red","blue","green","#FFFF00"];

                var donutChartCanvas = $('#id_canOtherMnt_chart1').get(0).getContext('2d');               
                var donutData = {
                    labels: AryCheckIn_Lable,
                    datasets: [
                    {
                        data: res.Data_Ary[0],
                        backgroundColor : AryCheckIn_Colors
                    }]};
                var donutOptions = {maintainAspectRatio : false, responsive : true};
                new Chart(donutChartCanvas, 
                {
                    options: 
                    {  
                        plugins: 
                        {
                            // Change options for ALL labels of THIS CHART
                            datalabels: {
                                font: {size: 20},
                                color: '#000000', 
                                anchor: 'center', 
                                display: 'auto'}
                        }
                    }, 
                    type: 'doughnut',
                    data: donutData,
                    //ptions: donutOptions

                });
            
            }
            else if(res.Status_Ary[0] === "false")   // No data found, insert new record
            {
                if(intDebugEnable === 1) alert("data not available"); 
            }
            else
            {
                if(intDebugEnable === 1) alert("Error"); 
            }
        });
        
        //-------------- Chart2 ------------------------------
        DataAry[0] = "funGetData_PieChart2";        // Table Name
        DataAry[1] = document.getElementById("id_startdate").value;
        DataAry[2] = document.getElementById("id_enddate").value;
        DataAry[3] = document.getElementById("id_Select_Department").value;
        DataAry[4] = document.getElementById("id_Select_Category").value;
        DataAry[5] = document.getElementById("id_Select_Status").value;
        
        if(intDebugEnable === 1) alert("DataAry :" + DataAry);
        $.post('getData_OtherReport.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("json_data2 :" + json_data2);           
            var res = $.parseJSON(json_data2);                        
            if(res.Status_Ary[0] === "true")   // No data found, insert new record
            {
                if(intDebugEnable === 1) alert("data available");
                //- 1. DONUT CHART - CheckIn Efficency Chart
                document.getElementById("id_divOtherMnt_chart2").innerHTML = '&nbsp;';
                document.getElementById("id_divOtherMnt_chart2").innerHTML = '<canvas id="id_canOtherMnt_chart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>';
                
                const AryCheckIn_Lable      = ["Completed", "Pending"];
                const AryCheckIn_Colors   = ["red","blue","green","#FFFF00"];

                var donutChartCanvas = $('#id_canOtherMnt_chart2').get(0).getContext('2d');               
                var donutData = {
                    labels: AryCheckIn_Lable,
                    datasets: [
                    {
                        data: res.Data_Ary[0],
                        backgroundColor : AryCheckIn_Colors
                    }]};
                var donutOptions = {maintainAspectRatio : false, responsive : true};
                new Chart(donutChartCanvas, 
                {
                    options: 
                    {  
                        plugins: 
                        {
                            // Change options for ALL labels of THIS CHART
                            datalabels: {
                                font: {size: 20},
                                color: '#000000', 
                                anchor: 'center', 
                                display: 'auto'}
                        }
                    }, 
                    type: 'doughnut',
                    data: donutData,
                    //ptions: donutOptions
                });
            }
            else if(res.Status_Ary[0] === "false")   // No data found, insert new record
            {
                if(intDebugEnable === 1) alert("data not available"); 
            }
            else
            {
                if(intDebugEnable === 1) alert("Error"); 
            }
        });  
     
    }
    function funLoadBarChart() 
    {
        let intDebugEnable = 0;

        //alert("this is Bar chart");
        //- 1. get data from php page
        const DataAry = [];    
        
        //-------------- Bar Chart1 ------------------------------
        DataAry[0] = "funGetData_BarChart1";        // Table Name
        DataAry[1] = document.getElementById("id_startdate").value;
        DataAry[2] = document.getElementById("id_enddate").value;
        DataAry[3] = document.getElementById("id_Select_Department").value;
        DataAry[4] = document.getElementById("id_Select_Category").value;
        DataAry[5] = document.getElementById("id_Select_Status").value;
        
        if(intDebugEnable === 1) alert("DataAry :" + DataAry);
        $.post('getData_OtherReport.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("json_data2 :" + json_data2);           
            var res = $.parseJSON(json_data2);                 
            if(res.Status_Ary[0] === "true")   // No data found, insert new record
            {
                if(intDebugEnable === 1) alert("data available");
                //-------------------------------------------------------------
                //- BAR CHART:2 - Line Wise Occurance Summary  
                //-------------------------------------------------------------
                document.getElementById("id_divOtherMnt_chart3").innerHTML = '&nbsp;';
                document.getElementById("id_divOtherMnt_chart3").innerHTML = '<canvas id="id_canOtherMnt_chart3" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>';
          
                var barChartCanvas = $('#id_canOtherMnt_chart3').get(0).getContext('2d');
                var barChart2_Data2 = 
                {
                    labels  : res.Data_Ary[0],
                    datasets: [
                    {
                        label               : 'Work Order Count',
                        backgroundColor     : 'blue',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : res.Data_Ary[1]
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
                            datalabels: {font: {size: 20},color: '#000000', anchor: 'center', rotation:'0'}
                        }
                    }, 
                    type: 'bar',
                    data: barChartData,
                    //options: barChartOptions
                });
            }
            else if(res.Status_Ary[0] === "false")   // No data found, insert new record
            {
                document.getElementById("id_divOtherMnt_chart3").innerHTML = '&nbsp;';
                document.getElementById("id_divOtherMnt_chart3").innerHTML = '<canvas id="id_canOtherMnt_chart3" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>';
                if(intDebugEnable === 1) alert("data not available"); 
            }
            else
            {   
                document.getElementById("id_divOtherMnt_chart3").innerHTML = '&nbsp;';
                document.getElementById("id_divOtherMnt_chart3").innerHTML = '<canvas id="id_canOtherMnt_chart3" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>';
               if(intDebugEnable === 1) alert("Error"); 
            }
        });
    }

    //-------------------- ViewReport Function --------------------------------------------
    function funLoadTable() 
    { 
        let intDebugEnable = 0;
        if(intDebugEnable === 1) alert("funLoadTable");

        const DataAry = []; 
        //--------------TABLE ------------------------------
        DataAry[0] = "funGetData_Table";        // Table Name
        DataAry[1] = document.getElementById("id_startdate").value;
        DataAry[2] = document.getElementById("id_enddate").value;
        DataAry[3] = document.getElementById("id_Select_Department").value;
        DataAry[4] = document.getElementById("id_Select_Category").value;
        DataAry[5] = document.getElementById("id_Select_Status").value;
        
        if(intDebugEnable === 1) alert("DataAry :" + DataAry);
        $.post('getData_OtherReport.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("json_data2 :" + json_data2);           
            var res = $.parseJSON(json_data2);                 
            if(res.Status_Ary[0] === "true")   // No data found, insert new record
            {
                if(intDebugEnable === 1) alert("data available");
                            //var intLinewiseTotalDT = 0;           
                var dtbl2 = $('#id_table1').DataTable();
                dtbl2.clear().draw();
                //---------- Insert Table Header -------------------------            
                //$(dtbl2.column(2).header()).html("Downtime (Min)");
                //$(dtbl2.column(3).header()).html("Occurrence");                     
                //---------- Insert Table Body -------------------------
                intRowCount = res.Data_Ary.length;
                if(intDebugEnable === 1) alert("intRowCount :" + intRowCount);
                let intTmp = 0;
                for(i=0;i<intRowCount;i++)
                {
                    //intLinewiseTotalDT = res.LineWiseDowntimeCategory1_Ary[i]+res.LineWiseDowntimeCategory2_Ary[i]+res.LineWiseDowntimeCategory3_Ary[i]+res.LineWiseDowntimeCategory4_Ary[i]+res.LineWiseDowntimeCategory5_Ary[i]+res.LineWiseDowntimeCategory6_Ary[i];
                    intTmp = i + 1;
                    dtbl2.row.add([intTmp.toString(), res.Data_Ary[i][0], res.Data_Ary[i][1], res.Data_Ary[i][2], res.Data_Ary[i][3] , res.Data_Ary[i][4],res.Data_Ary[i][5],res.Data_Ary[i][6],res.Data_Ary[i][7],res.Data_Ary[i][8],res.Data_Ary[i][9],res.Data_Ary[i][10],res.Data_Ary[i][11],res.Data_Ary[i][12],res.Data_Ary[i][13],res.Data_Ary[i][14],res.Data_Ary[i][15],res.Data_Ary[i][16],res.Data_Ary[i][17]]).draw(false);
                } 
            }
            else if(res.Status_Ary[0] === "false")   // No data found, insert new record
            {
                var dtbl2 = $('#id_table1').DataTable();
                dtbl2.clear().draw();
                if(intDebugEnable === 1) alert("data not available"); 
            }
            else
            {
                var dtbl2 = $('#id_table1').DataTable();
                dtbl2.clear().draw();
                if(intDebugEnable === 1) alert("Error"); 
            }
        });        
    }
    //------------- Load Departments to Filter Data -------------------
    function funLoad_Departments() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("funLoad_Departments");
                
        const DataAry = [];         
        //---------------- Load Departments --------------------------------------
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "Department";
        DataAry[2] = "tblwo_errorlevel_breakdown";
        DataAry[3] = "0";
        if(intDebugEnable === 1)    alert("DataAry :" + DataAry);      
        $.post('comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("json_data2 : " + json_data2);
            var res = $.parseJSON(json_data2);  
            if(res.Status_Ary[0] === "true")
            {
                AryDepartment = res.Data_Ary;
                if(intDebugEnable === 1) alert("AryDepartment : " + AryDepartment); 
                //------------ Remove All Items in "AryUserType" -----------------------------------
                var options5 = document.querySelectorAll('#id_Select_Department option');
                options5.forEach(o => o.remove());
                                 
                //------------ Fill New Items -------------------------------------
                var sel_UserType = document.getElementById("id_Select_Department");
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
                funLoadPieChart();
                funLoadBarChart();
                funLoadTable();
            }
            
        });
    }
    /*
    //------------- Load Categories to Filter Data -------------------
    function funLoad_Categories() 
    {
        let intDebugEnable = 1;        
        if(intDebugEnable === 1)    alert("funLoad_Departments");
                
        const DataAry = [];         
        //---------------- Load Departments --------------------------------------
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "WorkOrderSubCategory";
        DataAry[2] = "tblwo_event";
        DataAry[3] = "0";
        if(intDebugEnable === 1)    alert("DataAry :" + DataAry);      
        $.post('comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("json_data2 : " + json_data2);
            var res = $.parseJSON(json_data2);  
            if(res.Status_Ary[0] === "true")
            {
                AryDepartment = res.Data_Ary;
                if(intDebugEnable === 1) alert("AryDepartment : " + AryDepartment); 
                //------------ Remove All Items in "AryUserType" -----------------------------------
                var options5 = document.querySelectorAll('#id_Select_Category option');
                options5.forEach(o => o.remove());
                                 
                //------------ Fill New Items -------------------------------------
                var sel_UserType = document.getElementById("id_Select_Category");
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
                //funRefresh_WoTable();
            }
            
        });
    }
    */
    //------------- Load All Charts And Table ------------------
    function funLoadAllChart() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("funLoadAllChart");
        funLoadPieChart();
        funLoadBarChart();
        funLoadTable();
        
    }
    
</script>
</body>
</html>
