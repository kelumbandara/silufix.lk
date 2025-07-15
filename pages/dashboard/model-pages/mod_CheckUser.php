<!-- Navbar -->
<div class="modal" id="id_ModCheckUser">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">User Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="funModCheckUser_Close()">
                    <span aria-hidden="true" class="text-white close-icon"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="mt-2 fixed-height-label" id="id_ModWoCheckIn_WoNo" readonly> </div>
                        <div class="text-warning">
                            <!-- Insert Image with Width and Height -->
                            <img src="../../myimg/User_CheckIn.png" alt="Check In Image" class="img-fluid" style="width: 80px; height: 80px;">
                        </div>
                    </div>
                </div>               
                <div class="border-top my-2"></div>
                <div class="text-warning mt-2 fixed-height-label" id="id_ModCheckUser_AllocatedMc" readonly>
                    Enter login details
                </div>
                <div class="row mt-2">
                    <div class="col-md-3">
                        <label for="username" class="form-label">Username</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="id_ModCheckUser_UserName" placeholder="Enter your username">
                    </div>
                </div>                
                <div class="row mt-2">
                    <div class="col-md-3">
                        <label for="password" class="form-label">Password</label>
                    </div>
                    <div class="col-md-6">
                        <input type="password" class="form-control" id="id_ModCheckUser_Password" placeholder="Enter your password">
                    </div>
                </div>                
                <div class="border-top my-1"></div>                
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary" onclick="funModCheckUser_LogIn()">Login</button>
                </div>
                   
            </div>
        </div>
    </div>
</div>
