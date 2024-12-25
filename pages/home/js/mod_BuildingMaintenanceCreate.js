//--------------------------------------------------------------------------
//--------------- MODEL BOX : CREATE BREAKDOWN -----------------------------
//--------------------------------------------------------------------------
function funModBuildMntCre_Close()
{
    //alert("Building Maintenance x click.."); 
    var varmodbox = document.getElementById("id_ModBuildMntCre");
    varmodbox.style.display = "none";
}
function funModBuildMntCre_Cancel()
{
    //alert("Building Maintenance Cose ."); 
    var varmodbox = document.getElementById("id_ModBuildMntCre");
    varmodbox.style.display = "none";
}
function funModBuildMntCreateClicked()      // Initial load value
{        
    //alert("Model Building Maintenance Create Clicked..");
	document.getElementById('id_ModBuildMntCre_Update').disabled = false; 
    //---------- Open Model_Plan Maintenance -------------------------------
    var varmodbox = document.getElementById("id_ModBuildMntCre");
    varmodbox.style.display = "block";
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
    const datetimeInput = document.getElementById('id_ModBuildMntCre_dtmDateTime');
    datetimeInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
    //datetimeInput.disabled = true;          
}
//----------------------------------------------------------------------------
function funModBuildMntCre_Filter()
{        
    //alert("function SelectPlannedMaintenanceFilter ");
}
//----------------------------------------------------------------------------
function funModBuildMntCre_Update()
{        
    //alert("function mod Create Plan Maintenance update");
    //alert(document.getElementById("id_ModBuildMntCre_dtmDateTime").value);
     
    var strTemp = "";
     //alert("Breakdown Update Clicked");      
     const DataAry = []; 
    DataAry[0] = "WMS-1760A";
    DataAry[1] = "Unit-1";
    DataAry[2] = "RelatedDep";
    DataAry[3] = "BuildingMaintenance";
    DataAry[4] = document.getElementById("id_ModBuildMntCre_SelProjectCategory").value;  // WorkOrderSubCategory
    DataAry[5] = "";                        // WorkOrderSubCategory2
    DataAry[6] = JS_SessionArry[0].CurrentUserDepartment;                   // WoDepartment
    DataAry[7] = document.getElementById("id_ModBuildMntCre_dtmDateTime").value;     //CreatedDateTime     
    DataAry[8] = JS_SessionArry[0].CurrentUserName;
    DataAry[9] = "";
    DataAry[10] = "";
    DataAry[11] = "";
    DataAry[12] = "";  
    DataAry[13] = "";  
    DataAry[14] = document.getElementById("id_ModBuildMntCre_inpNote").value; 
     
    strTemp = "Work Order Placed - On " + document.getElementById("id_ModBuildMntCre_dtmDateTime").value + " By " + JS_SessionArry[0].CurrentUserName + "(" + JS_SessionArry[0].CurrentUserContact + ")";
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
    if(DataAry[14]==="")
    {
        //alert("Please select data");
        Swal.fire({title: 'Error.!',text: 'Please Wnter Description',icon: 'error',confirmButtonText: 'OK'});
    }
    else
    {
	document.getElementById('id_ModBuildMntCre_Update').disabled = true; 
        //alert(DataAry);
        $.post('class/insertData_WoBrakdown.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2);           
            //var res = $.parseJSON(json_data2);            
            Swal.fire({title: 'Success.!',text: 'Data updated successfully',icon: 'success',confirmButtonText: 'OK'});  // success, error, warning, info, question   
            //alert("Data Updated successfully.");               
            var varmodbox = document.getElementById("id_ModBuildMntCre");
            varmodbox.style.display = "none";  
            //funRefreshClicked();
            funRefresh_HomePage();  
        }); 
    }    
}

