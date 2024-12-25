
function funMoWoDetails_Close()
{
    alert("Wo Table Row Clicked.."); 
    var varmodbox = document.getElementById("id_MoWoDetails");
    varmodbox.style.display = "none";

}
//--------------- Function Click Create Breakdown ----------------------------
function funUserNewClicked()
{        
    alert("Users New Clicked..123");        
 
    //---------- Open Model_Break Down --------------------------------------
    var varmodbox = document.getElementById("id_ModUsersNew");
    varmodbox.style.display = "block";

           
}
//--------------- Function Click Create Breakdown ----------------------------
function funWoTableRowClicked()
{        
    alert("Users Table row Clicked..1");        
    //---------- Read ReceiptNumber ----------------------------------------
    //var table3 = $('#example1').DataTable();        
    //var mydata = table3.rows('.selected').data(); 
    var mydata = dtbl1.rows('.selected').data(); 
    //alert(mydata[0][5]);
    //alert(mydata[0][24]);
    var strWorkOrderNumber      = mydata[0][1];
    var strWorkOrderDepartment  = mydata[0][2];
    //var strWorkOrderCategory    = mydata[0][4];

    //alert(strWorkOrderNumber);
    //alert(strWorkOrderDepartment);
    const now = new Date();
    // Format the date and time as required by the datetime-local input
    const year = now.getFullYear().toString().padStart(4, '0');
    const month = (now.getMonth() + 1).toString().padStart(2, '0');
    const day = now.getDate().toString().padStart(2, '0');
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');

    //---------- Open Model_Break Down --------------------------------------
    var varmodbox = document.getElementById("id_ModUsersNew");
    varmodbox.style.display = "block";

    const DataAry = []; 
    DataAry[0] = strWorkOrderNumber;        
    DataAry[1] = strWorkOrderDepartment;        
    //alert(DataAry);             
    //var vblSendPara =  "1234";         
    $.post('class/getData_ModWoDetails.php', { userpara: DataAry}, function(json_data2) 
    {
        //alert(json_data2);  
        var res = $.parseJSON(json_data2);
        document.getElementById("id_ModWoDetails_WoNo").innerHTML   = res.WorkOrderNo_Ary;
        document.getElementById("id_ModWoDetails_WoDate").innerHTML = res.CreatedDateTime_Ary;

        document.getElementById("id_ModWoDetails_WoProblem").innerHTML   = res.WoDescription_Ary;
        document.getElementById("id_ModWoDetails_Machine").innerHTML = res.MachineNo_Ary;

        document.getElementById("id_ModWoDetails_AllocatedMc").innerHTML   = res.AllocatedUser_Ary;
        document.getElementById("id_ModWoDetails_EventLog").innerHTML = res.WoEventLog_Ary;
    });       
}
