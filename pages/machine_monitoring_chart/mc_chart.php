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
                        <div class="border-top my-0"></div> 
                        <div class="row my-1">   
                            <!-- /.col -->
                            <div class="col-md-8">
                                <div class="card card-success">                                    
                                    <div class="card-body" id="Id_DivBarChart_1">                                    
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>                            
                            <!-- /.col -->
                            <div class="col-md-4">
                                
                            </div>
                        
                        <!-- /.row -->
                        </div>                        
                        <div class="border-top my-1"></div>                        
                        <!-- /.row (main row) -->
                    </div><!-- /.container-fluid -->
                    <!-- Include Footer -->
                    <?php
                        include '../../headers/footer-bar.php'
                    ?> 
                </div>
            </section>
        </div>    
    </div>    
 
<!-- Navbar -->
<?php
    //include './model-pages/mod_CreateBreakDown.php';    
    //include './model-pages/mod_BreakDownStateChange.php';        
?>    
<!-- Page specific script -->
<script>
    
    var i;
    var dtbl1;
    var strReceiptNo = "0";
    //------------- MQTT Settings ------------------
    var mqtt;
    var reconnectTimeout = 2000;
    var host="178.128.30.122";       // Noyon PORT 9001
    var strPublishTopic = "TST/SVR1760A";
    //var host="localhost";
    var port=9001;
    var intMqttState = 0;
    
    $(function () 
    {        
        //Initialize Select2 Elements
        $('.select2').select2();
        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        });  
         //alert("Hooi");
        //------------ DataTable Initialize -------------------
        $("#example1").DataTable({
            "paging": false,
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false,            
            "scrollX": true,
            "scrollY": 160,
            "info": false, 
            "rowCallback" : funCellCreated,
            "dom": "lrti"
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        //$("#example1").DataTable({
        //    "responsive": true, "lengthChange": false, "autoWidth": false,
        //    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        //}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        dtbl1 = $('#example1').DataTable();        
        //--- Load Tables --------------------------------------
        funRefreshClicked();
        //funRefreshHomeDowntimeDashboard(); 
        //MQTTconnect();
    }); 
    $('#myCustomSearchBox').keyup(function() 
    {
        dtbl1.search($(this).val()).draw(); // this  is for customized searchbox with datatable search feature.
    });
    $('[data-widget="pushmenu"]').PushMenu("collapse");    
    function funCellCreated(row, data, index) 
    {        
        //alert(index);
        $(row).find('td:eq(4)').css('background-color', data[1]);
        $(row).find('td:eq(5)').css('background-color', data[2]);
        $(row).find('td:eq(6)').css('background-color', data[3]);        
        //if(data[3]> 420)    $(row).find('td:eq(3)').css('background-color', data[4]);       
    }

    $('#example1 tbody').on('click', 'tr', function () 
    {        
        const table2 = new DataTable('#example1');
        table2.on('click', 'tbody tr', (e) => 
        {
            let classList = e.currentTarget.classList;
            if (classList.contains('selected')) 
            {
                //classList.remove('selected');
            }
            else 
            {
                table2.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
                classList.add('selected');          
                funWoTableRowClicked();
            }
        });        
    });

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
        var today = new Date();
        var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        document.getElementById("id_datetime").innerHTML = date+' '+time;
        //--------------- Update Data ----------------------------------------------
        //funRefreshHomeDowntimeDashboard();        
    }, 5000); 
    //-------------------- Read Data to Load Table ----------------------
    function funRefreshClicked() 
    {
        alert("Refresh page");
        //var myJavaScriptVariable = "<?php echo isset($_SESSION['user_name2']) ? $_SESSION['user_name2'] : 'Modaya'; ?>";
        //alert(myJavaScriptVariable);        
        
        //-------------- Update Home page Chart ---------------------------------------------
        var vblSendPara =  "1234"; 
        $.post('getData_McChart.php', { userpara: vblSendPara }, function(json_data2) 
        {
            alert(json_data2);           
            var res = $.parseJSON(json_data2);        
            const varDate = ["08/12/2023", "09/12/2023", "10/12/2023","12/12/2023", "14/12/2023", "16/12/2023","17/12/2023", "19/12/2023", "20/12/2023"];
            const varWoCount = [10,18,11,20,23,19,16,21,11];     
                     
            var ServerDatetimeAry   = new Array();
            var Sen1SpeedAry        = new Array();
           
            ServerDatetimeAry   = res.ServerDatetime_Ary;          
            Sen1SpeedAry        = res.Sen1Speed_Ary;  
           
            //-------------------------------------------------------------
            //- BAR CHART:1 - Line Wise Downtime Summary  
            //-------------------------------------------------------------            
            document.getElementById("Id_DivBarChart_1").innerHTML = '&nbsp;';
            document.getElementById("Id_DivBarChart_1").innerHTML = '<canvas id="id_barChart_1" style="min-height: 200px; height: 250px; max-height: 300px; max-width: 100%;"></canvas>';
            var barChartCanvas = $('#id_barChart_1').get(0).getContext('2d');
            var barChart1_Data2 = 
            {
                //labels  : res.WorkOrderNo_Ary,
                labels  : ServerDatetimeAry,
                datasets: [
                {
                    label               : 'Machine RPM',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : Sen1SpeedAry
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
                type: 'line',
                data: barChartData
                //options: barChartOptions
            });            
        });           
    }   
    //--------------- Function Click Create Breakdown ----------------------------
    function funModelBreakDownClicked()
    {        
        //alert("Model Brakdown Clicked..");
        //---------- Open Model_Break Down --------------------------------------
        var varmodbox = document.getElementById("id_mod_breakdown");
        varmodbox.style.display = "block";
        
        //alert("Refresh Button clicked.."); 
        var vblSendPara =  "1234"; 
        $.post('class/getData_HomeModelCreateWo.php', { userpara: vblSendPara }, function(json_data2) 
        {
            //alert(json_data2);  
            var res = $.parseJSON(json_data2);
           
            var AryMcCategory = new Array();
            var AryLevel1   = new Array();
            var AryLevel2   = new Array();
            var AryLevel3   = new Array();
            var AryMachineNumber = new Array();
            
            AryMcCategory = res.McCategoryAry;           
            AryLevel1 = res.Level1Ary;                   
            AryLevel2 = res.Level2Ary;           
            AryLevel3 = res.Level3Ary;     
            
            AryMachineNumber = res.MachineNumberAry;
            //alert(AryMachineNumber[0]);
            //alert(AryMachineNumber[1]);
            //alert(AryMachineNumber[2]);
            //------------ Remove All Items in "Machine Category" -----------------------------------
            var options2 = document.querySelectorAll('#id_McCategory option');
            options2.forEach(o => o.remove());
            //------------ Fill New Items -------------------------------------
            var sel_cusordno = document.getElementById("id_McCategory");
            for(var i = 0; i < AryMcCategory.length; i++)
            {
                var opt = AryMcCategory[i];
                var el = document.createElement("option");
                el.textContent = opt;
                el.value = opt;
                sel_cusordno.appendChild(el);
            }             
            //------------ Remove All Items in "Machine No" -----------------------------------
            var options3 = document.querySelectorAll('#id_MachineNo option');
            options3.forEach(o => o.remove());
            //------------ Fill New Items -------------------------------------
            var sel_shoporderno = document.getElementById("id_MachineNo");
            for(var i = 0; i < AryMachineNumber.length; i++)
            {
                var opt3 = AryMachineNumber[i];
                var el3 = document.createElement("option");
                el3.textContent = opt3;
                el3.value = opt3;
                sel_shoporderno.appendChild(el3);
            }
            
            //------------ Remove All Items in "MachineNumber" -----------------------------------
            var options4 = document.querySelectorAll('#id_FaultType option');
            options4.forEach(o => o.remove());
            //------------ Fill New Items -------------------------------------
            var sel_FaultType = document.getElementById("id_FaultType");
            for(var i = 0; i < AryLevel1.length; i++)
            {
                var opt4 = AryLevel1[i];
                var el4 = document.createElement("option");
                el4.textContent = opt4;
                el4.value = opt4;
                sel_FaultType.appendChild(el4);
            }
            
            //------------ Remove All Items in "Design" -----------------------------------
            var options5 = document.querySelectorAll('#id_FaultLevel option');
            options5.forEach(o => o.remove());
            //------------ Fill New Items -------------------------------------
            var sel_FaultLevel = document.getElementById("id_FaultLevel");
            for(var i = 0; i < AryLevel2.length; i++)
            {
                var opt5 = AryLevel2[i];
                var el5 = document.createElement("option");
                el5.textContent = opt5;
                el5.value = opt5;
                sel_FaultLevel.appendChild(el5);
            }   
            //---------------- Load Now Date and time to Model Box --------------------------
            // Get the current date and time
            const now = new Date();
            // Format the date and time as required by the datetime-local input
            const year = now.getFullYear().toString().padStart(4, '0');
            const month = (now.getMonth() + 1).toString().padStart(2, '0');
            const day = now.getDate().toString().padStart(2, '0');
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');

            // Set the value of the input
            const datetimeInput = document.getElementById('id_datetime');
            datetimeInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
            datetimeInput.disabled = true;
            
        });        
    }
    //----------- fun Back Button Cliked  ----------------------------------
    function funClickedEditBack()
    {
        setTimeout(window.close, 10);
        window.open("./index.php");
    }
    //-------------------- Model : Edit Update Clicked -------------------------
    function funClickedModBreakdownUpdate() 
    {
        //alert("Breakdown Update Clicked");   
        const DataAry = []; 

        DataAry[0] = "WMS-1760A";
        DataAry[1] = "Unit-1";
        DataAry[2] = "RelatedDep";
        DataAry[3] = "BreakDown";
        DataAry[4] = document.getElementById("id_datetime").value;        
        DataAry[5] = document.getElementById("id_McCategory").value;
        DataAry[6] = document.getElementById("id_MachineNo").value;
        DataAry[7] = document.getElementById("id_FaultType").value;
        DataAry[8] = document.getElementById("id_FaultLevel").value;
        DataAry[9] = "L3";
        DataAry[10] = "L4";         
        DataAry[11] = document.getElementById("id_note").value;        
        DataAry[12] = "Open";
        DataAry[13] = "";
        DataAry[14] = "";
        DataAry[15] = 1;
        DataAry[16] = 1;
        DataAry[17] = 1;
        
        //alert(DataAry); 
        //var vblSendPara =  "1234"; 
        $.post('class/insertData_WoBrakdown.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2);           
            var res = $.parseJSON(json_data2);
            //alert(res);
            //alert(res[0]); 
            //alert(res[1]);   
            if(intMqttState === 1)
            {
                message = new Paho.MQTT.Message("{\"MacAdd\":\"E8:9F:6D:92:D3:0D\",\"MsgType\":\"BrkdwnEvent\",\"IPAdd\":\"192.168.1.105\",\"UserName\":\"Kelum\",\"ModelNo\":\"DCS-1507A_UI\",\"ManufacDate\":\"16/12/2023\",\"EventNo\":\"1\",\"PwrOnCount\":\"0\",\"RunTime\":\"0\",\"FrameworkVer\":\"DCS-1507A_Frm3\",\"SoftVer\":\"8.0\",\"SigStrength\":\"-36\"}");
                message.destinationName =strPublishTopic;
                mqtt.send(message);
            }
            else
            {
                alert("Fail Connecting with server");
            }    
            //alert("Data Updated successfully.");               
            var varmodbox = document.getElementById("id_mod_breakdown");
            varmodbox.style.display = "none";  
            funRefreshClicked();
        }); 
        //alert("Data Updated successfully.");               
        //var varmodbox = document.getElementById("id_mod_breakdown");
        //varmodbox.style.display = "none";  
        //funRefreshClicked();
    }
    //--------------- Function Click Create Breakdown ----------------------------
    function funWoTableRowClicked()
    {        
        //alert("Wo Table Row Clicked..");
        //---------- Read ReceiptNumber ----------------------------------------
        //var table3 = $('#example1').DataTable();        
        //var mydata = table3.rows('.selected').data();  
        
        var mydata = dtbl1.rows('.selected').data(); 
        //alert(mydata[0][5]);
        //alert(mydata[0][24]);
        var strWorkOrderNumber      = mydata[0][1];
        var strWorkOrderDepartment  = mydata[0][2];
        var strWorkOrderCategory    = mydata[0][4];
        var strWorkOrderStatus      = mydata[0][7];
        //alert(strWorkOrderCategory);
        //alert(strWorkOrderStatus);
        const now = new Date();
        // Format the date and time as required by the datetime-local input
        const year = now.getFullYear().toString().padStart(4, '0');
        const month = (now.getMonth() + 1).toString().padStart(2, '0');
        const day = now.getDate().toString().padStart(2, '0');
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');

        // Set the value of the input        

        if(strWorkOrderCategory === "BreakDown")
        {
            //alert("Break Down");
            if(strWorkOrderStatus === "Open")
            {
                //alert("Work OrderStste : Open");
                //---------- Open Model_Break Down --------------------------------------                
                var varmodbox = document.getElementById("id_mod_breakdown_statechange");
                varmodbox.style.display = "block";
                document.getElementById("id_mod_breakdown_heading").innerHTML = "Acknowledge to BreakDown";
                document.getElementById("id_mod_breakdown_WoNo").value      = strWorkOrderNumber;
                document.getElementById("id_mod_breakdown_WoDep").value     = strWorkOrderDepartment;
                document.getElementById("id_mod_breakdown_WoCat").value     = strWorkOrderCategory;
                document.getElementById("id_mod_breakdown_WoStatus").value  = "Acknowledged";
                const datetimeInput = document.getElementById('id_mod_breakdown_dt');
                datetimeInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
                datetimeInput.disabled = true;
        
            }
            else if(strWorkOrderStatus === "Acknowledged")
            {
                //alert("Work OrderStste : Respond");
                //---------- Open Model_Break Down --------------------------------------                
                var varmodbox = document.getElementById("id_mod_breakdown_statechange");
                varmodbox.style.display = "block";
                document.getElementById("id_mod_breakdown_heading").innerHTML = "Inprogress a BreakDown";
                document.getElementById("id_mod_breakdown_WoNo").value      = strWorkOrderNumber;
                document.getElementById("id_mod_breakdown_WoDep").value     = strWorkOrderDepartment;
                document.getElementById("id_mod_breakdown_WoCat").value     = strWorkOrderCategory;
                document.getElementById("id_mod_breakdown_WoStatus").value  = "Inprogress";
                const datetimeInput = document.getElementById('id_mod_breakdown_dt');
                datetimeInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
                datetimeInput.disabled = true;
            }
            else if(strWorkOrderStatus === "Inprogress")
            {
                //alert("Work OrderStste : Close");
                //---------- Open Model_Break Down --------------------------------------                
                var varmodbox = document.getElementById("id_mod_breakdown_statechange");
                varmodbox.style.display = "block";
                document.getElementById("id_mod_breakdown_heading").innerHTML = "Close a BreakDown";
                document.getElementById("id_mod_breakdown_WoNo").value      = strWorkOrderNumber;
                document.getElementById("id_mod_breakdown_WoDep").value     = strWorkOrderDepartment;
                document.getElementById("id_mod_breakdown_WoCat").value     = strWorkOrderCategory;
                document.getElementById("id_mod_breakdown_WoStatus").value  = "Closed";
                const datetimeInput = document.getElementById('id_mod_breakdown_dt');
                datetimeInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
                datetimeInput.disabled = true;
            }
            else if(strWorkOrderStatus === "Closed")
            {
                //alert("Work OrderStste : Closed");
                //---------- Open Model_Break Down --------------------------------------                
                var varmodbox = document.getElementById("id_mod_breakdown_statechange");
                varmodbox.style.display = "block";
                document.getElementById("id_mod_breakdown_heading").innerHTML = "Verify a BreakDown";
                document.getElementById("id_mod_breakdown_WoNo").value      = strWorkOrderNumber;
                document.getElementById("id_mod_breakdown_WoDep").value     = strWorkOrderDepartment;
                document.getElementById("id_mod_breakdown_WoCat").value     = strWorkOrderCategory;
                document.getElementById("id_mod_breakdown_WoStatus").value  = "Verified";
                const datetimeInput = document.getElementById('id_mod_breakdown_dt');
                datetimeInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
                datetimeInput.disabled = true;
            }
            else
            {
                alert("Work Order Already Closed.");
            }
        }
        else if(strWorkOrderCategory === "PlanMaintenance")
        {
            alert("Plan Maintenance");
        }
        else if(strWorkOrderCategory === "RedTag")
        {
            alert("Red Tag");
        }
        else if(strWorkOrderCategory === "BuildingMaintenance")
        {
            alert("Building Maintenance");
        }
        else
        {
             alert("Category not relavant..");
        }
        
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
                alert("Fail Connecting with server");
            }    
            //var AryCustomOrder = new Array();
            //AryCustomOrder = res.CustomOrderAry;
            //document.getElementById("id_status").value = res[1];
        }); 
        //alert("Data Updated successfully.");
               
        var varmodbox = document.getElementById("id_mod_breakdown_statechange");
        varmodbox.style.display = "none";        
        funRefreshClicked();
        
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
        var options = {timeout: 3,onSuccess: onMqttConnect};  		 
        mqtt.connect(options); //connect
    }
    function funRefreshHomeDowntimeDashboard()
    {
        //alert("Update Home Downtime Dashboard");
        //-------------- Update Home page Running Downtime Dashboard ---------------------------------------------
        var vblSendPara =  "1234"; 
        $.post('class/getData_HomeRunDtDashboard.php', { userpara: vblSendPara }, function(json_data2) 
        {
            //alert(json_data2);  
            var res = $.parseJSON(json_data2);
            //alert(json_data2); 
            var RunDT_IDAry           = new Array();
            var RunDT_MachineNoAry    = new Array();
            var RunDT_DowntimeAry     = new Array();
            var strText = "";

            RunDT_IDAry               = res.RunDT_ID_Ary;          
            RunDT_MachineNoAry        = res.RunDT_MachineNo_Ary;
            RunDT_DowntimeAry      = res.RunDT_RunDowntime_Ary;
    
            let intRecCount = RunDT_IDAry.length; 
            //alert(intRecCount);           
            for(i=1; i<8; i++)
            {       
                //alert("Inside for loop");
                if(i < intRecCount)
                {
                    //alert("i < intRecCount");
                    strText = "id_mcnoruningdt_" + i;
                    document.getElementById(strText).innerHTML = RunDT_MachineNoAry[i];
                    strText = "id_mcruningdt_" + i;
                    document.getElementById(strText).innerHTML = RunDT_DowntimeAry[i];
                    strText = "id_mcrundtcolor_" + i;
                    document.getElementById(strText).style.backgroundColor =  "red";
                }
                else
                {
                    //alert("i !< intRecCount");
                    strText = "id_mcnoruningdt_" + i;
                    document.getElementById(strText).innerHTML = "";
                    strText = "id_mcruningdt_" + i;
                    document.getElementById(strText).innerHTML = "";
                    strText = "id_mcrundtcolor_" + i;
                    document.getElementById(strText).style.backgroundColor =  "whitesmoke";
                }
            }  
            //alert("Update DT Dashboard Finised");
        });
        //-------------- Update Home page Attend Downtime Dashboard ---------------------------------------------
        vblSendPara =  "1234"; 
        $.post('class/getData_HomeAttnDtDashboard.php', { userpara: vblSendPara }, function(json_data2) 
        {
            //alert(json_data2);  
            var res = $.parseJSON(json_data2);
            //alert(json_data2); 
            var AttnDT_IDAry           = new Array();
            var AttnDT_MachineNoAry    = new Array();
            var AttnDT_DowntimeAry     = new Array();
            var strText = "";
        
            AttnDT_IDAry            = res.AttnDT_ID_Ary;          
            AttnDT_MachineNoAry     = res.AttnDT_MachineNo_Ary;
            AttnDT_DowntimeAry      = res.AttnDT_RunDowntime_Ary;
    
            let intRecCount = AttnDT_IDAry.length; 
            //alert(intRecCount);           
            for(i=1; i<7; i++)
            {            
                if(i < intRecCount)
                {
                    //alert("i < intRecCount");
                    strText = "id_mcnoattenddt_" + i;
                    document.getElementById(strText).innerHTML = AttnDT_MachineNoAry[i];
                    strText = "id_mcattenddt_" + i;
                    document.getElementById(strText).innerHTML = AttnDT_DowntimeAry[i];
                    strText = "id_mcatnddtcolor_" + i;
                    document.getElementById(strText).style.backgroundColor =  "lightgreen";
                }
                else
                {
                    strText = "id_mcnoattenddt_" + i;
                    document.getElementById(strText).innerHTML = "";
                    strText = "id_mcattenddt_" + i;
                    document.getElementById(strText).innerHTML = "";
                    strText = "id_mcatnddtcolor_" + i;
                    document.getElementById(strText).style.backgroundColor =  "whitesmoke";
                }
            }  
            //alert("Update DT Dashboard Finised");
        });
    }
</script>
</body>
</html>
