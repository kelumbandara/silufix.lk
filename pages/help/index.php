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
                            <h4 class="text-lg-left text-warning"><strong>User Manual</strong></h4>                        
                        </div>
                    </div>    
                    <div class="border-top my-0"></div>
                    <div id="pdfContainer" style="display:none;">
                        <iframe id="pdfIframe" src="" style="width: 100%; height: 600px;" frameborder="0"></iframe>
                    </div>
                    
                    <div class="border-top my-2"></div>
                             
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
        //funLoadUsers();
        var pdfContainer = document.getElementById('pdfContainer');
        var pdfIframe = document.getElementById('pdfIframe');
        pdfIframe.src = '../../doc/UserManual.pdf'; // Set the source of the iframe to your PDF URL
        pdfContainer.style.display = 'block'; // Show the PDF container
    });  
    
  
</script>
</body>
</html>
