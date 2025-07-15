
<?php
    session_start();
    require_once('../../../initialize.php');
    require_once('../../../config.php');
    
    $num = $_POST["userpara"];   
    $strFuncType = $num[0];    
    //$strFuncType = "funAutoDelete";  
    //    
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strServerDateTime = date("Y-m-d H:i:s");    
    //----------- Declare Variables -----------------------  
    $Status_ary     = array();
    $ReturnData_ary = array();
    $ReturnData_ary[0]  = "NA";     
    //----------------- Function : User Delete ------------------------------
    if($strFuncType === "funUserDelete")      //-------------- funGetCheckInDetails_byWoEpf -----------
    {
        $strWorkOrderNo         = $num[1]; 
        $strCurrentUserEPF      = $num[2];   
        $strCurrentUserName     = $num[3];     
        $strCurrentUserContact  = $num[4];   

        $WoStatus   = "Deleted";
        $State      = 6;
        $strAddEventLog = ", WO Delete - On" . $strServerDateTime . " By " . $strCurrentUserName . "[" . $strCurrentUserContact . "]";
        //$data = array();
        //$data[0] = "Test1";
        //$data[1] = "Test2";       
        try 
        {
            //$stmt = $conn->prepare("UPDATE tblwo_event SET RespondDateTime=:respdt, RespondUser=:respusr, WoStatus =:wost, State=:stat WHERE WorkOrderNo=:wono");
            $stmt = $conn->prepare("UPDATE tblwo_event SET WoEventLog=CONCAT(WoEventLog, :evtlog),WoStatus=:wostat,State=:stat WHERE WorkOrderNo=:wono");
            //$stmt = $conn->prepare("UPDATE tblwo_event SET VerifiedDateTime='2024-02-02 10:59:49',VerifiedUser='Kelum Bandara',WoEventLog='Test log2',WoDelete='Verified',State='1' WHERE WorkOrderNo=:wono");

            $stmt->bindParam(':wono', $strWorkOrderNo);
            $stmt->bindParam(':evtlog', $strAddEventLog);
            $stmt->bindParam(':wostat', $WoStatus);
            $stmt->bindParam(':stat', $State); 
            $stmt->execute();   
            if ($stmt->rowCount() > 0) 
            {
                $Status_ary[0] = "true";
                $Status_ary[1] = "Record Deleted"; 
            } 
            else
            {
                $Status_ary[0] = "false";
                $Status_ary[1] = "Record not Deleted."; 
            }    
        } 
        catch (Exception $ex) 
        {
            $Status_ary[0] = "error";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }
        $conn = null;        
    }
        
    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
        
    //print json_encode($error);
    print json_encode($data_ary); 
    // print json_encode($ProductQuantity_ary); 
       
?>