//--------------------------------------------------------------------------
//--------------- MODEL BOX : CREATE RED TAG ------------------------
//--------------------------------------------------------------------------
function funModRedTagCre_Close()
{
    //alert("Cose Model Box.."); 
    var varmodbox = document.getElementById("id_ModRedTagCre");
    varmodbox.style.display = "none";
}
function funModRedTagCre_Cancel()
{
    //alert("Cose Model Box.."); 
    var varmodbox = document.getElementById("id_ModRedTagCre");
    varmodbox.style.display = "none";
}
function funModRedTagCreateClicked()
{        
    let intDebugEnable = 0;  
    if(intDebugEnable === 1)    alert("funModRedTagCreateClicked");
        
    document.getElementById('id_ModRedTagCre_Update').disabled = false; 
    //---------- Open Model_Plan Maintenance -------------------------------
    var varmodbox = document.getElementById("id_ModRedTagCre");
    varmodbox.style.display = "block";
    const DataAry = []; 
    DataAry[0] = "MachineCategory";
    DataAry[1] = JS_SessionArry[0].CurrentUserDepartment; 
    if(intDebugEnable === 1)   alert("DataAry : "  + DataAry);
    $.post('class/getData_HomeModelCreateWo.php', { userpara: DataAry}, function(json_data2) 
    {
        //alert(json_data2);  
        var res = $.parseJSON(json_data2);
        var AryMcCategory = new Array();
        AryMcCategory = res.Data_Ary;           
       
        //------------ Remove All Items in "Machine Category" -----------------------------------
        var options2 = document.querySelectorAll('#id_ModRedTagCre_SelMcCategory option');
        options2.forEach(o => o.remove());
        //------------ Fill New Items -------------------------------------
        var sel_cusordno = document.getElementById("id_ModRedTagCre_SelMcCategory");
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
        const datetimeInput = document.getElementById('id_ModRedTagCre_dtmDateTime');
        datetimeInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
        if(JS_SessionArry[0].CurrentUserDepartment === "Engineering")
        {
            datetimeInput.disabled = false;
        }
        else
        {
            datetimeInput.disabled = true;
        }        
    });
   
}

//----------------------------------------------------------------------------
function funDateChanged()
{        
    let intDebugEnable = 0;        
    if(intDebugEnable === 1)    alert("funDateChanged");

     // Get the datetime value from the input field
    const datetimeInput = document.getElementById('id_ModRedTagCre_dtmDateTime');
    const datetimeValue = datetimeInput.value;
    
    // If input is empty or invalid, return early
    if (!datetimeValue) return;
    
    // Convert the datetime value to a Date object
    const [datePart, timePart] = datetimeValue.split('T');
    const [year, month, day] = datePart.split('-').map(Number);
    const [hours, minutes] = timePart.split(':').map(Number);
    const inputDate = new Date(year, month - 1, day, hours, minutes);
    
    // Get the current date and calculate the maximum allowed past date
    const now = new Date();
    const maxAllowedDate = new Date(now);
    maxAllowedDate.setDate(now.getDate() - 3);
    
    // Check if the input date is more than 3 days in the past
    if (inputDate < maxAllowedDate) 
    {
        // Adjust the input date to the maximum allowed date
        const [maxYear, maxMonth, maxDay] = [
            maxAllowedDate.getFullYear(),
            maxAllowedDate.getMonth() + 1,
            maxAllowedDate.getDate()
        ];
        const maxHours = maxAllowedDate.getHours().toString().padStart(2, '0');
        const maxMinutes = maxAllowedDate.getMinutes().toString().padStart(2, '0');
        
        // Set the input field to the maximum allowed date
        datetimeInput.value = `${maxYear}-${maxMonth.toString().padStart(2, '0')}-${maxDay.toString().padStart(2, '0')}T${maxHours}:${maxMinutes}`;
        Swal.fire({title: 'Error.!',text: 'Please select the date maximum 3 days back',icon: 'error',confirmButtonText: 'OK'});
    }
}
//----------------------------------------------------------------------------
function funModRedTagCre_Filter()
{        
    //alert("function SelectPlannedMaintenanceFilter ");
}
//----------------------------------------------------------------------------
function funModRedTagCre_Update()
{        
    //alert("function mod Create Plan Maintenance update");
    
    var strTemp = "";
    //alert("Breakdown Update Clicked");      
    const DataAry = []; 
    DataAry[0] = "WMS-1760A";
    DataAry[1] = "Unit-1";
    DataAry[2] = "RelatedDep";
    DataAry[3] = "RedTag";
    DataAry[4] = document.getElementById("id_ModRedTagCre_SelRedTagCategory").value; // WorkOrderSubCategory
    DataAry[5] = "";                        // WorkOrderSubCategory2
    DataAry[6] = JS_SessionArry[0].CurrentUserDepartment;                   // WoDepartment
    DataAry[7] = document.getElementById("id_ModRedTagCre_dtmDateTime").value;     //CreatedDateTime      
    DataAry[8] = JS_SessionArry[0].CurrentUserName;
      
    DataAry[9] = document.getElementById("id_ModRedTagCre_SelMcCategory").value;
    DataAry[10] = document.getElementById("id_ModRedTagCre_SelMachineNo").value;
    DataAry[12] = document.getElementById("id_ModRedTagCre_SelFaultType").value;
    DataAry[13] = document.getElementById("id_ModRedTagCre_SelFaultLevel").value;
    DataAry[14] = document.getElementById("id_ModRedTagCre_inpNote").value; 
    strTemp = "Red Tag Placed - On " + document.getElementById("id_ModRedTagCre_dtmDateTime").value + " By " + JS_SessionArry[0].CurrentUserName + "(" + JS_SessionArry[0].CurrentUserContact + ")";
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
    if((DataAry[9]==="Select data")||(DataAry[10]==="Select data")||(DataAry[12]==="Select data"))
    {
        //alert("Please select data");
        Swal.fire({title: 'Error.!',text: 'Please select the data',icon: 'error',confirmButtonText: 'OK'});
    }
    else
    {
	document.getElementById('id_ModRedTagCre_Update').disabled = true; 
        //---------------- Find ValueAdd in Machine Number ------------------------------
        const DataAry2 = []; 
        DataAry2[0] = "funGetFilteredData";        // Function Name    
        DataAry2[1] = "ValueAdd";
        DataAry2[2] = "tblwo_machinemanagement";
        DataAry2[3] = "1";
        DataAry2[4] = "MachineNumber";
        DataAry2[5] = document.getElementById("id_ModRedTagCre_SelMachineNo").value;    //MachineNo
        //alert(DataAry2);
        $.post('class/comFunctions.php', { userpara: DataAry2 }, function(json_data2) 
        {
            //alert(json_data2);           
            var res = $.parseJSON(json_data2);                           
            DataAry[11] = res.Data_Ary[0];             
            //alert(DataAry);
            ////alert("Select ok");
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
                //alert("Data Updated successfully.");               
                var varmodbox = document.getElementById("id_ModRedTagCre");
                varmodbox.style.display = "none";  
                //funRefreshClicked();
                funRefresh_HomePage();  
            }); 
        });
    }    
}
//-------------------- Fault Type Filter Function -------------------------
function funModRedTagCre_SelFaultTypeFilter()
{
    //alert("Select Fault Type filter value");    
     const DataAry = []; 
    DataAry[0] = "Level1";
    DataAry[1] = JS_SessionArry[0].CurrentUserDepartment; 
    DataAry[2] = document.getElementById("id_ModRedTagCre_SelMcCategory").value; 
    DataAry[3] = document.getElementById("id_ModRedTagCre_SelFaultType").value; 
    
    //alert(DataAry);
    $.post('class/getData_HomeModelCreateWo.php', { userpara: DataAry}, function(json_data2) 
    {
        //alert(json_data2);  
        var res = $.parseJSON(json_data2);
        var AryLevel1 = new Array();
        AryLevel1 = res.Data_Ary;           
  
        if(res.Status_Ary[0] === "true")
        {
            //---------- Load Level 1 , Select box ----------------------------------      
            var options5 = document.querySelectorAll('#id_ModRedTagCre_SelFaultLevel option');
            options5.forEach(o => o.remove());
            //------------ Fill New Items -------------------------------------
            var sel_FaultLevel = document.getElementById("id_ModRedTagCre_SelFaultLevel");
            for(var i = 0; i < AryLevel1.length; i++)
            {
                var opt5 = AryLevel1[i];
                var el5 = document.createElement("option");
                el5.textContent = opt5;
                el5.value = opt5;
                sel_FaultLevel.appendChild(el5);
            }   
        }
        else
        {
            //alert("Data Not Available");
            //---------- Load Level 1 , Select box ----------------------------------      
            var options5 = document.querySelectorAll('#id_ModRedTagCre_SelFaultLevel option');
            options5.forEach(o => o.remove());
            
            var opt5 = ["Select data"];
            opt5.forEach(function(value) 
            {
                var el5 = document.createElement("option");
                el5.textContent = value;
                el5.value = value;
                document.getElementById("id_ModRedTagCre_SelFaultLevel").appendChild(el5);
            });            
        }     
    });   
}
//-------------------- Machine Category Filter Function -------------------------
function funModRedTagCre_SelMachineCategoryFilter()
{
    //alert("Select Machine Category filter value");  
    
    const DataAry = []; 
    DataAry[0] = "funGetFilteredData";        // Function Name    
    DataAry[1] = "MachineNumber";
    DataAry[2] = "tblwo_machinemanagement";
    DataAry[3] = "1";
    DataAry[4] = "MachineCategory";
    DataAry[5] = document.getElementById("id_ModRedTagCre_SelMcCategory").value;       //"pneumatic";  
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
            var options3 = document.querySelectorAll('#id_ModRedTagCre_SelMachineNo option');
            options3.forEach(o => o.remove());
            //------------ Fill New Items -------------------------------------
            var sel_shoporderno = document.getElementById("id_ModRedTagCre_SelMachineNo");
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
            var options3 = document.querySelectorAll('#id_ModRedTagCre_SelMachineNo option');
            options3.forEach(o => o.remove());
            
            var opt3 = ["Select data"];
            opt3.forEach(function(value) 
            {
                var el3 = document.createElement("option");
                el3.textContent = value;
                el3.value = value;
                document.getElementById("id_ModRedTagCre_SelMachineNo").appendChild(el3);
            });
        }
    });
    //--------------------- Load Fault Type --------------------------------------------
    //const DataAry = []; 
    DataAry[0] = "FaultType";
    DataAry[1] = JS_SessionArry[0].CurrentUserDepartment; 
    DataAry[2] = document.getElementById("id_ModRedTagCre_SelMcCategory").value; 
    //alert(DataAry);
    $.post('class/getData_HomeModelCreateWo.php', { userpara: DataAry}, function(json_data2) 
    {
        //alert(json_data2);  
        var res = $.parseJSON(json_data2);
        var AryFaultType = new Array();
        AryFaultType = res.Data_Ary;           
  
        //------------ Remove All Items in "AryFaultType" -----------------------------------
        var options4 = document.querySelectorAll('#id_ModRedTagCre_SelFaultType option');
        options4.forEach(o => o.remove());
        //------------ Fill New Items -------------------------------------
        var sel_FaultType = document.getElementById("id_ModRedTagCre_SelFaultType");
        for(var i = 0; i < AryFaultType.length; i++)
        {
            var opt4 = AryFaultType[i];
            var el4 = document.createElement("option");
            el4.textContent = opt4;
            el4.value = opt4;
            sel_FaultType.appendChild(el4);
        }        
    });
}
