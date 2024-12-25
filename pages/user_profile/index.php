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
                     <br/><br/>
                    <div class="row justify-content-center"> <!-- Center the content horizontally -->
                       <!-- comment -->
                        <div class="col-3">                            
                        </div>
                        <div class="col-5">
                            <div class="login-box" style="width: 100%">        
                            <!-- /.login-logo -->
                                <div class="card">
                                    <div class="card-body login-card-body">
                                        <h3 class="text-center">User Profile</h3>
                                        <div class="row">
                                            <div class="col-md-12 text-center">                      
                                                <div class="text-warning mt-1">
                                                    <!-- Insert Image with Width and Height -->
                                                    <img src="../../myimg/User_CheckIn.png" alt="Check In Image" class="img-fluid" style="width: 80px; height: 80px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12 text-center mt-3">  
                                                <input id="id_FullName" type="text" class="form-control text-center" placeholder="Full Name">
                                            </div>
                                            <div class="col-md-12 text-center mt-3">  
                                                <input id="id_MobNo" type="text" class="form-control text-center" placeholder="Mobile number">
                                            </div>
                                        </div>   
                                        <div class="row mt-2">
                                            <div class="col-md-12 text-center mt-2">  
                                                <div class="input-group mb-3"> 
                                                    <input id="id_curr_Password" type="password" class="form-control text-center" placeholder="Current Password">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center mt-2">  
                                                <div class="input-group mb-3"> 
                                                    <input id="id_new_Password" type="password" class="form-control text-center" placeholder="New Password">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">    
                                            <div class="col-md-12 text-center mt-3">
                                                <button type="submit" onclick="funClickOK()" class="btn btn-primary btn-block" style="width: 100%">OK</button>
                                            </div>                       
                                            <!-- /.col -->
                                        </div>
                                    </div>
                                    <!-- /.login-card-body -->
                                </div>
                            </div> 
                        </div>
                        <div class="col-4">
                            
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
               <!-- Include Footer -->
               <br/><!-- comment -->
               <br/>
               <br/>
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
    //var i;
    //var j;
    //--------------- Admin Panel Minimize ----------------------
    $('[data-widget="pushmenu"]').PushMenu("collapse");
    //--------------- Admin Panel Minimize END ----------------------
    $(document).ready(function () 
    {     
        //alert("page load"); 
        document.getElementById("id_FullName").value    = "<?php echo htmlspecialchars($_SESSION["user_name"]); ?>";
        document.getElementById("id_MobNo").value       = "<?php echo htmlspecialchars($_SESSION["user_contactno"]); ?>";
        //funLoadMachinesAttend();        
    });
    function funClickOK() 
    {    
        //alert("OK Clicked..");       
        var strEPF          = "<?php echo htmlspecialchars($_SESSION["user_epf"]); ?>";
        var strCurrPassword = document.getElementById("id_curr_Password").value;
        var strNewPassword  = document.getElementById("id_new_Password").value;
    
        const DataAry = []; 
        DataAry[0] = "funUpdateUser";        // Table Name
        DataAry[1] = strEPF;  
        DataAry[2] = strCurrPassword;  
        DataAry[3] = strNewPassword;  
        
        //alert(DataAry);
        if((DataAry[2] === "")||(DataAry[3] === ""))
        {
            Swal.fire({
                            title: 'Error.!',
                            text: "Password blank..",
                            icon: 'Warning', // success, error, warning, info, question
                            confirmButtonText: 'OK'
                        });
        }
        else
        {
            $.post('userProfile.php', { userpara: DataAry }, function(json_data2) 
            {
                //alert(json_data2);           
                var res = $.parseJSON(json_data2);                 
                if (res.Status_Ary[0] === "true") 
                {
                   Swal.fire({
                            title: 'Success.',
                            text: 'Password Updated.',
                            icon: 'success', // success, error, warning, info, question
                            confirmButtonText: 'OK'
                        });
                        
                    document.getElementById("id_curr_Password").value   = "";
                    document.getElementById("id_new_Password").value    = "";
                    window.location.href = "../logout/logout.php"; // Redirect to login page
                }
                else
                {
                     Swal.fire({
                            title: 'Password Updating Error !',
                            text: res.Status_Ary[1],
                            icon: 'Warning', // success, error, warning, info, question
                            confirmButtonText: 'OK'
                        });
                    document.getElementById("id_curr_Password").value   = "";
                    document.getElementById("id_new_Password").value    = "";
                    //alert("Fales");
                }
            });
        }
    }  
</script>
</body>
</html>
