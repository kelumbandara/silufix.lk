  <!-- Navbar -->
<div class="modal" id="id_MoWoDetails">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">      
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
                        <label class="text-warning"><strong>Work Order Details</strong></label>
                        <table style="width: 100%"> 
                            <tbody>
                                <tr>
                                    <td style="width:33%;">WO Number</td>
                                    <td style="width:2%;">:</td>            
                                    <td style="width:66%;" id="id_ModWoDetails_WoNo">-</td>            
                                </tr>
                                <tr>
                                    <td style="width:33%;">Date</td>
                                    <td style="width:2%;">:</td>   
                                    <td style="width:65%;" id="id_ModWoDetails_WoDate">-</td>   
                                </tr> 
                                <tr>
                                    <td style="width:33%;">Problem</td>
                                    <td style="width:2%;">:</td>   
                                    <td style="width:65%;"> <div class="fixed-height-label overflow-auto" style="height: 30px; max-height: 30px;" id="id_ModWoDetails_WoProblem" readonly></div> </td>   
                                </tr> 
                                <tr>
                                    <td style="width:33%;">Machine</td>
                                    <td style="width:2%;">:</td>   
                                    <td style="width:65%;"> <div class="fixed-height-label overflow-auto" style="height: 30px; max-height: 30px;" id="id_ModWoDetails_Machine" readonly></div> </td>   
                                </tr> 
                            </tbody>               
                        </table>                        
                    </div>                     
                    <div class="col-md-5"> 
                        <div class="form-group">
                           <label><strong>Chat History</strong></label>
                            <div class="fixed-height-label overflow-auto" style="height: 100px; max-height: 140px;" id="id_ModWoDetails_ChatHistory" readonly>                              
                            
                            </div> 
                        </div>
                    </div>
                </div>     
                
                <div class="border-top my-1"></div>  
                <div class="row">                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Engaged Mechanics</strong></label>
                            <table id="id_tblmod_wocheckin" style="width: 100%">
                                <thead class="bg-info">
                                    <tr>
                                        <th style="width:10%;">EPF</th>
                                        <th style="width:50%;">Name</th>
                                        <th style="width:30%;">Contact</th> 
                                        <th style="width:10%;">Duration(Min)</th>
                                    </tr>
                                </thead>
                                <tbody>    
                                </tbody>               
                            </table> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Allocated Mechanics</strong></label>
                            <div class="fixed-height-label overflow-auto" style="height: 80px; max-height: 140px;" id="id_ModWoDetails_AllocatedMc" readonly>                              
                            
                            </div> 
                        </div>
                    </div>
                </div>    
                
                <div class="border-top my-1"></div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleLabel"><strong>Event Log</strong></label>
                            <div class="fixed-height-label overflow-auto" style="height: 50px; max-height: 100px;" id="id_ModWoDetails_EventLog" readonly>
                                
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="border-top my-2"></div> 
                <div class="row">                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" onclick="funModWoDetails_AllocateMC()" style="width: 32%" <?php echo (in_array('1001812', $roll_areas) ? '' : 'disabled'); ?>>Allocate MC</button>
                            <button type="submit" class="btn btn-primary" onclick="funModWoDetails_CheckIn()" id="id_ModWoDetails_btnCheckIn" style="width: 32%" <?php echo (in_array('1001813', $roll_areas) ? '' : 'disabled'); ?>>Check In</button>
                            <button type="submit" class="btn btn-primary" onclick="funModWoDetails_WoClose()" style="width: 32%" <?php echo (in_array('1001814', $roll_areas) ? '' : 'disabled'); ?>>Close WO</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" onclick="funModWoDetails_WoVerify()" style="width: 32%" <?php echo (in_array('1001815', $roll_areas) ? '' : 'disabled'); ?>>Verify</button>
                            <button type="submit" class="btn btn-primary" onclick="funModWoDetails_WoReOpen()" style="width: 32%" <?php echo (in_array('1001816', $roll_areas) ? '' : 'disabled'); ?>>Re-Open</button>
                            <button type="submit" class="btn btn-primary" onclick="funModWoDetails_WoChat()" style="width: 32%" <?php echo (in_array('1001817', $roll_areas) ? '' : 'disabled'); ?>>Chat</button>             
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>