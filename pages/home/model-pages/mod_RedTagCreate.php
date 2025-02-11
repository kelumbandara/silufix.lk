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
                <h6 class="modal-title text-center" id="id_ModRedTagCre_lblUserDep" style="width: 100%">User's Department : --</h6>
               
                <div class="row p-1">                    
                    <div class="col-md-12">                   
                        <label style="font-weight: bolder">Site</label>    
                        <select class="form-control select2" onchange="funModRedTagCre_SelLocationFilter()" id="id_ModRedTagCre_Site" style="width: 100%;">
                        <option selected="none"></option>                             
                        </select>
                    </div>                    
                </div> 
                
                <div class="row p-1">                 
                    <div class="col-md-12">                      
                         <label style="font-weight: bolder">Location</label>    
                        <select class="form-control select2"  onchange="funModRedTagCre_SelBuildingFilter()" id="id_ModRedTagCre_Location" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>               
                    </div>
                    <div class="col-md-12">                   
                        <label style="font-weight: bolder">Building</label>    
                        <select class="form-control select2" onchange="funModRedTagCre_SelIssueTypeFilter()" id="id_ModRedTagCre_Building" style="width: 100%;">
                            <option selected="none"></option>                            
                        </select>
                    </div>
                    <div class="col-md-12">                      
                         <label style="font-weight: bolder">Issue Type</label>    
                        <select class="form-control select2"  onchange="funModRedTagCre_SelIssueDescriptionFilter()" id="id_ModRedTagCre_IssueType" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>               
                    </div>
                </div> 
                <div class="row p-1">
                    <div class="col-md-12">                   
                        <label style="font-weight: bolder">Issue Description</label>    
                        <select class="form-control select2"  id="id_ModRedTagCre_IssueDescription" style="width: 100%; background-color: blue">
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