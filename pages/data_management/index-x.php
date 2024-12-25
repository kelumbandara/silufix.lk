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
                            <h3 class="card-title">Data Management</h3>
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
                                            <input class="form-control" type="date" id="id_startdate" onchange="funRefreshPage()" name="startDate" style="font-size: 15px;"/>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-2">    
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <div>
                                            <input class="form-control" type="date" id="id_enddate" onchange="funRefreshPage()" name="endDate" style="font-size: 15px;"/>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-2">                   
                                    <label style="font-weight: bolder;" >Department</label>    
                                    <select class="form-control select2" onchange="funRefreshPage()" id="id_Select_Department" style="width: 100%;">
                                        <option selected="none"></option>                            
                                    </select>
                                </div>
                                <div class="col-md-2">                   
                                    <label style="font-weight: bolder;" >Category</label>    
                                    <select class="form-control select2" onchange="funRefreshPage()" id="id_Select_Category" style="width: 100%;">
                                        <option value="All">All</option>
                                        <option value="BreakDown">Breakdown</option>
                                        <option value="PlanMaintenance">Plan Maintenance</option> 
                                        <option value="RedTag">Red Tag</option> 
                                        <option value="BuildingMaintenance">Building Maintenance</option> 
                                        <option value="OtherProject">Other Project</option> 
                                    </select>
                                </div>
                               
                                <div class="col-md-2"> 
                                    <div class="form-group">                                         
                                        <div class="form-group mt-4">
                                            <button type="button" class="form-control btn btn-primary" onclick="funRefreshPage()" id="id_ViewReport" name="viewbutton">View Report</button>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-2"> 
                                    
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
                                            <h3 class="card-title"><b>Work Order Details</b></h3>                                    
                                        </div> 
                                    </div>
                                    <div class="card-body" id="id_class1">
                                        <table id="id_table1" class="table table-bordered table-striped display compact">
                                            <thead class="bg-info">
                                                <tr>
                                                    <th>#</th>
                                                    <th>WorkOrderNo</th>
                                                    <th>CreatedDateTime</th>
                                                    <th>Department</th>                                                    
                                                    <th>Category</th>
                                                    <th>SubCategory</th>
                                                    <th>Description</th>
                                                    <th>Status</th>                                                    
                                                    <th>CreatedUser</th> 
                                                    <th>McCategory</th> 
                                                    <th>MachineNo</th>                                                     	
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
 
<?php    
    include './mod_WoManage.php';   

?> 
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
        dtbl1 = $('#id_table1').DataTable(); 
        
        funLoad_Departments();
        //funLoad_Categories();
        
    });
    
    $('#id_table1 tbody').on('click', 'tr', function () 
    {        
        const table2 = new DataTable('#id_table1');
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
        //DataAry[5] = document.getElementById("id_Select_Status").value;
        
        if(intDebugEnable === 1) alert("DataAry :" + DataAry);
        $.post('Data_Management.php', { userpara: DataAry }, function(json_data2) 
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
                    dtbl2.row.add([intTmp.toString(), res.Data_Ary[i][0], res.Data_Ary[i][1], res.Data_Ary[i][2], res.Data_Ary[i][3] , res.Data_Ary[i][4],res.Data_Ary[i][5],res.Data_Ary[i][6],res.Data_Ary[i][7],res.Data_Ary[i][8],res.Data_Ary[i][9],res.Data_Ary[i][10],res.Data_Ary[i][11],res.Data_Ary[i][12],res.Data_Ary[i][13],res.Data_Ary[i][14],res.Data_Ary[i][15],res.Data_Ary[i][16],res.Data_Ary[i][17],res.Data_Ary[i][18],res.Data_Ary[i][19]]).draw(false);
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
                              
                //-------------------------------------------------------------------
                funLoadTable();
            }
            
        });
    }
    //------------- Load All Charts And Table ------------------
    function funRefreshPage() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("funRefreshPage");

        funLoadTable();
        
    }
    //--------------- Function Click Create Breakdown ----------------------------
    function funWoTableRowClicked()
    {      
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("funWoTableRowClicked");
       
        //---------- Read ReceiptNumber ----------------------------------------
        //var table3 = $('#example1').DataTable();        
        //var mydata = table3.rows('.selected').data(); 
        var mydata = dtbl1.rows('.selected').data(); 
        //alert(mydata[0][5]);
        //alert(mydata[0][24]);
        var strWorkOrderNumber      = mydata[0][1];
        var strWorkOrderDepartment  = mydata[0][3];
        var strWorkOrderCategory    = mydata[0][4];
        var strWorkOrderDescription = mydata[0][6];
           
        //---------- Open Model_Wo Detail --------------------------------------
        var varmodbox = document.getElementById("id_ModWoManage");
        varmodbox.style.display = "block";
        
        document.getElementById("id_Mod_WoNumber").innerHTML        = strWorkOrderNumber;
        document.getElementById("id_Mod_Department").innerHTML    = strWorkOrderDepartment;
        document.getElementById("id_Mod_Category").innerHTML      = strWorkOrderCategory;        
        document.getElementById("id_Mod_WoDescription").innerHTML   = strWorkOrderDescription;
         
        
    }
    function funMoWoManage_Close()
    {
        //alert("Wo Table Row Clicked.."); 
        var varmodbox = document.getElementById("id_ModWoManage");
        varmodbox.style.display = "none";
    }
    
    //--------------- Function Click Create Breakdown ----------------------------
    function funMod_Clear()
    {      
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("funMod_Clear");
        Swal.fire({
                title: 'You are trying to delete this workorder record..',
                text: 'Your details will save on event log. Please confirm.',
                //icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => 
            {
                if (result.isConfirmed) 
                {
                    //executeFunction();
                    //alert("user click yes");
                
                    const DataAry = [];  
                    DataAry[0] = "funDelete_Record";
                    DataAry[1] = document.getElementById("id_Mod_WoNumber").innerHTML;        // Table Name
                                        
                    if(intDebugEnable === 1)    alert("DataAry :" + DataAry);
                    $.post('Data_Management.php', { userpara: DataAry }, function(json_data2) 
                    {
                        if(intDebugEnable === 1)    alert("json_data2" + json_data2);      
                        var res = $.parseJSON(json_data2); 
                        //alert(res.Status_Ary[0]);
                        if(res.Status_Ary[0] === "true")
                        {
                             Swal.fire({title: 'Success.!',text: 'Data deleted successfully',icon: 'success',confirmButtonText: 'OK'});  // success, error, warning, info, question   
                        }
                        else
                        {
                            Swal.fire({title: 'Error.!',text: res.Status_Ary[1],icon: 'error',confirmButtonText: 'OK'});  // success, error, warning, info, question   
                        }                
                        //------------- Close Model_Wo Details ---------------------------------                    
                        var varmodbox = document.getElementById("id_ModWoManage");
                        varmodbox.style.display = "none";
                        //alert("Re-fresh");
                        //funRefreshClicked();
                        funRefreshPage();  
                    }); 
                }
                else
                {
                    //alert("user click no");
                }
            });
        
    }
    //--------------- Function Click Create Breakdown ----------------------------
    function funMod_Change()
    {      
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("funMod_Change");
        
        let strWoCategory       = document.getElementById("id_Mod_Category").innerHTML;
        let strSelectedCategory = document.getElementById("id_Mod_Select_Category").value; 
        
        //if(intDebugEnable === 1)    alert("strWoCategory :" + strWoCategory);
        //if(intDebugEnable === 1)    alert("strSelectedCategory :" + strSelectedCategory);
        
        if(strSelectedCategory === "NA")
        {
            // success, error, warning, info, question
            Swal.fire({title: 'Alert !!',text: 'Please select a category.',icon: 'Warning', confirmButtonText: 'OK'});
        }
        else
        {
            if(strWoCategory === "BreakDown")
            {
                if((strSelectedCategory === 'RedTag')||(strSelectedCategory === 'PlanMaintenance'))
                {
                    if(intDebugEnable === 1)    alert(strSelectedCategory);
                    Swal.fire({
                        title: 'You are trying to change the category of  this workorder record..',
                        text: 'Your details will save on event log. Please confirm.',
                        //icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => 
                    {
                        if (result.isConfirmed) 
                        {
                            //executeFunction();
                            //alert("user click yes");
                            const DataAry = [];  
                            DataAry[0] = "funChange_Record";
                            DataAry[1] = document.getElementById("id_Mod_WoNumber").innerHTML;        // Table Name
                            DataAry[2] = strSelectedCategory;
                            
                            if(intDebugEnable === 1)        alert("DataAry :" + DataAry);
                            $.post('Data_Management.php', { userpara: DataAry }, function(json_data2) 
                            {
                                if(intDebugEnable === 1)    alert("json_data2" + json_data2);      
                                var res = $.parseJSON(json_data2); 
                                //alert(res.Status_Ary[0]);
                                if(res.Status_Ary[0] === "true")
                                {
                                     Swal.fire({title: 'Success.!',text: 'Category changed successfully',icon: 'success',confirmButtonText: 'OK'});  // success, error, warning, info, question   
                                }
                                else
                                {
                                    Swal.fire({title: 'Error.!',text: res.Status_Ary[1],icon: 'error',confirmButtonText: 'OK'});  // success, error, warning, info, question   
                                }                
                                //------------- Close Model_Wo Details ---------------------------------                    
                                var varmodbox = document.getElementById("id_ModWoManage");
                                varmodbox.style.display = "none";
                                //alert("Re-fresh");
                                //funRefreshClicked();
                                funRefreshPage();  
                            }); 
                        }
                        else
                        {
                            //alert("user click no");
                        }
                    });
                }
                else
                {
                    Swal.fire({title: 'Alert !!',text: 'Selected category can not changed..',icon: 'Warning', confirmButtonText: 'OK'});
                }
            }
            else  if(strWoCategory === "RedTag")
            {
                if(strSelectedCategory === 'PlanMaintenance')
                {
                    if(intDebugEnable === 1)    alert("PlanMaintenance");
                    Swal.fire({
                        title: 'You are trying to change the category of  this workorder record..',
                        text: 'Your details will save on event log. Please confirm.',
                        //icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => 
                    {
                        if (result.isConfirmed) 
                        {
                            //executeFunction();
                            //alert("user click yes");
                            const DataAry = [];  
                            DataAry[0] = "funChange_Record";
                            DataAry[1] = document.getElementById("id_Mod_WoNumber").innerHTML;        // Table Name
                            DataAry[2] = strSelectedCategory;
                            
                            if(intDebugEnable === 1)        alert("DataAry :" + DataAry);
                            $.post('Data_Management.php', { userpara: DataAry }, function(json_data2) 
                            {
                                if(intDebugEnable === 1)    alert("json_data2" + json_data2);      
                                var res = $.parseJSON(json_data2); 
                                //alert(res.Status_Ary[0]);
                                if(res.Status_Ary[0] === "true")
                                {
                                     Swal.fire({title: 'Success.!',text: 'Category changed successfully',icon: 'success',confirmButtonText: 'OK'});  // success, error, warning, info, question   
                                }
                                else
                                {
                                    Swal.fire({title: 'Error.!',text: res.Status_Ary[1],icon: 'error',confirmButtonText: 'OK'});  // success, error, warning, info, question   
                                }                
                                //------------- Close Model_Wo Details ---------------------------------                    
                                var varmodbox = document.getElementById("id_ModWoManage");
                                varmodbox.style.display = "none";
                                //alert("Re-fresh");
                                //funRefreshClicked();
                                funRefreshPage();  
                            }); 
                        }
                        else
                        {
                            //alert("user click no");
                        }
                    });
                }
                else
                {
                    Swal.fire({title: 'Alert !!',text: 'Selected category can not changed..',icon: 'Warning', confirmButtonText: 'OK'});
                }
            }
            else
            {
                Swal.fire({title: 'Alert !!',text: 'Selected category can not changed..',icon: 'Warning', confirmButtonText: 'OK'});
            }
            
        }

    }
    
    
</script>
</body>
</html>
