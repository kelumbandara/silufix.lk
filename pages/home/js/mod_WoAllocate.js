$(function () 
{         
    //--------------- Model User All Users Table ---------------------
    $("#id_tblmod_woallusers").DataTable({
        "paging": false,
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,            
        "scrollX": true,
        "scrollY": 340,
        "info": false, 
        //"rowCallback" : funCellCreated,
        "dom": "lrti"
    }).buttons().container().appendTo('#id_tblmod_woallusers_wrapper .col-md-6:eq(0)');        
    dtbl2 = $('#id_tblmod_woallusers').DataTable();
    //--------------- Model : Only Allocated Users Table ---------------------
    $("#id_tblmod_woallocated").DataTable({
        "paging": false,
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,            
        "scrollX": true,
        "scrollY": 180,
        "info": false, 
        //"rowCallback" : funCellCreated,
        "dom": "lrti"
    }).buttons().container().appendTo('#id_tblmod_woallocated_wrapper .col-md-6:eq(0)');  
    dtbl3 = $('#id_tblmod_woallocated').DataTable(); 
    //--- Load Tables --------------------------------------
    //funRefreshClicked();
    //funRefreshHomeDowntimeDashboard(); 
    //MQTTconnect();
}); 
//---------------- Model : All Mechanic Show Tble Click Event to Allocate MC--------------------------
$('#id_tblmod_woallusers tbody').on('click', 'tr', function () 
{     
    let intDebugEnable = 0;        
    if(intDebugEnable === 1)    alert("To Alllocated..");
    //--------- Check for Data Validation --------------------------------
    if(document.getElementById('id_ModWoAllocate_dtmStart').value === document.getElementById('id_ModWoAllocate_dtmEnd').value)
    {
        if(intDebugEnable === 1)    alert("Same date time");
        Swal.fire({title: 'Warning.!',text: "Please set allocated time",icon: 'warning',confirmButtonText: 'OK'});  // success, error, warning, info, question   
    }
    else
    {
        if(intDebugEnable === 1)    alert("not Same date time");
        const table2 = new DataTable('#id_tblmod_woallusers');
        table2.on('click', 'tbody tr', (e) => 
        {
            //alert("Test-2");
            let classList = e.currentTarget.classList;
            if (classList.contains('selected')) 
            {
                //classList.remove('selected');
            }
            else 
            {
                table2.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
                classList.add('selected');          
                //funWoTableRowClicked();
                var mydata          = dtbl2.rows('.selected').data(); 
                var strEmpEPF       = mydata[0][0];
                var strEmpName      = mydata[0][1];
                var strEmpContact   = mydata[0][2];  

                //employeeData.push(res.Data_Ary[i].AllocatedUser);
                //alert(employeeData);
                if (employeeData.includes(strEmpEPF))
                {
                    //alert("EPF found");
                    Swal.fire({
                        title: 'Error.!',
                        text: 'User Already Allocated..',
                        icon: 'error',
                        confirmButtonText: 'OK'
                      });
                } 
                else 
                {
                    //alert("EPF not found");
                    employeeData.push(strEmpEPF);                
                    //var strWorkOrderNo =  document.getElementById("id_ModWoAllocate_WoNo").innerHTML;  
                    //alert(strWorkOrderNo);
                    //----------- Update Event Log, When Already Allocated list Deactive -----------------------------            
                    const DataAry = [];             
                    DataAry[0] = "funUpdateEventLog";
                    //DataAry[1] = strWorkOrderNo;
                    DataAry[1] = JS_SessionArry[0].WorkOrderNo;
                    DataAry[2] = JS_SessionArry[0].CurrentUserName;
                    DataAry[3] = JS_SessionArry[0].CurrentUserContact;
                    DataAry[4] = ",Allocated " + strEmpName + "- On";
                    //Work Order Placed - On 2024-02-02T17:38 By Kelum Bandara(0772628859)
                    //----------- Update Event Log --------------------------------------------------            
                    if(intDebugEnable === 1)    alert("DataAry : " + DataAry); 
                    $.post('class/comFunctions.php', { userpara: DataAry }, function(json_data2) 
                    {
                        if(intDebugEnable === 1)    alert("json_data2 : " + json_data2); 

                    });     
                    //----------- Insert Row to tblwo_allocatedusers  -----------------------------            
                    //const DataAry = []; 
                    DataAry[0] = "funInsertData";
                    DataAry[1] = JS_SessionArry[0].WorkOrderNo;
                    DataAry[2] = strEmpEPF;  
                    DataAry[3] = strEmpContact; 
                    DataAry[4] = document.getElementById('id_ModWoAllocate_dtmStart').value;
                    DataAry[5] = document.getElementById('id_ModWoAllocate_dtmEnd').value;

                    //alert("Insert Data " + DataAry); 
                    //var vblSendPara =  "1234"; 
                    $.post('class/insertData_ModWoAllocate.php', { userpara: DataAry }, function(json_data2) 
                    {
                        if(intDebugEnable === 1)    alert("json_data2 : " + json_data2);           
                        var res = $.parseJSON(json_data2);    
                        if(intDebugEnable === 1) alert("Status_Ary" + res.Status_Ary[0]);
                        if(res.Status_Ary[0] === "true")
                        {
                             Swal.fire({title: 'Success.!',text: 'Data updated successfully',icon: 'success',confirmButtonText: 'OK'});  // success, error, warning, info, question   
                        }
                        else
                        {
                            Swal.fire({title: 'Error.!',text: res.Status_Ary[1],icon: 'error',confirmButtonText: 'OK'});  // success, error, warning, info, question   
                        }
                        //funRefreshClicked();
                        //-------------- Reda Data from tblwo_allocatedusers WHERE WorkOrderNo = xxxx: -------------------
                        //------------ Read Allocated Mechanics list -------------------------
                        DataAry[0] = "funGetAllocatedUserData";      
                        DataAry[1] = JS_SessionArry[0].WorkOrderNo;;     
                        if(intDebugEnable === 1)    alert("DataAry : " + DataAry);           
                        $.post('class/comFunctions.php', { userpara: DataAry}, function(json_data2) 
                        {
                            if(intDebugEnable === 1)    alert("json_data2 : " + json_data2); 
                            var res = $.parseJSON(json_data2);
                            dtbl3.clear().draw(); 
                            if(res.Status_Ary[0] === "true")
                            {            
                                //var AllocatedMcList = "";
                                var AllocatedMc_Ary = res.Data_Ary;
                                for (i = 0; i < AllocatedMc_Ary.length; i++) 
                                {
                                   dtbl3.row.add([res.Data_Ary[i].AllocatedUser,res.Data_Ary[i].EmpName, res.Data_Ary[i].Contact, res.Data_Ary[i].AllocatedUserStartDateTime.substring(2, 16), res.Data_Ary[i].AllocatedUserEndDateTime.substring(2, 16),res.Data_Ary[i].DurationInMinutes]).draw(false);
                                } 
                            }
                            else
                            {
                                //alert("No data found");
                            }
                        });
                    });
                }
            }
        });
    }     
});
//---------------- Model : Already Allocate Users Row Clicked Function---------------------------
$('#id_tblmod_woallocated tbody').on('click', 'tr', function () 
{        
    let intDebugEnable = 0;        
    if(intDebugEnable === 1)    alert("Already allocated");
    
    const table2 = new DataTable('#id_tblmod_woallocated');
    table2.on('click', 'tbody tr', (e) => 
    {
        //alert("Already Allocated MC clicked");         
        let classList = e.currentTarget.classList;
        if (classList.contains('selected')) 
        {
            //classList.remove('selected');
        }
        else 
        {
            table2.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
            classList.add('selected');
            var mydata = dtbl3.rows('.selected').data(); 
            var strEmpEPF  = mydata[0][0];
            var strEmpName = mydata[0][1];
            //var strEmpContact = mydata[0][2];            
            //var strWorkOrderNo =  document.getElementById("id_ModWoAllocate_WoNo").innerHTML;  
            //-------------- Remove users from employeeData Array ------------------------------
            //employeeData.push(strEmpEPF);
            const const_index = employeeData.indexOf(strEmpEPF);
            if (const_index !== -1) 
            {
                // Remove the EPF from the array
                employeeData.splice(const_index, 1);
                //alert("user removed");
            }
            //----------- Update Event Log, When Already Allocated list Deactive -----------------------------            
            const DataAry = [];             
            DataAry[0] = "funUpdateEventLog";
            DataAry[1] = JS_SessionArry[0].WorkOrderNo;
            DataAry[2] = JS_SessionArry[0].CurrentUserName;
            DataAry[3] = JS_SessionArry[0].CurrentUserContact;
            DataAry[4] = ",Removed Allocate " + strEmpName + "- On";
            //Work Order Placed - On 2024-02-02T17:38 By Kelum Bandara(0772628859)
            //----------- Update Event Log --------------------------------------------------            
            //alert(DataAry); 
            $.post('class/comFunctions.php', { userpara: DataAry }, function(json_data2) 
            {
                //alert(json_data2); 
                //var res = $.parseJSON(json_data2);
            });                
            //----------- Update Allocate Database ------------------------------------------
            DataAry[0] = JS_SessionArry[0].WorkOrderNo;
            DataAry[1] = strEmpEPF;
            //alert(DataAry); 
            //var vblSendPara =  "1234"; 
            $.post('class/updateData_ModWoAllocate.php', { userpara: DataAry }, function(json_data2) 
            {
                //alert(json_data2);           
                var res = $.parseJSON(json_data2);         
                 //funRefreshClicked();
                 //------------- Update, Refresh Table --------------------------------------
                DataAry[0] = "funGetAllocatedUserData";      
                DataAry[1] = JS_SessionArry[0].WorkOrderNo;     
                if(intDebugEnable === 1)    alert("DataAry" + DataAry);
                $.post('class/comFunctions.php', { userpara: DataAry}, function(json_data2) 
                {
                    //alert(json_data2);  
                    if(intDebugEnable === 1)    alert("json_data2" + json_data2);
                    var res = $.parseJSON(json_data2);
                    dtbl3.clear().draw(); 
                    if(res.Status_Ary[0] === "true")
                    {            
                        //var AllocatedMcList = "";
                        var AllocatedMc_Ary = res.Data_Ary;
                        for (i = 0; i < AllocatedMc_Ary.length; i++) 
                        {
                           dtbl3.row.add([res.Data_Ary[i].AllocatedUser,res.Data_Ary[i].EmpName, res.Data_Ary[i].Contact, res.Data_Ary[i].AllocatedUserStartDateTime.substring(2, 16), res.Data_Ary[i].AllocatedUserEndDateTime.substring(2, 16),res.Data_Ary[i].DurationInMinutes]).draw(false);
                        } 
                    }
                    else
                    {
                        //alert("No data found");
                    }
                });
            }); 
        }
    });        
});

//--------------- Function Click Create Breakdown ----------------------------
function funModWoDetails_AllocateMC()
{        
    //---------- Check Login Required --------------------------------
    if(roll_other_ary.includes('90011'))          // User Check Required....
    {
        //alert("Current User : " + JS_SessionArry[0].CurrentUserName);
        //JS_SessionArry[0].WorkOrderNo = document.getElementById("id_ModWoDetails_WoNo").innerHTML; 
        JS_SessionArry[0].NextModelID       = "id_ModWoAllocate"; 
        JS_SessionArry[0].NextFunctionName  = "funOpenMod_WoAllocate";      
        //---------- Open Model for Check User -------------------------------------
        var varmodbox = document.getElementById("id_ModCheckUser");
        varmodbox.style.display = "block";        
    }
    else
    {        
        funOpenMod_WoAllocate();
    }
}
//----------------- Open Model Alloacate-------------------------------------  
function funOpenMod_WoAllocate()
{
    let intDebugEnable = 0;
        
    if(intDebugEnable === 1)   alert("Open WoAllocate Model"); 
    //----- Clear Employee Data (EPF) array ---------------------------------
    employeeData.length = 0;
    //---------- Update Wo Details ---------------------------------------
    var strWorkOrderNumber  = document.getElementById("id_ModWoDetails_WoNo").innerHTML;  
    var strWorkOrderDate    = document.getElementById("id_ModWoDetails_WoDate").innerHTML;
    var strWorkProblem      = document.getElementById("id_ModWoDetails_WoProblem").innerHTML;
    var strMachineNo        = document.getElementById("id_ModWoDetails_Machine").innerHTML;

    //---------- Open Model_Wo Close --------------------------------------
    var varmodbox = document.getElementById("id_ModWoAllocate");
    varmodbox.style.display = "block";    
    document.getElementById("id_ModWoAllocate_WoNo").innerHTML      = strWorkOrderNumber;   
    document.getElementById("id_ModWoAllocate_WoDate").innerHTML    = strWorkOrderDate;
    document.getElementById("id_ModWoAllocate_WoProblem").innerHTML = strWorkProblem;
    document.getElementById("id_ModWoAllocate_Machine").innerHTML   = strMachineNo;
     
    //------------- Load All Mechanics ----------------------------------- 
    if(intDebugEnable === 1)   alert("Load All Mechanic");
    const DataAry = []; 
    DataAry[0] = strWorkOrderNumber;        
    DataAry[1] = strMachineNo;        
    //alert(DataAry);             
    //var vblSendPara =  "1234";         
    $.post('class/getData_ModWoAllocate.php', { userpara: DataAry}, function(json_data2) 
    {
        //alert(json_data2);  
        var res = $.parseJSON(json_data2); 
        var strEPF          = new Array();
        var strName         = new Array();
        var strContactNo    = new Array(); 
        
        strEPF              = res.EPF_Ary; 
        strName             = res.EmpName_Ary;          
        strContactNo        = res.Contact_Ary;  
        //---------------- Update Table -------------------
       let intRecCount = strName.length; 
       dtbl2.clear().draw();            
       for(i=0; i<intRecCount; i++)
       {               
           //dtbl1.row.add([WorkCenterNoAry[i], WorkCenterName[i], LowerValue[i] , UpperValue[i], LowerColor[i], MiddleColor[i], UpperColor[i], "<a class=\"btn btn-info btn-sm\" name=\"btn_edit\"><i class=\"fa fa-edit\"></i></a>"]).draw(false);
           dtbl2.row.add([strEPF[i], strName[i], strContactNo[i], '<button type="button" class="btn btn-link clickable-icon"><i class="fa fa-check"></i></button>']).draw(false);
       }    
    });     
    //------------ Load Already Allocated Mechanics ------------------------------------
    if(intDebugEnable === 1)   alert("Load Already Allocated Mechanics");
    DataAry[0] = "funGetAllocatedUserData";      
    DataAry[1] = strWorkOrderNumber;     
    //alert(DataAry);             
    //var vblSendPara =  "1234";         
    $.post('class/comFunctions.php', { userpara: DataAry}, function(json_data2) 
    {
        //alert(json_data2);  
        var res = $.parseJSON(json_data2);
        dtbl3.clear().draw(); 
        if(res.Status_Ary[0] === "true")
        {            
            var AllocatedMcList = "";
            var AllocatedMc_Ary = res.Data_Ary;
            employeeData.length = 0;
            for (i = 0; i < AllocatedMc_Ary.length; i++) 
            {
                employeeData.push(res.Data_Ary[i].AllocatedUser);
                //alert(res.Data_Ary[i].WorkOrderNo);
                //AllocatedMcList += res.Data_Ary[i].AllocatedUser + "," +res.Data_Ary[i].EmpName + " [" + res.Data_Ary[i].Contact +"]";
                //AllocatedMcList += "<br>";
                //alert(res.Data_Ary[i].DurationInMinutes);
                
                //let strStartDateTime = res.Data_Ary[i].AllocatedUserStartDateTime;
                //strStartDateTime = strStartDateTime.substring(2, 16);
                //let strEndDateTime = res.Data_Ary[i].AllocatedUserEndDateTime;
                //strEndDateTime = strEndDateTime.substring(2, 16);
                dtbl3.row.add([res.Data_Ary[i].AllocatedUser, res.Data_Ary[i].EmpName, res.Data_Ary[i].Contact, res.Data_Ary[i].AllocatedUserStartDateTime.substring(2, 16), res.Data_Ary[i].AllocatedUserEndDateTime.substring(2, 16), res.Data_Ary[i].DurationInMinutes]).draw(false);
            } 
            document.getElementById("id_ModWoDetails_AllocatedMc").innerHTML   = AllocatedMcList;
        }
        else
        {
            //document.getElementById("id_ModWoDetails_AllocatedMc").innerHTML   = "";
            //alert("No data found");
        }
    });
    //---------------- Load Now Date and time to Model Box --------------------------
    if(intDebugEnable === 1)   alert("Load Date time box");
    // Get the current date and time
    const now = new Date();
    // Format the date and time as required by the datetime-local input
    const year = now.getFullYear().toString().padStart(4, '0');
    const month = (now.getMonth() + 1).toString().padStart(2, '0');
    const day = now.getDate().toString().padStart(2, '0');
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');

    // Set the value of the input
    const datetimeInput = document.getElementById('id_ModWoAllocate_dtmStart');
    datetimeInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
    const datetimeInput2 = document.getElementById('id_ModWoAllocate_dtmEnd');
    datetimeInput2.value = `${year}-${month}-${day}T${hours}:${minutes}`;
    if(intDebugEnable === 1)   alert("Model Loading End");
}
//--------------- Filters ----------------------
function funModWoClose_Filter()
{
    //alert("Filter function");
}
function funMoWoAlocate_Close()
{
    //alert("Wo Table Row Clicked.."); 
    //------------- Refresh Work Order Details ---------------------------------
    //funWoTableRowClicked();
    //-----------------------------------------------------------
    var varmodbox = document.getElementById("id_ModWoAllocate");
    varmodbox.style.display = "none";
    
    let strReturn = funWoDetailsRefresh(JS_SessionArry[0].WorkOrderNo);
    //funRefreshClicked();
    funRefresh_HomePage();  

}
//------- Check Start and End Time boxes -------------------------
function funDateChanged()
{
    //alert("Allocate time changed.."); 
    
   // const startDateInput = document.getElementById("id_ModWoAllocate_dtmStart");
   // const endDateInput = document.getElementById("id_ModWoAllocate_dtmEnd");

    const startDateInput = new Date(document.getElementById("id_ModWoAllocate_dtmStart").value);
    const endDateInput = new Date(document.getElementById("id_ModWoAllocate_dtmEnd").value);

    if (endDateInput <= startDateInput) 
    {
        //alert("End datetime must be greater than start datetime");
        Swal.fire({title: 'Error.!',text: 'End datetime must be greater than start datetime',icon: 'error',confirmButtonText: 'OK'});  // success, error, warning, info, question   
                     
        document.getElementById("id_ModWoAllocate_dtmEnd").value = document.getElementById("id_ModWoAllocate_dtmStart").value; // Clear the end datetime input
    }

}
