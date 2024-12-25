<!-- Navbar -->
<div class="modal" id="id_ModWoCheckIn">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Mechanic Check In</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="funModWoCheckIn_Close()">
                    <span aria-hidden="true" class="text-white close-icon"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="mt-2 fixed-height-label" id="id_ModWoCheckIn_WoNo" readonly> Test wo</div>
                        <div class="text-warning">
                            <!-- Insert Image with Width and Height -->
                            <img src="../../myimg/User_CheckIn.png" alt="Check In Image" class="img-fluid" style="width: 80px; height: 80px;">
                        </div>
                        <div class="mt-2">
                            <input type="datetime-local" id="id_ModWoCheckIn_dtmDateTime" class="form-control" name="startDate" required/>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-2 fixed-height-label" id="id_ModWoCheckIn_AllocatedMc" readonly>
                    Placed On: 2024-01-16 14:12:21
                </div>
                <div class="border-top my-2"></div>
                              
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary" onclick="funModWoCheckIn_CheckIn()">Check In</button>
                </div>
                   
            </div>
        </div>
    </div>
</div>
