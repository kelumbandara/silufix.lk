  <!-- Navbar -->
<div class="modal" id="id_ModUsersNew">
    <div class="modal-dialog">      
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-center" style="width: 100%">Report a Breakdown</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h6 class="modal-title text-center" style="width: 100%">User's Department : Engineering</h6>
                <div class="row p-1">
                    
                    <div class="col-md-6">                   
                        <label style="font-weight: bolder">Machine Category</label>    
                        <select class="form-control select2" onchange="funModBrkDownCre_Filter()" id="id_ModBrkDownCre_SelMcCategory" style="width: 100%;">
                            <option selected="none"></option>                            
                        </select>
                    </div>
                    <div class="col-md-6">                      
                         <label style="font-weight: bolder">Machine No</label>    
                        <select class="form-control select2" onchange="funModBrkDownCre_Filter()" id="id_ModBrkDownCre_SelMachineNo" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>               
                    </div>
                </div> 
                <div class="row p-1">
                    <div class="col-md-6">                   
                        <label style="font-weight: bolder">Fault Type</label>    
                        <select class="form-control select2" onchange="funModBrkDownCre_Filter()" id="id_ModBrkDownCre_SelFaultType" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>
                    </div>
                    <div class="col-md-6">                      
                         <label style="font-weight: bolder">Fault Level</label>    
                        <select class="form-control select2" onchange="funModBrkDownCre_Filter()" id="id_ModBrkDownCre_SelFaultLevel" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>               
                    </div>
                </div> 
                <br/>
                <div class="row p-1">   
                    <div class="col-md-6">
                        <input type="datetime-local" id="id_ModBrkDownCre_dtmDateTime" class="form-control" name="startDate" required/>                           
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="id_ModBrkDownCre_inpNote" class="form-control" name="Note" value="Note"> 
                    </div>
                    
                </div>        		
                 
            </div>
            <div class="modal-footer bg-light">
                <button type="submit" class="btn btn-primary" onclick="funModUsers_Update()" >Update</button>
                <a href="home.php" class="btn btn-warning">&nbsp;Back</a>
            </div>
        </div>
    </div>
</div>