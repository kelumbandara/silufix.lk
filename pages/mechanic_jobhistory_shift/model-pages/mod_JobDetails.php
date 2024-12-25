  <!-- Navbar -->
<div class="modal" id="id_MoWoDetails">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">      
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white text-center" id="exampleModalLabel">Work Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="funMoWoDetails_Close()">
                    
                    <span aria-hidden="true" class="text-white close-icon"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">                    
                    <div class="col-md-7">  
                        <!-- <label class="text-warning"><strong>Work Order Details</strong></label> -->
                        <table style="width: 100%"> 
                            <tbody>
                                <tr>
                                    <td style="width:35%;">WO Number</td>
                                    <td style="width:2%;">:</td>            
                                    <td style="width:63%;" id="id_ModWoDetails_WoNo">-</td>            
                                </tr>
                                <tr>
                                    <td style="width:35%;">Category/Department</td>
                                    <td style="width:2%;">:</td>   
                                    <td style="width:63%;"> <div class="fixed-height-label overflow-auto" style="height: 30px; max-height: 30px;" id="id_ModWoDetails_WoProblem" readonly></div> </td>   
                                </tr> 
                               
                            </tbody>               
                        </table>                        
                    </div>  
                    <div class="col-md-5">  
                        <!-- <label class="text-warning"><strong>Work Order Details</strong></label> -->
                        <table style="width: 100%"> 
                            <tbody>
                                <tr>
                                    <td style="width:55%;">Total Time</td>
                                    <td style="width:2%;">:</td>   
                                    <td style="width:45%;" id="id_ModWoDetails_WoTotDowntime">-</td>   
                                </tr> 
                                <tr>
                                    <td style="width:55%;">Total Attended Time</td>
                                    <td style="width:2%;">:</td>            
                                    <td style="width:45%;" id="id_ModWoDetails_WoAttnTime">-</td>            
                                </tr>                                
                            </tbody>               
                        </table>                        
                    </div>                    
                </div>     
                <div class="row">                    
                    <div class="col-md-12">  
                        <!-- <label class="text-warning"><strong>Work Order Details</strong></label> -->
                        <table style="width: 100%"> 
                            <tbody>
                                <tr>
                                    <td style="width:20%;">Machine/Details</td>
                                    <td style="width:2%;">:</td>   
                                    <td style="width:78%;"> <div class="fixed-height-label overflow-auto" style="height: 30px; max-height: 30px;" id="id_ModWoDetails_Machine" readonly></div> </td>   
                                </tr>
                            </tbody>               
                        </table>                        
                    </div>                    
                </div> 
                <div class="border-top my-1"></div>  
                <div class="row">                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <table id="id_tblmod_wocheckin" style="width: 140%">
                                <thead class="bg-info">
                                    <tr>
                                        <th style="width:10%;">EPF</th>
                                        <th style="width:50%;">Name</th>
                                        <th style="width:30%;">Check In Time</th> 
                                        <th style="width:30%;">Check Out Time</th> 
                                        <th style="width:10%;">Duration(Min)</th>
                                    </tr>
                                </thead>
                                <tbody>    
                                </tbody>               
                            </table> 
                        </div>
                    </div>                   
                </div>                    
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">                           
                            <div class="fixed-height-label overflow-auto" style="height: 140px; max-height: 160px;" id="id_ModWoDetails_EventLog" readonly>
                                
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>