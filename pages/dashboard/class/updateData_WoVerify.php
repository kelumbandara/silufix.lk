
<?php
    session_start();
    require_once('../../../initialize.php');
    require_once('../../../config.php');
    
    $num = $_POST["userpara"];   
    $strFuncType = $num[0];    
    //$strFuncType = "funAutoVerify";  
    //    
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strServerDateTime = date("Y-m-d H:i:s");    
    //----------- Declare Variables -----------------------  
    $Status_ary     = array();
    $ReturnData_ary = array();
    $ReturnData_ary[0]  = "NA";     
    //----------------- Function : User Verify ------------------------------
    if($strFuncType === "funUserVerify")      //-------------- funGetCheckInDetails_byWoEpf -----------
    {
        $strWorkOrderNo         = $num[1]; 
        $strCurrentUserEPF      = $num[2];   
        $strCurrentUserName     = $num[3];     
        $strCurrentUserContact  = $num[4];   

        $WoStatus   = "Verified";
        $State      = 4;
        $strAddEventLog = ", WO Verify - On" . $strServerDateTime . " By " . $strCurrentUserName . "[" . $strCurrentUserContact . "]";
        //$data = array();
        //$data[0] = "Test1";
        //$data[1] = "Test2";       
        try 
        {
            //$stmt = $conn->prepare("UPDATE tblwo_event SET RespondDateTime=:respdt, RespondUser=:respusr, WoStatus =:wost, State=:stat WHERE WorkOrderNo=:wono");
            $stmt = $conn->prepare("UPDATE tblwo_event SET VerifiedDateTime=:veridt,VerifiedUser=:veriusr,WoEventLog=CONCAT(WoEventLog, :evtlog),WoStatus=:wostat,State=:stat WHERE WorkOrderNo=:wono");
            //$stmt = $conn->prepare("UPDATE tblwo_event SET VerifiedDateTime='2024-02-02 10:59:49',VerifiedUser='Kelum Bandara',WoEventLog='Test log2',WoVerify='Verified',State='1' WHERE WorkOrderNo=:wono");

            $stmt->bindParam(':wono', $strWorkOrderNo);
            $stmt->bindParam(':veridt', $strServerDateTime);
            $stmt->bindParam(':veriusr', $strCurrentUserEPF); 
            $stmt->bindParam(':evtlog', $strAddEventLog);
            $stmt->bindParam(':wostat', $WoStatus);
            $stmt->bindParam(':stat', $State); 
            $stmt->execute();   
            if ($stmt->rowCount() > 0) 
            {
                $Status_ary[0] = "true";
                $Status_ary[1] = "Record Updated"; 
            } 
            else
            {
                $Status_ary[0] = "false";
                $Status_ary[1] = "Record not updated."; 
            }    
        } 
        catch (Exception $ex) 
        {
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }
        $conn = null;        
    }
    elseif($strFuncType === "funAutoVerify")      
    {        
        //$WoStatus   = "Verified";
        $State      = 5;
        $strAddEventLog = ", WO Verify - On" . $strServerDateTime . " By Auto " . "[after 24Hours]";
     
        try 
        {
            //$stmt = $conn->prepare("UPDATE tblwo_event SET VerifiedDateTime=:veridt,VerifiedUser=:veriusr,WoEventLog=CONCAT(WoEventLog, :evtlog),WoStatus=:wostat,State=:stat WHERE WorkOrderNo=:wono");
            $sqlString = "UPDATE tblwo_event
                    SET 
                        VerifiedDateTime = NOW(),
                        VerifiedUser = 'Auto',
                        WoEventLog=CONCAT(WoEventLog,:evtlog),
                        WoStatus = 'Auto-Verified',
                        State   = :stat
                    WHERE 
                        (TIMESTAMPDIFF(HOUR, ClosedDateTime, NOW()) > 24)
                        AND WoStatus = 'Closed';";
            
            $stmt = $conn->prepare($sqlString);
            $stmt->bindParam(':evtlog', $strAddEventLog);
            $stmt->bindParam(':stat', $State); 
            $stmt->execute();   
            if ($stmt->rowCount() > 0) 
            {
                $Status_ary[0] = "true";
                $Status_ary[1] = "Record Updated :" + rowCount(); 
            } 
            else
            {
                $Status_ary[0] = "false";
                $Status_ary[1] = "Record not updated."; 
            }    
        } 
        catch (Exception $ex) 
        {
            $Status_ary[0] = "false";
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