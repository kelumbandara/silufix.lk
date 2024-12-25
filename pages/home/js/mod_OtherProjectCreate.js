//--------------------------------------------------------------------------
//--------------- MODEL BOX : CREATE BREAKDOWN -----------------------------
//--------------------------------------------------------------------------

function funModOtherProjectCre_Close()
{
    //alert("Building Maintenance x click.."); 
    var varmodbox = document.getElementById("id_ModOtherProjectCre");
    varmodbox.style.display = "none";
}
function funModOtherProjectCre_Cancel()
{
    //alert("Building Maintenance Cose ."); 
    var varmodbox = document.getElementById("id_ModOtherProjectCre");
    varmodbox.style.display = "none";
}
function funModOtherProjectCreateClicked()      // Initial load value
{        
    //alert("Model Other project Create Clicked..");
	document.getElementById('id_ModOtherProjectCre_Update').disabled = false; 
    //---------- Open Model_Plan Maintenance -------------------------------
    var varmodbox = document.getElementById("id_ModOtherProjectCre");
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
    const datetimeInput = document.getElementById('id_ModOtherProjectCre_dtmDateTime');
    datetimeInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
    //datetimeInput.disabled = true;          
}
//----------------------------------------------------------------------------
function funModOtherProjectCre_Filter()
{        
    //alert("function SelectPlannedMaintenanceFilter ");
}
//----------------------------------------------------------------------------
function funModOtherProjectCre_Update()
{        
    //alert("function Other Project Update");
    //alert(document.getElementById("id_ModOtherProjectCre_dtmDateTime2").value);
    
    var strTemp = "";
     //alert("Breakdown Update Clicked");      
    const DataAry = []; 
    DataAry[0] = "WMS-1760A";
    DataAry[1] = "Unit-1";
    DataAry[2] = "RelatedDep";
    DataAry[3] = "OtherProject";
    DataAry[4] = document.getElementById("id_ModOtherProjectCre_SelProjectCategory").value;      // WorkOrderSubCategory
    DataAry[5] = "";                        // WorkOrderSubCategory2
    DataAry[6] = JS_SessionArry[0].CurrentUserDepartment; 
    DataAry[7] = document.getElementById("id_ModOtherProjectCre_dtmDateTime2").value;     //CreatedDateTime      
    DataAry[8] = JS_SessionArry[0].CurrentUserName;        // CreatedUser
    
    DataAry[9]  = "";
    DataAry[10] = "";
    DataAry[11] = "";
    DataAry[12] = "";   
    DataAry[13] = "";  
    DataAry[14] = document.getElementById("id_ModOtherProjectCre_inpNote").value; 
     
    strTemp = "Work Order Placed - On " + document.getElementById("id_ModOtherProjectCre_dtmDateTime2").value + " By " + JS_SessionArry[0].CurrentUserName + "(" + JS_SessionArry[0].CurrentUserContact + ")";
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
        Swal.fire({title: 'Error.!',text: 'Please Enter Description',icon: 'error',confirmButtonText: 'OK'});
    }
    else
    {
	document.getElementById('id_ModOtherProjectCre_Update').disabled = true; 
        //alert(DataAry);
        $.post('class/insertData_WoBrakdown.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2);           
            var res = $.parseJSON(json_data2);
            if(res.Status_Ary[0] === "true")
            {
                Swal.fire({title: 'Success.!',text: 'Data updated successfully',icon: 'success',confirmButtonText: 'OK'});  // success, error, warning, info, question   
                //alert("Data Updated successfully.");               
                var varmodbox = document.getElementById("id_ModOtherProjectCre");
                varmodbox.style.display = "none";  
                //funRefreshClicked();
                funRefresh_HomePage(); 
            }
            else
            {
                Swal.fire({title: 'Error.!',text: res.Status_Ary[1],icon: 'error',confirmButtonText: 'OK'});  // success, error, warning, info, question   
            }
        }); 
    }        
}

