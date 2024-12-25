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
                            <h3 class="card-title">Mechanic Performance</h3>
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
                                        <label>Mechanic</label>
                                        <div>
                                            <select class="form-control" id="id_SelMechanics" onchange="funSetShiftTime()">
                                                <option value="mcname">MC Name</option>                                               
                                            </select> 
                                        </div>                               
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Shift</label>
                                        <div>
                                            <select class="form-control" id="id_ShiftType" onchange="funSetShiftTime()">
                                                <option value="shift_day">Day Shift</option>
                                                <option value="shift_night">Night Shift</option>
                                            </select> 
                                        </div>                               
                                    </div>
                                </div>      
                                <div class="col-md-2">    
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div>
                                            <input class="form-control" type="date" id="id_shiftdate" name="shiftDate" style="font-size: 15px;" onchange="funSetShiftTime()"/>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-2">     
                                    <div class="form-group">
                                        <label>Shift Time :</label>
                                        <h6 id="id_lbl_sdate">2018-02-12 12:00:15</h6>
                                        <h6 id="id_lbl_edate">2018-02-12 12:00:15</h6>
                                    </div>                                    
                                </div>
                                <div class="col-md-2"> 
                                    <div class="form-group">                                         
                                        <div class="form-group">
                                            <button type="button" class="form-control btn btn-primary mt-4" onclick="funViewReport()" id="id_ViewReport" name="viewbutton">View Report</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-default" >
                        <div class="card-header">
                            <h3 class="card-title">Mechanic Performance Chart</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>                                
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">  
                            <div class="table-responsive">
                                <div class="overflow-auto">
                                    <div id="timeline"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-default" >                        
                                <div class="card-header">
                                    <h3 class="card-title">Checking Performance Chart</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>                                
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" id="id_divCheckin_chart">  
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-default" >  
                                <div class="card-header">
                                    <h3 class="card-title">Allocate Performance Chart</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>                                
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <!-- /.card-header -->
                                <div class="card-body" id="id_divAllocate_chart">  
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- /.card -->
                    <section class="content">
                        <div class="container-fluid">                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-danger">  
                                        <div class="card-header">
                                            <h3 class="card-title"><b>Mechanic Performance Evaluation Sheet </b></h3>                                    
                                        </div>                                
                                        <!-- /.card-header -->
                                        <div class="card-body" id="id_class1">
                                            <table id="id_table1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Work Order No</th>
                                                        <th>Description</th>
                                                        <th>User CheckIn Time</th>
                                                        <th>User CheckOut Time</th>
                                                        <th>Worked Duration</th>
                                                    </tr>
                                                </thead>
                                                <tbody>                                          
                                                </tbody>
                                               
                                            </table>	
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->
                    </section>
                    
                </div><!-- /.container-fluid -->
                <!-- Include Footer -->
                <?php
                    include '../../headers/footer-bar.php'
                ?> 
            </section>
        </div>    
    </div>    
 
<!-- Page specific script -->
<script>
    
    // Create the data table with multiple bars per row
    //--------------- Admin Panel Minimize ----------------------
    $('[data-widget="pushmenu"]').PushMenu("collapse");
    
    $(function () 
    {
        //----------- Load Google Chart -------------------------------------------
        // Load the Google Charts library and Draw the chart when Google Charts library is loaded
        google.charts.load('current', {'packages':['timeline']});
        google.charts.setOnLoadCallback(drawGooleChart);
        //-------------- Load Datetime box ----------------------------------------
        document.getElementById('id_shiftdate').valueAsDate = new Date();
        
        /*
        var currentDate = new Date();
        currentDate.setHours(currentDate.getHours() + 5); // Add 5 hours
        currentDate.setMinutes(currentDate.getMinutes() + 30); // Add 30 minutes
        var formattedDate = currentDate.toISOString().slice(0, 16);
        document.getElementById('id_sdate').value = formattedDate;
        //document.getElementById('id_sdate').valueAsDate = new Date();
        
        currentDate = new Date(Date.now() + ( 3600 * 1000 * 24));
        currentDate.setHours(currentDate.getHours() + 5); // Add 5 hours
        currentDate.setMinutes(currentDate.getMinutes() + 30); // Add 30 minutes
        formattedDate = currentDate.toISOString().slice(0, 16);
        document.getElementById('id_edate').value = formattedDate;
        //document.getElementById('id_edate').valueAsDate = new Date(Date.now() + ( 3600 * 1000 * 24));        
        */
       
        //$("#example2").DataTable({
        //    "responsive": true, "lengthChange": false, "autoWidth": false,
        //    "buttons": ["copy", "csv", "excel", "pdf", "print"]
        //}).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
        
        $('#id_table1').DataTable({
            dom: 'Bfrtip',
            buttons: [{ extend: 'copyHtml5', footer: true },{ extend: 'excelHtml5', footer: true },{ extend: 'csvHtml5', footer: true },{ extend: 'pdfHtml5', footer: true },{ extend: 'print', footer: true }]
        });       
        funLoadMehanics();
        funViewReport();
    });
      
    //-------------------- Load CheckIn/Allocation Chart --------------------------------------    
    function drawGooleChart() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1) alert("drawGooleChart"); 
        //var SESSION_CurrentUserEPF      = "<?php echo htmlspecialchars($_SESSION["user_epf"]); ?>";        
        const DataAry = [];  
        //-------------------- Update CheckIn Chart -------------------------------------------------------        
        DataAry[0] = "funGetData_CheckInAllocateTimeChart";        // Table Name
        DataAry[1] = document.getElementById("id_SelMechanics").value;
        DataAry[2] = document.getElementById("id_lbl_sdate").innerHTML;
        DataAry[3] = document.getElementById("id_lbl_edate").innerHTML;
        if(intDebugEnable === 1) alert("DataAry :" + DataAry);
        $.post('getData_McPerformance.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("json_data2 :" + json_data2);           
            var res = $.parseJSON(json_data2);                 
            //alert(res.Status_Ary[0]);        
            if(res.Status_Ary[0] === "true")   // No data found, insert new record
            {             
                if(intDebugEnable === 1) alert("res.Status_Ary[0] :" + res.Status_Ary[0]);
                var dataAry_new = res.Data_Ary;                
                
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn({ type: 'string', id: 'ChekInAllocate' });
                dataTable.addColumn({ type: 'string', id: 'WoNo' });
                dataTable.addColumn({ type: 'date', id: 'Start' });
                dataTable.addColumn({ type: 'date', id: 'End' });
               
                if(intDebugEnable === 1) alert("dataTable:" + dataTable);                 
                dataAry_new.forEach(function(row) 
                {   
                    var startDate = new Date(row[2]);
                    var endDate = new Date(row[3]);                    
                    var endDateTimeString = endDate.toISOString().slice(0, 16);
                    //dataTable.addRow([row[0], row[1], new Date(startDateTimeString), new Date(endDateTimeString)]);
                    dataTable.addRow([row[0], row[1],startDate, endDate]);
                });
                if(intDebugEnable === 1) alert("options"); 
                var options = 
                        {
                            height: 240,
                            timeline: 
                            {
                                groupByRowLabel: true // Display multiple bars per row
                                
                            }
                        };
                // Instantiate and draw the chart
                var chart = new google.visualization.Timeline(document.getElementById('timeline'));
                chart.draw(dataTable, options);
                if(intDebugEnable === 1) alert("Chart End..");
            }
            else
            {
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn({ type: 'string', id: 'ChekInAllocate' });
                dataTable.addColumn({ type: 'string', id: 'WoNo' });
                dataTable.addColumn({ type: 'date', id: 'Start' });
                dataTable.addColumn({ type: 'date', id: 'End' });
               
                if(intDebugEnable === 1) alert("dataTable:" + dataTable);                 
                
                if(intDebugEnable === 1) alert("options"); 
                var options = 
                        {
                            height: 240,
                            timeline: 
                            {
                                groupByRowLabel: true // Display multiple bars per row
                                
                            }
                        };
                // Instantiate and draw the chart
                var chart = new google.visualization.Timeline(document.getElementById('timeline'));
                chart.draw(dataTable, options);

            } 
        });
    }
    
    //-------------------- ViewReport Function --------------------------------------------
    function funViewReport() 
    {
        let intDebugEnable = 0;
        //if(intDebugEnable === 1) alert("View button Clicked"); 
        //var SESSION_CurrentUserEPF      = "<?php echo htmlspecialchars($_SESSION["user_epf"]); ?>";
        
        const DataAry = [];           
        //-------------- Check User Already CheckIn ------------------------------
        DataAry[0] = "funGetData_CheckInTable";        // Table Name
        DataAry[1] = document.getElementById("id_SelMechanics").value;
        DataAry[2] = document.getElementById("id_lbl_sdate").innerHTML;
        DataAry[3] = document.getElementById("id_lbl_edate").innerHTML;
       
        if(intDebugEnable === 1) alert("DataAry :" + DataAry);
        $.post('getData_McPerformance.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("json_data2 :" + json_data2);           
            var res = $.parseJSON(json_data2);                 
            //alert(res.Status_Ary[0]);        
            if(res.Status_Ary[0] === "true")   // No data found, insert new record
            {
                //------------------------------------------------------------
                //- Table 1 - Department Wise Total Downtime 
                //------------------------------------------------------------ 
                var dtbl1 = $('#id_table1').DataTable();
                dtbl1.clear().draw();
                //---------- Insert Table Header -------------------------            
                //$(dtbl1.column(2).header()).html("Downtime (Min)");
                //$(dtbl1.column(3).header()).html("Occurrence");
                //---------- Insert Table Body -------------------------
                intRowCount = res.Data_Ary.length;
                for(i=0;i<intRowCount;i++)
                {
                    intTmp = i + 1;      
                    dtbl1.row.add([intTmp.toString(), res.Data_Ary[i][0], res.Data_Ary[i][1],res.Data_Ary[i][2],res.Data_Ary[i][3], res.Data_Ary[i][4]]).draw(false);
                } 
                //---------- Insert Table Footer -------------------------        
                //$(dtbl1.column(3).footer()).html(dtbl1.column(3).data().reduce( function (a,b){return parseFloat(a)+parseFloat(b);}));
                //$(dtbl1.column(5).footer()).html(dtbl1.column(5).data().reduce( function (a,b){return parseFloat(a)+parseFloat(b);}));
            }
            else if(res.Status_Ary[0] === "false")   // No data found, insert new record
            {
                var dtbl1 = $('#id_table1').DataTable();
                dtbl1.clear().draw();
                //Swal.fire({title: 'Alert.!',text: "Data not available",icon: 'info',confirmButtonText: 'OK'});
            }
            else
            {
                var dtbl1 = $('#id_table1').DataTable();
                dtbl1.clear().draw();
                Swal.fire({title: 'Error.!',text: res.Status_Ary[0],icon: 'error',confirmButtonText: 'OK'});
            }
        }); 
        drawGooleChart();
        drawPieCharts();
    }
    //-------------------- ViewReport Function --------------------------------------------
    function funLoadMehanics() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1) alert("funLoadMehanics"); 
        //--------- Load User Departments -------------------------------------
        const DataAry = [];
        DataAry[0] = "funGetMechanicData";        // Function Name    
        
        if(intDebugEnable === 1)    alert("DataAry" + DataAry);      
        $.post('getData_McPerformance.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("json_data2 : " + json_data2);
            var res = $.parseJSON(json_data2); 
            if(intDebugEnable === 1) alert("res.Status_Ary[0] " + res.Status_Ary[0]);
            if(res.Status_Ary[0] === "true")
            {
                var epfArray = [];
                var nameArray = [];
                res.Data_Ary.forEach(function(item) 
                {
                    epfArray.push(item[0]);
                    nameArray.push(item[1]);
                });

                //AryMechanics = res.Data_Ary[0];                
                if(intDebugEnable === 1) alert("epfArray : 220 " + epfArray[0]); 
                //------------ Remove All Items in "AryMechanics" -----------------------------------
                var options4 = document.querySelectorAll('#id_SelMechanics option');
                options4.forEach(o => o.remove());
                //------------ Fill New Items -------------------------------------
                var sel_UserType = document.getElementById("id_SelMechanics");
                var SESSION_CurrentUserEPF      = "<?php echo htmlspecialchars($_SESSION["user_epf"]); ?>"; 
                var SESSION_CurrentUserName      = "<?php echo htmlspecialchars($_SESSION["user_name"]); ?>";                 
                var opt4 = SESSION_CurrentUserEPF;
                var el4 = document.createElement("option");
                el4.textContent = SESSION_CurrentUserName;
                el4.value = opt4;
                sel_UserType.appendChild(el4);
                
                for(var i = 0; i < epfArray.length; i++)
                {
                    var opt4 = epfArray[i];
                    var el4 = document.createElement("option");
                    el4.textContent = nameArray[i];
                    el4.value = opt4;
                    sel_UserType.appendChild(el4);
                }
                //var SESSION_CurrentUserEPF      = "<?php echo htmlspecialchars($_SESSION["user_epf"]); ?>";
                //document.getElementById("id_SelMechanics").value        = "kel";
                //document.getElementById("id_SelMechanics").textContent  = "kel";
            }
        });
    }
    //--------------------- Set Shift Time -----------------------------------------
    function funSetShiftTime()
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1) alert("funSetShiftTime"); 
        
        let strSelShiftTime = document.getElementById("id_ShiftType").value;
        if(intDebugEnable === 1) alert("strSelShiftTime : " + strSelShiftTime);
        
        if(strSelShiftTime === "shift_day")
        {
            if(intDebugEnable === 1) alert("Day Shift ");
                        
            const startDate = new Date(document.getElementById('id_shiftdate').value);
            startDate.setHours(7, 0, 0, 0); // Change only the time part to 07:00:00
            startDate.setHours(startDate.getHours() + 5); // Add 5 hours
            startDate.setMinutes(startDate.getMinutes() + 30); // Add 30 minutes
            
            const endDate = new Date(startDate.getTime() + (12 * 60 * 60 * 1000)); // Add 12 hours  
        
            document.getElementById("id_lbl_sdate").innerHTML = startDate.toISOString().slice(0, 16);
            document.getElementById("id_lbl_edate").innerHTML = endDate.toISOString().slice(0, 16);  
            
        }
        else 
        {
            if(intDebugEnable === 1) alert("Night Shift ");
                        
            const startDate = new Date(document.getElementById('id_shiftdate').value);
            startDate.setHours(19, 0, 0, 0); // Change only the time part to 07:00:00
            startDate.setHours(startDate.getHours() + 5); // Add 5 hours
            startDate.setMinutes(startDate.getMinutes() + 30); // Add 30 minutes
            
            const endDate = new Date(startDate.getTime() + (12 * 60 * 60 * 1000)); // Add 12 hours  
        
            document.getElementById("id_lbl_sdate").innerHTML = startDate.toISOString().slice(0, 16);
            document.getElementById("id_lbl_edate").innerHTML = endDate.toISOString().slice(0, 16); 
        }
        funViewReport();
        drawPieCharts();
    }
    //-------------------- Load CheckIn/Allocation Chart --------------------------------------    
    function drawPieCharts() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1) alert("drawPieCharts"); 
        const DataAry = [];
        //-------------------- Update CheckIn Efficency Chart-----------------------------------------------------        
        DataAry[0] = "funGetData_TotalCheckInTime";        // Table Name
        DataAry[1] = document.getElementById("id_SelMechanics").value;
        DataAry[2] = document.getElementById("id_lbl_sdate").innerHTML;
        DataAry[3] = document.getElementById("id_lbl_edate").innerHTML;
        if(intDebugEnable === 1) alert("DataAry :" + DataAry);
        $.post('getData_McPerformance.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("json_data2 :" + json_data2);           
            var res = $.parseJSON(json_data2);                 
            //alert(res.Status_Ary[0]);        
            if(res.Status_Ary[0] === "true")   // No data found, insert new record
            {             
                if(intDebugEnable === 1) alert("res.Status_Ary[0] :" + res.Status_Ary[0]);
                
                const AryCheckIn_Lable     = ["CheckIn Duration", "Idle Duration"];
                const AryCheckIn_Duration  = [0, 720];
                const AryCheckIn_Colors    = ["#39A275", "#FECF6A"];
                
                const AryAllocate_Lable     = ["Allocated Duration", "Idle Duration"];
                const AryAllocate_Duration  = [0, 720];
                const AryAllocate_Colors    = ["#8F3985", "#FECF6A"];
                
		var intValue = parseInt(res.Data_Ary[0][0], 10);
                AryAllocate_Duration[0] = intValue;
                if(intValue < 720)
                {                    
                    AryAllocate_Duration[1] = 720 - intValue;
                }
                else
                {
                    AryAllocate_Duration[1] = 0;
                } 
                intValue = parseInt(res.Data_Ary[1][0], 10);
                AryCheckIn_Duration[0] = intValue;
                if(intValue < 720)
                {                    
                    AryCheckIn_Duration[1] = 720 - intValue;
                }
                else
                {
                    AryCheckIn_Duration[1] = 0;
                }                 
                //------------------------------------------------------------
                //- 1. DONUT CHART - CheckIn Efficency Chart
                //------------------------------------------------------------    
                //--- Refres the Canvas DIV -----------------------------------------------   
                document.getElementById("id_divCheckin_chart").innerHTML = '&nbsp;';
                document.getElementById("id_divCheckin_chart").innerHTML = '<canvas id="id_PieChart_CheckIn" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>';

                var donutChartCanvas = $('#id_PieChart_CheckIn').get(0).getContext('2d');               
                var donutData = {
                  labels: AryCheckIn_Lable,
                  datasets: [
                    {
                      data: AryCheckIn_Duration,
                      backgroundColor : AryCheckIn_Colors
                    }]};
                var donutOptions = {maintainAspectRatio : false, responsive : true};
                new Chart(donutChartCanvas, 
                {
                    options: {
                            plugins: {
                                datalabels: {
                                    color: '#000000',
                                    formatter: function(value, context) {
                                        // Display the value as a label on each segment
                                        return context.chart.data.labels[context.dataIndex] + ': ' + value;
                                    }
                                }
                            }
                        },  
                    type: 'doughnut',
                    data: donutData,
                    //options: donutOptions

                });
                //------------------------------------------------------------
                //- 1. DONUT CHART - Allocated Efficency Chart
                //------------------------------------------------------------    
                //--- Refres the Canvas DIV -----------------------------------------------   
                document.getElementById("id_divAllocate_chart").innerHTML = '&nbsp;';
                document.getElementById("id_divAllocate_chart").innerHTML = '<canvas id="id_PieChart_Allocate" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>';

                var donutChartCanvas = $('#id_PieChart_Allocate').get(0).getContext('2d');               
                var donutData = {
                  labels: AryAllocate_Lable,
                  datasets: [
                    {
                      data: AryAllocate_Duration,
                      backgroundColor : AryAllocate_Colors
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
            }
        });
        
    }
    
</script>
</body>
</html>
