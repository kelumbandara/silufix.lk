
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
    $ClosedUser     = $num[7];
    //$Note           = $num[7];
    
    $RespondUser      = $_SESSION["user_name"];   
    //$WorkOrderStatusChange  = "Respond";
    $WorkOrderStatusChange  = $num[3];
    $WoState    = "Closed";
    $WoVerify   = "-";
    $State      = 3;
           
    //----------- Declare Variables -----------------------    
    $Status_ary     = array();
    $ReturnData_ary = array();
    $ReturnData_ary[0]  = "NA"; 
    
    try 
    {
        //------ Check WorkOrder State < 3 (If Workorder closed , can not verify) ------------------
        $checkStateStmt = $conn->prepare("SELECT State FROM tblwo_event WHERE WorkOrderNo = :wono");
        $checkStateStmt->bindParam(':wono', $WorkOrderNo);
        $checkStateStmt->execute();
        $row = $checkStateStmt->fetch(PDO::FETCH_ASSOC);
        // Check if the State is less than 3
        if ($row['State'] < 3) 
        {
             //$stmt = $conn->prepare("UPDATE tblwo_event SET RespondDateTime=:respdt, RespondUser=:respusr, WoStatus =:wost, State=:stat WHERE WorkOrderNo=:wono");
            $stmt = $conn->prepare("UPDATE tblwo_event SET ClosedFaultType=:flttp,ClosedFaultLevel1=:fltlvl1,ClosedFaultLevel2=:fltlvl2,ClosedFaultLevel3=:fltlvl3,ClosedFaultLevel4=:fltlvl4,ClosedDateTime=:clsdt,ClosedUser=:clsusr,WoStatus=:wost, WoVerify=:woveri, State=:stat WHERE WorkOrderNo=:wono");
            $stmt->bindParam(':flttp', $FaultType);
            $stmt->bindParam(':fltlvl1', $FaultLevel1); 
            $stmt->bindParam(':fltlvl2', $FaultLevel2);
            $stmt->bindParam(':fltlvl3', $FaultLevel3);
            $stmt->bindParam(':fltlvl4', $FaultLevel4);
            $stmt->bindParam(':clsdt', $CloseDateTime);
            $stmt->bindParam(':clsusr',$ClosedUser);
            //$stmt->bindParam(':eventlg', $Note);
            $stmt->bindParam(':wost', $WoState);  
            $stmt->bindParam(':woveri', $WoVerify);          
            $stmt->bindParam(':stat', $State);        
            $stmt->bindParam(':wono', $WorkOrderNo);     
            $stmt->execute();   
            //$stmt->close();
            $Status_ary[0] = "true";
            $Status_ary[1] = "Data saved successfully";   
        }
        else
        {
            // State is not less than 3, do not execute the insertion
            $Status_ary[0] = "false";
            $Status_ary[1] = "WorkOrder already closed.."; 
        }       
    } 
    catch (Exception $ex) 
    {
        $Status_ary[0] = "error";
        $Status_ary[1] = 'Error Msg: ' .$ex->getMessage(); 
        //$stmt->close(); 
    }
    $conn = null;
   
    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
    //print json_encode($RecordSavingState);
    //print json_encode($num); 
    print json_encode($data_ary);  
       
?>