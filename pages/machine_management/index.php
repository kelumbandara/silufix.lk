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
                            <h4 class="text-lg-left text-warning"><strong>Machine Management</strong></h4>                        
                        </div>
                    </div>    
                    <div class="border-top my-2"></div>
                    <div class="row mt-4">                        
                        <div class="col-lg-12">
                           <!-- Add User Form -->
                            <h4>Add New Machine</h4>
                            <form id="addUserForm">
                                <div class="form-row">
                                    <div class="form-group col-md-1">
                                        <label>ID</label>
                                        <input type="text" class="form-control" id="id_id" readonly>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label>Asset Code</label>
                                        <input type="text" class="form-control" id="id_assetcode" required>
                                    </div>                                     
                                    <div class="form-group col-md-2">
                                        <label>Machine Category</label> 
                                        <select class="form-control" id="id_mchategory" required>
                                            <option value="machine1">Machine 1</option>
                                            <option value="machine1">Machine 1</option>                                                                                      
                                        </select>                                        
                                    </div> 
                                    <div class="form-group col-md-2">
                                        <label>Machine Number</label>
                                        <input type="text" class="form-control" id="id_machinenumber" required>
                                    </div>  
                                    <div class="form-group col-md-1">
                                        <label>Value Add</label>                                        
                                        <select class="form-control" id="id_valueadd" required>
                                            <option value="0">0</option>                                                                                                                               
                                        </select>
                                    </div> 
                                    <div class="form-group col-md-2">
                                        <label>Department</label>                                        
                                        <select class="form-control" id="id_department" required>
                                            <option value="Department-1">Department-1</option>
                                            <option value="Department-1">Department-1</option>                                                                                       
                                        </select>
                                    </div> 
                                    <div class="form-group col-md-1">
                                       <button type="button" class=" form-control btn btn-primary mt-4" onclick="funUpdateUser()">Update</button>
                                    </div>
                                    <div class="form-group col-md-1">                                       
                                        <button type="button" class=" form-control btn btn-primary mt-4" onclick="funNewUser()">New</button>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <button type="button" class=" form-control btn btn-primary mt-4" onclick="funClearData()">Clear</button>
                                    </div>
                                </div>                                
                            </form>                        
                        </div>
                    </div>
                    <div class="border-top my-2"></div>
                    <div class="row mt-4">                        
                        <div class="col-lg-12">
                            <!-- Display Users Table -->
                            <div class="mb-3">
                                <h4>User List</h4>
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Asset Code</th>
                                            <th>Machine Category</th>
                                            <th>Machine Number</th>
                                            <th>Value Add</th>
                                            <th>Department</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="id_tableusers">
                                        <!-- User data will be populated here dynamically -->
                                    </tbody>
                                </table>
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
 
<!-- Navbar -->
<?php
  // include './model-pages/mod_BreakDown.php';        
?>    
<!-- Java Script Functions -->
<script>
    //--------------- Admin Panel Minimize ----------------------
    $('[data-widget="pushmenu"]').PushMenu("collapse");
    //--------------- Admin Panel Minimize END ----------------------
    $(document).ready(function () 
    {
        // Load user data on page load
        funLoadMachines();        
    });
    //-------------- Load Users -------------------------------
    function funLoadMachines() 
    {        
        let intDebugEnable = 0;
        //alert("Load Machines ");   
        //------------------ Load Machine Table --------------------------------------
        const DataAry = []; 
        DataAry[0] = "funGetMachineTable";        // Table Name
        DataAry[1] = "Active";        
        //alert(DataAry);
        $.post('mchManagement.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2);           
            var res = $.parseJSON(json_data2);                 
            //alert(res.Status_Ary[0]);            
            document.getElementById("id_tableusers").innerHTML = res.Data_Ary[0];             
        });         
        //------------------ Load Machine category ----------------------------------
        DataAry[0] = "funGetMachineCategory";        // Table Name
        DataAry[1] = "Active";        
        //alert(DataAry);
        $.post('mchManagement.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2);           
            var res = $.parseJSON(json_data2); 
            if(res.Status_Ary[0] === "true")
            {
                //------------ Remove All Items in "Machine Category" -----------------------------------
                var options2 = document.querySelectorAll('#id_mchategory option');
                options2.forEach(o => o.remove());
                //------------ Fill New Items -------------------------------------
                var sel_cusordno = document.getElementById("id_mchategory");
                for(var i = 0; i < res.Data_Ary.length; i++)
                {
                    var opt = res.Data_Ary[i];
                    var el = document.createElement("option");
                    el.textContent = opt;
                    el.value = opt;
                    sel_cusordno.appendChild(el);
                }   
                //Swal.fire({title: 'Success.!',text: 'Selected Employee deleted',icon: 'success',confirmButtonText: 'OK'});
            }
            else
            {
                Swal.fire({title: 'Error.!',text: 'Machine Category not found',icon: 'error',confirmButtonText: 'OK'});
            }            
        });
        //---------------- Load Value Add ----------------------------------------
        //const DataAry = [];
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "ValueAdd";
        DataAry[2] = "tblwo_machinemanagement";
        DataAry[3] = "0";
        if(intDebugEnable === 1)    alert("Location : 150 " + DataAry);      
        $.post('comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("Location : 160 " + json_data2);
            var res = $.parseJSON(json_data2);  
            if(res.Status_Ary[0] === "true")
            {
                AryValueAdd = res.Data_Ary;
                if(intDebugEnable === 1) alert("Location : 170 " + AryValueAdd); 
                //------------ Remove All Items in "AryUserType" -----------------------------------
                var options4 = document.querySelectorAll('#id_valueadd option');
                options4.forEach(o => o.remove());
                //------------ Fill New Items -------------------------------------
                var sel_UserType = document.getElementById("id_valueadd");
                for(var i = 0; i < AryValueAdd.length; i++)
                {
                    var opt4 = AryValueAdd[i];
                    var el4 = document.createElement("option");
                    el4.textContent = opt4;
                    el4.value = opt4;
                    sel_UserType.appendChild(el4);
                }    
                funLoadPermissions();
            }
        });
        //---------------- Load Departments --------------------------------------
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "Department";
        DataAry[2] = "tblwo_errorlevel_breakdown";
        DataAry[3] = "0";
        if(intDebugEnable === 1)    alert("Location : 150 " + DataAry);      
        $.post('comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("Location : 160 " + json_data2);
            var res = $.parseJSON(json_data2);  
            if(res.Status_Ary[0] === "true")
            {
                AryDepartment = res.Data_Ary;
                if(intDebugEnable === 1) alert("Location : 170 " + AryDepartment); 
                //------------ Remove All Items in "AryUserType" -----------------------------------
                var options5 = document.querySelectorAll('#id_department option');
                options5.forEach(o => o.remove());
                //------------ Fill New Items -------------------------------------
                var sel_UserType = document.getElementById("id_department");
                for(var i = 0; i < AryDepartment.length; i++)
                {
                    var opt5 = AryDepartment[i];
                    var el5 = document.createElement("option");
                    el5.textContent = opt5;
                    el5.value = opt5;
                    sel_UserType.appendChild(el5);
                }    
                funLoadPermissions();
            }
        });
    }    
    //-------------- Click Delete -------------------------------
    function deleteUser(userId) 
    {        
        //alert("Delete Users ID=" + userId);
        const DataAry = []; 
        DataAry[0] = "funDeleteUser";        // Table Name
        DataAry[1] = userId;   // UserID     
        //alert(DataAry);
        
        Swal.fire(
        {
            title: 'Delete Machine',
            text: 'Are you sure you want to proceed?',
            //icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => 
        {
            if (result.isConfirmed) 
            {
                $.post('mchManagement.php', { userpara: DataAry }, function(json_data2) 
                {
                    //alert(json_data2);           
                    var res = $.parseJSON(json_data2);    
                    if(res.Status_Ary[0] === "true")
                    {
                        Swal.fire({title: 'Success.!',text: 'Selected Machine deleted',icon: 'success',confirmButtonText: 'OK'});
                    }
                    else
                    {
                        Swal.fire({title: 'Error.!',text: 'Data Deleting Error',icon: 'error',confirmButtonText: 'OK'});
                    }
                    //alert(res.Status_Ary[0]);            
                    //document.getElementById("id_tableusers").innerHTML = res.Data_Ary[0];
                    funLoadMachines();
                });
            }
            else
            {
                //alert("user click no");
            }
        });
    }
    //-------------- Click Edit -------------------------------
    function editUser(userId) 
    {        
        //alert("Load Users ID=" + userId);
        //readSelectedRow(userId);
        //document.getElementById("id_tableusers").innerHTML = res.Data_Ary[0];   
        var strUserId = userId.toString();        
        //alert(strUserId);
        // Get the table body
        var tableBody = document.getElementById("id_tableusers");
        // Iterate through each row in the table
        var rows = tableBody.getElementsByTagName("tr");
        for (var i = 0; i < rows.length; i++) 
        {
            // Get the cells in the current row
            var cells = rows[i].getElementsByTagName("td");
            if (cells.length > 0 && cells[0].innerText === strUserId) 
            {              
                // Display each cell value in the console (you can modify this part)
                document.getElementById("id_id").value              = cells[0].innerText;
                document.getElementById("id_assetcode").value       = cells[1].innerText;
                document.getElementById("id_mchategory").value      = cells[2].innerText;
                document.getElementById("id_machinenumber").value   = cells[3].innerText;
                document.getElementById("id_valueadd").value        = cells[4].innerText;
                document.getElementById("id_department").value      = cells[5].innerText;
            }
        }   
        // Scroll the webpage to the top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    function funUpdateUser() 
    {      
        //alert("Update User"); 
        const DataAry = []; 
        DataAry[0] = "funUpdateUser";        // Table Name
      
        DataAry[1] = document.getElementById("id_id").value;
        DataAry[2] = document.getElementById("id_assetcode").value;
        DataAry[3] = document.getElementById("id_mchategory").value;
        DataAry[4] = document.getElementById("id_machinenumber").value;
        DataAry[5] = document.getElementById("id_valueadd").value;
        DataAry[6] = document.getElementById("id_department").value;        
        //alert(DataAry);
        if(DataAry[1] !== "")
        {
            $.post('mchManagement.php', { userpara: DataAry }, function(json_data2) 
            {
                //alert(json_data2);           
                var res = $.parseJSON(json_data2);  
                if(res.Status_Ary[0] === "true")
                {
                    Swal.fire({title: 'Success.!',text: 'Updated Successfully',icon: 'success',confirmButtonText: 'OK'});
                }
                else
                {
                    Swal.fire({title: 'Error.!',text: 'Data updating error' + res.Status_Ary[1],icon: 'error',confirmButtonText: 'OK'});
                }
                funLoadMachines();             
            });        
        }
        else
        {
            //alert("id not found");
            Swal.fire({title: 'Error.!',text: 'Data updating error',icon: 'error',confirmButtonText: 'OK'});
        }        
    }
    function funNewUser() 
    {    
        let intDebugEnable = 0;
        if(intDebugEnable === 1)    alert("Location : 700" + "New User"); 

        const DataAry = []; 
        DataAry[0] = "funNewUser";        // Table Name
        DataAry[1] = document.getElementById("id_id").value;
        DataAry[2] = document.getElementById("id_assetcode").value;
        DataAry[3] = document.getElementById("id_mchategory").value;
        DataAry[4] = document.getElementById("id_machinenumber").value;
        DataAry[5] = document.getElementById("id_valueadd").value;
        DataAry[6] = document.getElementById("id_department").value; 
              
        //alert(DataAry);  
        if(intDebugEnable === 1)    alert("Location : 710" + DataAry); 
        if((DataAry[2]==="")||(DataAry[3]==="")||(DataAry[4]==="")||(DataAry[5]==="")||(DataAry[6]===""))
        {
            Swal.fire({title: 'Error.!',text: 'Please fill the data',icon: 'error',confirmButtonText: 'OK'});
        }
        else
        {
            if(DataAry[1] === "")
            {
                $.post('mchManagement.php', { userpara: DataAry }, function(json_data2) 
                {
                    //alert(json_data2); 
                    if(intDebugEnable === 1)    alert("Location : 720" + json_data2); 
                    var res = $.parseJSON(json_data2);  
                    if(res.Status_Ary[0] === "true")
                    {
                        Swal.fire({title: 'Success.!',text: 'Updated Successfully',icon: 'success',confirmButtonText: 'OK'});
                    }
                    else
                    {
                        Swal.fire({title: 'Error.!',text: 'Data updating error :' + res.Status_Ary[1],icon: 'error',confirmButtonText: 'OK'});
                    }
                    funLoadMachines();          
                }); 
            }
            else
            {
                Swal.fire({title: 'Error.!',text: 'Please cler and enter new data',icon: 'error',confirmButtonText: 'OK'});
            }    
        }            
    }
    function funClearData() 
    {    
        //alert("New User");
        document.getElementById("id_id").value              = "";
        document.getElementById("id_assetcode").value       = "";
        document.getElementById("id_mchategory").value      = "";
        document.getElementById("id_machinenumber").value   = "";
        document.getElementById("id_valueadd").value        = ""; 
        document.getElementById("id_department").value      = "";
    }  
  
</script>
</body>
</html>
