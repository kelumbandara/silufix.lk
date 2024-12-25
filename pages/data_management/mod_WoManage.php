  <!-- Navbar -->
<div class="modal" id="id_ModWoManage">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">      
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white text-center" id="exampleModalLabel">Work Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="funMoWoManage_Close()">
                    
                    <span aria-hidden="true" class="text-white close-icon"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">                    
                    <div class="col-md-6">                          
                        <table style="width: 100%"> 
                            <tbody>
                                <tr>
                                    <td style="width:30%;">WO Number</td>
                                    <td style="width:5%;">:</td>            
                                    <td style="width:30%;" id="id_Mod_WoNumber">-</td> 
                                </tr>
                                <tr>
                                    <td style="width:33%;">Department</td>
                                    <td style="width:2%;">:</td>   
                                    <td style="width:65%;" id="id_Mod_Department">-</td>   
                                </tr> 
                                <tr>
                                    <td style="width:33%;">Category</td>
                                    <td style="width:2%;">:</td>   
                                    <td style="width:65%;" id="id_Mod_Category"></td>   
                                </tr> 
                            </tbody>               
                        </table>                        
                    </div>                     
                    <div class="col-md-6"> 
                        <table style="width: 100%"> 
                            <tbody>
                                <tr>
                                    <td style="width:30%;"></td>
                                    <td style="width:5%;"></td>            
                                    <td style="width:30%;"></td> 
                                </tr>
                                <tr>
                                    <td style="width:33%;"></td>
                                    <td style="width:2%;"></td>   
                                    <td style="width:60%;">
                                                                             
                                    </td>   
                                </tr> 
                                <tr>
                                    <td style="width:33%;">New Category</td>
                                    <td style="width:2%;">:</td>   
                                    <td style="width:65%;">
                                        <select class="form-control select2" onchange="funLoadAllChart()" id="id_Mod_Select_Category" style="width: 100%;">
                                            <option value="NA">NA</option>
                                            <option value="BreakDown">Breakdown</option>
                                            <option value="PlanMaintenance">Plan Maintenance</option> 
                                            <option value="RedTag">Red Tag</option> 
                                            <option value="BuildingMaintenance">Building Maintenance</option> 
                                            <option value="OtherProject">Other Project</option> 
                                        </select>                                      
                                    </td>   
                                </tr> 
                            </tbody>               
                        </table>
                    </div>
                </div>     
             
                <div class="border-top my-1"></div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleLabel"><strong>Wo Description</strong></label>
                            <div class="fixed-height-label overflow-auto" style="height: 50px; max-height: 100px;" id="id_Mod_WoDescription" readonly>
                                
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="border-top my-2"></div> 
                <div class="row">                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" onclick="funMod_Change()" style="width: 90%">Change</button>
                       </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" onclick="funMod_Clear()" style="width: 90%">Clear</button>
                         </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                           <button type="submit" class="btn btn-primary" onclick="funMoWoManage_Close()" style="width: 90%">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>