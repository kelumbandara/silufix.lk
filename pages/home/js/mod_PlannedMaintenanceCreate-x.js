//--------------------------------------------------------------------------
//--------------- MODEL BOX : CREATE BREAKDOWN -----------------------------
//--------------------------------------------------------------------------
function funModPlanMntCre_Close()
{
    //alert("Plan Maintenance x click.."); 
    var varmodbox = document.getElementById("id_ModPlanMntCre");
    varmodbox.style.display = "none";
}
function funModPlanMntCre_Cancel()
{
    //alert("Plan Maintenance Cose ."); 
    var varmodbox = document.getElementById("id_ModPlanMntCre");
    varmodbox.style.display = "none";
}
function funModelPlannedMaintenanceClicked()        // Initial load function....
{        
    //alert("Model Plan Maintenance Clicked..");
    //---------- Open Model_Plan Maintenance -------------------------------
    var varmodbox = document.getElementById("id_ModPlanMntCre");
    varmodbox.style.display = "block";
    const DataAry = []; 
    DataAry[0] = "MachineCategory";
    DataAry[1] = JS_SessionArry[0].CurrentUserDepartment;
    //alert(DataAry);
    $.post('class/getData_HomeModelCreateWo.php', { userpara: DataAry}, function(json_data2) 
    {    
        //alert(json_data2);  
        var res = $.parseJSON(json_data2);
        var AryMcCategory = new Array();   
        AryMcCategory = res.Data_Ary;         
        //------------ Remove All Items in "Machine Category" -----------------------------------
        var options2 = document.querySelectorAll('#id_ModPlanMntCre_SelMcCategory option');
        options2.forEach(o => o.remove());
        //------------ Fill New Items -------------------------------------
        var sel_cusordno = document.getElementById("id_ModPlanMntCre_SelMcCategory");
        for(var i = 0; i < AryMcCategory.length; i++)
        {
            var opt = AryMcCategory[i];
            var el = document.createElement("option");
            el.textContent = opt;
            el.value = opt;
            sel_cusordno.appendChild(el);
        }  
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
        const datetimeInput = document.getElementById('id_ModPlanMntCre_dtmDateTime');
        datetimeInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
        //datetimeInput.disabled = true;            
    });          
}

//----------------------------------------------------------------------------
function funModPlanMntCre_Update()
{        
    //alert("function mod Create Plan Maintenance update");
    
    var strTemp = "";
     //alert("Breakdown Update Clicked");      
     const DataAry = []; 
  
     DataAry[0] = "WMS-1760A";
     DataAry[1] = "Unit-1";
     DataAry[2] = "RelatedDep";
     DataAry[3] = "PlanMaintenance";
     DataAry[4] = "";
     DataAry[5] = "";
     DataAry[6] = JS_SessionArry[0].CurrentUserDepartment;
     DataAry[7] = document.getElementById("id_ModPlanMntCre_dtmDateTime").value;  
     DataAry[8] = JS_SessionArry[0].CurrentUserName;
     DataAry[9] = document.getElementById("id_ModPlanMntCre_SelMcCategory").value;
     DataAry[10] = document.getElementById("id_ModPlanMntCre_SelMachineNo").value;
     DataAry[12] = "";
     DataAry[13] = "";           
     DataAry[14] = document.getElementById("id_ModPlanMntCre_inpNote").value; 
     
    strTemp = "Work Order Placed - On " + document.getElementById("id_ModPlanMntCre_dtmDateTime").value + " By " + JS_SessionArry[0].CurrentUserName + "(" + JS_SessionArry[0].CurrentUserContact + ")";
    //alert(strTemp);
     DataAry[15] = strTemp;     //WoEventLog 
     DataAry[16] = 'A';              //Shift
     DataAry[17] = "New";      //Wo Status
     DataAry[18] = "-";
     DataAry[19] = "";
     DataAry[20] = 1;
     DataAry[21] = 1;
     DataAry[22] = 1;
    //-------- Check All fields are selected ...................................
    if((DataAry[6]==="Select data")||(DataAry[7]==="Select data"))
    {
        //alert("Please select data");
        Swal.fire({title: 'Error.!',text: 'Please select the data',icon: 'error',confirmButtonText: 'OK'});
    }
    else
    {
        //---------------- Find ValueAdd in Machine Number ------------------------------
        const DataAry2 = []; 
        DataAry2[0] = "funGetFilteredData";        // Function Name    
        DataAry2[1] = "ValueAdd";
        DataAry2[2] = "tblwo_machinemanagement";
        DataAry2[3] = "1";
        DataAry2[4] = "MachineNumber";
        DataAry2[5] = document.getElementById("id_ModPlanMntCre_SelMachineNo").value;    //MachineNo
        //alert(DataAry2);
        $.post('class/comFunctions.php', { userpara: DataAry2 }, function(json_data2) 
        {
            //alert(json_data2);           
            var res = $.parseJSON(json_data2);                           
            DataAry[11] = res.Data_Ary[0];             
            //alert(DataAry);  
            $.post('class/insertData_WoBrakdown.php', { userpara: DataAry }, function(json_data2) 
            {
                //alert(json_data2);           
                var res = $.parseJSON(json_data2);   
                //alert(res.Status_Ary[0]);
                if(res.Status_Ary[0] === "true")
                {
                     Swal.fire({title: 'Success.!',text: 'Data updated successfully',icon: 'success',confirmButtonText: 'OK'});  // success, error, warning, info, question   
                }
                else
                {
                    Swal.fire({title: 'Error.!',text: res.Status_Ary[1],icon: 'error',confirmButtonText: 'OK'});  // success, error, warning, info, question   
                }      
                var varmodbox = document.getElementById("id_ModPlanMntCre");
                varmodbox.style.display = "none";  
                //funRefreshClicked();
                funRefresh_HomePage();  
            }); 
        });
    }    
}

//----------------------------------------------------------------------------
function funModPlanMntCre_MachineCategoryFilter()
{        
    //alert("function MachineCategoryFil ");
    const DataAry = []; 
    DataAry[0] = "funGetFilteredData";        // Function Name    
    DataAry[1] = "MachineNumber";
    DataAry[2] = "tblwo_machinemanagement";
    DataAry[3] = "1";
    DataAry[4] = "MachineCategory";
    DataAry[5] = document.getElementById("id_ModPlanMntCre_SelMcCategory").value;       //"pneumatic";  
    //alert(DataAry);
    $.post('class/comFunctions.php', { userpara: DataAry }, function(json_data2) 
    {
        //alert(json_data2);           
        var res = $.parseJSON(json_data2);                           
        var AryMachineNo_new = new Array();

        AryMachineNo_new   = res.Data_Ary; 
        //alert(AryMachineNo_new);
        if(res.Status_Ary[0] === "true")
        {
            //------------ Remove All Items in "Machine No" -----------------------------------
            var options3 = document.querySelectorAll('#id_ModPlanMntCre_SelMachineNo option');
            options3.forEach(o => o.remove());
            //------------ Fill New Items -------------------------------------
            var sel_shoporderno = document.getElementById("id_ModPlanMntCre_SelMachineNo");
            for(var i = 0; i < AryMachineNo_new.length; i++)
            {
                var opt3 = AryMachineNo_new[i];
                var el3 = document.createElement("option");
                el3.textContent = opt3;
                el3.value = opt3;
                sel_shoporderno.appendChild(el3);
            }
        }
        else
        {
            //alert("Data Not Available");
            //------------ Remove All Items in "Machine No" -----------------------------------
            var options3 = document.querySelectorAll('#id_ModPlanMntCre_SelMachineNo option');
            options3.forEach(o => o.remove());
            //------------ Fill New Items -------------------------------------
            var opt3 = ["Select data"];
            opt3.forEach(function(value) 
            {
                var el3 = document.createElement("option");
                el3.textContent = value;
                el3.value = value;
                document.getElementById("id_ModPlanMntCre_SelMachineNo").appendChild(el3);
            });
        }
    });
}
//----------------------------------------------------------------------------
function funModPlanMntCre_MachineNoFilter()
{        
    //alert("function Machine No Filter ");
}