
<?php
    session_start();
    require_once('../../../initialize.php');
    require_once('../../../config.php');
    
    $num = $_POST["userpara"];
       
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strServerDateTime = date("Y-m-d H:i:s");    
    //----------- Declare Variables -----------------------  
    $WorkOrderNo   = $num[0]; 
    $UserName      = $num[1];     
    //$WorkOrderNo   = "WO_00000097";
    //$UserName      = "Dhananji";    
    //$RespondUser      = $_SESSION["user_name"];   
   
    $State      = "Deactive";
           
    $data = array();
    $data[0] = "Test1";
    $data[1] = "Test2";       
    try 
    {
        //$stmt = $conn->prepare("UPDATE tblwo_event SET RespondDateTime=:respdt, RespondUser=:respusr, WoStatus =:wost, State=:stat WHERE WorkOrderNo=:wono");
        $stmt = $conn->prepare("UPDATE tblwo_allocatedusers SET DeAllocatedDateTime=:deallodt,Status=:stat WHERE WorkOrderNo=:wono AND AllocatedUser=:alusr");
        
        $stmt->bindParam(':deallodt', $strServerDateTime);
        $stmt->bindParam(':stat', $State);
        $stmt->bindParam(':wono', $WorkOrderNo);
        $stmt->bindParam(':alusr', $UserName);       
        
        $stmt->execute();   
        //$stmt->close();
        $data[1] = "Save Successfully"; 
    } 
    catch (Exception $ex) 
    {
        $data[1] = 'Error Msg: ' .$ex->getMessage();
        //$stmt->close(); 
    }
   $conn = null;
   //print json_encode($RecordSavingState);
   //print json_encode($num); 
   print json_encode($data);  
       
?>