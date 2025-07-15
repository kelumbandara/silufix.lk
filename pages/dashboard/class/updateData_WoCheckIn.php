
<?php
    session_start();
    require_once('../../../initialize.php');
    require_once('../../../config.php');
    
    $num = $_POST["userpara"];
    $strFuncType = $num[0];    
    //$strFuncType = "funCheckOutUsers";
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strServerDateTime = date("Y-m-d H:i:s");    
    //----------- Declare Variables -----------------------  
    $i = 0; 
    $j = 0;     
    $Status_ary     = array();
    $ReturnData_ary = array();
    $ReturnData_ary[0]  = "NA"; 
    if($strFuncType === "funCheckOutUsers")      //-------------- funGetCheckInDetails_byWoEpf -----------
    {        
        $strWoNumber    = $num[1]; 
        $strEPF         = $num[2];
        //$strWoNumber    = "WO_00000100";
        //$strEPF         = "10393";        
        $strStatus      = "Deactive";
        try 
        {
            //$stmt = $conn->prepare("UPDATE tblwo_event SET RespondDateTime=:respdt, RespondUser=:respusr, WoStatus =:wost, State=:stat WHERE WorkOrderNo=:wono");
            //$stmt = $conn->prepare("UPDATE tblwo_allcheckinusers SET CheckOutDateTime =:chkoutdt,Status =:stat WHERE WorkOrderNo=:wono AND CheckInUser= :chkinusr");
            //$stmt = $conn->prepare("UPDATE tblwo_allcheckinusers SET CheckOutDateTime ='2024-02-10 12:52:00',Status ='Deactive' WHERE WorkOrderNo='WO_00000098' AND CheckInUser= '10393'");
            //$stmt = $conn->prepare("UPDATE tblwo_allcheckinusers SET CheckOutDateTime =:chkoutdt,Status ='Deactive' WHERE WorkOrderNo='WO_00000098' AND CheckInUser= '986'");
            //$stmt = $conn->prepare("UPDATE tblwo_allcheckinusers SET CheckOutDateTime =:chkoutdt, Status =:stat WHERE WorkOrderNo='WO_00000107' AND CheckInUser= '10393'");
            $stmt = $conn->prepare("UPDATE tblwo_allcheckinusers SET CheckOutServerDateTime=:chkoutsvrdt, CheckOutUserDateTime=:chkoutusrdt, Status =:stat WHERE Status='Active' AND WorkOrderNo=:wono AND CheckInUser= :chkinusr");
            
            $stmt->bindParam(':chkoutsvrdt', $strServerDateTime);
            $stmt->bindParam(':chkoutusrdt', $strServerDateTime);
            $stmt->bindParam(':stat', $strStatus);            
            $stmt->bindParam(':wono', $strWoNumber);              
            $stmt->bindParam(':chkinusr', $strEPF); 
            $stmt->execute();   
            //$stmt->close();
            $Status_ary[0] = "true";
            $Status_ary[1] = "Data Available"; 
        } 
        catch (Exception $ex) 
        {
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();  
        }       
        $conn = null;
    }
    else if($strFuncType === "funWoStateChange")      //-------------- funGetCheckInDetails_byWoEpf -----------
    {        
        $strWoNumber    = $num[1]; 
        $strEPF         = $num[2];
        $strWoState    = "Inprogress";
        $strWoVerify   = "-";        
        $strState      = "2";
        try 
        {
            //$stmt = $conn->prepare("UPDATE tblwo_event SET RespondDateTime=:respdt, RespondUser=:respusr, WoStatus =:wost, State=:stat WHERE WorkOrderNo=:wono");
            $stmt = $conn->prepare("
		UPDATE 
			tblwo_event 
		SET 
			RespondDateTime = IF(RespondUser = '', :respdt, RespondDateTime),
                    	RespondUser = IF(RespondUser = '', :respuser, RespondUser),	
			WoStatus=:wostat,
			WoVerify=:wovery,
			State=:stat 
		WHERE 
			WorkOrderNo=:wono
			");
            

		$stmt->bindParam(':wono', $strWoNumber);
            $stmt->bindParam(':respdt', $strServerDateTime);
            $stmt->bindParam(':respuser', $strEPF); 
            $stmt->bindParam(':wostat', $strWoState);
            $stmt->bindParam(':wovery', $strWoVerify);
            $stmt->bindParam(':stat', $strState);
            $stmt->execute();  
            //$stmt->close();
            $Status_ary[0] = "true";
            $Status_ary[1] = "Data Available"; 
        } 
        catch (Exception $ex) 
        {
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();  
        }       
        $conn = null;
    }
    else if($strFuncType === "funCheckOutAllUsers")      //-------------- funGetCheckInDetails_byWoEpf -----------
    {        
        $strWoNumber        = $num[1];        
        $strCheckInState    = "Deactive";
        try 
        {
            $stmt = $conn->prepare("UPDATE tblwo_allcheckinusers SET CheckOutServerDateTime=:chkoutsvrdt, CheckOutUserDateTime=:chkoutusrdt, Status=:checkstat WHERE WorkOrderNo=:wono AND Status='Active'");
            $stmt->bindParam(':chkoutsvrdt', $strServerDateTime);
            $stmt->bindParam(':chkoutusrdt', $strServerDateTime);
            $stmt->bindParam(':wono', $strWoNumber);
            $stmt->bindParam(':checkstat', $strCheckInState);           
            $stmt->execute();  
            //$stmt->close();
            $Status_ary[0] = "true";
            $Status_ary[1] = "Data Available"; 
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