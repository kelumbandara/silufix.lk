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
                <div class="container-fluid  "> 
                    <div class="card card-default" >
                        <div class="card-header">
                            <h2 class="card-title text-warning"><strong>MTBF/MTTR Reports</strong></h2>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>                                
                            </div>
                        </div>                        
                        <div class="row col-12"> 
                            
                             <div class="col-md-2">                   
                                <label style="font-weight: bolder;" >Machine Category</label>    
                                <select class="form-control select2" onchange="funReportMttr_FilterMcCat()" id="id_ReportMttr_SelMcCat" style="width: 100%;">
                                    <option selected="none"></option>                            
                                </select>
                            </div>
                            <div class="col-md-2">                   
                                <label style="font-weight: bolder;" >Fault Type</label>    
                                <select class="form-control select2" onchange="funReportMttr_FilterFaultType()" id="id_ReportMttr_SelFaultType" style="width: 100%;">
                                    <option selected="none"></option>                            
                                </select>
                            </div>
                            <div class="col-md-2">                   
                                <label style="font-weight: bolder">Fault Level 1</label>    
                                <select class="form-control select2" onchange="funReportMttr_FilterFaultLevel1()" id="id_ReportMttr_SelFaultLevel1" style="width: 100%;">
                                    <option selected="none"></option>                            
                                </select>
                            </div>
                            <div class="col-md-2">                      
                                 <label style="font-weight: bolder">Fault Level 2</label>    
                                <select class="form-control select2" onchange="funReportMttr_FilteFaultLevel2()" id="id_ReportMttr_SelFaultLevel2" style="width: 100%;">
                                    <option selected="none"></option>                            
                                </select>               
                            </div>
                            <div class="col-md-2">                   
                                <label style="font-weight: bolder">Fault Level 3</label>    
                                <select class="form-control select2" onchange="funReportMttr_FilteFaultLevel3()" id="id_ReportMttr_SelFaultLevel3" style="width: 100%;">
                                    <option selected="none"></option>                            
                                </select>
                            </div>                        
                        </div>
                        <div class="row col-12"> 
                            <div class="col-md-2"> 
                                <label>Date Start:</label>
                                <div>
                                    <input type="date" id="id_sdate" value="22-07-2018" />
                                </div>
                            </div>
                            <div class="col-md-2"> 
                                <label>End Start:</label>
                                <div>
                                    <input type="date" id="id_edate" value="22-07-2018" />
                                </div>
                            </div>
                            <div class="col-md-2">                              
                                <div class="mt-4">
                                    <button class="form-control btn btn-primary" type="button" class="btn btn-primary" onclick="funViewReport()" id="id_ViewReport" name="viewbutton">View Report</button>
                                </div>
                            </div>   
                        </div>
                        <br>
                    </div>                    
                    <!-- /.card -->
                    <section class="content">
                        <div class="container-fluid">                            
                            <div class="row">
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-info">
                                        <div class="inner text-center">
                                            <h3 id="id_mtbf_value">0</h3>                                            
                                            <h5 id="id_mtbf_totocc">0</h5>
                                            <h5 id="id_mtbf_tottm">0</h5>                                            
                                        </div>
                                        <a href="#" class="small-box-footer">Mean Time Between Failures <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-success">
                                        <div class="inner text-center">
                                            <h3 id="id_mttr_value">0</h3>                                            
                                            <h5 id="id_mttr_totocc">0</h5>
                                            <h5 id="id_mttr_tottm">0</h5> 
                                        </div>                                       
                                        <a href="#" class="small-box-footer">Mean Time To Repair<i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="content">
                        <div class="container-fluid">                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-danger">  
                                        <div class="card-header">
                                            <h3 class="card-title"><b>MTBF/MTTR Details</b></h3>                                    
                                        </div> 
                                    </div>
                                    <div class="card-body" id="id_class1">
                                        <table id="id_table1" class="table table-bordered table-striped display compact">
                                            <thead class="bg-info">
                                                <tr>
                                                    <th>#</th>
                                                    <th>WorkOrderNo</th>
                                                    <th>CreatedDate</th>
                                                    <th>Department</th>
                                                    <th>Machine Category</th>
                                                    <th>Machine Number</th> 
                                                    <th>Fault type</th>           
                                                    <th>W/O Description</th>
                                                    <th>W/O Status</th>
                                                    <th>CreatedUser</th>
                                                    <th>RespondDateTime</th>
                                                    <th>Allocated Mechanic</th>
                                                    <th>Check in Mechanic</th>
                                                    <th>ClosedDateTime</th>
                                                    <th>ClosedUser</th>
                                                    <th>Total Time Duration</th>
                                                    <th>Cloused Fault Type</th>
                                                    <th>Cloused Fault level01</th>
                                                    <th>Cloused Fault level02</th>
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
            </section>
        </div> 
        <!-- Include Footer -->
        <?php
            include '../../headers/footer-bar.php'
        ?> 
</div>    
 
<!-- Page specific script -->
<script>
    //--------------- Admin Panel Minimize ----------------------
    $('[data-widget="pushmenu"]').PushMenu("collapse");
    
    $(function () 
    {
        document.getElementById('id_sdate').valueAsDate = new Date(Date.now() - (3600 * 1000 * 24 * 7));
        document.getElementById('id_edate').valueAsDate = new Date(Date.now() + ( 3600 * 1000 * 24)); 
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
      
        funLoadPage();
        //funViewReport();
    });

    //-------------------- ViewReport Function --------------------------------------------
    function funViewReport() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("View button Clicked");
 
        var strTotalOccurance = "";
        var vbl_sdate = document.getElementById("id_sdate").value;
        var vbl_edate = document.getElementById("id_edate").value;
        
        const DataAry = [];         
        DataAry[0] = "funGetMttrData";        // Table Name
        DataAry[1] = vbl_sdate;               // Start Date  
        DataAry[2] = vbl_edate;               // End Date Date 
        DataAry[3] = document.getElementById("id_ReportMttr_SelMcCat").value;
        DataAry[4] = document.getElementById("id_ReportMttr_SelFaultType").value;
        DataAry[5] = document.getElementById("id_ReportMttr_SelFaultLevel1").value;
        DataAry[6] = document.getElementById("id_ReportMttr_SelFaultLevel2").value;
        DataAry[7] = document.getElementById("id_ReportMttr_SelFaultLevel3").value;           
        if(intDebugEnable === 1)    alert("DataAry :" + DataAry);
         //--------------- Calculate MTTR ------------------------------------------------- 
        $.post('getData_WoReport_Advance.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert(json_data2);  
            var res = $.parseJSON(json_data2); 
      
            if(res.Status_Ary[0] === "true")
            {       
                strTotalOccurance = res.Data_Ary[1];
                if(intDebugEnable === 1) alert("strTotalOccurance :" + strTotalOccurance); 
                document.getElementById("id_mttr_totocc").innerHTML     = "Total Occurance : " + res.Data_Ary[1];
                document.getElementById("id_mttr_tottm").innerHTML      = "Downtime Time(Min) : " + res.Data_Ary[2];
                document.getElementById("id_mttr_value").innerHTML      =  parseFloat(res.Data_Ary[3]).toFixed(2);
            
                //------------ Calculate MTBF ---------------------------------------------
                // Parse the date strings into Date objects
                var dtStartDate = new Date(vbl_sdate);
                var dtEndDate = new Date(vbl_edate);
                // Calculate the difference in milliseconds
                var differenceInMs = dtEndDate - dtStartDate;
                // Convert milliseconds to minutes
                var differenceInMinutes = Math.floor(differenceInMs / (1000 * 60));
                //alert(differenceInMinutes);
                //console.log("Difference in minutes:", differenceInMinutes);
                //alert(strTotalOccurance);
                var strMTBF = differenceInMinutes / parseFloat(strTotalOccurance);
                //alert(strMTBF);
                document.getElementById("id_mtbf_totocc").innerHTML     = "Total Occurance : " + strTotalOccurance;
                document.getElementById("id_mtbf_tottm").innerHTML      = "Total Time(Min) : " + differenceInMinutes;
                document.getElementById("id_mtbf_value").innerHTML      = parseFloat(strMTBF).toFixed(2);
           
            }
            else if(res.Status_Ary[0] === "false")
            {
                //---------- Data not found ------------------------
                document.getElementById("id_mttr_totocc").innerHTML     = "Total Occurance : " + "-";
                document.getElementById("id_mttr_tottm").innerHTML      = "Downtime Time(Min) : " + "-";
                document.getElementById("id_mttr_value").innerHTML      = "NA";
                
                document.getElementById("id_mtbf_totocc").innerHTML     = "Total Occurance : " + "-";
                document.getElementById("id_mtbf_tottm").innerHTML      = "Total Time(Min) : " + "-";
                document.getElementById("id_mtbf_value").innerHTML      = "NA";
                
            }
            else if(res.Status_Ary[0] === "error")
            {
                Swal.fire({title: 'Error.!',text: res.Status_Ary[1],icon: 'error',confirmButtonText: 'OK'});
            }
        });
        funLoadTable();
    }
    
    //-------------------- Load Page : Machine Categories ----------------------------------
    function funLoadPage() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("Load Page");
        //alert("Select Machine Category filter value");  
        //----------------------- Load Machine Numbers --------------------------------------
        const DataAry = []; 
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "McCategory";
        DataAry[2] = "tblwo_errorlevel_breakdown";
        DataAry[3] = "0";
        //DataAry[4] = "MachineCategory";
        //DataAry[5] = document.getElementById("id_ModBrkDownCre_SelMcCategory").value;       //"pneumatic";  
        if(intDebugEnable === 1)    alert("DataAry :" + DataAry);
        
        $.post('comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1)    alert("json_data2 :" + json_data2);
            var res = $.parseJSON(json_data2);  
            
            var AryMcCategory = new Array();
            AryMcCategory   = res.Data_Ary; 
            
            if(intDebugEnable === 1)    alert("AryMcCategory :" + AryMcCategory);
            if(res.Status_Ary[0] === "true")
            {
                //------------ Remove All Items in "Machine No" -----------------------------------
                var options1 = document.querySelectorAll('#id_ReportMttr_SelMcCat option');
                options1.forEach(o => o.remove());
                //------------ Fill New Items -------------------------------------
                var sel_shoporderno = document.getElementById("id_ReportMttr_SelMcCat");
                for(var i = 0; i < AryMcCategory.length; i++)
                {
                    var opt1 = AryMcCategory[i];
                    var el1 = document.createElement("option");
                    el1.textContent = opt1;
                    el1.value = opt1;
                    sel_shoporderno.appendChild(el1);
                }               
                //--------------- Clear Fault Type Filter --------------------------------------
                var options2 = document.querySelectorAll('#id_ReportMttr_SelFaultType option');
                options2.forEach(o => o.remove());
                var opt2 = ["All"];
                opt2.forEach(function(value) 
                {
                    var el2 = document.createElement("option");
                    el2.textContent = value;
                    el2.value = value;
                    document.getElementById("id_ReportMttr_SelFaultType").appendChild(el2);
                });
                //--------------- Clear Fault Level1 Filter --------------------------------------
                var options3 = document.querySelectorAll('#id_ReportMttr_SelFaultLevel1 option');
                options3.forEach(o => o.remove());
                var opt3 = ["All"];
                opt3.forEach(function(value) 
                {
                    var el3 = document.createElement("option");
                    el3.textContent = value;
                    el3.value = value;
                    document.getElementById("id_ReportMttr_SelFaultLevel1").appendChild(el3);
                });
                //--------------- Clear Fault Level2 Filter --------------------------------------
                var options4 = document.querySelectorAll('#id_ReportMttr_SelFaultLevel2 option');
                options4.forEach(o => o.remove());
                var opt4 = ["All"];
                opt4.forEach(function(value) 
                {
                    var el4 = document.createElement("option");
                    el4.textContent = value;
                    el4.value = value;
                    document.getElementById("id_ReportMttr_SelFaultLevel2").appendChild(el4);
                });
                //--------------- Clear Fault Level2 Filter --------------------------------------
                var options5 = document.querySelectorAll('#id_ReportMttr_SelFaultLevel3 option');
                options5.forEach(o => o.remove());
                var opt5 = ["All"];
                opt5.forEach(function(value) 
                {
                    var el5 = document.createElement("option");
                    el5.textContent = value;
                    el5.value = value;
                    document.getElementById("id_ReportMttr_SelFaultLevel3").appendChild(el5);
                });
                funViewReport();
                funLoadTable();
            }
            else
            {
                // Remove existing options
                var options1 = document.querySelectorAll('#id_ReportMttr_SelMcCat option');
                options1.forEach(o => o.remove());

                // Create new options
                var opt1 = ["All"];
                opt1.forEach(function(value) 
                {
                    var el1 = document.createElement("option");
                    el1.textContent = value;
                    el1.value = value;
                    document.getElementById("id_ReportMttr_SelMcCat").appendChild(el1);
                });
            }
        });
    }
    //-------------------- Filter : FaultType Categories ----------------------------------
    function funReportMttr_FilterMcCat() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("FaultType Load");
        //alert("Select Machine Category filter value");
        //----------------------- Load Machine Numbers --------------------------------------
        const DataAry = []; 
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "FaultType";
        DataAry[2] = "tblwo_errorlevel_breakdown";
        DataAry[3] = "1";
        DataAry[4] = "McCategory";
        DataAry[5] = document.getElementById("id_ReportMttr_SelMcCat").value;       //"pneumatic";  
        if(intDebugEnable === 1)    alert("DataAry :" + DataAry);
        
        $.post('comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1)    alert("json_data2 :" + json_data2);
            var res = $.parseJSON(json_data2);  
            
            var AryMcCategory = new Array();
            AryMcCategory   = res.Data_Ary; 
            
            if(intDebugEnable === 1)    alert("AryMcCategory :" + AryMcCategory);
            if(res.Status_Ary[0] === "true")
            {
                //------------ Remove All Items in "Machine No" -----------------------------------
                var options1 = document.querySelectorAll('#id_ReportMttr_SelFaultType option');
                options1.forEach(o => o.remove());
                //------------ Fill New Items -------------------------------------
                var sel_shoporderno = document.getElementById("id_ReportMttr_SelFaultType");
                for(var i = 0; i < AryMcCategory.length; i++)
                {
                    var opt2 = AryMcCategory[i];
                    var el2 = document.createElement("option");
                    el2.textContent = opt2;
                    el2.value = opt2;
                    sel_shoporderno.appendChild(el2);
                }
                //--------------- Clear Fault Level1 Filter --------------------------------------
                var options3 = document.querySelectorAll('#id_ReportMttr_SelFaultLevel1 option');
                options3.forEach(o => o.remove());
                var opt3 = ["All"];
                opt3.forEach(function(value) 
                {
                    var el3 = document.createElement("option");
                    el3.textContent = value;
                    el3.value = value;
                    document.getElementById("id_ReportMttr_SelFaultLevel1").appendChild(el3);
                });
                //--------------- Clear Fault Level2 Filter --------------------------------------
                var options4 = document.querySelectorAll('#id_ReportMttr_SelFaultLevel2 option');
                options4.forEach(o => o.remove());
                var opt4 = ["All"];
                opt4.forEach(function(value) 
                {
                    var el4 = document.createElement("option");
                    el4.textContent = value;
                    el4.value = value;
                    document.getElementById("id_ReportMttr_SelFaultLevel2").appendChild(el4);
                });
                //--------------- Clear Fault Level2 Filter --------------------------------------
                var options5 = document.querySelectorAll('#id_ReportMttr_SelFaultLevel3 option');
                options5.forEach(o => o.remove());
                var opt5 = ["All"];
                opt5.forEach(function(value) 
                {
                    var el5 = document.createElement("option");
                    el5.textContent = value;
                    el5.value = value;
                    document.getElementById("id_ReportMttr_SelFaultLevel3").appendChild(el5);
                });
            }
            else
            {
                // Remove existing options
                var options2 = document.querySelectorAll('#id_ReportMttr_SelFaultType option');
                options2.forEach(o => o.remove());
                // Create new options
                var opt2 = ["All"];
                opt2.forEach(function(value) 
                {
                    var el2 = document.createElement("option");
                    el2.textContent = value;
                    el2.value = value;
                    document.getElementById("id_ReportMttr_SelFaultType").appendChild(el2);
                });
            }
        });
    }
    //-------------------- Filter : Fault Level 1 ----------------------------------
    function funReportMttr_FilterFaultType() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("Fault level 1 Load");
        //alert("Select Machine Category filter value");
        //----------------------- Load Machine Numbers --------------------------------------
        const DataAry = []; 
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "Level1";
        DataAry[2] = "tblwo_errorlevel_breakdown";
        DataAry[3] = "2";
        DataAry[4] = "McCategory";
        DataAry[5] = document.getElementById("id_ReportMttr_SelMcCat").value;       //"pneumatic";  
        DataAry[6] = "FaultType";
        DataAry[7] = document.getElementById("id_ReportMttr_SelFaultType").value;       //"pneumatic";  
        
        if(intDebugEnable === 1)    alert("DataAry :" + DataAry);
        
        $.post('comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1)    alert("json_data2 :" + json_data2);
            var res = $.parseJSON(json_data2);  
            
            var AryMcCategory = new Array();
            AryMcCategory   = res.Data_Ary; 
            
            if(intDebugEnable === 1)    alert("AryMcCategory :" + AryMcCategory);
            if(res.Status_Ary[0] === "true")
            {
                //------------ Remove All Items in "Machine No" -----------------------------------
                var options1 = document.querySelectorAll('#id_ReportMttr_SelFaultLevel1 option');
                options1.forEach(o => o.remove());
                //------------ Fill New Items -------------------------------------
                var sel_shoporderno = document.getElementById("id_ReportMttr_SelFaultLevel1");
                for(var i = 0; i < AryMcCategory.length; i++)
                {
                    var opt3 = AryMcCategory[i];
                    var el3 = document.createElement("option");
                    el3.textContent = opt3;
                    el3.value = opt3;
                    sel_shoporderno.appendChild(el3);
                }
                //--------------- Clear Fault Level2 Filter --------------------------------------
                var options4 = document.querySelectorAll('#id_ReportMttr_SelFaultLevel2 option');
                options4.forEach(o => o.remove());
                var opt4 = ["All"];
                opt4.forEach(function(value) 
                {
                    var el4 = document.createElement("option");
                    el4.textContent = value;
                    el4.value = value;
                    document.getElementById("id_ReportMttr_SelFaultLevel2").appendChild(el4);
                });
                //--------------- Clear Fault Level2 Filter --------------------------------------
                var options5 = document.querySelectorAll('#id_ReportMttr_SelFaultLevel3 option');
                options5.forEach(o => o.remove());
                var opt5 = ["All"];
                opt5.forEach(function(value) 
                {
                    var el5 = document.createElement("option");
                    el5.textContent = value;
                    el5.value = value;
                    document.getElementById("id_ReportMttr_SelFaultLevel3").appendChild(el5);
                });
            }
            else
            {
                // Remove existing options
                var options3 = document.querySelectorAll('#id_ReportMttr_SelFaultLevel1 option');
                options3.forEach(o => o.remove());
                // Create new options
                var opt3 = ["All"];
                opt3.forEach(function(value) 
                {
                    var el3 = document.createElement("option");
                    el3.textContent = value;
                    el3.value = value;
                    document.getElementById("id_ReportMttr_SelFaultLevel1").appendChild(el3);
                });
            }
        });
    }
    //-------------------- Filter : Fault Level 2 ----------------------------------
    function funReportMttr_FilterFaultLevel1() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("Fault level 2 Load");
        //alert("Select Machine Category filter value");
        //----------------------- Load Machine Numbers --------------------------------------
        const DataAry = []; 
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "Level2";
        DataAry[2] = "tblwo_errorlevel_breakdown";
        DataAry[3] = "3";
        DataAry[4] = "McCategory";
        DataAry[5] = document.getElementById("id_ReportMttr_SelMcCat").value;       //"pneumatic";  
        DataAry[6] = "FaultType";
        DataAry[7] = document.getElementById("id_ReportMttr_SelFaultType").value;       //"pneumatic";  
        DataAry[8] = "Level1";
        DataAry[9] = document.getElementById("id_ReportMttr_SelFaultLevel1").value;
        
        if(intDebugEnable === 1)    alert("DataAry :" + DataAry);        
        $.post('comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1)    alert("json_data2 :" + json_data2);
            var res = $.parseJSON(json_data2);  
            
            var AryMcCategory = new Array();
            AryMcCategory   = res.Data_Ary; 
            
            if(intDebugEnable === 1)    alert("AryMcCategory :" + AryMcCategory);
            if(res.Status_Ary[0] === "true")
            {
                //------------ Remove All Items in "Machine No" -----------------------------------
                var options1 = document.querySelectorAll('#id_ReportMttr_SelFaultLevel2 option');
                options1.forEach(o => o.remove());
                //------------ Fill New Items -------------------------------------
                var sel_shoporderno = document.getElementById("id_ReportMttr_SelFaultLevel2");
                for(var i = 0; i < AryMcCategory.length; i++)
                {
                    var opt4 = AryMcCategory[i];
                    var el4 = document.createElement("option");
                    el4.textContent = opt4;
                    el4.value = opt4;
                    sel_shoporderno.appendChild(el4);
                }
                //--------------- Clear Fault Level2 Filter --------------------------------------
                var options5 = document.querySelectorAll('#id_ReportMttr_SelFaultLevel3 option');
                options5.forEach(o => o.remove());
                var opt5 = ["All"];
                opt5.forEach(function(value) 
                {
                    var el5 = document.createElement("option");
                    el5.textContent = value;
                    el5.value = value;
                    document.getElementById("id_ReportMttr_SelFaultLevel3").appendChild(el5);
                });
            }
            else
            {
                // Remove existing options
                var options4 = document.querySelectorAll('#id_ReportMttr_SelFaultLevel2 option');
                options4.forEach(o => o.remove());
                // Create new options
                var opt4 = ["All"];
                opt4.forEach(function(value) 
                {
                    var el4 = document.createElement("option");
                    el4.textContent = value;
                    el4.value = value;
                    document.getElementById("id_ReportMttr_SelFaultLevel2").appendChild(el4);
                });
            }
        });
    }
    //-------------------- Filter : Fault Level 3 ----------------------------------
    function funReportMttr_FilteFaultLevel2() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("Fault level 2 Load");
        
        //alert("Select Machine Category filter value");
        //----------------------- Load Machine Numbers --------------------------------------
        const DataAry = []; 
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "Level3";
        DataAry[2] = "tblwo_errorlevel_breakdown";
        DataAry[3] = "4";
        DataAry[4] = "McCategory";
        DataAry[5] = document.getElementById("id_ReportMttr_SelMcCat").value;       //"pneumatic";  
        DataAry[6] = "FaultType";
        DataAry[7] = document.getElementById("id_ReportMttr_SelFaultType").value;       //"pneumatic";  
        DataAry[8] = "Level1";
        DataAry[9] = document.getElementById("id_ReportMttr_SelFaultLevel1").value;
        DataAry[10] = "Level2";
        DataAry[11] = document.getElementById("id_ReportMttr_SelFaultLevel2").value;
        
        if(intDebugEnable === 1)    alert("DataAry :" + DataAry);        
        $.post('comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1)    alert("json_data2 :" + json_data2);
            var res = $.parseJSON(json_data2);  
            
            var AryMcCategory = new Array();
            AryMcCategory   = res.Data_Ary; 
            
            if(intDebugEnable === 1)    alert("AryMcCategory :" + AryMcCategory);
            if(res.Status_Ary[0] === "true")
            {
                //------------ Remove All Items in "Machine No" -----------------------------------
                var options1 = document.querySelectorAll('#id_ReportMttr_SelFaultLevel3 option');
                options1.forEach(o => o.remove());
                //------------ Fill New Items -------------------------------------
                var sel_shoporderno = document.getElementById("id_ReportMttr_SelFaultLevel3");
                for(var i = 0; i < AryMcCategory.length; i++)
                {
                    var opt5 = AryMcCategory[i];
                    var el5 = document.createElement("option");
                    el5.textContent = opt5;
                    el5.value = opt5;
                    sel_shoporderno.appendChild(el5);
                }
            }
            else
            {
                // Remove existing options
                var options5 = document.querySelectorAll('#id_ReportMttr_SelFaultLevel3 option');
                options5.forEach(o => o.remove());
                // Create new options
                var opt5 = ["All"];
                opt5.forEach(function(value) 
                {
                    var el5 = document.createElement("option");
                    el5.textContent = value;
                    el5.value = value;
                    document.getElementById("id_ReportMttr_SelFaultLevel3").appendChild(el5);
                });
            }
        });
    }
     //-------------------- Load Datatable Function --------------------------------------------
    function funLoadTable() 
    { 
        let intDebugEnable = 0;
        if(intDebugEnable === 1) alert("funLoadTable");

        const DataAry = []; 
        //--------------TABLE ------------------------------
        DataAry[0] = "funGetData_Table";        // Table Name
        DataAry[1] = document.getElementById("id_sdate").value;
        DataAry[2] = document.getElementById("id_edate").value;
        DataAry[3] = document.getElementById("id_ReportMttr_SelMcCat").value;
        DataAry[4] = document.getElementById("id_ReportMttr_SelFaultType").value;
        DataAry[5] = document.getElementById("id_ReportMttr_SelFaultLevel1").value;
        DataAry[6] = document.getElementById("id_ReportMttr_SelFaultLevel2").value;
        DataAry[7] = document.getElementById("id_ReportMttr_SelFaultLevel3").value;   
         
        if(intDebugEnable === 1) alert("DataAry :" + DataAry);
        $.post('getData_WoReport_Advance.php', { userpara: DataAry }, function(json_data2) 
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
                intRowCount = res.Data_Ary2.length;
                if(intDebugEnable === 1) alert("intRowCount :" + intRowCount);
                let intTmp = 0;
                for(i=0;i<intRowCount;i++)
                {
                    //intLinewiseTotalDT = res.LineWiseDowntimeCategory1_Ary[i]+res.LineWiseDowntimeCategory2_Ary[i]+res.LineWiseDowntimeCategory3_Ary[i]+res.LineWiseDowntimeCategory4_Ary[i]+res.LineWiseDowntimeCategory5_Ary[i]+res.LineWiseDowntimeCategory6_Ary[i];
                    intTmp = i + 1;
                    dtbl2.row.add([intTmp.toString(), res.Data_Ary2[i][0], res.Data_Ary2[i][1], res.Data_Ary2[i][2], res.Data_Ary2[i][3] , res.Data_Ary2[i][4],res.Data_Ary2[i][5],res.Data_Ary2[i][6],res.Data_Ary2[i][7],res.Data_Ary2[i][8],res.Data_Ary2[i][9],res.Data_Ary2[i][10],res.Data_Ary2[i][11],res.Data_Ary2[i][12],res.Data_Ary2[i][13],res.Data_Ary2[i][14],res.Data_Ary2[i][15],res.Data_Ary2[i][16],res.Data_Ary2[i][17],res.Data_Ary2[i][18],res.Data_Ary2[i][19],res.Data_Ary2[i][20],res.Data_Ary2[i][21]]).draw(false);
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
   
</script>
</body>
</html>
