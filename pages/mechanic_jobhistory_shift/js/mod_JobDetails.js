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
        "scrollY": 160,
        "info": false, 
        //"rowCallback" : funCellCreated,
        "dom": "lrti"
    }).buttons().container().appendTo('#id_tblmod_wocheckin_wrapper .col-md-6:eq(0)');  
    dtbl4 = $('#id_tblmod_wocheckin').DataTable(); 
    //--- Load Tables --------------------------------------
    //funRefreshClicked();
    //funRefreshHomeDowntimeDashboard(); 
    //MQTTconnect();
    //alert("Wo Details init finish..");
}); 
function funMoWoDetails_Close()
{
    //alert("Wo Table Row Clicked.."); 
    var varmodbox = document.getElementById("id_MoWoDetails");
    varmodbox.style.display = "none";
}
//--------------- Function Click Create Breakdown ----------------------------
function funWoTableRowClicked(strWorkOrderNumber)
{   
    let intDebugEnable = 0;        
    if(intDebugEnable === 1) alert("strWoNumber : " + strWorkOrderNumber); 

    //---------- Open Model_Wo Detail --------------------------------------
    var varmodbox = document.getElementById("id_MoWoDetails");
    varmodbox.style.display = "block";
    
    //-------------- Read Wo Details --------------------------------
    const DataAry = []; 
    DataAry[0] = strWorkOrderNumber;        
    //DataAry[1] = strWorkOrderDepartment;        
    if(intDebugEnable === 1) alert(DataAry);   
    $.post('getData_ModJobDetails.php', { userpara: DataAry}, function(json_data2) 
    {
        if(intDebugEnable === 1) alert(json_data2);  
        
        var res = $.parseJSON(json_data2);
        document.getElementById("id_ModWoDetails_WoNo").innerHTML               = res.WorkOrderNo_Ary;
        document.getElementById("id_ModWoDetails_WoTotDowntime").innerHTML      = res.TotalDownTime_Ary;
        document.getElementById("id_ModWoDetails_WoAttnTime").innerHTML         = res.TotalAttendingTime_Ary;
        let tmpWoCategory   = res.WorkOrderCategory_Ary[0];
        //(tmpWoCategory);            
        document.getElementById("id_ModWoDetails_WoProblem").innerHTML  = "NA";
        document.getElementById("id_ModWoDetails_Machine").innerHTML = "NA";    
        
        if(intDebugEnable === 1) alert("tmpWoCategory :" + tmpWoCategory);  
        //tmpWoCategory = "BreakDown";
        if(tmpWoCategory === "BreakDown")
        {
            //alert("Breakdown-1");
            document.getElementById("id_ModWoDetails_WoProblem").innerHTML  = res.FaultType_Ary[0];
            document.getElementById("id_ModWoDetails_Machine").innerHTML    = res.MachineNo_Ary[0] + " [" + res.WoDepartment_Ary[0] + "]" + res.WoDescription_Ary[0];
        }
        else if(tmpWoCategory === "PlanMaintenance")
        {
            //alert("PlanMaintenance-1");
            document.getElementById("id_ModWoDetails_WoProblem").innerHTML  = res.WorkOrderCategory_Ary[0] +" [" + res.WoDepartment_Ary[0] + "]";
            document.getElementById("id_ModWoDetails_Machine").innerHTML    = res.MachineNo_Ary[0] + " [" + res.WoDescription_Ary[0] + "]";       
        }  
        else if(tmpWoCategory === "RedTag")
        {
            //alert("RedTag-1");
            document.getElementById("id_ModWoDetails_WoProblem").innerHTML  = res.WorkOrderCategory_Ary[0] +" [" + res.WoDepartment_Ary[0] + "]";
            document.getElementById("id_ModWoDetails_Machine").innerHTML    = res.MachineNo_Ary[0] + " [" + res.WoDescription_Ary[0] + "]";
        }  
        else if(tmpWoCategory === "BuildingMaintenance")
        {
            //alert("BuildingMaintenance-1");
            document.getElementById("id_ModWoDetails_WoProblem").innerHTML  = res.WorkOrderCategory_Ary[0] +" [" + res.WoDepartment_Ary[0] + "]";
            document.getElementById("id_ModWoDetails_Machine").innerHTML    = res.WoDescription_Ary[0];
        }  
        else if(tmpWoCategory === "OtherProject")
        {
            //alert("OtherProject-1");
            document.getElementById("id_ModWoDetails_WoProblem").innerHTML  = res.WorkOrderCategory_Ary[0] + " [" + res.WoDepartment_Ary[0] + "]";
            document.getElementById("id_ModWoDetails_Machine").innerHTML    = res.WorkOrderSubCategory_Ary[0] + " : " + res.WoDescription_Ary[0];
        }
        else        // Error Wo CAtegory not found
        {
            //alert("Wo Category not found");
            //writeToLogFile("Home Table: Wo Category not found");
        }
        //------------- Update Wo Event Log --------------------------------------
        //alert("Update Event Log..");
        var strEventList = "";
        var EventList_Ary = res.WoEventLog_Ary[0];
        if(intDebugEnable === 1)  alert("EventList_Ary : " + EventList_Ary);
        if(intDebugEnable === 1)  alert("EventList_Ary.length : " + EventList_Ary.length);
        for (i = EventList_Ary.length-1; i >= 0; i--) 
        {
            //alert(EventList_Ary[i]);
            strEventList += EventList_Ary[i];
            strEventList += "<br>";
        } 
        document.getElementById("id_ModWoDetails_EventLog").innerHTML = strEventList;
    }); 
    
    //intDebugEnable = 1;        
    
    //------------ Read Check In/ Engaged User List -------------------------
    DataAry[0] = "funGetCheckInUserData_All";      
    DataAry[1] = strWorkOrderNumber;     
    //alert(DataAry);             
    if(intDebugEnable === 1) alert("DataAry : " + DataAry);    
    $.post('comFunctions.php', { userpara: DataAry}, function(json_data2) 
    {
        //alert(json_data2);  
        if(intDebugEnable === 1) alert("json_data2 : " + json_data2);   
        var res = $.parseJSON(json_data2);
        if(res.Status_Ary[0] === "true")
        {   
            //var EngagedMc_Ary = res.Data_Ary;
            /*
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
            */
            dtbl4.clear().draw();
            var EngagedMc_Ary = res.Data_Ary;                
            for (i = 0; i < EngagedMc_Ary.length; i++) 
            {
                //alert(res.Data_Ary[i].CheckInUserDateTime);
                //strEngagedMcList += res.Data_Ary[i].CheckInUser + "," +res.Data_Ary[i].EmpName + " [" + res.Data_Ary[i].Contact +"] : " + res.Data_Ary[i].CheckInDuration;
                dtbl4.row.add([res.Data_Ary[i].CheckInUser,res.Data_Ary[i].EmpName, res.Data_Ary[i].CheckInUserDateTime,res.Data_Ary[i].CheckOutUserDateTime, res.Data_Ary[i].CheckInDuration]).draw(false);

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
  
}
/*
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
    
    if(intDebugEnable === 1) alert("Location : 780 ");
    return "true";
}
*/

/*
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
         
         
       
    });        
});
*/

/*
// --------------- Function Refresh Wo Details page by WorkOrder Number ----------------------------
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
 * 
 */