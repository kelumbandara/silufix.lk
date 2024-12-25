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
                            <h3 class="card-title">Machine wise Report</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>                                
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">  
                            <div class="row">                                 
                                <div class="col-md-1">    
                                    <div class="form-group">
                                        <label>Select Date</label>
                                    </div> 
                                </div>
                                <div class="col-md-2">    
                                    <div class="form-group">
                                        <div>
                                            <input class="form-control" type="date" id="id_startdate" onchange="funLoadAllChart()" name="startDate" style="font-size: 15px;"/>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-2"> 
                                    <div class="form-group">                                         
                                        <div class="form-group">
                                            <button type="button" class="form-control btn btn-primary" onclick="funViewReport()" id="id_ViewReport" name="viewbutton">View</button>
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
                                    <div id="id_charttitle"> Machine Run Times</div>
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
        //document.getElementById('id_startdate').valueAsDate = new Date(Date.now() - (3600 * 1000 * 24 * 7));
        document.getElementById('id_startdate').valueAsDate = new Date(Date.now());
        //document.getElementById('id_enddate').valueAsDate   = new Date(Date.now() + ( 3600 * 1000 * 24)); 
        //-------------- Load Datetime box ----------------------------------------
        //document.getElementById('id_shiftdate').valueAsDate = new Date();
      
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
    //-------------------- Load CheckIn/Allocation Chart --------------------------------------    
    function drawGooleChart() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1) alert("drawGooleChart"); 
        //var SESSION_CurrentUserEPF      = "<?php echo htmlspecialchars($_SESSION["user_epf"]); ?>"; 
        var extraInfoArray = []; // Array to store extra information
        
        // Show SweetAlert loading message
        Swal.fire({
            title: 'Please wait...',
            text: 'Data is loading',
            showConfirmButton: false,  // Hide confirm button
            allowOutsideClick: false, // Disable clicking outside to close
            willOpen: () => {
                Swal.showLoading();  // Show the loading spinner
            }
        });

        const DataAry = [];  
        //-------------------- Update CheckIn Chart -------------------------------------------------------        
        DataAry[0] = "funGetData_McRunDurationChart";        // Table Name
        DataAry[1] = document.getElementById("id_startdate").value;
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
                             
                dataAry_new.forEach(function(row,index) 
                {                     
                    var startDate = new Date(row[1]);
                    var endDate = new Date(row[2]);                      
                   
                    if (endDate >= startDate) 
                    {
                        // Your code for handling this case
                        //var endDateTimeString = endDate.toISOString().slice(0, 16);
                        dataTable.addRow([row[0], ' ' ,startDate, endDate]);
                       //var strRowInfo = row[1] + "," + row[2] + "," + row[3] + "," + row[4] + "," + row[5];
                       var strRowInfo = row[0] + "," + row[1] + "," + row[2];
                       extraInfoArray.push({ index: index, info: strRowInfo });
                    }                                    
         
                });
                if(intDebugEnable === 1) alert("options"); 
                var options = 
                        {
                            title: 'My Chart Title', // Add your chart title here
                            height: 600,
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
                
                //document.getElementById("id_charttitle").innerHTML = document.getElementById("id_SelMachine").options[document.getElementById("id_SelMachine").selectedIndex].text;
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
            // Close the loading message once the data has been processed
            Swal.close();
            //drawPieCharts();
            //drawPieCharts_Allocate();
        });
    }
    
</script>
</body>
</html>
