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
    let intDebugEnable =0;  
    if(intDebugEnable === 1)    alert("funModRedTagCreateClicked");
        
    document.getElementById('id_ModRedTagCre_Update').disabled = false; 
    //---------- Open Model_Create Redtag  -------------------------------
    var varmodbox = document.getElementById("id_ModRedTagCre");
    varmodbox.style.display = "block";
    document.getElementById("id_ModRedTagCre_lblUserDep").innerHTML = "User's Department : " + JS_SessionArry[0].CurrentUserDepartment;
    const DataAry = []; 
    //alert("Select Site Category filter value");  
    DataAry[0] = "funGetFilteredData";        // Function Name    
    DataAry[1] = "Site";
    DataAry[2] = "tblwo_masterdata_redtag";
    DataAry[3] = "0";
    
    //alert(DataAry);
    $.post('class/comFunctions.php', { userpara: DataAry }, function(json_data2) 
    {
        // Parse the received JSON data
        var res = $.parseJSON(json_data2);                           
        var ArySite_new = res.Data_Ary; 

        // Remove all existing options in the select box
        var options3 = document.querySelectorAll('#id_ModRedTagCre_Site option');
        options3.forEach(o => o.remove());

        // Reference to the select box
        var sel_shoporderno = document.getElementById("id_ModRedTagCre_Site");

        // Add the default option
        var defaultOption = document.createElement("option");
        defaultOption.textContent = "Select data";
        defaultOption.value ="Select data"; // You can leave the value empty or set it as per your requirement
        //defaultOption.disabled = true; // Optional: To prevent selecting this as a valid value
        //defaultOption.selected = true; // Optional: To make it the selected option by default
        sel_shoporderno.appendChild(defaultOption);

        // Fill the select box with new items
        for (var i = 0; i < ArySite_new.length; i++) 
        {
            var opt3 = ArySite_new[i];
            var el3 = document.createElement("option");
            el3.textContent = opt3;
            el3.value = opt3;
            sel_shoporderno.appendChild(el3);
        }
    });
    //funModRedTagCre_SelSiteFilter();
    //funModRedTagCre_SelLocationFilter();     
}

//-------------------- Location Filter Function -------------------------
function funModRedTagCre_SelLocationFilter()
{
    let intDebugEnable = 0;  
    if(intDebugEnable === 1)    alert("funModRedTagCre_SelLocationFilter");        
    
    const DataAry = []; 
    DataAry[0] = "funGetFilteredData";        // Function Name    
    DataAry[1] = "Location";
    DataAry[2] = "tblwo_masterdata_redtag";
    DataAry[3] = "1";
    DataAry[4] = "Site";
    DataAry[5] = document.getElementById("id_ModRedTagCre_Site").value;       
    if(intDebugEnable === 1)    alert("DataAry :" + DataAry); 
    
    $.post('class/comFunctions.php', { userpara: DataAry }, function(json_data2) 
    {
        //alert(json_data2);   
        if(intDebugEnable === 1)    alert("json_data2" + json_data2);         
        var res = $.parseJSON(json_data2);                           
        var ArySite_new = new Array();

        ArySite_new   = res.Data_Ary; 
        //alert(ArySite_new);
        if(res.Status_Ary[0] === "true")
        {
            //------------ Remove All Items in "Machine No" -----------------------------------
            var options3 = document.querySelectorAll('#id_ModRedTagCre_Location option');
            options3.forEach(o => o.remove());

            // Reference to the select box
            var sel_shoporderno = document.getElementById("id_ModRedTagCre_Location");

            // Add the default option
            var defaultOption = document.createElement("option");
            defaultOption.textContent = "Select data";
            defaultOption.value = "Select data"; // You can leave the value empty or set it as per your requirement
            //defaultOption.disabled = true; // Optional: To prevent selecting this as a valid value
            //defaultOption.selected = true; // Optional: To make it the selected option by default
            sel_shoporderno.appendChild(defaultOption);

            //------------ Fill New Items -------------------------------------
            var sel_shoporderno = document.getElementById("id_ModRedTagCre_Location");
            for(var i = 0; i < ArySite_new.length; i++)
            {
                var opt3 = ArySite_new[i];
                var el3 = document.createElement("option");
                el3.textContent = opt3;
                el3.value = opt3;
                sel_shoporderno.appendChild(el3);
            }
        }
        else
        {            
            if(intDebugEnable === 1)    alert("Data Not Available");  
            //---------- Load Level 1 , Select box ----------------------------------      
            var options5 = document.querySelectorAll('#id_ModRedTagCre_Location option');
            options5.forEach(o => o.remove());            
            var opt5 = ["Select data"];
            opt5.forEach(function(value) 
            {
                var el5 = document.createElement("option");
                el5.textContent = value;
                el5.value = value;
                document.getElementById("id_ModRedTagCre_Location").appendChild(el5);
            });  
        }  
    });
    funModRedTagCre_SelBuildingFilter();    
}
//-------------- Fing All Buildings ----------------------------------
function funModRedTagCre_SelBuildingFilter()
{
    let intDebugEnable = 0;  
    if(intDebugEnable === 1)    alert("funModRedTagCre_SelBuildingFilter"); 
     const DataAry = []; 
     DataAry[0] = "funGetFilteredData";        // Function Name    
     DataAry[1] = "Building";
     DataAry[2] = "tblwo_masterdata_redtag";
     DataAry[3] ="2";
     DataAry[4] = "Site";
     DataAry[5] = document.getElementById("id_ModRedTagCre_Site").value;
     DataAry[6] = "Location";
     DataAry[7] = document.getElementById("id_ModRedTagCre_Location").value;
    
    if(intDebugEnable === 1)    alert("DataAry :" + DataAry); 
    $.post('class/comFunctions.php', { userpara: DataAry}, function(json_data2) 
    {
        if(intDebugEnable === 1)    alert("json_data2 :" + json_data2);   
        var res = $.parseJSON(json_data2);
        var AryLevel1 = new Array();
        AryLevel1 = res.Data_Ary;    
        if(res.Status_Ary[0] === "true")
        {
            //---------- Load Level 1 , Select box ----------------------------------      
            var options5 = document.querySelectorAll('#id_ModRedTagCre_Building option');
            options5.forEach(o => o.remove());
            // Reference to the select box
            var sel_FaultLevel = document.getElementById("id_ModRedTagCre_Building");
            // Add the default option
            var defaultOption = document.createElement("option");
            defaultOption.textContent = "Select data";
            defaultOption.value = "Select data"; // You can leave the value empty or set it as per your requirement
            //defaultOption.disabled = true; // Optional: To prevent selecting this as a valid value
            //defaultOption.selected = true; // Optional: To make it the selected option by default
            sel_FaultLevel.appendChild(defaultOption);
            //------------ Fill New Items -------------------------------------
            var sel_FaultLevel = document.getElementById("id_ModRedTagCre_Building");
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
            if(intDebugEnable === 1)    alert("Data Not Available");  
            //---------- Load Level 1 , Select box ----------------------------------      
            var options5 = document.querySelectorAll('#id_ModRedTagCre_Building option');
            options5.forEach(o => o.remove());            
            var opt5 = ["Select data"];
            opt5.forEach(function(value) 
            {
                var el5 = document.createElement("option");
                el5.textContent = value;
                el5.value = value;
                document.getElementById("id_ModRedTagCre_Building").appendChild(el5);
            });  
        }     
    });  
    funModRedTagCre_SelIssueTypeFilter(); 
}
//-------------------- Select Issue Type Filter Function -------------------------
function funModRedTagCre_SelIssueTypeFilter()
{
    let intDebugEnable = 0;  
    if(intDebugEnable === 1)    alert("funModRedTagCre_SelIssueTypeFilter"); 
     const DataAry = []; 
     DataAry[0] = "funGetFilteredData";        // Function Name    
     DataAry[1] = "IssueType";
     DataAry[2] = "tblwo_masterdata_redtag";
     DataAry[3] = "3";
     DataAry[4] = "Site";
     DataAry[5] = document.getElementById("id_ModRedTagCre_Site").value;
     DataAry[6] = "Location";
     DataAry[7] = document.getElementById("id_ModRedTagCre_Location").value;
     DataAry[8] = "Building";
     DataAry[9] = document.getElementById("id_ModRedTagCre_Building").value;
    
     if(intDebugEnable === 1)    alert("DataAry :" + DataAry); 
    $.post('class/comFunctions.php', { userpara: DataAry}, function(json_data2) 
    {
        if(intDebugEnable === 1)    alert("json_data2 :" + json_data2);   
        var res = $.parseJSON(json_data2);
        var AryLevel1 = new Array();
        AryLevel1 = res.Data_Ary;     
        if(res.Status_Ary[0] === "true")
        {
            //---------- Load Level 1 , Select box ----------------------------------      
            var options5 = document.querySelectorAll('#id_ModRedTagCre_IssueType option');
            options5.forEach(o => o.remove());

            // Reference to the select box
            var sel_FaultLevel = document.getElementById("id_ModRedTagCre_IssueType");

            // Add the default option
            var defaultOption = document.createElement("option");
            defaultOption.textContent = "Select data";
            defaultOption.value = "Select data"; // You can leave the value empty or set it as per your requirement
            //defaultOption.disabled = true; // Optional: To prevent selecting this as a valid value
            //defaultOption.selected = true; // Optional: To make it the selected option by default
            sel_FaultLevel.appendChild(defaultOption);
            //------------ Fill New Items -------------------------------------
            var sel_FaultLevel = document.getElementById("id_ModRedTagCre_IssueType");
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
            if(intDebugEnable === 1)    alert("Data is not Available :"); 
            //---------- Load Level 1 , Select box ----------------------------------      
            var options5 = document.querySelectorAll('#id_ModRedTagCre_IssueType option');
            options5.forEach(o => o.remove());
            
            var opt5 = ["Select data"];
            opt5.forEach(function(value) 
            {
                var el5 = document.createElement("option");
                el5.textContent = value;
                el5.value = value;
                document.getElementById("id_ModRedTagCre_IssueType").appendChild(el5);
            });            
        }     
    });  
    funModRedTagCre_SelIssueDescriptionFilter();  
}
//-------------------- Select Issue Description Filter Function -------------------------
function funModRedTagCre_SelIssueDescriptionFilter()
{
    let intDebugEnable = 0;  
    if(intDebugEnable === 1)    alert("funModRedTagCre_SelIssueDescriptionFilter"); 
     const DataAry = []; 
     DataAry[0] = "funGetFilteredData";        // Function Name    
     DataAry[1] = "IssueDescriptionMain";
     DataAry[2] = "tblwo_masterdata_redtag";
     DataAry[3] = "4";
     DataAry[4] = "Site";
     DataAry[5] = document.getElementById("id_ModRedTagCre_Site").value;
     DataAry[6] = "Location";
     DataAry[7] = document.getElementById("id_ModRedTagCre_Location").value;
     DataAry[8] = "Building";
     DataAry[9] = document.getElementById("id_ModRedTagCre_Building").value;
    
     if(intDebugEnable === 1)    alert("DataAry :" + DataAry); 
    $.post('class/comFunctions.php', { userpara: DataAry}, function(json_data2) 
    {
        if(intDebugEnable === 1)    alert("json_data2 :" + json_data2);   
        var res = $.parseJSON(json_data2);
        var AryLevel1 = new Array();
        AryLevel1 = res.Data_Ary;     
        if(res.Status_Ary[0] === "true")
        {
            //---------- Load Level 1 , Select box ----------------------------------      
            var options5 = document.querySelectorAll('#id_ModRedTagCre_IssueDescription option');
            options5.forEach(o => o.remove());

            // Reference to the select box
            var sel_FaultLevel = document.getElementById("id_ModRedTagCre_IssueDescription");

            // Add the default option
            var defaultOption = document.createElement("option");
            defaultOption.textContent = "Select data";
            defaultOption.value = "Select data"; // You can leave the value empty or set it as per your requirement
            //defaultOption.disabled = true; // Optional: To prevent selecting this as a valid value
            //defaultOption.selected = true; // Optional: To make it the selected option by default
            sel_FaultLevel.appendChild(defaultOption);
            //------------ Fill New Items -------------------------------------
            var sel_FaultLevel = document.getElementById("id_ModRedTagCre_IssueDescription");
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
            if(intDebugEnable === 1)    alert("Data is not Available :"); 
            //---------- Load Level 1 , Select box ----------------------------------      
            var options5 = document.querySelectorAll('#id_ModRedTagCre_IssueDescription option');
            options5.forEach(o => o.remove());
            
            var opt5 = ["Select data"];
            opt5.forEach(function(value) 
            {
                var el5 = document.createElement("option");
                el5.textContent = value;
                el5.value = value;
                document.getElementById("id_ModRedTagCre_IssueDescription").appendChild(el5);
            });            
        }     
    });   
}
//-------------- Create a Redtag Function --------------------------------------------------
function funModRedTagCre_Update()
{        
    let intDebugEnable = 0;  
    if(intDebugEnable === 1)    alert("funModRedTagCre_Update");
    const now = new Date();
    const formattedDateTime = now.getFullYear() + '-' +
    String(now.getMonth() + 1).padStart(2, '0') + '-' +
    String(now.getDate()).padStart(2, '0') + ' ' +
    String(now.getHours()).padStart(2, '0') + ':' +
    String(now.getMinutes()).padStart(2, '0') + ':' +
    String(now.getSeconds()).padStart(2, '0');
    if(intDebugEnable === 1)    alert("formattedDateTime :" + formattedDateTime);
    var strTemp = "";
    //alert("Breakdown Update Clicked");      
    const DataAry = []; 
    DataAry[0] = "MMS-1810A";
    DataAry[1] = "Unit-1";
    DataAry[2] = "RelatedDep";
    DataAry[3] = "RedTag";
    DataAry[4] = "";  // WorkOrderSubCategory
    DataAry[5] = "";  // WorkOrderSubCategory2    

    DataAry[6] = document.getElementById("id_ModRedTagCre_Site").value; //site
    DataAry[7] = document.getElementById("id_ModRedTagCre_Location").value; //Location
    DataAry[8] = document.getElementById("id_ModRedTagCre_Building").value; // building
    DataAry[9] = document.getElementById("id_ModRedTagCre_IssueType").value; // issuer type
    DataAry[10] = document.getElementById("id_ModRedTagCre_IssueDescription").value; // isuer description
    DataAry[11] = ""; //Issue_Description2
    DataAry[12] = formattedDateTime;
    DataAry[13] = JS_SessionArry[0].CurrentUserDepartment;
    DataAry[14] = JS_SessionArry[0].CurrentUserEPF;
    DataAry[15] = formattedDateTime; //PlannedDateTime
    DataAry[16] = formattedDateTime; //StartedDateTime
    DataAry[17] = formattedDateTime; //CloseDateTime
    DataAry[18] = formattedDateTime; //VerifiedDateTime
    strTemp = "Red Tag Placed - On " + formattedDateTime  + " By " + JS_SessionArry[0].CurrentUserName + "(" + JS_SessionArry[0].CurrentUserContact + ")";
    //alert(strTemp);
    DataAry[19] = strTemp;     //WoEventLog 
    DataAry[20] = 'A';              //Shift
    DataAry[21] = "New";      //Wo Status
    DataAry[22] = 1;
    
    if(intDebugEnable === 1)    alert("DataAry : " + DataAry);

    //-------- Check All fields are selected ...................................
    if((DataAry[6]==="Select data")||(DataAry[7]==="Select data")||(DataAry[8]==="Select data")||(DataAry[9]==="Select data"))
    {
        //alert("Please select data");
        Swal.fire({title: 'Error.!',text: 'Please select the data',icon: 'error',confirmButtonText: 'OK'});
    }
    else
    {       
            $.post('class/insertData_WoBrakdown.php', { userpara: DataAry }, function(json_data2) 
            {
                if(intDebugEnable === 1)    alert("json_data2 : " + json_data2);     
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
        
    }    
}

/*
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
    */
/*
//-------------------- Site Filter Function -------------------------
function funModRedTagCre_SelSiteFilter()
{
    //alert("Select site filter value");  
    
    
    const DataAry = []; 
    DataAry[0] = "funGetFilteredData";        // Function Name    
    DataAry[1] = "Building";
    DataAry[2] = "tblwo_masterdata_redtag";
    DataAry[3] = "1";
    DataAry[4] = "SiteName";
    DataAry[5] = document.getElementById("id_ModRedTagCre_Site").value;       
    //alert(DataAry);
    $.post('class/comFunctions.php', { userpara: DataAry }, function(json_data2) 
    {
        //alert(json_data2);           
        var res = $.parseJSON(json_data2);                           
        var ArySite_new = new Array();

        ArySite_new   = res.Data_Ary; 
        //alert(ArySite_new);
        if(res.Status_Ary[0] === "true")
        {
            //------------ Remove All Items in "Machine No" -----------------------------------
            var options3 = document.querySelectorAll('#id_ModRedTagCre_SelBuilding option');
            options3.forEach(o => o.remove());

            // Reference to the select box
            var sel_shoporderno = document.getElementById("id_ModRedTagCre_SelBuilding");

            // Add the default option
            var defaultOption = document.createElement("option");
            defaultOption.textContent = "Select data";
            defaultOption.value = "Select data"; // You can leave the value empty or set it as per your requirement
            //defaultOption.disabled = true; // Optional: To prevent selecting this as a valid value
            //defaultOption.selected = true; // Optional: To make it the selected option by default
            sel_shoporderno.appendChild(defaultOption);

            //------------ Fill New Items -------------------------------------
            var sel_shoporderno = document.getElementById("id_ModRedTagCre_SelBuilding");
            for(var i = 0; i < ArySite_new.length; i++)
            {
                var opt3 = ArySite_new[i];
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
            var options3 = document.querySelectorAll('#id_ModRedTagCre_SelBuilding option');
            options3.forEach(o => o.remove());
            
            var opt3 = ["Select data"];
            opt3.forEach(function(value) 
            {
                var el3 = document.createElement("option");
                el3.textContent = value;
                el3.value = value;
                document.getElementById("id_ModRedTagCre_SelBuilding").appendChild(el3);
            });
        }
    });
    funModRedTagCre_SelBuildingFilter();
    
}
*/
