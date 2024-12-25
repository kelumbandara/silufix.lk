
<?php
    session_start();
    require_once('../../../initialize.php');
    require_once('../../../config.php');
    
    $num = $_POST["userpara"];
       
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strServerDateTime = date("Y-m-d H:i:s");    
    //----------- Declare Variables -----------------------  
    $strWorkOrderNo         = $num[0]; 
    $strCurrentUserEPF      = $num[1];   
    $strCurrentUserName     = $num[2];     
    $strCurrentUserContact  = $num[3];   
                
    // $strWorkOrderNo         = "WO_00000129"; 
    // $strCurrentUserEPF      = "10393";   
    //$strCurrentUserName     = "Kelum Bandara";     
    //$strCurrentUserContact  = "077889955";    
    $strWoVerify   = "-";
    $strWoReOpen   = "Re-Open";
    $strWoStatus   = "Inprogress";    
    $State      = 2;
    
    $strAddEventLog = ",WO Re-Open - On" . $strServerDateTime . " By " . $strCurrentUserName . "[" . $strCurrentUserContact . "]";
    $data = array();
    $data[0] = "Test1";
    $data[1] = "Test2";       
    try 
    {
        //$stmt = $conn->prepare("UPDATE tblwo_event SET VerifiedDateTime=:veridt,VerifiedUser=:veriusr,WoEventLog=CONCAT(WoEventLog, :evtlog),WoVerify=:wovery,State=:stat WHERE WorkOrderNo=:wono");
        $stmt = $conn->prepare("UPDATE tblwo_event SET WoEventLog=CONCAT(WoEventLog, :evtlog),WoStatus=:wostat,WoVerify=:wovery,State=:stat,WoReOpen=:reopn WHERE WorkOrderNo=:wono");
        $stmt->bindParam(':wono', $strWorkOrderNo);
        $stmt->bindParam(':evtlog', $strAddEventLog);
        $stmt->bindParam(':wostat', $strWoStatus);
        $stmt->bindParam(':wovery', $strWoVerify);
        $stmt->bindParam(':stat', $State);         
        $stmt->bindParam(':reopn', $strWoReOpen);
        
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