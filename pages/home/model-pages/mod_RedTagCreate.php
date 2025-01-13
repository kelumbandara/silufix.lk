  <!-- Navbar -->
<div class="modal" id="id_ModRedTagCre">
    <div class="modal-dialog">      
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-center" style="width: 100%">Request a RedTag Service</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="funModRedTagCre_Close()">
                    <span aria-hidden="true" class="text-white close-icon"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h6 class="modal-title text-center" id="id_ModRedTagCre_lblUserDep" style="width: 100%">User's Department : Engineering</h6>
               
                <div class="row p-1">                    
                    <div class="col-md-12">                   
                        <label style="font-weight: bolder">Red Tag Category</label>    
                        <select class="form-control select2" id="id_ModRedTagCre_SelRedTagCategory" style="width: 100%;">
                            <option selected="none">Safety</option>  
                            <option selected="none">Leakages</option>  
                            <option selected="none">Worn Out or Broken Part</option>  
                            <option selected="none">Unusual Vibration/Heat</option>  
			    <option selected="none">Hard to Clean Area</option> 
                            <option selected="none">Other</option>                               
                        </select>
                    </div>                    
                </div> 
                
                <div class="row p-1">                    
                    <div class="col-md-6">                   
                        <label style="font-weight: bolder">Machine Category</label>    
                        <select class="form-control select2" onchange="funModRedTagCre_SelMachineCategoryFilter()" id="id_ModRedTagCre_SelMcCategory" style="width: 100%;">
                            <option selected="none"></option>                            
                        </select>
                    </div>
                    <div class="col-md-6">                      
                         <label style="font-weight: bolder">Machine No</label>    
                        <select class="form-control select2" onchange="funModRedTagCre_Filter()" id="id_ModRedTagCre_SelMachineNo" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>               
                    </div>
                </div> 
                <div class="row p-1">
                    <div class="col-md-6">                   
                        <label style="font-weight: bolder">Fault Type</label>    
                        <select class="form-control select2" onchange="funModRedTagCre_SelFaultTypeFilter()" id="id_ModRedTagCre_SelFaultType" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>
                    </div>
                    <div class="col-md-6">                      
                         <label style="font-weight: bolder">Fault Level</label>    
                        <select class="form-control select2" onchange="funModRedTagCre_Filter()" id="id_ModRedTagCre_SelFaultLevel" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>               
                    </div>
                </div> 
                <br/>
                <!-- <div class="row p-1">   
                    <div class="col-md-6">
                        <input type="datetime-local" id="id_ModRedTagCre_dtmDateTime" class="form-control" onchange="funDateChanged()" name="startDate" required/>                           
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="id_ModRedTagCre_inpNote" class="form-control" name="Note" placeholder="Note"> 
                    </div>
                    
                </div>        		 -->
                 
            </div>
            <div class="modal-footer bg-light">
                
                <button type="submit" id="id_ModRedTagCre_Update" class="btn btn-primary" onclick="funModRedTagCre_Update()" >Submit</button>
                <button type="submit" class="btn btn-primary" onclick="funModRedTagCre_Cancel()" >Cancel</button>
            </div>
        </div>
    </div>
</div>