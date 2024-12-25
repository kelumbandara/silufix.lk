
function funModWoChat_Close()
{
    //alert("Cose Model Box.."); 
    var varmodbox = document.getElementById("id_ModWoChat");
    varmodbox.style.display = "none";
}
function funKeyPress(event, vblKey) 
{
    //alert("Chat press");
    if (event.key === 'Enter')
    {
        //alert(vblKey.value);
        funModWoChat_Update();
    }
}
//--------------- Check In Function ----------------------
function funModWoChat_Update()
{
    //alert("funMod Chat Update function"); 
    const DataAry = []; 
    var strWorkOrderNo  = document.getElementById("id_ModWoChat_WoNo").innerHTML; 
    var strChatSendBy   = JS_SessionArry[0].CurrentUserEPF;    //document.getElementById("id_ModWoChat_SendBy").innerHTML; 
    var strChatMessage  = document.getElementById("id_ModWoChat_ChatMessage").value; 
    if(strChatMessage !== "")
    {
        //--------Insert New Row ---------------- 
        DataAry[0] = strWorkOrderNo;        // Table Name
        DataAry[1] = strChatSendBy; 
        DataAry[2] = strChatMessage; 
        //alert(DataAry);

        $.post('class/insertData_ModWoChat.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2);           
            //var res = $.parseJSON(json_data2);  

            //------------- Refresh Work Order Details ---------------------------------
            let strReturn = funWoDetailsRefresh(JS_SessionArry[0].WorkOrderNo);
            //alert("strReturn :" + strReturn);
            funRefresh_HomePage();   
            //alert("Table refresh finished");
            //------ Close Model Box ----------------------
            var varmodbox = document.getElementById("id_ModWoChat");
            varmodbox.style.display = "none";
            //funRefreshClicked();  
        });
    }
    else
    {
        Swal.fire({
            title: 'Error.!',
            text: 'Chat Message blank',
            icon: 'error',
            confirmButtonText: 'OK',
            customClass: 
            {
                popup: 'small-popup',
                title: 'small-title',
                content: 'small-text',
            }});
    }
     
} 
//--------------- Function Click Create Breakdown ----------------------------
function funModWoDetails_WoChat()
{        
    //alert("Check In Chat");  
    if(roll_other_ary.includes('900'))          // User Check Required....
    {
        JS_SessionArry[0].WorkOrderNo = document.getElementById("id_ModWoDetails_WoNo").innerHTML; 
        JS_SessionArry[0].NextModelID = "id_ModWoChat"; 
        JS_SessionArry[0].NextFunctionName = "funOpenMod_WoChat";
        //alert("Next Function : " + JS_SessionArry[0].NextFunctionName);        
        //---------- Open Model for Check User -------------------------------------
        var varmodbox = document.getElementById("id_ModCheckUser");
        varmodbox.style.display = "block";        
    }
    else
    {
        funOpenMod_WoChat();
    }  
}
//-------------- Open Model WO Checking -----------------------  
function funOpenMod_WoChat()
{
    //alert("No need User Check");
    //--------- Clear History -----------------------------------------------
    document.getElementById("id_ModWoChat_ChatMessage").value     = "";   
    document.getElementById("id_ModWoChat_ChatHistory").innerHTML = document.getElementById("id_ModWoDetails_ChatHistory").innerHTML;    
  
    //---------- Read ReceiptNumber ----------------------------------------
    //var strWorkOrderNumber  = document.getElementById("id_ModWoDetails_WoNo").innerHTML;  
    //---------- Close Model_Wo Details --------------------------------------
    //var varmodbox = document.getElementById("id_MoWoDetails");
    //varmodbox.style.display = "none";
    //---------- Open Model_Wo Close --------------------------------------
    var varmodbox = document.getElementById("id_ModWoChat");
    varmodbox.style.display = "block";
      
    document.getElementById("id_ModWoChat_WoNo").innerHTML     = JS_SessionArry[0].WorkOrderNo;   
    document.getElementById("id_ModWoChat_SendBy").innerHTML   = JS_SessionArry[0].CurrentUserName;
    
}

