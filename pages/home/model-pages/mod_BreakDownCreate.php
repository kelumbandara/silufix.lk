  <!-- Navbar -->
<div class="modal" id="id_ModBrkDownCre">
    <div class="modal-dialog">      
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-center" style="width: 100%">Report a Breakdown</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="funModBrkDownCre_Close()">
                    <span aria-hidden="true" class="text-white close-icon"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h6 class="modal-title text-center" id="id_ModBrkDownCre_lblUserDep" style="width: 100%">User's Department : Engineering</h6>
                <div class="row p-1">
                    
                    <div class="col-md-6">                   
                        <label style="font-weight: bolder">Site</label>    
                        <select class="form-control select2" onchange="funModBreakDown_SelSiteFilter()" id="id_ModBrkDownCre_SelSite" style="width: 100%;">
                            <option selected="none"></option>                            
                        </select>
                    </div>
                    <div class="col-md-6">                      
                         <label style="font-weight: bolder">Building</label>    
                        <select class="form-control select2" onchange="funModBreakDown_SelBuildingFilter()" id="id_ModBrkDownCre_Selbuilding" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>               
                    </div>
                </div> 
                <div class="row p-1">
                    <div class="col-md-6">                   
                        <label style="font-weight: bolder">Issuer Type</label>    
                        <select class="form-control select2" onchange="funModBrkDownCre_SelFaultTypeFilter()" id="id_ModBrkDownCre_SelFaultType" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>
                    </div>
                    <div class="col-md-6">                      
                         <label style="font-weight: bolder">Issuer Description</label>    
                        <select class="form-control select2" onchange="funModBrkDownCre_Filter()" id="id_ModBrkDownCre_SelFaultLevel" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>               
                    </div>
                </div> 
                <br/>
                        		
                 
            </div>
            <div class="modal-footer bg-light">
                <button type="submit" class="btn btn-primary" onclick="funModBrkDownCre_Update()" >Submit</button>
                <button type="submit" class="btn btn-primary" onclick="funModBrkDownCre_Cancel()" >Cancel</button>
            </div>
        </div>
    </div>
</div>