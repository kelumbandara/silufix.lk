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
                            <h3 class="card-title">Machine wise Report </h3>
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
                                    <label style="font-weight: bolder;" >Module No</label>    
                                    <select class="form-control select2" onchange="funLoad_Categories()" id="id_Select_ModuleNo" style="width: 100%;">
                                        <option selected="none"></option>                            
                                    </select>
                                </div>
                                <div class="col-md-2">                   
                                    <label style="font-weight: bolder;" >MC Category</label>    
                                    <select class="form-control select2" onchange="funLoadMachineNo()" id="id_Select_Category" style="width: 100%;">
                                       
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Machine No</label>
                                        <select class="form-control" id="id_SelMachine">
                                            <option value="mcname">MC Name</option>                                               
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="form-group">                                         
                                        <div class="form-group">
                                            <button type="button" class="form-control btn btn-primary mt-4" onclick="funViewReport()" id="id_ViewReport" name="viewbutton">View</button>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>                        
                    </div>
                    <div class="card card-default" >
                        <!-- /.card-header -->
                        <div class="card-body">  
                            <div class="table-responsive">
                                <div class="overflow-auto">
                                    <div id="id_charttitle"> Chart Title</div>
                                    <div id="timeline"></div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div><!-- /.container-fluid -->
                <!-- Include Footer -->
                <?php
                    include '../../headers/footer-bar.php'
                ?> 
            </section>
        </div>    
    </div>    
 
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<script src="../../plugins/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script> 

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
        //document.getElementById('id_startdate').valueAsDate = new Date();
        document.getElementById('id_startdate').valueAsDate = new Date(Date.now() - (3600 * 1000 * 24 * 7));
        document.getElementById('id_enddate').valueAsDate   = new Date(Date.now() + ( 3600 * 1000 * 24)); 
        //-------------- Load Datetime box ----------------------------------------
        //document.getElementById('id_shiftdate').valueAsDate = new Date();
        
        //-------------- Find Current Shift ------------------------------------
        // Retrieve the current date and time
        /*
        var currentDate = new Date();
        var currentHour = currentDate.getHours();
        if (currentHour >= 7 && currentHour < 19) 
        {
            const startDate = new Date();
            startDate.setHours(7, 0, 0, 0); // Change only the time part to 07:00:00
            startDate.setHours(startDate.getHours() + 5); // Add 5 hours
            startDate.setMinutes(startDate.getMinutes() + 30); // Add 30 minutes
            const endDate = new Date(startDate.getTime() + (12 * 60 * 60 * 1000)); // Add 12 hours              
            document.getElementById('id_ShiftType').value = "shift_day";  
            document.getElementById("id_lbl_sdate").innerHTML   = startDate.toISOString().slice(0, 16);
            document.getElementById("id_lbl_edate").innerHTML   = endDate.toISOString().slice(0, 16);
        }
        else 
        {
            const startDate = new Date();
            startDate.setHours(19, 0, 0, 0); // Change only the time part to 07:00:00
            startDate.setHours(startDate.getHours() + 5); // Add 5 hours
            startDate.setMinutes(startDate.getMinutes() + 30); // Add 30 minutes
            const endDate = new Date(startDate.getTime() + (12 * 60 * 60 * 1000)); // Add 12 hours 
            document.getElementById('id_ShiftType').value = "shift_night";
            document.getElementById("id_lbl_sdate").innerHTML   = startDate.toISOString().slice(0, 16);
            document.getElementById("id_lbl_edate").innerHTML   = endDate.toISOString().slice(0, 16);
        }     
        */
        funLoad_Module();
        //funLoad_Categories();        
        //funLoadMachineNo();
        //funViewReport();
    });
      
    
    //-------------------- ViewReport Function --------------------------------------------
    function funViewReport() 
    {
        let intDebugEnable = 0;
        if(intDebugEnable === 1) alert("View button Clicked"); 
        //var SESSION_CurrentUserEPF      = "<?php echo htmlspecialchars($_SESSION["user_epf"]); ?>";
        
        /*
        const DataAry = [];           
        //-------------- Check User Already CheckIn ------------------------------
        DataAry[0] = "funGetData_CheckInTable";        // Table Name
        DataAry[1] = document.getElementById("id_SelMachine").value;
        DataAry[2] = document.getElementById("id_lbl_sdate").innerHTML;
        DataAry[3] = document.getElementById("id_lbl_edate").innerHTML;
       
        if(intDebugEnable === 1) alert("DataAry :" + DataAry);
        $.post('getData_JobHistoryShift.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("json_data2 :" + json_data2);           
            var res = $.parseJSON(json_data2);                 
            //alert(res.Status_Ary[0]);        
            
            drawGooleChart();
        }); 
        */
        drawGooleChart();
    }
    
    //-------------------- ViewReport Function --------------------------------------------
    function funLoadMachineNo() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1) alert("funLoadMachineNo"); 
        //----------------------- Load Machine Numbers --------------------------------------
        const DataAry = []; 
        //---------------- Load Machine Categories --------------------------------------
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "MachineNumber";
        DataAry[2] = "tblmc_configuration";
        DataAry[3] = "2";
        DataAry[4] = "ModuleNo";
        DataAry[5] = document.getElementById("id_Select_ModuleNo").value; 
        DataAry[6] = "MachineCategory";
        DataAry[7] = document.getElementById("id_Select_Category").value;       //"pneumatic";  
        
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
                var options5 = document.querySelectorAll('#id_SelMachine option');
                options5.forEach(o => o.remove());
                                 
                //------------ Fill New Items -------------------------------------
                var sel_UserType = document.getElementById("id_SelMachine");
                //var opt4 = "All";
                //var el4 = document.createElement("option");
                //el4.textContent = opt4;
                //el4.value = opt4;
                //sel_UserType.appendChild(el4);                
                for(var i = 0; i < AryDepartment.length; i++)
                {
                    var opt5 = AryDepartment[i];
                    var el5 = document.createElement("option");
                    el5.textContent = opt5;
                    el5.value = opt5;
                    sel_UserType.appendChild(el5);
                }
            }           
            funViewReport();
        });
    }
    
    //------------- Load Module Numbers to Filter Data -------------------
    function funLoad_Module() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("funLoad_Module");
                
        const DataAry = [];         
        //---------------- Load Departments --------------------------------------
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "ModuleNo";
        DataAry[2] = "tblmc_configuration";
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
                var options5 = document.querySelectorAll('#id_Select_ModuleNo option');
                options5.forEach(o => o.remove());
                                 
                //------------ Fill New Items -------------------------------------
                var sel_UserType = document.getElementById("id_Select_ModuleNo");
                var opt4 = "Select Data";
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
                //--------------- Clear Machine Category Filter --------------------------------------
                var options2 = document.querySelectorAll('#id_Select_Category option');
                options2.forEach(o => o.remove());
                var opt2 = ["Select Data"];
                opt2.forEach(function(value) 
                {
                    var el2 = document.createElement("option");
                    el2.textContent = value;
                    el2.value = value;
                    document.getElementById("id_Select_Category").appendChild(el2);
                });
                //--------------- Clear Machine Number Filter --------------------------------------
                var options2 = document.querySelectorAll('#id_SelMachine option');
                options2.forEach(o => o.remove());
                var opt2 = ["Select Data"];
                opt2.forEach(function(value) 
                {
                    var el2 = document.createElement("option");
                    el2.textContent = value;
                    el2.value = value;
                    document.getElementById("id_SelMachine").appendChild(el2);
                });
            }
            else
            {
                // Remove existing options
                var options1 = document.querySelectorAll('#id_Select_ModuleNo option');
                options1.forEach(o => o.remove());
                // Create new options
                var opt1 = ["Select Data"];
                opt1.forEach(function(value) 
                {
                    var el1 = document.createElement("option");
                    el1.textContent = value;
                    el1.value = value;
                    document.getElementById("id_Select_ModuleNo").appendChild(el1);
                });
            }
            
        });
    }
    
    //------------- Load Categories to Filter Data -------------------
    function funLoad_Categories() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("funLoad_Module");
                
        const DataAry = [];         
        //---------------- Load Machine Categories --------------------------------------
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "MachineCategory";
        DataAry[2] = "tblmc_configuration";
        DataAry[3] = "1";
        DataAry[4] = "ModuleNo";
        DataAry[5] = document.getElementById("id_Select_ModuleNo").value;  
        
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
                //var opt4 = "All";
                //var el4 = document.createElement("option");
                //el4.textContent = opt4;
                //el4.value = opt4;
                //sel_UserType.appendChild(el4);
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
    //-------------------- Load CheckIn/Allocation Chart --------------------------------------    
    function drawGooleChart() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1) alert("drawGooleChart"); 
        //var SESSION_CurrentUserEPF      = "<?php echo htmlspecialchars($_SESSION["user_epf"]); ?>"; 
        var extraInfoArray = []; // Array to store extra information
        
        const DataAry = [];  
        //-------------------- Update CheckIn Chart -------------------------------------------------------        
        DataAry[0] = "funGetData_McRunDurationChart";        // Table Name
        DataAry[1] = document.getElementById("id_SelMachine").value;
        DataAry[2] = document.getElementById("id_startdate").value;
        DataAry[3] = document.getElementById("id_enddate").value;
        if(intDebugEnable === 1) alert("DataAry :" + DataAry);
        $.post('getData_MachineRunDuration.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("json_data2 :" + json_data2);           
            var res = $.parseJSON(json_data2);                 
            if(res.Status_Ary[0] === "true")   // No data found, insert new record
            {             
                if(intDebugEnable === 1) alert("res.Status_Ary[0] :" + res.Status_Ary[0]);
                var dataAry_new = res.Data_Ary;                
               
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn({ type: 'string', id: 'ChekInAllocate' });
                dataTable.addColumn({ type: 'string', id: 'McNo' });
                dataTable.addColumn({ type: 'date', id: 'Start' });
                dataTable.addColumn({ type: 'date', id: 'End' });
                               
                if(intDebugEnable === 1) alert("dataTable:" + dataTable); 
                
                var setStartDate = 0;
                var InitialStartDate;
                
                dataAry_new.forEach(function(row,index) 
                {                     
                    var startDate = new Date(row[2]);
                    var endDate = new Date(row[3]);  
                    
                    if(setStartDate === 0)
                    {
                        InitialStartDate = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate());
                        setStartDate = 1;                        
                    }
                    var NoOfDays = Math.floor((startDate - InitialStartDate) / (1000 * 60 * 60 * 24));     
                    if(NoOfDays > 0)
                    {
                        startDate.setDate(startDate.getDate() - NoOfDays);
                        endDate.setDate(endDate.getDate() - NoOfDays);        
                    }  
                    
                    //var endDateTimeString = endDate.toISOString().slice(0, 16);
                     dataTable.addRow([row[0], ' ' ,startDate, endDate]);
                    //var strRowInfo = row[1] + "," + row[2] + "," + row[3] + "," + row[4] + "," + row[5];
                    var strRowInfo = row[1] + "," + row[2] + "," + row[3];
                    extraInfoArray.push({ index: index, info: strRowInfo });                  
         
                });
                if(intDebugEnable === 1) alert("options"); 
                var options = 
                        {
                            title: 'My Chart Title', // Add your chart title here
                            height: 440,
                            timeline: {groupByRowLabel: true}, // Display multiple bars per row
                            tooltip: { trigger: 'none' } // Disable automatic tooltips
                        };
                // Instantiate and draw the chart
                var chart = new google.visualization.Timeline(document.getElementById('timeline'));
                chart.draw(dataTable, options);
                
                // Event listener to show additional info when a bar is clicked
                google.visualization.events.addListener(chart, 'select', function() 
                {
                    var selection = chart.getSelection();
                    if (selection.length > 0) 
                    {
                        var row = selection[0].row;
                        // Retrieve the extra info using the row index
                        var extraInfo = extraInfoArray.find(item => item.index === row).info;                        
                        // Split the string
                        var extraInfo_ary = extraInfo.split(',');
                        // Format the HTML content
                        //var strHtmlContent ='<b>Start Time: </b> '   + extraInfo_ary[1] + '<br>' +
                        //                    '<b>End Time: </b> '     + extraInfo_ary[2] + '<br>' +
                        //                    '<b>MachineNo: </b> '    + extraInfo_ary[3] + '<br>' +
                        //                    '<b>WoDescription: </b> ' + extraInfo_ary[4];   
                                    
                        //alert(extraInfo_ary[0]);
                        //funWoTableRowClicked(extraInfo_ary[0]);
                        /*
                        Swal.fire({
                            title: 'Workorder No: '+ extraInfo_ary[0],
                            html: strHtmlContent,
                            confirmButtonText: 'OK',
                            //confirmButtonColor: '#0056b3', // Custom color for the button
                            //background: '#fcf3cf', // Background color of the popup
                            //color: '#333' // Text color
                        });
                        */
                    }
                });               
                
                document.getElementById("id_charttitle").innerHTML = document.getElementById("id_SelMachine").options[document.getElementById("id_SelMachine").selectedIndex].text;
                if(intDebugEnable === 1) alert("Chart End..");
            }
            else
            {
                if(intDebugEnable === 1) alert("Else : Blank Chart"); 
                
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn({ type: 'string', id: 'ChekInAllocate' });
                dataTable.addColumn({ type: 'string', id: 'McNo' });
                dataTable.addColumn({ type: 'date', id: 'Start' });
                dataTable.addColumn({ type: 'date', id: 'End' });
               
                dataTable.addRows([
                     ['No Data', '', new Date(2024, 3, 6, 7, 0, 0), new Date(2024, 3, 6, 7, 0, 1)],
                     ['No Data', '', new Date(2024, 3, 6, 19, 0, 0), new Date(2024, 3, 6, 19, 0, 1)],
                     ['No Data', '', new Date(2024, 3, 6, 7, 0, 0), new Date(2024, 3, 6, 7, 0, 1)],
                     ['No Data', '', new Date(2024, 3, 6, 19, 0, 0), new Date(2024, 3, 6, 19, 0, 1)],
                   ]);
              
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
            //drawPieCharts();
            //drawPieCharts_Allocate();
        });
    }
    
</script>
</body>
</html>
