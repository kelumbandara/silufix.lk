
function funModWoCheckIn_Close()
{
    //alert("Close Model Box.start.");  
    //-----------------------------------------------------------
    var varmodbox = document.getElementById("id_ModWoCheckIn");
    varmodbox.style.display = "none";
    //alert("Close Model Box.end.");
}
//--------------- Check In Function ----------------------
function funModWoCheckIn_CheckIn()
{
    let intDebugEnable = 0;        
    if(intDebugEnable === 1)    alert("funModWoCheckIn_CheckIn function"); 
   
    const DataAry = []; 
    //var strWorkOrderNo      = document.getElementById("id_ModWoCheckIn_WoNo").innerHTML; 
    var strCheckInDateTime  = document.getElementById("id_ModWoCheckIn_dtmDateTime").value;           
    //-------------- Check User Already CheckIn ------------------------------
    DataAry[0] = "funGetCheckInDetails_byWoEpf";        // Table Name
    DataAry[1] = JS_SessionArry[0].WorkOrderNo;    
    DataAry[2] = JS_SessionArry[0].CurrentUserEPF; 
    if(intDebugEnable === 1) alert("DataAry :" + DataAry);
    
    $.post('class/comFunctions.php', { userpara: DataAry }, function(json_data2) 
    {
        if(intDebugEnable === 1) alert("json_data2 :" + json_data2);           
        var res = $.parseJSON(json_data2);                 
        //alert(res.Status_Ary[0]);        
        if(res.Status_Ary[0] === "false")   // No data found, insert new record
        {
            //alert("Insert New Raw...");            
            //----------- Update Event Log, When Already Allocated list Deactive -----------------------------            
            //const DataAry = [];             
            DataAry[0] = "funUpdateEventLog";
            //DataAry[1] = strWorkOrderNo;
            DataAry[1] = JS_SessionArry[0].WorkOrderNo;
            DataAry[2] = JS_SessionArry[0].CurrentUserName;
            DataAry[3] = JS_SessionArry[0].CurrentUserContact;
            DataAry[4] = ",CheckIn " + JS_SessionArry[0].CurrentUserName + "- On " + strCheckInDateTime + " Actual Time:";
            //Work Order Placed - On 2024-02-02T17:38 By Kelum Bandara(0772628859)
            //----------- Update Event Log --------------------------------------------------            
            //alert(DataAry); 
            $.post('class/comFunctions.php', { userpara: DataAry }, function(json_data2) 
            {
                //alert(json_data2); 
                //var res = $.parseJSON(json_data2);
            });
            //--------Insert New Row ----------------                         
            DataAry[0] = JS_SessionArry[0].WorkOrderNo;        // Table Name
            DataAry[1] = JS_SessionArry[0].CurrentUserEPF; 
            DataAry[2] = strCheckInDateTime; 
            DataAry[3] = strCheckInDateTime;                        
            //alert("Location : 120" +DataAry);
            $.post('class/insertData_ModWoCheckIn.php', { userpara: DataAry }, function(json_data2) 
            {
                //alert("Location : 130" +json_data2);           
                //var res = $.parseJSON(json_data2);                 
                //-------------- Modify Wo Event State ----> Inprogress ----------------------                
                DataAry[0] = "funWoStateChange";
                DataAry[1] = JS_SessionArry[0].WorkOrderNo;        // Table Name
                DataAry[2] = JS_SessionArry[0].CurrentUserEPF; 
                //alert("Location : 140" +DataAry);
                $.post('class/updateData_WoCheckIn.php', { userpara: DataAry }, function(json_data2) 
                {
                    //alert("Location : 150" +json_data2);           
                    //var res = $.parseJSON(json_data2);
                });
                               
                //------------- Refresh Work Order Details ---------------------------------
                let strReturn = funWoDetailsRefresh(JS_SessionArry[0].WorkOrderNo);
                //alert("strReturn :" + strReturn);
                //funRefreshClicked();  
                funRefresh_HomePage();  
                //alert("Table refresh finished");
                //------ Close Model Box ----------------------
                //alert("CheckIn Success");
                var varmodbox = document.getElementById("id_ModWoCheckIn");
                varmodbox.style.display = "none";
            }); 
        }
        else        // Already CheckIn
        {
            Swal.fire({title: 'Error.!',text: 'Already CheckIn',icon: 'error',confirmButtonText: 'OK'});
            //alert("Already CheckIn");                     
        }        
    });      
} 
//--------------- Function Click Create Breakdown ----------------------------
function funModWoDetails_CheckIn()
{        
    //alert("Wo Details Check In");
    if(document.getElementById("id_ModWoDetails_btnCheckIn").innerHTML === "Check In")
    {
        //alert("Check In"); 
        //alert("Check In clicked");  
        if(roll_other_ary.includes('90011'))          // User Check Required....
        {
            //alert("Check In, user login"); 
            //JS_SessionArry[0].WorkOrderNo = document.getElementById("id_ModWoDetails_WoNo").innerHTML; 
            JS_SessionArry[0].NextModelID       = "id_ModWoCheckIn"; 
            JS_SessionArry[0].NextFunctionName  = "funOpenMod_WoCheckIn";
            //alert("Next Function : " + JS_SessionArry[0].NextFunctionName);
            //---------- Open Model for Check User -------------------------------------
            var varmodbox = document.getElementById("id_ModCheckUser");
            varmodbox.style.display = "block";        
        }
        else
        {
            //alert("Check In, Open function"); 
            funOpenMod_WoCheckIn();
        }  
    }
    else
    {
        //alert("Check Out"); 
        Swal.fire({
            title: 'Check out Work Order',
            text: 'Are you sure you want to proceed?',
            //icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => 
        {
            if (result.isConfirmed) 
            {
                //----------- Update Event Log, When Already Allocated list Deactive -----------------------------            
                const DataAry = [];             
                DataAry[0] = "funUpdateEventLog";
                //DataAry[1] = strWorkOrderNo;
                DataAry[1] = JS_SessionArry[0].WorkOrderNo;
                DataAry[2] = JS_SessionArry[0].CurrentUserName;
                DataAry[3] = JS_SessionArry[0].CurrentUserContact;
                DataAry[4] = ",CheckOut " + JS_SessionArry[0].CurrentUserName; + "- On";
                //Work Order Placed - On 2024-02-02T17:38 By Kelum Bandara(0772628859)
                //----------- Update Event Log --------------------------------------------------            
                //alert(DataAry); 
                $.post('class/comFunctions.php', { userpara: DataAry }, function(json_data2) 
                {
                    //alert(json_data2); 
                    //var res = $.parseJSON(json_data2);
                });
                //-------------------- Update Checkout -------------------------------------------
                //const DataAry = []; 
                DataAry[0]  = "funCheckOutUsers";
                DataAry[1] = JS_SessionArry[0].WorkOrderNo;        // Table Name
                DataAry[2] = JS_SessionArry[0].CurrentUserEPF;                 
                //alert("Location 200 : " + DataAry);
                $.post('class/updateData_WoCheckIn.php', { userpara: DataAry }, function(json_data2) 
                {
                    //alert(json_data2);           
                    //var res = $.parseJSON(json_data2); 
                    //------------- Refresh Work Order Details ---------------------------------
                    funWoDetailsRefresh(JS_SessionArry[0].WorkOrderNo);
                    //funRefreshClicked(); 
                    funRefresh_HomePage();  
                });                               
            }
            else
            {
                //alert("user click no");
            }
        });
    }
}
//-------------- Open Model WO Checking -----------------------  
function funOpenMod_WoCheckIn()
{
    let intDebugEnable = 0;        
    if(intDebugEnable === 1)    alert("funOpenMod_WoCheckIn function2"); 
    if(intDebugEnable === 1)    alert("JS_SessionArry[0].WorkOrderCategory :" + JS_SessionArry[0].WorkOrderCategory); 
    if((JS_SessionArry[0].WorkOrderCategory === "BreakDown")||(JS_SessionArry[0].WorkOrderCategory === "RedTag"))
    {        
        //------------------- Find MachineNumber Department -------------------------------------------    
        const DataAry = []; 
        DataAry[0]  = "funGet_MachineDepartment";
        DataAry[1]  = JS_SessionArry[0].WorkOrderNo;

        if(intDebugEnable === 1) alert("DataAry :" + DataAry);
        $.post('class/getData_WoCheckIn.php', { userpara: DataAry }, function(json_data2) 
        {
            var res = $.parseJSON(json_data2);
            if(intDebugEnable === 1) alert("json_data2 :" + json_data2);         
            strMachineDepartment    = res.Data_Ary[1];
            strWorkOrderDepartment  = JS_SessionArry[0].WorkOrderDepartment;
            strLoggingDepartment       = JS_SessionArry[0].LoggingUserDepartment;        
            if(intDebugEnable === 1) alert("strMachineDepartment:" + strMachineDepartment);
            if(intDebugEnable === 1) alert("strWorkOrderDepartment:" + strWorkOrderDepartment);
            if(intDebugEnable === 1) alert("strLoggingDepartment:" + strLoggingDepartment);
            
            if(strMachineDepartment === strLoggingDepartment)
            {
                if(intDebugEnable === 1) alert("You have permission:");
                //---------- Open CheckIn Model Box --------------------------------------------------
                //---------- Check Current User Already Checkin --------------------------------------    
                //const DataAry = []; 
                DataAry[0]  = "funGetFilteredData";
                DataAry[1]  = "WorkOrderNo";
                DataAry[2]  = "tblwo_allcheckinusers";
                DataAry[3]  = "2";
                DataAry[4]  = "CheckInUser";
                DataAry[5]  = JS_SessionArry[0].CurrentUserEPF;
                DataAry[6]  = "Status";
                DataAry[7]  = "Active";              
                //alert("funOpenMod_WoCheckIn, DataAry :" + DataAry);
                //if(intDebugEnable === 1) alert("funOpenMod_WoCheckIn, DataAry :" + DataAry);
                $.post('class/comFunctions.php', { userpara: DataAry }, function(json_data2) 
                {
                    var res = $.parseJSON(json_data2);
                    //alert("funOpenMod_WoCheckIn, json_data2 :" + json_data2);
                    //if(intDebugEnable === 1) alert("funOpenMod_WoCheckIn, json_data2 :" + json_data2);      
                    if(res.Status_Ary[0] === "true")
                    {            
                        // success, error, warning, info, question
                        Swal.fire({title: 'User Alreay CkecIn.!',text: res.Data_Ary[0],icon: 'info', confirmButtonText: 'OK'});
                    }
                    else
                    {
                        //---------- Open Model_Wo Checkin --------------------------------------
                        var varmodbox = document.getElementById("id_ModWoCheckIn");
                        varmodbox.style.display = "block";

                        document.getElementById("id_ModWoCheckIn_WoNo").innerHTML           = JS_SessionArry[0].WorkOrderNo;   
                        document.getElementById("id_ModWoCheckIn_AllocatedMc").innerHTML    = JS_SessionArry[0].CurrentUserName;
                        //---------------- Load Now Date and time to Model Box --------------------------
                        // Get the current date and time
                        const now = new Date();
                        // Format the date and time as required by the datetime-local input
                        const year = now.getFullYear().toString().padStart(4, '0');
                        const month = (now.getMonth() + 1).toString().padStart(2, '0');
                        const day = now.getDate().toString().padStart(2, '0');
                        const hours = now.getHours().toString().padStart(2, '0');
                        const minutes = now.getMinutes().toString().padStart(2, '0');

                        // Set the value of the input
                        const datetimeInput = document.getElementById('id_ModWoCheckIn_dtmDateTime');
                        datetimeInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
                        datetimeInput.disabled = true;
                    }        
                });  
            }
            else
            {
                // success, error, warning, info, question
                Swal.fire({title: 'Error',text: "Your department is not match.",icon: 'error', confirmButtonText: 'OK'});
            }
        });
    }
    else
    {
        //---------- Open CheckIn Model Box --------------------------------------------------
        //---------- Check Current User Already Checkin --------------------------------------   
        if(intDebugEnable === 1) alert("Not a Breakdown or RedTag");
        if(intDebugEnable === 1) alert("JS_SessionArry[0].CurrentUserEPF :" + JS_SessionArry[0].CurrentUserEPF);
        
        const DataAry = []; 
        DataAry[0]  = "funGetFilteredData";
        DataAry[1]  = "WorkOrderNo";
        DataAry[2]  = "tblwo_allcheckinusers";
        DataAry[3]  = "2";
        DataAry[4]  = "CheckInUser";
        DataAry[5]  = JS_SessionArry[0].CurrentUserEPF;
        DataAry[6]  = "Status";
        DataAry[7]  = "Active";              
        //alert("funOpenMod_WoCheckIn, DataAry :" + DataAry);
        if(intDebugEnable === 1) alert("funOpenMod_WoCheckIn, DataAry :" + DataAry);
        $.post('class/comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            var res = $.parseJSON(json_data2);
            //alert("funOpenMod_WoCheckIn, json_data2 :" + json_data2);
            if(intDebugEnable === 1) alert("funOpenMod_WoCheckIn, json_data2 :" + json_data2);      
            if(res.Status_Ary[0] === "true")
            {            
                // success, error, warning, info, question
                Swal.fire({title: 'User Alreay CkecIn.!',text: res.Data_Ary[0],icon: 'info', confirmButtonText: 'OK'});
            }
            else
            {
                //---------- Open Model_Wo Checkin --------------------------------------
                var varmodbox = document.getElementById("id_ModWoCheckIn");
                varmodbox.style.display = "block";

                document.getElementById("id_ModWoCheckIn_WoNo").innerHTML           = JS_SessionArry[0].WorkOrderNo;   
                document.getElementById("id_ModWoCheckIn_AllocatedMc").innerHTML    = JS_SessionArry[0].CurrentUserName;
                //---------------- Load Now Date and time to Model Box --------------------------
                // Get the current date and time
                const now = new Date();
                // Format the date and time as required by the datetime-local input
                const year = now.getFullYear().toString().padStart(4, '0');
                const month = (now.getMonth() + 1).toString().padStart(2, '0');
                const day = now.getDate().toString().padStart(2, '0');
                const hours = now.getHours().toString().padStart(2, '0');
                const minutes = now.getMinutes().toString().padStart(2, '0');

                // Set the value of the input
                const datetimeInput = document.getElementById('id_ModWoCheckIn_dtmDateTime');
                datetimeInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
                datetimeInput.disabled = true;
            }        
        });  
    }
}
