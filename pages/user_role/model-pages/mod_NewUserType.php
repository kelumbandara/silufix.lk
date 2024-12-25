  <!-- Navbar -->
<div class="modal" id="id_ModUserTypeCre">
    <div class="modal-dialog">      
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-center" style="width: 100%">New User Roll</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="funModUserTypeCre_Close()">
                    <span aria-hidden="true" class="text-white close-icon"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">               
                <div class="row p-1">                    
                    <div class="col-md-12">                   
                        <label style="font-weight: bolder">User Roll</label>    
                        <div class="col-md-12">
                            <input type="text" id="id_ModUserTypeCre_UserRoll" class="form-control" name="UserRoll" placeholder="User Roll"> 
                        </div>
                    </div>
                </div>                 
                <br/>
                <div class="row p-1">                    
                    <div class="col-md-12">                      
                        <label style="font-weight: bolder">Roll Description</label>    
                        <div class="col-md-12">
                            <input type="text" id="id_ModUserTypeCre_RollDescription" class="form-control" name="RollDescription" placeholder="Roll Description"> 
                        </div>          
                    </div>
                </div>                 
                <br/>
            </div>
            <div class="modal-footer bg-light">
                <button type="submit" class="btn btn-primary" onclick="funModUserTypeCre_Update()" >Add</button>
                <button type="submit" class="btn btn-primary" onclick="funModUserTypeCre_Cancel()" >Cancel</button>
            </div>
        </div>
    </div>
</div>