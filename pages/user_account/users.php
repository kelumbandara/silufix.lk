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
                            <h4 class="text-lg-left text-warning"><strong>User Management </strong></h4>                        
                        </div>
                    </div>    
                    <div class="border-top my-2"></div>
                    <div class="row mt-4">                        
                        <div class="col-lg-12">
                           <!-- Add User Form -->
                            <h4>Add New User</h4>
                            <form id="addUserForm">
                                <div class="form-row">
                                    <div class="form-group col-md-1">
                                        <label>ID</label>
                                        <input type="text" class="form-control" id="id_id" readonly>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label>EPF</label>
                                        <input type="text" class="form-control" id="id_epf" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Employee Name</label>
                                        <input type="text" class="form-control" id="id_empname"required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>User Name</label>
                                        <input type="text" class="form-control" id="id_username" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Password</label>
                                        <input type="password" class="form-control" id="id_password" required>
                                    </div>                                                                                                         
                                    <div class="form-group col-md-2">
                                        <label>Department</label>                                        
                                        <select class="form-control" id="id_department" required>                                                                                       
                                        </select>
                                    </div>  
                                </div>
                                <div class="form-row"> 
                                    <div class="form-group col-md-2">
                                        <label>Contact</label>
                                        <input type="text" class="form-control" id="id_contact" required>
                                    </div>            
                                    <div class="form-group col-md-2">
                                        <label>Email</label>
                                        <input type="text" class="form-control" id="id_email" required>
                                    </div>
                         
                                    <div class="form-group col-md-2">
                                        <label>User Type</label>                                        
                                        <select class="form-control" id="id_usertype" required>                                           
                                        </select>
                                    </div> 
                                    <div class="form-group col-md-1">
                                        <label>Availability</label>
                                        <select class="form-control" id="id_availability" required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
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
                                            <th>EPF</th>
                                            <th>Employee Name</th>
                                            <th>User Name</th>
                                            <th>Password</th>
                                            <th>Department</th>
                                            <th>Contact</th>                                            
                                            <th>Email</th>
                                            <th>User Type</th>
                                            <th>Availability</th>
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
<!-- Page specific script -->
<script>
    let intDebugEnable = 1;
    
    //--------------- Admin Panel Minimize ----------------------
    $('[data-widget="pushmenu"]').PushMenu("collapse");
    //--------------- Admin Panel Minimize END ----------------------
    $(document).ready(function () 
    {
        // Load user data on page load
        funLoadUsers();        
    });
    //-------------- Load Users -------------------------------
    function funLoadUsers() 
    {        
        let intDebugEnable = 0;
        //alert("Load Users");    
        //--------- Load User Type to Array -------------------------------------
        const DataAry = [];
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "UserType";
        DataAry[2] = "tblusers_roleaccess";
        DataAry[3] = "0";
        if(intDebugEnable === 1)    alert("Location : 100 " + DataAry);      
        $.post('comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("Location : 110 " + json_data2);
            var res = $.parseJSON(json_data2);  
            if(res.Status_Ary[0] === "true")
            {
                AryUserType = res.Data_Ary;
                if(intDebugEnable === 1) alert("Location : 120 " + AryUserType); 
                //------------ Remove All Items in "AryUserType" -----------------------------------
                var options4 = document.querySelectorAll('#id_usertype option');
                options4.forEach(o => o.remove());
                //------------ Fill New Items -------------------------------------
                var sel_UserType = document.getElementById("id_usertype");
                for(var i = 0; i < AryUserType.length; i++)
                {
                    var opt4 = AryUserType[i];
                    var el4 = document.createElement("option");
                    el4.textContent = opt4;
                    el4.value = opt4;
                    sel_UserType.appendChild(el4);
                }
            }
        });
        //--------- Load User Departments -------------------------------------
        //const DataAry = [];
        DataAry[0] = "funGetFilteredData";        // Function Name    
        DataAry[1] = "Department";
        DataAry[2] = "tblwo_errorlevel_breakdown";
        DataAry[3] = "0";
        if(intDebugEnable === 1)    alert("Location : 200 " + DataAry);      
        $.post('comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("Location : 210 " + json_data2);
            var res = $.parseJSON(json_data2);  
            if(res.Status_Ary[0] === "true")
            {
                AryDepartment = res.Data_Ary;
                if(intDebugEnable === 1) alert("Location : 220 " + AryDepartment); 
                //------------ Remove All Items in "AryDepartment" -----------------------------------
                var options4 = document.querySelectorAll('#id_department option');
                options4.forEach(o => o.remove());
                //------------ Fill New Items -------------------------------------
                var sel_UserType = document.getElementById("id_department");
                for(var i = 0; i < AryDepartment.length; i++)
                {
                    var opt4 = AryDepartment[i];
                    var el4 = document.createElement("option");
                    el4.textContent = opt4;
                    el4.value = opt4;
                    sel_UserType.appendChild(el4);
                }
            }
        });
        //------------ Load Users --------------------------------------
        //const DataAry = []; 
        DataAry[0] = "funGetUserTable";        // Table Name
        DataAry[1] = "Active";        
        //alert(DataAry);
        $.post('userManage.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2);           
            var res = $.parseJSON(json_data2);                 
            //alert(res.Status_Ary[0]);            
            document.getElementById("id_tableusers").innerHTML = res.Data_Ary[0];             
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
            title: 'Delete User',
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
                $.post('userManage.php', { userpara: DataAry }, function(json_data2) 
                {
                    //alert(json_data2);           
                    var res = $.parseJSON(json_data2);    
                    if(res.Status_Ary[0] === "true")
                    {
                        Swal.fire({title: 'Success.!',text: 'Selected Employee deleted',icon: 'success',confirmButtonText: 'OK'});
                    }
                    else
                    {
                        Swal.fire({title: 'Error.!',text: 'Data Deleting Error',icon: 'error',confirmButtonText: 'OK'});
                    }
                    //alert(res.Status_Ary[0]);            
                    //document.getElementById("id_tableusers").innerHTML = res.Data_Ary[0];
                    funLoadUsers();
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
                document.getElementById("id_id").value          = cells[0].innerText;
                document.getElementById("id_epf").value         = cells[1].innerText;
                document.getElementById("id_empname").value     = cells[2].innerText;
                document.getElementById("id_username").value    = cells[3].innerText;
                document.getElementById("id_password").value    = cells[4].innerText;
                document.getElementById("id_department").value  = cells[5].innerText;
                
                document.getElementById("id_contact").value     = cells[6].innerText;
                document.getElementById("id_email").value       = cells[7].innerText;
                document.getElementById("id_usertype").value    = cells[8].innerText;
                document.getElementById("id_availability").value  = cells[9].innerText;
            }
        }
        // Scroll the webpage to the top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    function funUpdateUser() 
    {         
        const DataAry = []; 
        DataAry[0] = "funUpdateUser";        // Table Name
        DataAry[1] = document.getElementById("id_id").value;
        DataAry[2] = document.getElementById("id_epf").value;
        DataAry[3] = document.getElementById("id_empname").value;
        DataAry[4] = document.getElementById("id_username").value;
        DataAry[5] = document.getElementById("id_password").value; 
        DataAry[6] = document.getElementById("id_department").value;
        DataAry[7] = document.getElementById("id_contact").value; 
        DataAry[8] = document.getElementById("id_email").value; 
        DataAry[9] = document.getElementById("id_usertype").value;
        DataAry[10] = document.getElementById("id_availability").value;        
        //alert(DataAry);
        if(DataAry[1] !== "")
        {
            $.post('userManage.php', { userpara: DataAry }, function(json_data2) 
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
                funLoadUsers();             
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
        //alert("New User");
        const DataAry = []; 
        DataAry[0] = "funNewUser";        // Table Name
        DataAry[1] = document.getElementById("id_id").value;
        DataAry[2] = document.getElementById("id_epf").value;
        DataAry[3] = document.getElementById("id_empname").value;
        DataAry[4] = document.getElementById("id_username").value;
        DataAry[5] = document.getElementById("id_password").value; 
        DataAry[6] = document.getElementById("id_department").value;
        DataAry[7] = document.getElementById("id_contact").value; 
        DataAry[8] = document.getElementById("id_email").value; 
        DataAry[9] = document.getElementById("id_usertype").value;
        DataAry[10] = document.getElementById("id_availability").value;        
        //alert(DataAry);   
        if((DataAry[2]==="")||(DataAry[3]==="")||(DataAry[4]==="")||(DataAry[5]==="")||(DataAry[7]==="")||(DataAry[8]===""))
        {
            Swal.fire({title: 'Error.!',text: 'Please fill the data',icon: 'error',confirmButtonText: 'OK'});

        }
        else
        {
            if(DataAry[1] === "")
            {
                $.post('userManage.php', { userpara: DataAry }, function(json_data2) 
                {
                    //alert(json_data2);           
                    var res = $.parseJSON(json_data2);  
                    if(res.Status_Ary[0] === "true")
                    {
                        Swal.fire({title: 'Success.!',text: 'Updated Successfully',icon: 'success',confirmButtonText: 'OK'});
                    }
                    else
                    {
                        Swal.fire({title: 'Error.!',text: 'Data updating error :' + res.Status_Ary[1],icon: 'error',confirmButtonText: 'OK'});
                    }
                    funLoadUsers();          
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
        document.getElementById("id_id").value          = "";
        document.getElementById("id_epf").value         = "";
        document.getElementById("id_empname").value     = "";
        document.getElementById("id_username").value    = "";
        document.getElementById("id_password").value    = ""; 
        document.getElementById("id_department").value  = "";
        document.getElementById("id_contact").value     = ""; 
        document.getElementById("id_email").value       = ""; 
        document.getElementById("id_usertype").value    = "";
        document.getElementById("id_availability").value  = "";                    
    }  
  
</script>
</body>
</html>
