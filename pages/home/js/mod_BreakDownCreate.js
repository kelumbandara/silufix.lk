//--------------------------------------------------------------------------
//--------------- MODEL BOX : CREATE BREAKDOWN -----------------------------
//--------------------------------------------------------------------------
 //-------------------- Model : Edit Update Clicked -------------------------
function funModBrkDownCre_Close()
{
    //alert("Cose Model Box.."); 
    var varmodbox = document.getElementById("id_ModBrkDownCre");
    varmodbox.style.display = "none";
}
function funModBrkDownCre_Cancel()
{
    //alert("Cose Model Box.."); 
    var varmodbox = document.getElementById("id_ModBrkDownCre");
    varmodbox.style.display = "none";
}
function funModBrkDownCre_Filter()
{
    
}
//------------------- Create a Breakdown Clicked -------------------------------------
function funModCreateBreakDownClicked()
{        
    //alert("Model Brakdown Clicked..");      
    //---------- Open Model_Break Down --------------------------------------
    var varmodbox = document.getElementById("id_ModBrkDownCre");
    varmodbox.style.display = "block";    
    document.getElementById("id_ModBrkDownCre_lblUserDep").innerHTML = "User's Department : " + JS_SessionArry[0].CurrentUserDepartment; 

    const DataAry = []; 
    DataAry[0] = "MachineCategory";
    DataAry[1] = JS_SessionArry[0].CurrentUserDepartment; 
    //alert(DataAry);
    //$.post('./pages/home/class/getData_HomeModelCreateWo.php', { userpara: DataAry}, function(json_data2) 
    $.post('class/getData_HomeModelCreateWo.php', { userpara: DataAry}, function(json_data2) 
    {
        //alert(json_data2);  
        var res = $.parseJSON(json_data2);
        var AryMcCategory = new Array();
        AryMcCategory = res.Data_Ary;           
       
        //------------ Remove All Items in "Machine Category" -----------------------------------
        var options2 = document.querySelectorAll('#id_ModBrkDownCre_SelMcCategory option');
        options2.forEach(o => o.remove());
        //------------ Fill New Items -------------------------------------
        var sel_cusordno = document.getElementById("id_ModBrkDownCre_SelMcCategory");
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
        const datetimeInput = document.getElementById('id_ModBrkDownCre_dtmDateTime');
        datetimeInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
        datetimeInput.disabled = true;
    });
}
    
//-------------------- Model : Edit Update Clicked -------------------------
function funModBrkDownCre_Update() 
{
    let intDebugEnable = 0;
    if(intDebugEnable === 1)    alert("funModBrkDownCre_Update");
    
    var strTemp = "";
    //alert("Breakdown Update Clicked");      
    const DataAry = []; 
            
    DataAry[0] = "WMS-1760A";              //FactoryCode
    DataAry[1] = "Unit-1";                 //Unit
    DataAry[2] = "RelatedDep";             //RelatedDepartment
    DataAry[3] = "BreakDown";              //WorkOrderCategory
    DataAry[4] = "";                       // WorkOrderSubCategory
    DataAry[5] = "";                        // WorkOrderSubCategory2
    DataAry[6] = JS_SessionArry[0].CurrentUserDepartment;                   // WoDepartment
    DataAry[7] = document.getElementById("id_ModBrkDownCre_dtmDateTime").value;     //CreatedDateTime      
    DataAry[8] = JS_SessionArry[0].CurrentUserName;        // CreatedUser
    DataAry[9] = document.getElementById("id_ModBrkDownCre_SelMcCategory").value;   //McCategory
    DataAry[10] = document.getElementById("id_ModBrkDownCre_SelMachineNo").value;    //MachineNo
    DataAry[12] = document.getElementById("id_ModBrkDownCre_SelFaultType").value;    //CreatedFaultType
    DataAry[13] = document.getElementById("id_ModBrkDownCre_SelFaultLevel").value;   //CreatedFaultLevel1
    DataAry[14] = document.getElementById("id_ModBrkDownCre_inpNote").value;        // Note
    // alert("Test - 1");
    strTemp = "Work Order Placed - On " + document.getElementById("id_ModBrkDownCre_dtmDateTime").value + " By " + JS_SessionArry[0].CurrentUserName + "(" + JS_SessionArry[0].CurrentUserContact + ")";
    //alert(strTemp);
     DataAry[15] = strTemp;     //WoEventLog 
     DataAry[16] = 'A';              //Shift
     DataAry[17] = "New";      //Wo Status
     DataAry[18] = "-";
     DataAry[19] = "";
     DataAry[20] = 1;
     DataAry[21] = 1;
     DataAry[22] = 1;
     
     if(intDebugEnable === 1)    alert("DataAry :" + DataAry);
     
    //-------- Check All fields are selected ...................................
    if((DataAry[9]==="Select data")||(DataAry[10]==="Select data")||(DataAry[12]==="Select data"))
    {
        //alert("Please select data");
        Swal.fire({title: 'Error.!',text: 'Please select the data',icon: 'error',confirmButtonText: 'OK'});
    }
    else
    {
        //alert(DataAry);
        //---------------- Find ValueAdd in Machine Number ------------------------------
        const DataAry2 = []; 
        DataAry2[0] = "funGetFilteredData";        // Function Name    
        DataAry2[1] = "ValueAdd";
        DataAry2[2] = "tblwo_machinemanagement";
        DataAry2[3] = "1";
        DataAry2[4] = "MachineNumber";
        DataAry2[5] = document.getElementById("id_ModBrkDownCre_SelMachineNo").value;    //MachineNo
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
                //alert(res[1]);   
                if(intMqttState === 1)
                {
                    message = new Paho.MQTT.Message("{\"MacAdd\":\"E8:9F:6D:92:D3:0D\",\"MsgType\":\"BrkdwnEvent\",\"IPAdd\":\"192.168.1.105\",\"UserName\":\"Kelum\",\"ModelNo\":\"DCS-1507A_UI\",\"ManufacDate\":\"16/12/2023\",\"EventNo\":\"1\",\"PwrOnCount\":\"0\",\"RunTime\":\"0\",\"FrameworkVer\":\"DCS-1507A_Frm3\",\"SoftVer\":\"8.0\",\"SigStrength\":\"-36\"}");
                    message.destinationName =strPublishTopic;
                    mqtt.send(message);
                }
                else
                {
                    //alert("Fail Connecting with server");
                }    
                //alert("Data Updated successfully.");               
                var varmodbox = document.getElementById("id_ModBrkDownCre");
                varmodbox.style.display = "none";  
                //funRefreshClicked();
                funRefresh_HomePage();  
            });
        });
    }    
 } 
//-------------------- Fault Type Filter Function -------------------------
function funModBrkDownCre_SelFaultTypeFilter()
{
    //alert("Select Fault Type filter value");    
    const DataAry = []; 
    DataAry[0] = "Level1";
    DataAry[1] = JS_SessionArry[0].CurrentUserDepartment; 
    DataAry[2] = document.getElementById("id_ModBrkDownCre_SelMcCategory").value; 
    DataAry[3] = document.getElementById("id_ModBrkDownCre_SelFaultType").value; 
    
    //alert(DataAry);
    $.post('class/getData_HomeModelCreateWo.php', { userpara: DataAry}, function(json_data2) 
    {
        //alert(json_data2);  
        var res = $.parseJSON(json_data2);
        var AryLevel1 = new Array();
        AryLevel1 = res.Data_Ary;           
  
        //---------- Load Level 1 , Select box ----------------------------------      
        var options5 = document.querySelectorAll('#id_ModBrkDownCre_SelFaultLevel option');
        options5.forEach(o => o.remove());
        //------------ Fill New Items -------------------------------------
        var sel_FaultLevel = document.getElementById("id_ModBrkDownCre_SelFaultLevel");
        for(var i = 0; i < AryLevel1.length; i++)
        {
            var opt5 = AryLevel1[i];
            var el5 = document.createElement("option");
            el5.textContent = opt5;
            el5.value = opt5;
            sel_FaultLevel.appendChild(el5);
        }       
    });
       
}
//-------------------- Machine Category Filter Function -------------------------
function funModBrkDownCre_SelMachineNoFilter()
{
    //alert("Select Machine Number filter value");  
    
}

//-------------------- Machine Category Filter Function -------------------------
function funModBrkDownCre_SelMachineCategoryFilter()
{
    //alert("Select Machine Category filter value");  
    //----------------------- Load Machine Numbers --------------------------------------
    const DataAry = []; 
    DataAry[0] = "funGetFilteredData";        // Function Name    
    DataAry[1] = "MachineNumber";
    DataAry[2] = "tblwo_machinemanagement";
    DataAry[3] = "1";
    DataAry[4] = "MachineCategory";
    DataAry[5] = document.getElementById("id_ModBrkDownCre_SelMcCategory").value;       //"pneumatic";  
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
            var options3 = document.querySelectorAll('#id_ModBrkDownCre_SelMachineNo option');
            options3.forEach(o => o.remove());
            //------------ Fill New Items -------------------------------------
            var sel_shoporderno = document.getElementById("id_ModBrkDownCre_SelMachineNo");
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
            // Remove existing options
            var options3 = document.querySelectorAll('#id_ModBrkDownCre_SelMachineNo option');
            options3.forEach(o => o.remove());

            // Create new options
            var opt3 = ["Select data"];
            opt3.forEach(function(value) 
            {
                var el3 = document.createElement("option");
                el3.textContent = value;
                el3.value = value;
                document.getElementById("id_ModBrkDownCre_SelMachineNo").appendChild(el3);
            });
        }
    });
    //--------------------- Load Fault Type --------------------------------------------
    //const DataAry = []; 
    DataAry[0] = "FaultType";
    DataAry[1] = JS_SessionArry[0].CurrentUserDepartment; 
    DataAry[2] = document.getElementById("id_ModBrkDownCre_SelMcCategory").value; 
    //alert(DataAry);
    $.post('class/getData_HomeModelCreateWo.php', { userpara: DataAry}, function(json_data2) 
    {
        //alert(json_data2);  
        var res = $.parseJSON(json_data2);
        var AryFaultType = new Array();
        AryFaultType = res.Data_Ary;           
  
        //------------ Remove All Items in "AryFaultType" -----------------------------------
        var options4 = document.querySelectorAll('#id_ModBrkDownCre_SelFaultType option');
        options4.forEach(o => o.remove());
        //------------ Fill New Items -------------------------------------
        var sel_FaultType = document.getElementById("id_ModBrkDownCre_SelFaultType");
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




