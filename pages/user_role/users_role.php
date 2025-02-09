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
                    <div class="row pt-0">
                       
                        <div class="col-lg-12">
                            <h4 class="text-lg-left text-warning"><strong>User Access Management </strong></h4>                        
                        </div>
                    </div>    
                    <div class="border-top my-2"></div>
                    <!-- User Role Selector -->
                    <div class="row mb-3">        
                        <label for="id_UserRoleSelect" class="col-md-2 col-form-label">User Role:</label>
                        <div class="col-md-3">                            
                            <select class="form-control" id="id_UserRoleSelect" onchange="funLoadPermissions()">                                
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary" onclick="funUpdatePermissions()">Update</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary" onclick="fun_NewUserType()">New</button>
                            <button type="button" class="btn btn-primary" onclick="fun_DeleteUserType()">Delete</button>
                        </div>                        
                    </div>
                    <div class="row mb-3">        
                        <label for="id_UserRoleSelect" class="col-md-2 col-form-label">Role Description</label>
                        <div class="col-md-3">
                            <h6 id="id_RoleDescription"> Test </h6>
                        </div>
                    </div>
                    
                    <div class="border-top my-2"></div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <h4>Admin Panel Access:</h4>
                            <!-- Home Dashboard Row -->
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_10">
                                <label class="form-check-label" for="id_10"><strong>Home Dashboard</strong></label>
                            </div>
                            <!-- Work Order Details -->
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_20">
                                <label class="form-check-label" for="id_20"><strong>Work Order Details</strong></label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_201">
                                <label class="form-check-label" for="id_201">Workorder Summary (MTBF/MTTR)</label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_202">
                                <label class="form-check-label" for="id_202">Breakdown</label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_203">
                                <label class="form-check-label" for="id_203">Red Tag</label>
                            </div>                           
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_204">
                                <label class="form-check-label" for="id_204">Service</label>
                            </div>                                                      
                            
                            <!-- Machine Monitoring -->
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_30">
                                <label class="form-check-label" for="id_30"><strong>Machine Monitoring</strong></label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_301">
                                <label class="form-check-label" for="id_301">Dashboard</label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_302">
                                <label class="form-check-label" for="id_302">Machine wise Report</label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_303">
                                <label class="form-check-label" for="id_303">Module wise Report</label>
                            </div>
                            <!-- Mechanic Performance -->
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_40">
                                <label class="form-check-label" for="id_40"><strong>Mechanic Performance</strong></label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_401">
                                <label class="form-check-label" for="id_401">Dashboard</label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_402">
                                <label class="form-check-label" for="id_402">Job History</label>
                            </div> 
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_403">
                                <label class="form-check-label" for="id_403">Job History Details</label>
                            </div> 
                            <!-- User Management -->
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_50">
                                <label class="form-check-label" for="id_50"><strong>User Management</strong></label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_501">
                                <label class="form-check-label" for="id_501">User Account Management</label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_502">
                                <label class="form-check-label" for="id_502">User Access Management</label>
                            </div>                             
                            <!-- Settings Row -->
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_60">
                                <label class="form-check-label" for="60"><strong>System Management</strong></label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_601">
                                <label class="form-check-label" for="id_601">Master Data- Breakdown</label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_602">
                                <label class="form-check-label" for="id_602">Master Data- Redtag</label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_603">
                                <label class="form-check-label" for="id_603">Master Data- Service</label>
                            </div>  
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_604">
                                <label class="form-check-label" for="id_604">Issue Types</label>
                            </div>  
                           <!-- User Profile -->
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_70">
                                <label class="form-check-label" for="id_70"><strong>User Profile</strong></label>
                            </div>                            
                        </div>
                        <div class="col-md-4">
                            <h4>Home Dashboard Access:</h4>
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_10011">
                                <label class="form-check-label" for="id_10011"><strong>Downtime Dashboard</strong></label>
                            </div>
                            <!-- Machine Monitoring Row -->
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_10012">
                                <label class="form-check-label" for="id_10012"><strong>Mechanic Dashboard</strong></label>
                            </div>
                            
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_10015">
                                <label class="form-check-label" for="id_10015"><strong>Downtime Summary</strong></label>
                            </div>
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_10016">
                                <label class="form-check-label" for="id_10016"><strong>WO Summary</strong></label>
                            </div>
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_10017">
                                <label class="form-check-label" for="id_10017"><strong>Breakdown Chart</strong></label>
                            </div>
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_10018">
                                <label class="form-check-label" for="id_10018"><strong>Work Order Table</strong></label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_1001811">
                                <label class="form-check-label" for="id_1001811">Work Order Details</label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_1001812">
                                <label class="form-check-label" for="id_1001812">Allocate Mechanics</label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_1001813">
                                <label class="form-check-label" for="id_1001813">Check In</label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_1001814">
                                <label class="form-check-label" for="id_1001814">Close WO</label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_1001815">
                                <label class="form-check-label" for="id_1001815">Verify</label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_1001816">
                                <label class="form-check-label" for="id_1001816">Re-Open</label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_1001817">
                                <label class="form-check-label" for="id_1001817">Chat</label>
                            </div> 
                            <div class="form-check mb-0 ml-4 d-none">
                                <input class="form-check-input" type="checkbox" value="" id="id_1001818">
                                <label class="form-check-label" for="id_1001818">Delete</label>
                            </div> 
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_10019">
                                <label class="form-check-label" for="id_10019"><strong>Break Down Button</strong></label>
                            </div>
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_10020">
                                <label class="form-check-label" for="id_10020"><strong>Planned Maintenance Button</strong></label>
                            </div>
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_10021">
                                <label class="form-check-label" for="id_10021"><strong>Red Tag</strong></label>
                            </div>
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_10022">
                                <label class="form-check-label" for="id_10022"><strong>Building Maintenance</strong></label>
                            </div>
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_10023">
                                <label class="form-check-label" for="id_10023"><strong>Other</strong></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h4>Other Settings:</h4>
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_90011">
                                <label class="form-check-label" for="id_901"><strong>User Credentials for Non Engineering Users</strong></label>
                            </div>
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_90012">
                                <label class="form-check-label" for="id_902"><strong>Hide Downtime Detail, Wo Summary and Chart</strong></label>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="" id="id_90013">
                                <label class="form-check-label" for="id_10018"><strong>Auto Refresh</strong></label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_9001311">
                                <label class="form-check-label" for="id_1001811">Downtime Dashboard</label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_9001312">
                                <label class="form-check-label" for="id_1001812">Mechanic Dashboard    </label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_9001313">
                                <label class="form-check-label" for="id_1001813">Downtime Summary</label>
                            </div>                            
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_9001314">
                                <label class="form-check-label" for="id_1001813">Work Order Summary</label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_9001315">
                                <label class="form-check-label" for="id_1001813">Chart</label>
                            </div>
                            <div class="form-check mb-0 ml-4">
                                <input class="form-check-input" type="checkbox" value="" id="id_9001316">
                                <label class="form-check-label" for="id_1001813">Work Order Table</label>
                            </div>                            
                        </div>                            
                    </div><!-- /.container-fluid -->
                    <br/><br/><!-- comment -->
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
    include './model-pages/mod_NewUserType.php';   
?>   
<!-- Page specific script -->
<script src="js/mod_NewUserType.js"></script>

<script>
    
    var idSectionsArray = ["id_10","id_20","id_201","id_202","id_203","id_204","id_30","id_301","id_302","id_303","id_40", "id_401", "id_402", "id_403", "id_50", "id_501", "id_502", "id_60","id_601","id_602","id_603","id_604","id_70"];
    var idAreaArray = ["id_10011","id_10012","id_10015","id_10016","id_10017","id_10018","id_1001811","id_1001812","id_1001813","id_1001814","id_1001815","id_1001816","id_1001817","id_1001818","id_10019","id_10020","id_10021","id_10022","id_10023"];
    var idOtherArray = ["id_90011","id_90012","id_90013","id_9001311","id_9001312","id_9001313","id_9001314","id_9001315","id_9001316"];
    //let ArrayRoleDescription    = []; 
    let AryUserType            = [];	
    let intDebugEnable = 0;
    //--------------- Admin Panel Minimize ----------------------
    $('[data-widget="pushmenu"]').PushMenu("collapse");
    //--------------- Admin Panel Minimize END ----------------------
    $(function () 
    {
        funFormLoad();
        // Initial load of permissions
        //funLoadPermissions();
    });
    //--------------- Function Form Load ----------------------------
    function funFormLoad()
    {
        //if(intDebugEnable === 1)alert("Location : 100 " + "Form Load");
        //document.getElementById("id_RoleDescription").innerHTML = "Tset112";
        //--------- Load User Type to Array -------------------------------------
        const DataAry = [];
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "UserType";
        DataAry[2] = "tblusers_roleaccess";
        DataAry[3] = "0";
        //if(intDebugEnable === 1)    alert("Location : 150 " + DataAry);      
        $.post('comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            //if(intDebugEnable === 1) alert("Location : 160 " + json_data2);
            var res = $.parseJSON(json_data2);  
            if(res.Status_Ary[0] === "true")
            {
                AryUserType = res.Data_Ary;
                if(intDebugEnable === 1) alert("Location : 170 " + AryUserType); 
                //------------ Remove All Items in "AryUserType" -----------------------------------
                var options4 = document.querySelectorAll('#id_UserRoleSelect option');
                options4.forEach(o => o.remove());
                //------------ Fill New Items -------------------------------------
                var sel_UserType = document.getElementById("id_UserRoleSelect");
                for(var i = 0; i < AryUserType.length; i++)
                {
                    var opt4 = AryUserType[i];
                    var el4 = document.createElement("option");
                    el4.textContent = opt4;
                    el4.value = opt4;
                    sel_UserType.appendChild(el4);
                }    
                funLoadPermissions();
            }
        });
    }
    // Function to load permissions based on the selected user role
    function funLoadPermissions()
    {
        //alert("Load Permision");        
        //--------- Load RoleDescription -------------------------------------
        const DataAry = []; 
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "RoleDescription";
        DataAry[2] = "tblusers_roleaccess";
        DataAry[3] = "1";
        DataAry[4] = "UserType";
        DataAry[5] = document.getElementById("id_UserRoleSelect").value;        
        //if(intDebugEnable === 1)    alert("Location : 210 " + DataAry);        
        $.post('comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            //if(intDebugEnable === 1) alert("Location : 220 " + json_data2);
            var res = $.parseJSON(json_data2);  
            if(res.Status_Ary[0] === "true")
            {
                //if(intDebugEnable === 1) alert("Location : 240 " + res.Data_Ary); 
                document.getElementById("id_RoleDescription").innerHTML = res.Data_Ary;
            }
        });  
        
        //---------------- LOAD SECTIONS SETTINGS -------------------------------------------------------
        //--------- Clear All Check Boxes ------------------------------
        //var idSectionsArray = ["id_10","id_15","id_151","id_152","id_153","id_20","id_201","id_202","id_25", "id_251", "id_252", "id_30", "id_301", "id_302", "id_303","id_35","id_40","id_401","id_402"];
        idSectionsArray.forEach(function (intElementId) 
        {
            try 
            {
                document.getElementById(intElementId).checked = false;
            }
            catch (error)
            {
                alert("Element with ID " + intElementId + " not found.");
            }
        });        
        //const DataAry = []; 
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "Sections";
        DataAry[2] = "tblusers_roleaccess";
        DataAry[3] = "1";
        DataAry[4] = "UserType";
        DataAry[5] = document.getElementById("id_UserRoleSelect").value;      //  User Rale value  
        //alert(DataAry);
        $.post('comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2);           
            var res = $.parseJSON(json_data2);                           
            //RoleData_Ary   = res.Data_Ary; 
            //alert(RoleData_Ary);
            if(res.Status_Ary[0] === "true")
            {
                var RoleData_Ary = res.Data_Ary[0].split(',');
                //alert("Data Available");             
                RoleData_Ary.forEach(function (number) 
                {
                    try 
                    {
                        var elementId2 = 'id_' + number;  
                        //alert(elementId2);
                        document.getElementById(elementId2).checked = true;
                    }
                    catch (error)
                    {
                        alert("Element with ID " + intElementId + " not found.");
                    }
                });
            }
            else
            {
                alert("Data Not Available");
            }
        });
        //---------------- LOAD AREA SETTINGS -------------------------------------------------------
        //--------- Clear All Check Boxes ------------------------------
        //var idSectionsArray = ["id_10","id_15","id_151","id_152","id_153","id_20","id_201","id_202","id_25", "id_251", "id_252", "id_30", "id_301", "id_302", "id_303","id_35","id_40","id_401","id_402"];
        //alert("Test-1");
        idAreaArray.forEach(function (intElementId) 
        {
            //alert("Test-2");
            //alert(intElementId);
            try 
            {
                document.getElementById(intElementId).checked = false;
            }
            catch (error)
            {
                alert("Element with ID " + intElementId + " not found.");
            }
        });                 
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "Areas";
        DataAry[2] = "tblusers_roleaccess";
        DataAry[3] = "1";
        DataAry[4] = "UserType";
        DataAry[5] = document.getElementById("id_UserRoleSelect").value;      //  User Rale value  
        //alert(DataAry);
        $.post('comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2);           
            var res = $.parseJSON(json_data2);                           
            //RoleData_Ary   = res.Data_Ary; 
            //alert(RoleData_Ary);
            if(res.Status_Ary[0] === "true")
            {
                var RoleData_Ary = res.Data_Ary[0].split(',');
                //alert("Data Available");             
                RoleData_Ary.forEach(function (number) 
                {
                    try 
                    {
                        var elementId2 = 'id_' + number;  
                        //alert(elementId2);
                        document.getElementById(elementId2).checked = true;
                    }
                    catch (error)
                    {
                        alert("Element with ID " + intElementId + " not found.");
                    }
                });
            }
            else
            {
                alert("Data Not Available");
            }
        });
        //---------------- LOAD OTHER SETTINGS -------------------------------------------------------
        //--------- Clear All Check Boxes ------------------------------
        //var idSectionsArray = ["id_10","id_15","id_151","id_152","id_153","id_20","id_201","id_202","id_25", "id_251", "id_252", "id_30", "id_301", "id_302", "id_303","id_35","id_40","id_401","id_402"];
        //alert("Test-1");
        idOtherArray.forEach(function (intElementId) 
        {
            //alert("Test-2");
            //alert(intElementId);
            try 
            {
                document.getElementById(intElementId).checked = false;
            }
            catch (error)
            {
                alert("Element with ID " + intElementId + " not found.");
            }
        });                 
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "Other";
        DataAry[2] = "tblusers_roleaccess";
        DataAry[3] = "1";
        DataAry[4] = "UserType";
        DataAry[5] = document.getElementById("id_UserRoleSelect").value;      //  User Rale value  
        //alert(DataAry);
        $.post('comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2);           
            var res = $.parseJSON(json_data2);                           
            //RoleData_Ary   = res.Data_Ary; 
            //alert(RoleData_Ary);
            if(res.Status_Ary[0] === "true")
            {
                var RoleData_Ary = res.Data_Ary[0].split(',');
                //alert("Data Available");             
                RoleData_Ary.forEach(function (number) 
                {
                    try 
                    {
                        var elementId2 = 'id_' + number;  
                        //alert(elementId2);
                        document.getElementById(elementId2).checked = true;
                    }
                    catch (error)
                    {
                        alert("Element with ID " + intElementId + " not found.");
                    }
                });
            }
            else
            {
                alert("Data Not Available");
            }
        });
    }
    
    // Function to submit permissions
    function funUpdatePermissions() 
    {        
        //---------------- Save Sections Data ---------------------------------------------
        //alert("Update Permision");        
        //var dataArray = [];
        var strText = "";
        idSectionsArray.forEach(function (intElementId) 
        {
            //alert(intElementId);
            var checkbox = document.getElementById(intElementId);
            if (checkbox && checkbox.checked) 
            {
                var parts = intElementId.split('_');
                var numericPart = parts.length > 1 ? parts[1] : null;
                if (numericPart) 
                {
                    //dataArray.push(numericPart);
                    strText += numericPart + ",";
                }
            }
        });
        //alert(strText);
        //------------------ Send to Store Data -----------------------       
        const DataAry = [];               
        DataAry[0] = "funUpdateUserSections";        // Table Name
        DataAry[1] = document.getElementById("id_UserRoleSelect").value;                
        DataAry[2] = strText;    
        //alert(DataAry);
        $.post('updateData_UserRole.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2);           
            var res = $.parseJSON(json_data2);   
            //alert(res.Status_Ary[0]);
            if(res.Status_Ary[0] === "true")
            {
                // success, error, warning, info, question
                Swal.fire({title: 'Success !!',text: 'Data saving success.',icon: 'success', confirmButtonText: 'OK'});
            }
            else
            {
                 // success, error, warning, info, question
                Swal.fire({title: 'Alert !!',text: 'Data saving error.',icon: 'Warning', confirmButtonText: 'OK'});
              
            }
        });  
        //---------------- Save Area Data ---------------------------------------------
        //alert("Update Area Data Permision");        
        //var dataArray = [];
        var strText = "";
        idAreaArray.forEach(function (intElementId) 
        {
            //alert(intElementId);
            var checkbox = document.getElementById(intElementId);
            if (checkbox && checkbox.checked) 
            {
                var parts = intElementId.split('_');
                var numericPart = parts.length > 1 ? parts[1] : null;
                if (numericPart) 
                {
                    //dataArray.push(numericPart);
                    strText += numericPart + ",";
                }
            }
        });
        //alert(strText);
        //------------------ Send to Store Data -----------------------       
        //const DataAry = [];               
        DataAry[0] = "funUpdateUserAreas";        // Table Name
        DataAry[1] = document.getElementById("id_UserRoleSelect").value;                
        DataAry[2] = strText;    
        //alert(DataAry);
        $.post('updateData_UserRole.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2);           
            var res = $.parseJSON(json_data2);   
            //alert(res.Status_Ary[0]);
            if(res.Status_Ary[0] === "true")
            {
                // success, error, warning, info, question
                Swal.fire({title: 'Success',text: 'Data saving success.',icon: 'success', confirmButtonText: 'OK'});
            }
            else
            {
                 // success, error, warning, info, question
                Swal.fire({title: 'Alert !!',text: 'Data saving error.',icon: 'Warning', confirmButtonText: 'OK'});
              
            }
        });
        //---------------- Save Other Data ---------------------------------------------
        //alert("Update Other Data Permision");        
        //var dataArray = [];
        var strText = "";
        idOtherArray.forEach(function (intElementId) 
        {
            //alert(intElementId);
            var checkbox = document.getElementById(intElementId);
            if (checkbox && checkbox.checked) 
            {
                var parts = intElementId.split('_');
                var numericPart = parts.length > 1 ? parts[1] : null;
                if (numericPart) 
                {
                    //dataArray.push(numericPart);
                    strText += numericPart + ",";
                }
            }
        });
        //alert(strText);
        //------------------ Send to Store Data -----------------------       
        //const DataAry = [];               
        DataAry[0] = "funUpdateUserOther";        // Table Name
        DataAry[1] = document.getElementById("id_UserRoleSelect").value;                
        DataAry[2] = strText;    
        //alert(DataAry);
        $.post('updateData_UserRole.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2);           
            var res = $.parseJSON(json_data2);   
            //alert(res.Status_Ary[0]);
            if(res.Status_Ary[0] === "true")
            {
                // success, error, warning, info, question
                Swal.fire({title: 'Success',text: 'Data saving success.',icon: 'success', confirmButtonText: 'OK'});
            }
            else
            {
                 // success, error, warning, info, question
                Swal.fire({title: 'Alert !!',text: 'Data saving error.',icon: 'Warning', confirmButtonText: 'OK'});
              
            }
        });

    }
    
    //--------------- Function Delete New UserType ----------------------------
    function fun_DeleteUserType()
    {
        if(intDebugEnable === 1)alert("Location : 300 " + "Delete UserType");  
        
        Swal.fire({
        title: 'Re-Open Work Order',
        text: 'Are you sure you want to delete user roll.',
        //icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
      }).then((result) => 
      {
            if (result.isConfirmed) 
            {
                //------------------ Send to Store Data -----------------------       
                const DataAry = [];               
                DataAry[0] = "funDeleteUser";        // Table Name
                DataAry[1] = document.getElementById("id_UserRoleSelect").value;                
                //alert(DataAry);
                $.post('updateData_UserRole.php', { userpara: DataAry }, function(json_data2) 
                {
                    //alert(json_data2);           
                    var res = $.parseJSON(json_data2);   
                    //alert(res.Status_Ary[0]);
                    if(res.Status_Ary[0] === "true")
                    {
                        // success, error, warning, info, question
                        //Swal.fire({title: 'Alert !!',text: 'UserType Deleted Success.',icon: 'success', confirmButtonText: 'OK'});
                    }
                    else
                    {
                         // success, error, warning, info, question
                        //Swal.fire({title: 'Alert !!',text: 'Deleting Error.',icon: 'Warning', confirmButtonText: 'OK'});

                    }
                    funFormLoad();
                }); 
            }
            else
            {
               //alert("user click no");
            }
        });


               
    }  
    //--------------- Function Create New UserType ----------------------------
    function fun_NewUserType()
    {
        //if(intDebugEnable === 1)alert("Location : 400 " + "New UserType");
        var varmodbox = document.getElementById("id_ModUserTypeCre");
        varmodbox.style.display = "block";
        
    }  
    //--------------- Function EditUserType ----------------------------
    function fun_EditUserType()
    {
        //if(intDebugEnable === 1)alert("Location : 500 " + "Edit UserType");
        var varmodbox = document.getElementById("id_ModUserTypeEdit");
        varmodbox.style.display = "block";
    }  
</script>
</body>
</html>
