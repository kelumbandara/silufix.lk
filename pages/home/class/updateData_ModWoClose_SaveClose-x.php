
<?php
    session_start();
    require_once('../../../initialize.php');
    require_once('../../../config.php');
    
    $num = $_POST["userpara"];
   
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strServerDateTime = date("Y-m-d H:i:s");    
    //----------- Declare Variables -----------------------  
    $WorkOrderNo    = $num[0]; 
    $FaultType      = $num[1]; 
    $FaultLevel1    = $num[2]; 
    $FaultLevel2    = $num[3]; 
    $FaultLevel3    = $num[4]; 
    $FaultLevel4    = $num[5];         
    $CloseDateTime  = $num[6];
    //$Note           = $num[7];
    
    $RespondUser      = $_SESSION["user_name"];   
    //$WorkOrderStatusChange  = "Respond";
    $WorkOrderStatusChange  = $num[3];
    $WoState    = "Closed";
    $WoVerify   = "-";
    $State      = 3;
           
    $data = array();
    $data[0] = "Test1";
    $data[1] = "Test2";       
    try 
    {
        //$stmt = $conn->prepare("UPDATE tblwo_event SET RespondDateTime=:respdt, RespondUser=:respusr, WoStatus =:wost, State=:stat WHERE WorkOrderNo=:wono");
        $stmt = $conn->prepare("UPDATE tblwo_event SET ClosedFaultType=:flttp,ClosedFaultLevel1=:fltlvl1,ClosedFaultLevel2=:fltlvl2,ClosedFaultLevel3=:fltlvl3,ClosedFaultLevel4=:fltlvl4,ClosedDateTime=:clsdt,WoStatus=:wost, WoVerify=:woveri, State=:stat WHERE WorkOrderNo=:wono");
        $stmt->bindParam(':flttp', $FaultType);
        $stmt->bindParam(':fltlvl1', $FaultLevel1); 
        $stmt->bindParam(':fltlvl2', $FaultLevel2);
        $stmt->bindParam(':fltlvl3', $FaultLevel3);
        $stmt->bindParam(':fltlvl4', $FaultLevel4);
        $stmt->bindParam(':clsdt', $CloseDateTime);
        //$stmt->bindParam(':eventlg', $Note);
        $stmt->bindParam(':wost', $WoState);  
        $stmt->bindParam(':woveri', $WoVerify);          
        $stmt->bindParam(':stat', $State);        
        $stmt->bindParam(':wono', $WorkOrderNo);     
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