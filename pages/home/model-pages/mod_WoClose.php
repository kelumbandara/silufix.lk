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
                                    <td style="width:20%;">Site</td>
                                    <td style="width:5%;">:</td>   
                                    <td style="width:75%;" id="id_ModWoClose_Machine">-</td>   
                                </tr> 
                            </tbody>               
                        </table>  
                    </div>
                </div>                 
                <div class="border-top my-1"></div>  
                <div class="row p-1">
                    <div class="col-md-6">                   
                        <label style="font-weight: bolder;" >Fault Type</label>    
                        <select class="form-control select2" onchange="funModWoClose_CorrectionAction()" id="id_ModWoClose_FaultType" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>
                    </div>
                    <div class="col-md-6">                   
                        <label style="font-weight: bolder">Correction Action</label>    
                        <select class="form-control select2" onchange="funModWoClose_UsedMaterial()" id="id_ModWoClose_CorrectionAction" style="width: 100%;">
                            <option selected="none"></option>                            
                        </select>
                    </div>
                </div>                 
                <div class="row p-1">                    
                    <div class="col-md-12">
                        <label style="font-weight: bolder">Note</label> 
                        <input type="text" id="id_ModWoClose_Note" class="form-control" name="Note" placeholder="Note"> 
                    </div>                     
                </div> 
                <div class="row p-1">
                    <div class="col-md-12">                      
                         <label style="font-weight: bolder">Used Material</label>    
                        <select class="form-control select2" onchange="funModWoClose_FilterFaultLevel2()" id="id_ModWoClose_UsedMaterial" multiple="multiple" style="width: 100%; background-color: blue">
                            <option selected="none"></option>                            
                        </select>               
                    </div>                    
                </div> 
                <div class="row p-1">   
                    <div class="col-md-12">
                        <label style="font-weight: bolder">After Correction</label> 
                        <input type="text" id="id_ModWoClose_Attachment" class="form-control" name="Note" placeholder="Attach Images"> 
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