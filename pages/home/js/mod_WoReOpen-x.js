
//--------------- Function Click Create Breakdown ----------------------------
function funModWoDetails_WoReOpen()
{        
    //alert("Re-Open Workorder.");
     if(roll_other_ary.includes('90011'))          // User Check Required....
    {
        JS_SessionArry[0].WorkOrderNo = document.getElementById("id_ModWoDetails_WoNo").innerHTML; 
        JS_SessionArry[0].NextModelID = ""; 
        JS_SessionArry[0].NextFunctionName = "funOpenMod_WoReOpen";
        //alert("Next Function : " + JS_SessionArry[0].NextFunctionName);
        
        //---------- Open Model for Check User -------------------------------------
        var varmodbox = document.getElementById("id_ModCheckUser");
        varmodbox.style.display = "block";        
    }
    else
    {
        funOpenMod_WoReOpen();
    } 
}
//-------------- Open Model WO Checking -----------------------  
function funOpenMod_WoReOpen()
{
    //alert("Re-open");
    
    Swal.fire({
      title: 'Re-Open Work Order',
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
            if(JS_SessionArry[0].WorkOrderStatus === "Closed")  
            {
                const DataAry = [];               
                DataAry[0] = JS_SessionArry[0].WorkOrderNo;        // Table Name
                DataAry[1] = JS_SessionArry[0].CurrentUserEPF;                 
                DataAry[2] = JS_SessionArry[0].CurrentUserName;
                DataAry[3] = JS_SessionArry[0].CurrentUserContact;

                //alert(DataAry);
                $.post('class/updateData_WoReOpen.php', { userpara: DataAry }, function(json_data2) 
                {
                    //alert(json_data2);           
                    //var res = $.parseJSON(json_data2);   
                    //---------- Close Model_Wo Details --------------------------------------
                    //var varmodbox = document.getElementById("id_MoWoDetails");
                    //varmodbox.style.display = "none";
                    //JS_SessionArry[0].WorkOrderStatus   = "Inprogress";
                    //JS_SessionArry[0].WorkOrderVerify   = "-";        
                    //alert("Re-fresh");
                    //------------- Refresh Work Order Details ---------------------------------
                      //------------- Refresh Work Order Details ---------------------------------
                    let strReturn = funWoDetailsRefresh(JS_SessionArry[0].WorkOrderNo);
                    //funRefreshClicked(); 
                    funRefresh_HomePage();  
                });
            }
            else
            {
                Swal.fire({
                            title: 'Alert !!',
                            text: 'Work Order not closed.',
                            icon: 'Warning', // success, error, warning, info, question
                            confirmButtonText: 'OK'
                        });
            }
        }
        else
        {
             //alert("user click no");
        }
    });   
}

