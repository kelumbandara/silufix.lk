
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>mmsnoyon</title>
    <link rel="icon" type="image/x-icon" href="../myimg/favicon.ico">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">     
</head>
<body class="hold-transition login-page">
    <div class="login-box">        
        <div class="login-logo">
            <div>
                <img src="../myimg/Noyon_Logo.jpg" class="user-image" alt="User Image" width="60" hight="70">  
            </div>
            <h3>Maintenance Management System <h3>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Enter login details</p>
                    <div class="input-group mb-3">
                        <input id="id_UserName" type="email" class="form-control" placeholder="User Name" onkeydown="funKeyPress(this)">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="id_Password" type="password" class="form-control" placeholder="Password" onkeydown="funKeyPress(this)">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember"> Remember Me </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" onclick="funCheckLogin()" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- Include SweetAlert JavaScript -->
    <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>

    <script>
         //var vblSec;
        var intTmp = 0;
        var strTmp = "";
        var i;
        
        //--------------- Load when document is ready ------------------------------------------
        $(function() 
        {      
            //alert("Execute Reports..");
            //funViewReport();
          
        });   
        function funKeyPress(vblKey) 
        {
            if(event.key === 'Enter') 
            {
                //alert(vblKey.value);  
                funCheckLogin();
            }        
        }
        //--------------- View Report function ------------------------------------------
        function funCheckLogin() 
	{
            var vbl_UserName = document.getElementById("id_UserName").value;
            var vbl_Password = document.getElementById("id_Password").value;            
            //alert(vbl_UserName);
            //alert(vbl_Password);
            if((vbl_UserName ==="") || (vbl_Password===""))
            {                
                //alert("Username or Password is blank");
                Swal.fire({
                    title: 'Error.!',
                    text: 'Username or Password is blank',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    customClass: 
                    {
                        popup: 'small-popup',
                        title: 'small-title',
                        content: 'small-text',
                    }});
            }           
            else
            {
                //alert("Check login details.");       
                var vblSendPara =  [vbl_UserName , vbl_Password];
                $.post('login.php', { userpara: vblSendPara }, function(json_data2) 
                {             
                    //alert(json_data2);
                    var res = $.parseJSON(json_data2);
                    //alert(res);                     
                    //alert(res.LoginDetailAry[0]);
                    //alert(res.LoginDetailAry[1]);
                    
                    if(res.LoginDetailAry[0] === "Success")
                    {
                        //alert("Open Home Page");
                        window.location.href = "./home/home.php";
                        //window.close();
                        //window.open("./home.php");
                        //alert("OK.!");
                    }
                    else
                    {
                        //alert("Username or Password incorrect..!");
                        Swal.fire({
                            title: 'Error.!',
                            text: 'Username or Password incorrect..',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            customClass: 
                            {
                                popup: 'small-popup',
                                title: 'small-title',
                                content: 'small-text',
                            }});
                    }
                 });
            }
           // alert("End");
        };
    </script>
</body>
</html>
