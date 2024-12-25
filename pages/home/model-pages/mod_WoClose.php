  <!-- Navbar -->
<div class="modal" id="id_MoWoClose">
    <div class="modal-dialog modal-lg">      
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Work Order Close</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="funMoWoClose_Close()">
                    <span aria-hidden="true" class="text-white close-icon"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">                    
                    <div class="col-md-9">  
                        <table style="width: 100%"> 
                            <tbody>
                                <tr>
                                    <td style="width:20%;">WO Number</td>
                                    <td style="width:5%;">:</td>            
                                    <td style="width:75%;" id="id_ModWoClose_WoNo">-</td>            
                                </tr>
                                <tr>
                                    <td style="width:20%;">Machine</td>
                                    <td style="width:5%;">:</td>   
                                    <td style="width:75%;" id="id_ModWoClose_Machine">-</td>   
                                </tr> 
                            </tbody>               
                        </table>  
                    </div>
                </div>                 
                <div class="border-top my-1"></div>  
                <div class="row p-1">
                    <div class="col-md-12">                   
                        <label style="font-weight: bolder;" >Fault Type</label>    
                        <select class="form-control select2" onchange="funModWoClose_FilterFaultType()" id="id_ModWoClose_SelFaultType" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>
                    </div>
                </div>                 
                <div class="row p-1">                    
                    <div class="col-md-6">                   
                        <label style="font-weight: bolder">Fault Level 1</label>    
                        <select class="form-control select2" onchange="funModWoClose_FilterFaultLevel1()" id="id_ModWoClose_SelFaultLevel1" style="width: 100%;">
                            <option selected="none"></option>                            
                        </select>
                    </div>
                    <div class="col-md-6">                      
                         <label style="font-weight: bolder">Fault Level 2</label>    
                        <select class="form-control select2" onchange="funModWoClose_FilterFaultLevel2()" id="id_ModWoClose_SelFaultLevel2" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>               
                    </div>
                </div> 
                <div class="row p-1">
                    <div class="col-md-6">                   
                        <label style="font-weight: bolder">Fault Level 3</label>    
                        <select class="form-control select2" onchange="funModWoClose_FilterFaultLevel3()" id="id_ModWoClose_SelFaultLevel3" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>
                    </div>
                    <div class="col-md-6">                      
                         <label style="font-weight: bolder">Fault Level 4</label>    
                        <select class="form-control select2" onchange="funModWoClose_FilterFaultLevel4()" id="id_ModWoClose_SelFaultLevel4" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>               
                    </div>
                </div> 
                <div class="row p-1">   
                    <div class="col-md-6">
                        <input type="datetime-local" id="id_ModWoClose_dtmDateTime" class="form-control" name="startDate" required/>                           
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="id_ModWoClose_inpNote" class="form-control" name="Note" placeholder="Note"> 
                    </div>                    
                </div>      
            </div>
            <div class="modal-footer bg-light">
                <button type="submit" class="btn btn-primary" onclick="funModWoClose_SaveClose()" >Save and Close</button>
                <a href="home.php" class="btn btn-warning">&nbsp;Back</a>
            </div>
        </div>
    </div>
</div>