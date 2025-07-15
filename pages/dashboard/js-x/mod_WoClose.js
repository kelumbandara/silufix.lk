/*
//------------- WO CLose : Change Fault Level4 Filter Value --------------------------------
function funModWoClose_FilterFaultLevel4()
{
    //alert("Filter: Change Fault Level4");
}

function funMoWoClose_Close()
{
    //alert("Wo Table Row Clicked.."); 
    var varmodbox = document.getElementById("id_MoWoClose");
    varmodbox.style.display = "none";

}
//--------------- Save and Close Function ----------------------
function funModWoClose_SaveClose()
{
    let intDebugEnable = 1;
    
    if(intDebugEnable === 1)    alert("funModWoClose_SaveClose");
    
  
    const DataAry = []; 
      
    DataAry[0] = JS_SessionArry[0].WorkOrderNo;
    DataAry[1] = document.getElementById("id_ModWoClose_FaultType").value;        
    DataAry[2] = document.getElementById("id_ModWoClose_CorrectionAction").value;
    DataAry[3] = document.getElementById("id_ModWoClose_Note").value;
    DataAry[4] = document.getElementById("id_ModWoClose_UsedMaterial").value;
    //DataAry[4] = selectedMaterials;
    DataAry[5] = JS_SessionArry[0].CurrentUserEPF; 

    //DataAry[7] = document.getElementById("id_ModWoClose_inpNote").value;    
    if(intDebugEnable === 1)    alert("DataAry : " + DataAry);
    let strWorkOrderCategory = JS_SessionArry[0].WorkOrderCategory;

    if(intDebugEnable === 1)    alert("strWorkOrderCategory : " + strWorkOrderCategory);
       
    if (DataAry[1] === "Select data" && (strWorkOrderCategory === "BreakDown" || strWorkOrderCategory === "RedTag")) 
    {
        // success, error, warning, info, question
        Swal.fire({ title: 'Alert !!',text: 'Please select the Fault Type.',icon: 'Warning', confirmButtonText: 'OK'});
    }
    else
    {
        $.post('class/updateData_ModWoClose_SaveClose.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert("Location :620 "+json_data2);   
            if(intDebugEnable === 1)    alert("json_data2 : " + json_data2);
            var res = $.parseJSON(json_data2);       
            if(res.Status_Ary[0] === "true")
            {
                //----------- Update Event Log, When Already Allocated list Deactive -----------------------------            
                //const DataAry = [];             
                DataAry[0] = "funUpdateEventLog";
                DataAry[1] = JS_SessionArry[0].WorkOrderNo;
                DataAry[2] = JS_SessionArry[0].CurrentUserName;
                DataAry[3] = JS_SessionArry[0].CurrentUserContact;
                DataAry[4] = ",WO Closed (" +  document.getElementById("id_ModWoClose_inpNote").value + ") - On";
                //Work Order Placed - On 2024-02-02T17:38 By Kelum Bandara(0772628859)
                //----------- Update Event Log --------------------------------------------------  
                $.post('class/comFunctions.php', { userpara: DataAry }, function(json_data2) 
                {            
                    //var res = $.parseJSON(json_data2);            
                    //-------------- CheckOut All CheckIn Users --------------------------------
                    DataAry[0] = "funCheckOutAllUsers";
                    DataAry[1] = JS_SessionArry[0].WorkOrderNo;
                    if(intDebugEnable === 1)    alert("DataAry : " + DataAry); 
                    $.post('class/updateData_WoCheckIn.php', { userpara: DataAry }, function(json_data2) 
                    {
                        if(intDebugEnable === 1)    alert("json_data2 : " + json_data2);          
                        //var res = $.parseJSON(json_data2);
                        //------------- Refresh Work Order Details ---------------------------------
                        //alert("Location : 651 "+ JS_SessionArry[0].WorkOrderNo);
                        let strReturn = funWoDetailsRefresh(JS_SessionArry[0].WorkOrderNo);
                        //funRefreshClicked(); 
                        //alert("Location : 660 "+strReturn); 
                        funRefresh_HomePage();  
                        //alert("Location : 670 "+strReturn); 
                        var varmodbox = document.getElementById("id_MoWoClose");
                        varmodbox.style.display = "none";  
                    });  
                });
            }
            else
            {
                // success, error, warning, info, question
                Swal.fire({title: 'Alert..!',text: res.Status_Ary[1],icon: 'info', confirmButtonText: 'OK'});
                var varmodbox = document.getElementById("id_MoWoClose");
                varmodbox.style.display = "none";  
            }
            //alert("Data Updated successfully.");
        });
    }
}
//------------- WO CLose : Change Fault Level2 Filter Value --------------------------------
function funModWoClose_FilterFaultLevel2()
{
    //alert("Filter: Change Fault Level2");
     const DataAry = []; 
    DataAry[0] = "Level3";        
    DataAry[1] = document.getElementById("id_ModWoClose_SelFaultType").value;    
    DataAry[2] = document.getElementById("id_ModWoClose_SelFaultLevel1").value;
    DataAry[3] = document.getElementById("id_ModWoClose_SelFaultLevel2").value;
    //alert(DataAry); 
    $.post('class/getData_ModWoClose.php', { userpara: DataAry}, function(json_data2) 
    {
        //alert(json_data2);  
        var res = $.parseJSON(json_data2);     
        //------------ Remove All Items in "Select FaultLevel 1" -----------------------------------
        var options5 = document.querySelectorAll('#id_ModWoClose_SelFaultLevel3 option');
        options5.forEach(o => o.remove());
        //------------ Fill New Items -------------------------------------
        var sel_FaultLevel = document.getElementById("id_ModWoClose_SelFaultLevel3");
        for(var i = 0; i < res.Data_Ary.length; i++)
        {
            var opt5 = res.Data_Ary[i];
            var el5 = document.createElement("option");
            el5.textContent = opt5;
            el5.value = opt5;
            sel_FaultLevel.appendChild(el5);
        }
               
    });
}
//------------- WO CLose : Change Fault Level3 Filter Value --------------------------------
function funModWoClose_FilterFaultLevel3()
{
    //alert("Filter: Change Fault Level3");   
    const DataAry = []; 
    DataAry[0] = "Level4";        
    DataAry[1] = document.getElementById("id_ModWoClose_SelFaultType").value;    
    DataAry[2] = document.getElementById("id_ModWoClose_SelFaultLevel1").value;
    DataAry[3] = document.getElementById("id_ModWoClose_SelFaultLevel2").value;
    DataAry[4] = document.getElementById("id_ModWoClose_SelFaultLevel3").value;
    //alert(DataAry); 
    $.post('class/getData_ModWoClose.php', { userpara: DataAry}, function(json_data2) 
    {
        //alert(json_data2);  
        var res = $.parseJSON(json_data2);     
        //------------ Remove All Items in "Select FaultLevel 1" -----------------------------------
        var options6 = document.querySelectorAll('#id_ModWoClose_SelFaultLevel4 option');
        options6.forEach(o => o.remove());
        //------------ Fill New Items -------------------------------------
        var sel_FaultLevel = document.getElementById("id_ModWoClose_SelFaultLevel4");
        for(var i = 0; i < res.Data_Ary.length; i++)
        {
            var opt6 = res.Data_Ary[i];
            var el6 = document.createElement("option");
            el6.textContent = opt6;
            el6.value = opt6;
            sel_FaultLevel.appendChild(el6);
        }                  
    });
}
*/

//--------------- Function Click Close Workorder ---------------------------
function funModWoDetails_WoClose()
{        
    let intDebugEnable = 0;    
    
    if(intDebugEnable === 1)    alert("funModWoDetails_WoClose");
    let strWorkOrderStatus = JS_SessionArry[0].WorkOrderStatus;

    if(intDebugEnable === 1)    alert(strWorkOrderStatus);
    
    if((strWorkOrderStatus === "New")||(strWorkOrderStatus === "Inprogress"))
    {
        Swal.fire({
            title: 'Close Work Order',
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
                if(intDebugEnable === 1)    alert("Closing Workorder...");
                //executeFunction();
                const DataAry = []; 
      
                DataAry[0] = JS_SessionArry[0].WorkOrderNo;
                DataAry[1] = JS_SessionArry[0].CurrentUserEPF;
                DataAry[2] = JS_SessionArry[0].WorkOrderCategory;
                //DataAry[2] = "NA"   document.getElementById("id_ModWoClose_CorrectionAction").value;
                //DataAry[3] = "NA"   document.getElementById("id_ModWoClose_Note").value;
                //DataAry[4] = "NA"   document.getElementById("id_ModWoClose_UsedMaterial").value;
                //DataAry[4] = selectedMaterials;
                //DataAry[5] = JS_SessionArry[0].CurrentUserEPF; 
                //DataAry[7] = document.getElementById("id_ModWoClose_inpNote").value;    
                if(intDebugEnable === 1)    alert("DataAry : " + DataAry);
             
                $.post('class/updateData_ModWoClose_SaveClose.php', { userpara: DataAry }, function(json_data2) 
                {
                    if(intDebugEnable === 1)    alert("json_data2 : " + json_data2); 
               
                    var res = $.parseJSON(json_data2);       
                    if(res.Status_Ary[0] === "true")
                    {
                        //----------- Update Event Log, When Already Allocated list Deactive -----------------------------            
                        //const DataAry = [];             
                        DataAry[0] = "funUpdateEventLog";
                        DataAry[1] = JS_SessionArry[0].WorkOrderNo;
                        DataAry[2] = JS_SessionArry[0].CurrentUserName;
                        DataAry[3] = JS_SessionArry[0].CurrentUserContact;
                        DataAry[4] = ",WO Closed (" +  document.getElementById("id_ModWoClose_inpNote").value + ") - On";
                        //Work Order Placed - On 2024-02-02T17:38 By Kelum Bandara(0772628859)
                        //----------- Update Event Log --------------------------------------------------  
                        $.post('class/comFunctions.php', { userpara: DataAry }, function(json_data2) 
                        {            
                            //var res = $.parseJSON(json_data2);            
                            //-------------- CheckOut All CheckIn Users --------------------------------
                            DataAry[0] = "funCheckOutAllUsers";
                            DataAry[1] = JS_SessionArry[0].WorkOrderNo;
                            if(intDebugEnable === 1)    alert("DataAry : " + DataAry); 
                            $.post('class/updateData_WoCheckIn.php', { userpara: DataAry }, function(json_data2) 
                            {
                                if(intDebugEnable === 1)    alert("json_data2 : " + json_data2);          
                                //var res = $.parseJSON(json_data2);
                                //------------- Refresh Work Order Details ---------------------------------
                                //alert("Location : 651 "+ JS_SessionArry[0].WorkOrderNo);
                                let strReturn = funWoDetailsRefresh(JS_SessionArry[0].WorkOrderNo);
                                //funRefreshClicked(); 
                                //alert("Location : 660 "+strReturn); 
                                funRefresh_HomePage();  
                                //alert("Location : 670 "+strReturn); 
                                var varmodbox = document.getElementById("id_MoWoClose");
                                varmodbox.style.display = "none";  
                            });  
                        });
                    }
                    else
                    {
                        // success, error, warning, info, question
                        Swal.fire({title: 'Alert..!',text: res.Status_Ary[1],icon: 'info', confirmButtonText: 'OK'});
                        var varmodbox = document.getElementById("id_MoWoClose");
                        varmodbox.style.display = "none";  
                    }
                    //alert("Data Updated successfully.");
                });
            }
            else
            {
                alert("user click no");
            }
        });        
    }
    else
    {
        // success, error, warning, info, question
        Swal.fire({title: 'Alert..!',text: 'Workorder Already Closed.',icon: 'info', confirmButtonText: 'OK'});
    }     
    //alert("Test-Finished");
}

/*
//-------------- Open Model WO Close -----------------------  
function funOpenMod_WoClose()
{
    let intDebugEnable = 1;
        
    if(intDebugEnable === 1)    alert("funOpenMod_WoClose");
    
    //alert("Location 400 : Work order Close..");    
    var strWorkOrderNumber  = document.getElementById("id_ModWoDetails_WoNo").innerHTML;
    var strMachineNo        = document.getElementById("id_ModWoDetails_Site").innerHTML;   
    //alert(strWorkOrderNumber);     
    //---------- Close Model_Wo Details --------------------------------------
    //var varmodbox = document.getElementById("id_MoWoDetails");
    //varmodbox.style.display = "none";
    //---------- Open Model_Wo Close --------------------------------------
    var varmodbox = document.getElementById("id_MoWoClose");
    varmodbox.style.display = "block";
    document.getElementById("id_ModWoClose_WoNo").innerHTML = strWorkOrderNumber;
    document.getElementById("id_ModWoClose_Machine").innerHTML = strMachineNo;
   
    const DataAry = []; 
    DataAry[0] = "FaultType";        
    DataAry[1] = "0";
    DataAry[2] = "0";        
    DataAry[3] = "0";
    if(intDebugEnable === 1)    alert("DataAry :" + DataAry);
    $.post('class/getData_ModWoClose.php', { userpara: DataAry}, function(json_data2) 
    {
        if(intDebugEnable === 1)    alert("json_data2 :" + json_data2);
        var res = $.parseJSON(json_data2);        
        //------------ Remove All Items in "Machine Category" -----------------------------------
        var options2 = document.querySelectorAll('#id_ModWoClose_FaultType option');
        options2.forEach(o => o.remove());
        //------------ Fill New Items -------------------------------------
        var sel_cusordno = document.getElementById("id_ModWoClose_FaultType");
        for(var i = 0; i < res.Data_Ary.length; i++)
        {
            var opt = res.Data_Ary[i];
            var el = document.createElement("option");
            el.textContent = opt;
            el.value = opt;
            sel_cusordno.appendChild(el);
        }   
    }); 
   
    funModWoClose_CorrectionAction();
}
//------------- WO CLose : Change Fault Type Filter Value --------------------------------
function funModWoClose_CorrectionAction()
{
    let intDebugEnable = 0;
    
    if(intDebugEnable === 1)    alert("funModWoClose_FilterFaultType");

    const DataAry = []; 
    DataAry[0] = "funGetFilteredData"; 
    DataAry[1] = "CorrectionAction";  
    DataAry[2] = "tblwo_closeerrors_redtag"; 
    DataAry[3] = "1"; 
    DataAry[4] = "FaultType";      
    DataAry[5] = document.getElementById("id_ModWoClose_FaultType").value; 
    //DataAry[2] = document.getElementById("id_ModWoClose_WoNo").innerHTML;    
    //DataAry[3] = "test";
    
    if(intDebugEnable === 1)    alert("DataAry : " + DataAry);
    $.post('class/comFunctions.php', { userpara: DataAry}, function(json_data2) 
    {
        if(intDebugEnable === 1)    alert("json_data2 : " + json_data2);  
        var res = $.parseJSON(json_data2);     
        if(res.Status_Ary[0] === "true")
        {
            //------------ Remove All Items in "Select FaultLevel 1" -----------------------------------
            var options3 = document.querySelectorAll('#id_ModWoClose_CorrectionAction option');
            options3.forEach(o => o.remove());
            //------------ Fill New Items -------------------------------------
            var sel_shoporderno = document.getElementById("id_ModWoClose_CorrectionAction");
            for(var i = 0; i < res.Data_Ary.length; i++)
            {
                var opt3 = res.Data_Ary[i];
                var el3 = document.createElement("option");
                el3.textContent = opt3;
                el3.value = opt3;
                sel_shoporderno.appendChild(el3);
            }  
        }
        else
        {
            //if(intDebugEnable === 1)    alert("Data is not Available :"); 
            //---------- Load Level 1 , Select box ----------------------------------      
            var options5 = document.querySelectorAll('#id_ModWoClose_CorrectionAction option');
            options5.forEach(o => o.remove());            
            var opt5 = ["Select data"];
            opt5.forEach(function(value) 
            {
                var el5 = document.createElement("option");
                el5.textContent = value;
                el5.value = value;
                document.getElementById("id_ModWoClose_CorrectionAction").appendChild(el5);
            });
        }
              
    });
}
//------------- WO CLose : Change Correction Action, Then load Used Materials --------------------------------
function funModWoClose_UsedMaterial()
{
    let intDebugEnable = 0;
    
    if(intDebugEnable === 1)    alert("funModWoClose_UsedMaterial");

    const DataAry = []; 
    DataAry[0] = "funGetFilteredData"; 
    DataAry[1] = "UsedMaterial";  
    DataAry[2] = "tblwo_closeerrors_redtag"; 
    DataAry[3] = "2"; 
    DataAry[4] = "FaultType";      
    DataAry[5] = document.getElementById("id_ModWoClose_FaultType").value; 
    DataAry[6] = "CorrectionAction";      
    DataAry[7] = document.getElementById("id_ModWoClose_CorrectionAction").value; 
    //DataAry[2] = document.getElementById("id_ModWoClose_WoNo").innerHTML;    
    //DataAry[3] = "test";
    
    if(intDebugEnable === 1)    alert("DataAry : " + DataAry);
    $.post('class/comFunctions.php', { userpara: DataAry}, function(json_data2) 
    {
        if(intDebugEnable === 1)    alert("json_data2 : " + json_data2);  
        var res = $.parseJSON(json_data2);     
        if(res.Status_Ary[0] === "true")
        {
            //------------ Remove All Items in "Select FaultLevel 1" -----------------------------------
            var options3 = document.querySelectorAll('#id_ModWoClose_UsedMaterial option');
            options3.forEach(o => o.remove());
            //------------ Fill New Items -------------------------------------
            var sel_shoporderno = document.getElementById("id_ModWoClose_UsedMaterial");
            for(var i = 0; i < res.Data_Ary.length; i++)
            {
                var opt3 = res.Data_Ary[i];
                var el3 = document.createElement("option");
                el3.textContent = opt3;
                el3.value = opt3;
                sel_shoporderno.appendChild(el3);
            }  
        }
        else
        {
            //if(intDebugEnable === 1)    alert("Data is not Available :"); 
            //---------- Load Level 1 , Select box ----------------------------------      
            var options5 = document.querySelectorAll('#id_ModWoClose_UsedMaterial option');
            options5.forEach(o => o.remove());            
            var opt5 = ["Select data"];
            opt5.forEach(function(value) 
            {
                var el5 = document.createElement("option");
                el5.textContent = value;
                el5.value = value;
                document.getElementById("id_ModWoClose_UsedMaterial").appendChild(el5);
            });
        }              
    });
}
*/