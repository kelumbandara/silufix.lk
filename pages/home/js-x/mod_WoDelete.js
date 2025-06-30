
//--------------- Function Click Create Breakdown ----------------------------
function funModWoDetails_WoDelete()
{        
    //alert("Verify Workorder.");  
    
    if(roll_other_ary.includes('90011'))          // User Check Required....
    {
        JS_SessionArry[0].WorkOrderNo = document.getElementById("id_ModWoDetails_WoNo").innerHTML; 
        JS_SessionArry[0].NextModelID = ""; 
        JS_SessionArry[0].NextFunctionName = "funOpenMod_WoDelete";
        //alert("Next Function : " + JS_SessionArry[0].NextFunctionName);
        
        //---------- Open Model for Check User -------------------------------------
        var varmodbox = document.getElementById("id_ModCheckUser");
        varmodbox.style.display = "block";        
    }
    else
    {
        funOpenMod_WoDelete();
    } 
}
//-------------- Open Model WO Verify -----------------------  
function funOpenMod_WoDelete()
{   
    let intDebugEnable = 0;        
    if(intDebugEnable === 1)    alert("WO Delete");
    
    Swal.fire({
      title: 'Delete Work Order',
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
            //executeFunction();
            //alert("user click yes");
            //alert("WO No : " + JS_SessionArry[0].WorkOrderNo); 
            //alert("WO Status : " + JS_SessionArry[0].WorkOrderStatus);

            const DataAry = [];  
            DataAry[0] = "funUserDelete";
            DataAry[1] = JS_SessionArry[0].WorkOrderNo;        // Table Name
            DataAry[2] = JS_SessionArry[0].CurrentUserEPF;                 
            DataAry[3] = JS_SessionArry[0].CurrentUserName;
            DataAry[4] = JS_SessionArry[0].CurrentUserContact;
            if(intDebugEnable === 1)  alert(DataAry);
            
            $.post('class/updateData_WoDelete.php', { userpara: DataAry }, function(json_data2) 
            {
                if(intDebugEnable === 1)  alert(json_data2);           
                var res = $.parseJSON(json_data2); 
                //alert(res.Status_Ary[0]);
                if(res.Status_Ary[0] === "true")
                {
                     Swal.fire({title: 'Success.!',text: 'Work Order Deleted',icon: 'success',confirmButtonText: 'OK'});  // success, error, warning, info, question   
                }
                else if(res.Status_Ary[0] === "false")
                {
                    Swal.fire({title: 'Error.!',text: 'Work Order Not Deleted',icon: 'error',confirmButtonText: 'OK'});  // success, error, warning, info, question   
                }     
                else
                {
                    Swal.fire({title: 'Error.!',text: res.Status_Ary[1],icon: 'error',confirmButtonText: 'OK'});  // success, error, warning, info, question   
                }  
                //------------- Close Model_Wo Details ---------------------------------                    
                var varmodbox = document.getElementById("id_MoWoDetails");
                varmodbox.style.display = "none";
                //alert("Re-fresh");
                //funRefreshClicked();
                funRefresh_HomePage();  
            });               
            
        }
        else
        {
           //alert("user click no");
        }
    }); 
}

