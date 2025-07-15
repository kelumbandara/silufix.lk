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
    //alert("Select Site Category filter value");  

    DataAry[0] = "funGetFilteredData";        // Function Name    
    DataAry[1] = "SiteName";
    DataAry[2] = "tblwo_errorlevel_redtag";
    DataAry[3] = "0";
    
    //alert(DataAry);
    $.post('class/comFunctions.php', { userpara: DataAry }, function(json_data2) 
    {
        // Parse the received JSON data
        var res = $.parseJSON(json_data2);                           
        var ArySite_new = res.Data_Ary; 

        // Remove all existing options in the select box
        var options3 = document.querySelectorAll('#id_ModBrkDownCre_SelSite option');
        options3.forEach(o => o.remove());

        // Reference to the select box
        var sel_shoporderno = document.getElementById("id_ModBrkDownCre_SelSite");

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
    funModBreakDown_SelSiteFilter();
}

function funModBreakDown_SelSiteFilter()
{
    //alert("Select site filter value");  
    
    
    const DataAry = []; 
    DataAry[0] = "funGetFilteredData";        // Function Name    
    DataAry[1] = "Building";
    DataAry[2] = "tblwo_errorlevel_redtag";
    DataAry[3] = "1";
    DataAry[4] = "SiteName";
    DataAry[5] = document.getElementById("id_ModBrkDownCre_SelSite").value;       
    alert(DataAry);
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
            var options3 = document.querySelectorAll('#id_ModBrkDownCre_Selbuilding option');
            options3.forEach(o => o.remove());

            // Reference to the select box
            var sel_shoporderno = document.getElementById("id_ModBrkDownCre_Selbuilding");

            // Add the default option
            var defaultOption = document.createElement("option");
            defaultOption.textContent = "Select data";
            defaultOption.value = "Select data"; // You can leave the value empty or set it as per your requirement
            //defaultOption.disabled = true; // Optional: To prevent selecting this as a valid value
            //defaultOption.selected = true; // Optional: To make it the selected option by default
            sel_shoporderno.appendChild(defaultOption);

            //------------ Fill New Items -------------------------------------
            var sel_shoporderno = document.getElementById("id_ModBrkDownCre_Selbuilding");
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
            var options3 = document.querySelectorAll('#id_ModBrkDownCre_Selbuilding option');
            options3.forEach(o => o.remove());
            
            var opt3 = ["Select data"];
            opt3.forEach(function(value) 
            {
                var el3 = document.createElement("option");
                el3.textContent = value;
                el3.value = value;
                document.getElementById("id_ModBrkDownCre_Selbuilding").appendChild(el3);
            });
        }
    });
    funModBreakDown_SelBuildingFilter();
    
}

function funModBreakDown_SelBuildingFilter()
{
    //alert("Select Building Type filter value");    
     const DataAry = []; 
     DataAry[0] = "funGetFilteredData";        // Function Name    
     DataAry[1] = "IssueType";
     DataAry[2] = "tblwo_errorlevel_redtag";
     DataAry[3] ="3";
     DataAry[4] = "SiteName";
     DataAry[5] = document.getElementById("id_ModBrkDownCre_SelSite").value;
     DataAry[6] = "Building";
     DataAry[7] = document.getElementById("id_ModBrkDownCre_Selbuilding").value;
    
    //alert(DataAry);
    $.post('class/comFunctions.php', { userpara: DataAry}, function(json_data2) 
    {
        //alert(json_data2);  
        var res = $.parseJSON(json_data2);
        var AryLevel1 = new Array();
        AryLevel1 = res.Data_Ary;           
  
        if(res.Status_Ary[0] === "true")
        {
            //---------- Load Level 1 , Select box ----------------------------------      
            var options5 = document.querySelectorAll('#id_ModRedTagCre_Issu_Type option');
            options5.forEach(o => o.remove());

            // Reference to the select box
            var sel_FaultLevel = document.getElementById("id_ModRedTagCre_Issu_Type");

            // Add the default option
            var defaultOption = document.createElement("option");
            defaultOption.textContent = "Select data";
            defaultOption.value = "Select data"; // You can leave the value empty or set it as per your requirement
            //defaultOption.disabled = true; // Optional: To prevent selecting this as a valid value
            //defaultOption.selected = true; // Optional: To make it the selected option by default
            sel_FaultLevel.appendChild(defaultOption);

            //------------ Fill New Items -------------------------------------
            var sel_FaultLevel = document.getElementById("id_ModRedTagCre_Issu_Type");
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
            var options5 = document.querySelectorAll('#id_ModRedTagCre_Issu_Type option');
            options5.forEach(o => o.remove());
            
            var opt5 = ["Select data"];
            opt5.forEach(function(value) 
            {
                var el5 = document.createElement("option");
                el5.textContent = value;
                el5.value = value;
                document.getElementById("id_ModRedTagCre_Issu_Type").appendChild(el5);
            });            
        }     
    });  
    funModRedTagCre_SelissuerFilter(); 
}
    
