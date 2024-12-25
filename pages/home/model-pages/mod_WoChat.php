<!-- Navbar -->
<div class="modal" id="id_ModWoChat">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Chat History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="funModWoChat_Close()">
                    <span aria-hidden="true" class="text-white close-icon"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="mt-2 fixed-height-label" id="id_ModWoChat_WoNo" readonly> Work Order Number</div>                        
                        <div class="text-warning mt-2 fixed-height-label" id="id_ModWoChat_SendBy" readonly>
                         Login Details
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="text-left"><strong>Chat History</strong></label>
                            <div class="fixed-height-label overflow-auto" style="height: 100px; max-height: 150px;" id="id_ModWoChat_ChatHistory" readonly>                              
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="border-top my-2"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="text-left"><strong>Chat Message</strong></label>
                           
                            <input id="id_ModWoChat_ChatMessage" class="form-control" onkeypress="funKeyPress(event, this)" style="resize: none; height: auto; overflow-y: auto;"><!-- comment -->
                        </div>
                    </div>
                </div>
                             
                <div class="border-top my-1"></div>                
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary" onclick="funModWoChat_Update()">Update</button>
                </div>
                   
            </div>
        </div>
    </div>
</div>
