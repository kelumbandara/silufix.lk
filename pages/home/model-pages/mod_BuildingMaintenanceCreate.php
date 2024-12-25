  <!-- Navbar -->
<div class="modal" id="id_ModBuildMntCre">
    <div class="modal-dialog">      
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-center" style="width: 100%">Request Building Maintenance</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="funModBuildMntCre_Close()">
                    <span aria-hidden="true" class="text-white close-icon"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h6 class="modal-title text-center" style="width: 100%">User's Department : Engineering</h6>
                                
                <br/>
                <div class="row p-1">   
                    <div class="col-md-6">
                        <input type="datetime-local" id="id_ModBuildMntCre_dtmDateTime" class="form-control" name="startDate" required/>                           
                    </div>                    
                </div>  
                <div class="row p-1">                    
                    <div class="col-md-12">                   
                        <label style="font-weight: bolder">Select the Category</label>    
                        <select class="form-control select2" id="id_ModBuildMntCre_SelProjectCategory" style="width: 100%;">
                            <option>Fabrication</option>  
                            <option>Civil</option>  
                            <option>Plumbing</option>  
				<option>Electrical</option> 
                            <option>AC Services</option>                            
                            <option>Other</option>                               
                        </select>
                    </div>                    
                </div> 
                <div class="row p-1">   
                    <div class="col-md-12">
                        <label style="font-weight: bolder">Write Description Here</label> 
                        <textarea id="id_ModBuildMntCre_inpNote" class="form-control" name="Note" style="height: 140px"></textarea>

                    </div>
                </div> 
                 
            </div>
            <div class="modal-footer bg-light">
                <button type="submit" id="id_ModBuildMntCre_Update" class="btn btn-primary" onclick="funModBuildMntCre_Update()" >Submit</button>
                <button type="submit" class="btn btn-primary" onclick="funModBuildMntCre_Cancel()" >Cancel</button>
            </div>
        </div>
    </div>
</div>