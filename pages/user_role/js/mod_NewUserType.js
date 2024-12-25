//--------------------------------------------------------------------------
//--------------- MODEL BOX : CREATE NEW USER TYPE -------------------------
//--------------------------------------------------------------------------
function funModUserTypeCre_Close()
{
    //alert(" x click.."); 
    var varmodbox = document.getElementById("id_ModUserTypeCre");
    varmodbox.style.display = "none";
}
function funModUserTypeCre_Cancel()
{
    
    var varmodbox = document.getElementById("id_ModUserTypeCre");
    varmodbox.style.display = "none";
}
//----------------------------------------------------------------------------
function funModUserTypeCre_Update()
{        
    //alert("function mod Create User Type");    
    var strTemp = "";
    //alert("Breakdown Update Clicked");      
    const DataAry = [];
    DataAry[0] =  "funInsertUserType";     
    DataAry[1] = document.getElementById("id_ModUserTypeCre_UserRoll").value;
    DataAry[2] = document.getElementById("id_ModUserTypeCre_RollDescription").value;    
    //alert(DataAry);
    //-------- Check All fields are selected ...................................
    if((DataAry[1]==="")||(DataAry[2]===""))
    {
        //alert("Please select data");
        //Swal.fire({title: 'Error.!',text: 'Please fill the data',icon: 'error',confirmButtonText: 'OK'});
    }
    else
    {
        //alert(DataAry);
        $.post('updateData_UserRole.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2);           
            //var res = $.parseJSON(json_data2);            
            //Swal.fire({title: 'Success.!',text: 'Data updated successfully',icon: 'success',confirmButtonText: 'OK'});  // success, error, warning, info, question   
            alert("Data Updated successfully.");               
            var varmodbox = document.getElementById("id_ModUserTypeCre");
            varmodbox.style.display = "none";  
            funFormLoad();
        }); 
    }    
}
