  <!-- Navbar -->
<div class="modal" id="id_ModPlanMntCre">
    <div class="modal-dialog">      
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-center" style="width: 100%">Request a Planned Maintenance</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="funModPlanMntCre_Close()">
                    <span aria-hidden="true" class="text-white close-icon"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h6 class="modal-title text-center" style="width: 100%">User's Department : Engineering</h6>
                <div class="row p-1">
                    
                    <div class="col-md-6">                   
                        <label style="font-weight: bolder">Machine Category</label>    
                        <select class="form-control select2" onchange="funModPlanMntCre_MachineCategoryFilter()" id="id_ModPlanMntCre_SelMcCategory" style="width: 100%;">
                            <option selected="none"></option>                            
                        </select>
                    </div>
                    <div class="col-md-6">                      
                         <label style="font-weight: bolder">Machine No</label>    
                        <select class="form-control select2" onchange="funModPlanMntCre_MachineNoFilter()" id="id_ModPlanMntCre_SelMachineNo" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>               
                    </div>
                </div> 
                
                <br/>
                <div class="row p-1">   
                    <div class="col-md-6">
                        <input type="datetime-local" id="id_ModPlanMntCre_dtmDateTime" class="form-control" name="startDate" required/>                           
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="id_ModPlanMntCre_inpNote" class="form-control" name="Note" placeholder="Note"> 
                    </div>
                    
                </div>        		
                 
            </div>
            <div class="modal-footer bg-light">
                <button type="submit" id="id_ModPlanMntCre_Update" class="btn btn-primary" onclick="funModPlanMntCre_Update()" >Submit</button>
                <button type="submit" class="btn btn-primary" onclick="funModPlanMntCre_Cancel()" >Cancel</button>
            </div>
        </div>
    </div>
</div>