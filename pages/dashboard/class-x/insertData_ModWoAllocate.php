
<?php
    session_start();
    require_once('../../../initialize.php');
    require_once('../../../config.php');
    
    $num = $_POST["userpara"];
    $strFuncType = $num[0];    
    //$strFuncType = "funInsertData";      
      
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strServerDateTime = date("Y-m-d H:i:s");   
      //----------- Declare Variables -----------------------    
    $Status_ary     = array();
    $ReturnData_ary = array();
    $ReturnData_ary[0]  = "NA"; 
    //----------------- Function : Insert Data to tblwo_allocatedusers ------------------------------
    if($strFuncType === "funInsertData")      //-------------- funGetCheckInDetails_byWoEpf -----------
    {
        $WorkOrderNo        = $num[1];    
        $AllocatedBy        = $_SESSION["user_name"];
        $AllocatedUser      = $num[2];   
        $Contact            = $num[3];
        $strStartData       = $num[4];
        $strEndData         = $num[5];
        $Status             = "Active";
        //--------------- Insert Data to Wo_Event -----------------------------    
        try 
        {   
            //$stmt = $conn->prepare("INSERT INTO tblwo_allocatedusers (WorkOrderNo, AllocatedBy, AllocatedUser, AllocatedServerDateTime, DeAllocatedDateTime, Status) VALUES (:wono, :allby, :allusr, :alldtm, :dealldtm, :stat)");
            $stmt = $conn->prepare("INSERT INTO tblwo_allocatedusers (WorkOrderNo, AllocatedBy, AllocatedUser, AllocatedServerDateTime, AllocatedUserStartDateTime, AllocatedUserEndDateTime, DeAllocatedBy, DeAllocatedDateTime, Status) VALUES (:wono, :alloby, :allousr, :allosvrdtm, :allostartdtm, :alloenddtm, :dealloby, :dealldtm, :stat)");
            $stmt->bindParam(':wono', $WorkOrderNo);
            $stmt->bindParam(':alloby', $AllocatedBy);
            $stmt->bindParam(':allousr', $AllocatedUser);
            $stmt->bindParam(':allosvrdtm', $strServerDateTime); // AllocatedServerDateTime
            $stmt->bindParam(':allostartdtm', $strStartData); // AllocatedUserStartDateTime
            $stmt->bindParam(':alloenddtm', $strEndData); // AllocatedUserEndDateTime
            $stmt->bindParam(':dealloby', $AllocatedBy); // DeAllocatedBy
            $stmt->bindParam(':dealldtm', $strServerDateTime); // DeAllocatedDateTime
            $stmt->bindParam(':stat', $Status);
            $stmt->execute();
            if ($stmt->rowCount() > 0) 
            {
                $Status_ary[0] = "true";
                $Status_ary[1] = "Inserted new record"; 
            } 
            else
            {
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not inserted"; 
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