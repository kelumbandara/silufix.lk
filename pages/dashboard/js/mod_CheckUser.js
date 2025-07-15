
function funModCheckUser_Close()
{
    //alert("Cose Model Box.."); 
    var varmodbox = document.getElementById("id_ModCheckUser");
    varmodbox.style.display = "none";

}
//--------------- Check In Function ----------------------
function funModCheckUser_LogIn()
{
    //alert("funMod Check In function"); 
    const DataAry = []; 
    //var strWorkOrderNo      = document.getElementById("id_ModWoCheckIn_WoNo").innerHTML; 
    //var strCheckInDateTime  = document.getElementById("id_ModWoCheckIn_dtmDateTime").value;
    var strCheckUserUserName  = document.getElementById("id_ModCheckUser_UserName").value;
    var strCheckUserPassword  = document.getElementById("id_ModCheckUser_Password").value;
    
    //---------------- Check UserName and Password ----------------------------------------
    DataAry[0] = "funCheckUserCredentials";        // Table Name
    DataAry[1] = strCheckUserUserName; 
    DataAry[2] = strCheckUserPassword; 
    
    if((strCheckUserUserName ==="") || (strCheckUserPassword===""))
    {                
        //alert("Username or Password is blank");
        Swal.fire({
            title: 'Error.!',
            text: 'Username or Password is blank',
            icon: 'error',
            confirmButtonText: 'OK',
            customClass: 
            {
                popup: 'small-popup',
                title: 'small-title',
                content: 'small-text',
            }});
    }           
    else
    {
        $.post('class/comFunctions.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2);           
            var res = $.parseJSON(json_data2);        
            //alert(res.LoginDetailAry[0]);        
            if(res.Status_Ary[0] === "true")        // Username and Password are correct
            {                          
                //strCurrentUserEPF   = res.Data_Ary[0];
                //strCurrentUserName  = res.Data_Ary[1];
                JS_SessionArry[0].CurrentUserEPF        = res.Data_Ary[0];
                JS_SessionArry[0].CurrentUserName       = res.Data_Ary[1];
                JS_SessionArry[0].CurrentUserContact    = res.Data_Ary[2];
                JS_SessionArry[0].CurrentUserDepartment = res.Data_Ary[3];
                var varmodbox = document.getElementById("id_ModCheckUser");
                varmodbox.style.display = "none";
                              
                if((JS_SessionArry[0].CurrentUserDepartment === "Engineering")||(JS_SessionArry[0].NextFunctionName !== "funOpenMod_WoCheckIn"))
                {
                    //alert(JS_SessionArry[0].NextFunctionName);
                    //----------- Select Next Function to be execute ------------------------------------------------                
                    if(JS_SessionArry[0].NextFunctionName === "funOpenMod_WoAllocate")      funOpenMod_WoAllocate();
                    else if(JS_SessionArry[0].NextFunctionName === "funOpenMod_WoCheckIn")  funOpenMod_WoCheckIn();
                    else if(JS_SessionArry[0].NextFunctionName === "funOpenMod_WoClose")    funOpenMod_WoClose();
                    else if(JS_SessionArry[0].NextFunctionName === "funOpenMod_WoVerify")   funOpenMod_WoVerify();
                    else if(JS_SessionArry[0].NextFunctionName === "funOpenMod_WoReOpen")   funOpenMod_WoReOpen();
                    else if(JS_SessionArry[0].NextFunctionName === "funWoDetails_CheckOut") funWoDetails_CheckOut();
                    else
                    {
                        //alert("No function found to execute..");
                        //alert(JS_SessionArry[0].NextFunctionName);
                        Swal.fire({title: 'Error.!',text: 'No any function found to execute',icon: 'error',confirmButtonText: 'OK'});
                    } 
                }
                else
                {
                    Swal.fire({title: 'Error.!',text: 'You are not Engineering Department',icon: 'error',confirmButtonText: 'OK'});
            
                }                
            }
            else
            {
                //alert(res.Status_Ary[1]);
                Swal.fire({
                        title: 'Error.!',
                        text: res.Status_Ary[1],
                        icon: 'error',
                        confirmButtonText: 'OK'});
                //alert("Loging Details are wrong.");     
            }        
        });
    }     
}
 

//--------------- Filters ----------------------
//function funModWoClose_Filter()
//{
  //  alert("Filter function -123");
//}
