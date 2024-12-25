$(function () 
{         
    //alert("Wo Details Start..");
    //--------------- Model : Only Allocated Users Table ---------------------
    $("#id_tblmod_wocheckin").DataTable({
        "paging": false,
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,            
        "scrollX": true,
        "scrollY": 80,
        "info": false, 
        //"rowCallback" : funCellCreated,
        "dom": "lrti"
    }).buttons().container().appendTo('#id_tblmod_wocheckin_wrapper .col-md-6:eq(0)');  
    dtbl4 = $('#id_tblmod_wocheckin').DataTable(); 
    //--- Load Tables --------------------------------------
    //funRefreshClicked();
    //funRefreshHomeDowntimeDashboard(); 
    //MQTTconnect();
}); 
function funMoWoDetails_Close()
{
    //alert("Wo Table Row Clicked.."); 
    var varmodbox = document.getElementById("id_MoWoDetails");
    varmodbox.style.display = "none";
}
//--------------- Function Click Create Breakdown ----------------------------
function funWoTableRowClicked()
{        
    //alert("Table row Clicked..1"); 
    //writeToLogFile("Open Workorder details :"); 
    //alert("Log test ..");
    
    if(!roll_areas_ary.includes('1001811'))
    {
        //alert("Remove Andon Dashboard");
         Swal.fire({
                        title: 'Alert !!',
                        text: 'You do not have permission',
                        icon: 'Warning', // success, error, warning, info, question
                        confirmButtonText: 'OK'
                    });
    }
    else
    {
        //alert("Read Table : Test-1"); 
        //---------- Read ReceiptNumber ----------------------------------------
        //var table3 = $('#example1').DataTable();        
        //var mydata = table3.rows('.selected').data(); 
        var mydata = dtbl1.rows('.selected').data(); 
        //alert(mydata[0][5]);
        //alert(mydata[0][24]);
        var strWorkOrderNumber      = mydata[0][1];
        var strWorkOrderDepartment  = mydata[0][3];
        var strWorkOrderCategory    = mydata[0][5];
        var strWorkOrderStatus      = mydata[0][7];
        //var strWorkOrderVerify      = mydata[0][8];
        JS_SessionArry[0].WorkOrderNo           = strWorkOrderNumber;
        JS_SessionArry[0].WorkOrderDepartment   = strWorkOrderDepartment;
        JS_SessionArry[0].WorkOrderCategory     = strWorkOrderCategory;
        JS_SessionArry[0].WorkOrderStatus       = strWorkOrderStatus;
        JS_SessionArry[0].WorkOrderVerify       = "-";   //strWorkOrderVerify;

        //--- Load Login User Details (Delete Last History) -----------------------
        JS_SessionArry[0].CurrentUserName       = SESSION_CurrentUserName;
        JS_SessionArry[0].CurrentUserEPF        = SESSION_CurrentUserEPF;
        JS_SessionArry[0].CurrentUserContact    = SESSION_CurrentUserContact;
        JS_SessionArry[0].CurrentUserDepartment = SESSION_CurrentUserDepartment;
        
        //alert(JS_SessionArry[0].WorkOrderCategory);
        //writeToLogFile("Open Workorder details :" +JS_SessionArry[0].WorkOrderNo);      
        //---------- Open Model_Wo Detail --------------------------------------
        var varmodbox = document.getElementById("id_MoWoDetails");
        varmodbox.style.display = "block";
        //-------------- Read Wo Details --------------------------------
        const DataAry = []; 
        DataAry[0] = strWorkOrderNumber;        
        DataAry[1] = strWorkOrderDepartment;        
        //alert(DataAry);   
        $.post('class/getData_ModWoDetails.php', { userpara: DataAry}, function(json_data2) 
        {
            //alert(json_data2);  
            var res = $.parseJSON(json_data2);
            document.getElementById("id_ModWoDetails_WoNo").innerHTML       = res.WorkOrderNo_Ary;
            document.getElementById("id_ModWoDetails_WoDate").innerHTML     = res.CreatedDateTime_Ary;   
            let tmpWoCategory   = res.WorkOrderCategory_Ary[0];
            //(tmpWoCategory);            
            document.getElementById("id_ModWoDetails_WoProblem").innerHTML  = "NA";
            document.getElementById("id_ModWoDetails_Machine").innerHTML = "NA";                
            //tmpWoCategory = "BreakDown";
            if(tmpWoCategory === "BreakDown")
            {
                //alert("Breakdown-1");
                document.getElementById("id_ModWoDetails_WoProblem").innerHTML  = res.FaultType_Ary[0];
                document.getElementById("id_ModWoDetails_Machine").innerHTML    = res.MachineNo_Ary[0] + " [" + strWorkOrderDepartment + "]" + res.WoDescription_Ary[0];
            }
            else if(tmpWoCategory === "PlanMaintenance")
            {
                //alert("PlanMaintenance-1");
                document.getElementById("id_ModWoDetails_WoProblem").innerHTML  = res.WorkOrderCategory_Ary[0] +" [" + strWorkOrderDepartment + "]";
                document.getElementById("id_ModWoDetails_Machine").innerHTML    = res.MachineNo_Ary[0] + " [" + res.WoDescription_Ary[0] + "]";       
            }  
            else if(tmpWoCategory === "RedTag")
            {
                //alert("RedTag-1");
                document.getElementById("id_ModWoDetails_WoProblem").innerHTML  = res.WorkOrderCategory_Ary[0] +" [" + strWorkOrderDepartment + "]";
                document.getElementById("id_ModWoDetails_Machine").innerHTML    = res.MachineNo_Ary[0] + " [" + res.WoDescription_Ary[0] + "]";
            }  
            else if(tmpWoCategory === "BuildingMaintenance")
            {
                //alert("BuildingMaintenance-1");
                document.getElementById("id_ModWoDetails_WoProblem").innerHTML  = res.WorkOrderCategory_Ary[0] +" [" + strWorkOrderDepartment + "]";
                document.getElementById("id_ModWoDetails_Machine").innerHTML    = res.WoDescription_Ary[0];
            }  
            else if(tmpWoCategory === "OtherProject")
            {
                //alert("OtherProject-1");
                document.getElementById("id_ModWoDetails_WoProblem").innerHTML  = res.WorkOrderCategory_Ary[0] + " [" + strWorkOrderDepartment + "]";
                document.getElementById("id_ModWoDetails_Machine").innerHTML    = res.WorkOrderSubCategory_Ary[0] + " : " + res.WoDescription_Ary[0];
            }
            else        // Error Wo CAtegory not found
            {
                alert("Wo Category not found");
                //writeToLogFile("Home Table: Wo Category not found");
            }
            //------------- Update Wo Event Log --------------------------------------
            var strEventList = "";
            var EventList_Ary = res.WoEventLog_Ary[0];
            //alert(EventList_Ary.length);
            for (i = EventList_Ary.length-1; i >= 0; i--) 
            {
                //alert(EventList_Ary[i]);
                strEventList += EventList_Ary[i];
                strEventList += "<br>";
            } 
            document.getElementById("id_ModWoDetails_EventLog").innerHTML = strEventList;
        }); 
        //------------ Read Check In/ Engaged User List -------------------------
        DataAry[0] = "funGetCheckInUserData";      
        DataAry[1] = strWorkOrderNumber;     
        //alert(DataAry);             
        //var vblSendPara =  "1234";         
        $.post('class/comFunctions.php', { userpara: DataAry}, function(json_data2) 
        {
            //alert(json_data2);  
            var res = $.parseJSON(json_data2);
            if(res.Status_Ary[0] === "true")
            {   
                //var EngagedMc_Ary = res.Data_Ary;
                var searchEPF = JS_SessionArry[0].CurrentUserEPF;  //"10393"; // EPF number to search
                //alert(searchEPF);
                var strUserAvalable = "false";
                for (var i = 0; i < res.Data_Ary.length; i++) 
                {
                    if (res.Data_Ary[i].CheckInUser.includes(searchEPF)) 
                    {
                        strUserAvalable = "true";                       
                    }
                }
                //alert(strUserAvalable);
                if(strUserAvalable === "true")
                {
                    document.getElementById("id_ModWoDetails_btnCheckIn").innerHTML = "Check Out";
                }
                else
                {
                    document.getElementById("id_ModWoDetails_btnCheckIn").innerHTML = "Check In";
                }
                //var strEngagedMcList = "";
                
                dtbl4.clear().draw();
                var EngagedMc_Ary = res.Data_Ary;                
                for (i = 0; i < EngagedMc_Ary.length; i++) 
                {
                    //alert(res.Data_Ary[i].WorkOrderNo);
                    //strEngagedMcList += res.Data_Ary[i].CheckInUser + "," +res.Data_Ary[i].EmpName + " [" + res.Data_Ary[i].Contact +"] : " + res.Data_Ary[i].CheckInDuration;
                    //strEngagedMcList += "<br>";
                    
                    dtbl4.row.add([res.Data_Ary[i].CheckInUser,res.Data_Ary[i].EmpName, res.Data_Ary[i].Contact, res.Data_Ary[i].CheckInDuration]).draw(false);
              
                } 
                //document.getElementById("id_ModWoDetails_EngagedMc").innerHTML   = strEngagedMcList;
                        
            }
            else
            {
                //document.getElementById("id_ModWoDetails_EngagedMc").innerHTML      = "";
                document.getElementById("id_ModWoDetails_btnCheckIn").innerHTML     = "Check In";
                //("No data found");
                dtbl4.clear().draw();
            }
        });    
        //------------ Read Allocated Mechanics list -------------------------
        DataAry[0] = "funGetAllocatedUserData";      
        DataAry[1] = strWorkOrderNumber;     
        //alert(DataAry);             
        //var vblSendPara =  "1234";         
        $.post('class/comFunctions.php', { userpara: DataAry}, function(json_data2) 
        {
            //alert(json_data2);  
            var res = $.parseJSON(json_data2);
            if(res.Status_Ary[0] === "true")
            {            
                var AllocatedMcList = "";
                var AllocatedMc_Ary = res.Data_Ary;
                for (i = 0; i < AllocatedMc_Ary.length; i++) 
                {
                    //alert(res.Data_Ary[i].WorkOrderNo);
                    AllocatedMcList += res.Data_Ary[i].AllocatedUser + "," +res.Data_Ary[i].EmpName + " [" + res.Data_Ary[i].Contact +"]";
                    AllocatedMcList += "<br>";
                } 
                document.getElementById("id_ModWoDetails_AllocatedMc").innerHTML   = AllocatedMcList;
            }
            else
            {
                document.getElementById("id_ModWoDetails_AllocatedMc").innerHTML   = "";
                //alert("No data found");
            }
        });
        //------------ Read Chat History Data List -------------------------
        DataAry[0] = "funGetChatHistoryData";      
        DataAry[1] = strWorkOrderNumber;     
        //alert(DataAry);             
        //var vblSendPara =  "1234";         
        $.post('class/comFunctions.php', { userpara: DataAry}, function(json_data2) 
        {
            //alert(json_data2); 
            var res = $.parseJSON(json_data2);
            if(res.Status_Ary[0] === "true")
            {            
                var ChatMsgList = "";
                var ChatMsg_Ary = res.Data_Ary;
                for (i = 0; i < ChatMsg_Ary.length; i++) 
                {
                    //alert(res.Data_Ary[i].WorkOrderNo);
                    ChatMsgList += res.Data_Ary[i].SendDateTime + " " + res.Data_Ary[i].ChatMessage + ", By " +res.Data_Ary[i].EmpName;
                    ChatMsgList += "<br>";
                } 
                document.getElementById("id_ModWoDetails_ChatHistory").innerHTML   = ChatMsgList;
            }
            else
            {
                document.getElementById("id_ModWoDetails_ChatHistory").innerHTML   = "";
                //alert("No data found");
            }       
        });
    }
}

//--------------- Function Refresh Wo Details page by WorkOrder Number ----------------------------
function funWoDetailsRefresh(tmpWorkOrderNo )
{
    let intDebugEnable = 0;
        
    if(intDebugEnable === 1)    alert("WO Refresh");
    //--- Load Login User Details (Delete Last History) -----------------------
    JS_SessionArry[0].CurrentUserName       = SESSION_CurrentUserName;
    JS_SessionArry[0].CurrentUserEPF        = SESSION_CurrentUserEPF;
    JS_SessionArry[0].CurrentUserContact    = SESSION_CurrentUserContact;
    JS_SessionArry[0].CurrentUserDepartment = SESSION_CurrentUserDepartment;
    const DataAry = []; 
    if(intDebugEnable === 1) alert("Location : 700 "+ DataAry); 
    //-------------- Read Event Log  --------------------------------
    DataAry[0] = tmpWorkOrderNo; 
    //var vblSendPara =  "1234";         
    $.post('class/getData_ModWoDetails.php', { userpara: DataAry}, function(json_data2) 
    {
        //alert(json_data2);
        if(intDebugEnable === 1) alert("Location : 710 "+ json_data2); 
        var res = $.parseJSON(json_data2);
        //------------- Update Wo Event Log --------------------------------------
        var strEventList = "";
        var EventList_Ary = res.WoEventLog_Ary[0];
        //alert(EventList_Ary.length);
        for (i = EventList_Ary.length-1; i >= 0; i--) 
        {
            //alert(EventList_Ary[i]);
            strEventList += EventList_Ary[i];
            strEventList += "<br>";
        } 
        document.getElementById("id_ModWoDetails_EventLog").innerHTML = strEventList;
    });       
    //------------ Read Check In/ Engaged User List -------------------------
    DataAry[0] = "funGetCheckInUserData";      
    DataAry[1] = tmpWorkOrderNo;     
    //alert(DataAry); 
    if(intDebugEnable === 1) alert("Location : 720 "+ DataAry);             
    //var vblSendPara =  "1234";         
    $.post('class/comFunctions.php', { userpara: DataAry}, function(json_data2) 
    {
        //alert(json_data2);  
        if(intDebugEnable === 1) alert("Location : 730 "+ json_data2);
        var res = $.parseJSON(json_data2);
        if(res.Status_Ary[0] === "true")
        {   
            //var EngagedMc_Ary = res.Data_Ary;
            var searchEPF = JS_SessionArry[0].CurrentUserEPF;  //"10393"; // EPF number to search
            //alert(searchEPF);
            var strUserAvalable = "false";
            for (var i = 0; i < res.Data_Ary.length; i++) 
            {
                if (res.Data_Ary[i].CheckInUser.includes(searchEPF)) 
                {
                    strUserAvalable = "true";                       
                }
            }
            //alert(strUserAvalable);
            if(strUserAvalable === "true")
            {
                document.getElementById("id_ModWoDetails_btnCheckIn").innerHTML = "Check Out";
            }
            else
            {
                document.getElementById("id_ModWoDetails_btnCheckIn").innerHTML = "Check In";
            }
            //var strEngagedMcList = "";
            //if(intDebugEnable === 1)    alert("Clear ChecKIn table.");
            dtbl4.clear().draw();
            var EngagedMc_Ary = res.Data_Ary;
            for (i = 0; i < EngagedMc_Ary.length; i++) 
            {
                //alert(res.Data_Ary[i].WorkOrderNo);
                //strEngagedMcList += res.Data_Ary[i].CheckInUser + "," +res.Data_Ary[i].EmpName + " [" + res.Data_Ary[i].Contact +"]";
                //strEngagedMcList += "<br>";
                dtbl4.row.add([res.Data_Ary[i].CheckInUser,res.Data_Ary[i].EmpName, res.Data_Ary[i].Contact, res.Data_Ary[i].CheckInDuration]).draw(false);
          
            } 
            //document.getElementById("id_ModWoDetails_EngagedMc").innerHTML   = strEngagedMcList;
        }
        else
        {
            dtbl4.clear().draw();
            //document.getElementById("id_ModWoDetails_EngagedMc").innerHTML      = "";
            document.getElementById("id_ModWoDetails_btnCheckIn").innerHTML     = "Check In";
            //("No data found");
        }
    });    
    //------------ Read Allocated Mechanics list -------------------------
    DataAry[0] = "funGetAllocatedUserData";      
    DataAry[1] = tmpWorkOrderNo;     
    //alert(DataAry);  
    if(intDebugEnable === 1) alert("Location : 740 "+ DataAry);           
    //var vblSendPara =  "1234";         
    $.post('class/comFunctions.php', { userpara: DataAry}, function(json_data2) 
    {
        //alert(json_data2);  
        if(intDebugEnable === 1) alert("Location : 750 "+ json_data2);
        var res = $.parseJSON(json_data2);
        if(res.Status_Ary[0] === "true")
        {            
            if(intDebugEnable === 1) alert("Location : 751 "+ "True");
            var AllocatedMcList = "";
            var AllocatedMc_Ary = res.Data_Ary;
            for (i = 0; i < AllocatedMc_Ary.length; i++) 
            {
                //alert(res.Data_Ary[i].WorkOrderNo);
                AllocatedMcList += res.Data_Ary[i].AllocatedUser + "," +res.Data_Ary[i].EmpName + " [" + res.Data_Ary[i].Contact +"]";
                AllocatedMcList += "<br>";
            } 
            document.getElementById("id_ModWoDetails_AllocatedMc").innerHTML   = AllocatedMcList;
        }
        else
        {
            document.getElementById("id_ModWoDetails_AllocatedMc").innerHTML   = "";
            //alert("No data found");
        }
    });
    //------------ Read Chat History Data List -------------------------
    DataAry[0] = "funGetChatHistoryData";      
    DataAry[1] = tmpWorkOrderNo;     
    //alert(DataAry);   
    if(intDebugEnable === 1) alert("Location : 760 "+ DataAry);          
    //var vblSendPara =  "1234";         
    $.post('class/comFunctions.php', { userpara: DataAry}, function(json_data2) 
    {
        //alert(json_data2); 
        if(intDebugEnable === 1) alert("Location : 770 "+ json_data2);
        var res = $.parseJSON(json_data2);
        if(res.Status_Ary[0] === "true")
        {            
            if(intDebugEnable === 1) alert("Location : 771 ");
            var ChatMsgList = "";
            var ChatMsg_Ary = res.Data_Ary;
            for (i = 0; i < ChatMsg_Ary.length; i++) 
            {
                //alert(res.Data_Ary[i].WorkOrderNo);
                ChatMsgList += res.Data_Ary[i].SendDateTime + " " + res.Data_Ary[i].ChatMessage + ", By " +res.Data_Ary[i].EmpName;
                ChatMsgList += "<br>";
            } 
            document.getElementById("id_ModWoDetails_ChatHistory").innerHTML   = ChatMsgList;
        }
        else
        {
            document.getElementById("id_ModWoDetails_ChatHistory").innerHTML   = "";
            //alert("No data found");
        }       
    });
    if(intDebugEnable === 1) alert("Location : 780 ");
    return "true";
}
//---------------- Model : Already CheckIn Users Row Clicked Function---------------------------
$('#id_tblmod_wocheckin tbody').on('click', 'tr', function () 
{        
    let intDebugEnable = 0;        
    if(intDebugEnable === 1)    alert("Already CheckIn Users..");
    
    const table2 = new DataTable('#id_tblmod_wocheckin');
    table2.on('click', 'tbody tr', (e) => 
    {
        //alert("Already CheckIn MC clicked");         
        let classList = e.currentTarget.classList;

        table2.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
        classList.add('selected');
        //var mydata = dtbl4.rows('.selected').data(); 
        //var strEmpEPF  = mydata[0][0];
        //var strEmpName = mydata[0][1];
        //alert(strEmpEPF);
        //alert(strEmpName);
        
        //--------------- Open User Checking ---------------------------------
        JS_SessionArry[0].NextModelID       = "id_MoWoDetails"; 
        JS_SessionArry[0].NextFunctionName  = "funWoDetails_CheckOut";
        
        //alert("Next Function : " + JS_SessionArry[0].NextFunctionName);
        //---------- Open Model for Check User -------------------------------------
        var varmodbox = document.getElementById("id_ModCheckUser");
        varmodbox.style.display = "block";  
        //var strEmpContact = mydata[0][2];            
        //var strWorkOrderNo =  document.getElementById("id_ModWoAllocate_WoNo").innerHTML;  
        //-------------- Remove users from employeeData Array ------------------------------
        //employeeCheckInData
        //employeeData.push(strEmpEPF);
        /*
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
         * 
         */ 
       
    });        
});

//--------------- Function Refresh Wo Details page by WorkOrder Number ----------------------------
function funWoDetails_CheckOut()
{
    let intDebugEnable = 0;        
    if(intDebugEnable === 1)    alert("WO Details Checkout function");
    
    var mydata = dtbl4.rows('.selected').data(); 
    var strEmpEPF  = mydata[0][0];
    var strEmpName = mydata[0][1];
    //alert(strEmpEPF);
    //alert(strEmpName);
    if(intDebugEnable === 1)    alert("table EPF :" + strEmpEPF);
    if(intDebugEnable === 1)    alert("CheckUser EPF :" + JS_SessionArry[0].CurrentUserEPF);
    
    if(strEmpEPF === JS_SessionArry[0].CurrentUserEPF)
    {
        if(intDebugEnable === 1)    alert("Current User matched. CheckOut users..");                
        //-------------------- Update Checkout -------------------------------------------
        const DataAry = []; 
        DataAry[0]  = "funCheckOutUsers";
        DataAry[1] = JS_SessionArry[0].WorkOrderNo;        // Table Name
        DataAry[2] = JS_SessionArry[0].CurrentUserEPF;                 
        if(intDebugEnable === 1)    alert("DataAry" + DataAry);
        $.post('class/updateData_WoCheckIn.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1)    alert("json_data2" + json_data2);
            //var res = $.parseJSON(json_data2); 
            //------------- Refresh Work Order Details ---------------------------------
            funWoDetailsRefresh(JS_SessionArry[0].WorkOrderNo);
            //funRefreshClicked(); 
            funRefresh_HomePage();  
        });

    }
    else
    {
        if(intDebugEnable === 1)    alert("Current User not matched");
        Swal.fire({title: 'Error.!',text: 'User not match.. ',icon: 'error',confirmButtonText: 'OK'});
            
    }
    
}