  <!-- Navbar -->
  <div class="modal" id="id_ModBrkDownCre">
  <div class="modal-dialog">      
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-center" style="width: 100%">Request a Breakdown Service</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="funModBrkDownCre_Close()">
                    <span aria-hidden="true" class="text-white close-icon"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h6 class="modal-title text-center" id="id_ModBrkDownCre_lblUserDep" style="width: 100%">User's Department : Engineering</h6>
               
                <div class="row p-1">                    
                    <div class="col-md-12">                   
                        <label style="font-weight: bolder">Site</label>    
                        <select class="form-control select2" onchange="funModBrkDownCre_SelLocationFilter()" id="id_ModBrkDownCre_Site" style="width: 100%;">
                        <option selected="none"></option>                             
                        </select>
                    </div>                    
                </div> 
                
                <div class="row p-1">                 
                    <div class="col-md-12">                      
                         <label style="font-weight: bolder">Location</label>    
                        <select class="form-control select2"  onchange="funModBrkDownCre_SelBuildingFilter()" id="id_ModBrkDownCre_Location" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>               
                    </div>
                    <div class="col-md-12">                   
                        <label style="font-weight: bolder">Building</label>    
                        <select class="form-control select2" onchange="funModBrkDownCre_SelIssueTypeFilter()" id="id_ModBrkDownCre_Building" style="width: 100%;">
                            <option selected="none"></option>                            
                        </select>
                    </div>
                    <div class="col-md-12">                      
                         <label style="font-weight: bolder">Issue Type</label>    
                        <select class="form-control select2"  onchange="funModBrkDownCre_SelIssueDescriptionFilter()" id="id_ModBrkDownCre_IssueType" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>               
                    </div>
                </div> 
                <div class="row p-1">
                    <div class="col-md-12">                   
                        <label style="font-weight: bolder">Issue Description</label>    
                        <select class="form-control select2"  id="id_ModBrkDownCre_IssueDescription" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>
                    </div>                    
                </div> 
                <br/>
                <!-- <div class="row p-1">   
                    <div class="col-md-6">
                        <input type="datetime-local" id="id_ModBrkDownCre_dtmDateTime" class="form-control" onchange="funDateChanged()" name="startDate" required/>                           
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="id_ModBrkDownCre_inpNote" class="form-control" name="Note" placeholder="Note"> 
                    </div>                    
                </div>        		 -->                 
            </div>
            <div class="modal-footer bg-light">                
                <button type="submit" id="id_ModBrkDownCre_Update" class="btn btn-primary" onclick="funModBrkDownCre_Update()" >Submit</button>
                <button type="submit" class="btn btn-primary" onclick="funModBrkDownCre_Cancel()" >Cancel</button>
            </div>
        </div>
    </div>
</div>