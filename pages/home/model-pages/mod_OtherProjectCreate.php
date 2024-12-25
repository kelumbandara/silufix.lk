  <!-- Navbar -->
<div class="modal" id="id_ModOtherProjectCre">
    <div class="modal-dialog">      
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-center" style="width: 100%">Request Other Project</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="funModOtherProjectCre_Close()">
                    <span aria-hidden="true" class="text-white close-icon"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h6 class="modal-title text-center" style="width: 100%">User's Department : </h6>                                
                <br/>                
                <div class="row pt-0"> 
                    <div class="form-group">
                        <label>Date and time:</label>
                        <div class="input-group date" id="ModOtherProjectCre_dtmDateTime" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" id="id_ModOtherProjectCre_dtmDateTime2" data-target="#ModOtherProjectCre_dtmDateTime"/>
                            <div class="input-group-append" data-target="#ModOtherProjectCre_dtmDateTime" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>                                   
                </div>            
             
                <div class="row p-1">                    
                    <div class="col-md-12">                   
                        <label style="font-weight: bolder">Select the Category</label>    
                        <select class="form-control select2" id="id_ModOtherProjectCre_SelProjectCategory" style="width: 100%;">
                            <option>New Fabrication</option>  
                            <option>Repair Item</option>  
                            <option>New Modification</option>  
                            <option>Interior Re-Arrange</option> 
                            <option>New Wiring Requirement</option>
                            <option>Supply line Modification</option>
                            <option>Machine Movement</option> 
                            <option>Other</option>       
                        </select>
                    </div>                    
                </div> 
                <div class="row p-1">   
                    <div class="col-md-12">
                        <label style="font-weight: bolder">Write Description Here</label> 
                        <textarea id="id_ModOtherProjectCre_inpNote" class="form-control" name="Note" style="height: 140px"></textarea>
                    </div>
                </div> 
                 
            </div>
            <div class="modal-footer bg-light">
                <button type="submit" id="id_ModOtherProjectCre_Update" class="btn btn-primary" onclick="funModOtherProjectCre_Update()" >Submit</button>
                <button type="submit" class="btn btn-primary" onclick="funModOtherProjectCre_Cancel()" >Cancel</button>
            </div>
        </div>
    </div>
</div>