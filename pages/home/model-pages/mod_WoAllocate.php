  <!-- Navbar -->
<div class="modal" id="id_ModWoAllocate">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">      
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Work Order Allocate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="funMoWoAlocate_Close()">
                    <span aria-hidden="true" class="text-white close-icon"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">                    
                    <div class="col-md-7">  
                        <div class="row">
                            <div class="col-md-12"> 
                                <table style="width: 100%"> 
                                    <tbody>
                                        <tr>
                                            <td style="width:30%;">WO Number</td>
                                            <td style="width:5%;">:</td>            
                                            <td style="width:65%;" id="id_ModWoAllocate_WoNo">-</td>            
                                        </tr>
                                        <tr>
                                            <td style="width:30%;">Date</td>
                                            <td style="width:5%;">:</td>   
                                            <td style="width:65%;" id="id_ModWoAllocate_WoDate">-</td>   
                                        </tr> 
                                        <tr>
                                            <td style="width:30%;">Problem</td>
                                            <td style="width:5%;">:</td>   
                                            <td style="width:65%;" id="id_ModWoAllocate_WoProblem">-</td>   
                                        </tr> 
                                        <tr>
                                            <td style="width:30%;">Machine</td>
                                            <td style="width:5%;">:</td>   
                                            <td style="width:65%;" id="id_ModWoAllocate_Machine">-</td>   
                                        </tr> 
                                    </tbody>               
                                </table> 
                            </div>
                        </div>
                        <div class="border-top my-1"></div> 
                        <div class="row">
                            <div class="col-md-6">
                                <label style="font-weight: bolder">Allocate Start</label>
                            </div>
                            <div class="col-md-6">
                                <input type="datetime-local" id="id_ModWoAllocate_dtmStart" class="form-control" name="startDate" onChange="funDateChanged()" required/>                           
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label style="font-weight: bolder">Allocate End</label>
                            </div>
                            <div class="col-md-6">
                                <input type="datetime-local" id="id_ModWoAllocate_dtmEnd" class="form-control" name="endDate" onChange="funDateChanged()" required/>                           
                            </div>
                        </div>
                        <div class="border-top my-1"></div> 
                        <div class="row">
                             <div class="col-md-12"> 
                                <div class="form-group">
                                    <label><strong>Already Allocated Mechanics</strong></label>
                                    <table id="id_tblmod_woallocated" class="table table-sm display compact" style="width: 100%">
                                        <thead class="bg-info">
                                            <tr>
                                                <th style="width:10%;">EPF</th>
                                                <th style="width:50%;">Name</th>
                                                <th style="width:30%;">Contact</th> 
                                                <th style="width:30%;">Start Time</th> 
                                                <th style="width:30%;">End Time</th>
                                                <th style="width:10%;">Duration(Min)</th>
                                            </tr>
                                        </thead>
                                        <tbody>    

                                        </tbody>               
                                    </table>  
                                </div>
                             </div>
                        </div>                        
                    </div>                     
                    <div class="col-md-5">  
                        <label><strong>List Of Mechanics</strong></label>
                        <table id="id_tblmod_woallusers" class="table display compact" style="width: 100%">
                            <thead class="bg-info">
                                <tr>
                                    <th style="width:20%;">EPF</th>
                                    <th style="width:50%;">Name</th>
                                    <th style="width:20%;">Contact</th>    
                                    <th style="width:10%;">Allocate</th>                                     
                                </tr>
                            </thead>
                            <tbody>    
                                
                            </tbody>               
                        </table>  
                    </div>                    
                </div>                 
            </div>
            <br/><br/>
        </div>
    </div>
</div>