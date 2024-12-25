<?php

    session_start();   
    require_once('../../../initialize.php');
    require_once('../../../config.php');
    
    $num = $_POST["userpara"];
           
    //$AryLength = array_map('count', $num);
    //$AryLength = sizeof($num);
  
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strServerDateTime = date("Y-m-d H:i:s");   
    
    //$strWorkOrderNo         = $num[0];    
    //$strCheckInUser         = $num[1]; 
    
    // Sample Data
   $FactoryCode         = $num[0];    //'WMS-1760A';
   $Unit                = $num[1];    //'Unit-1';
   $RelatedDepartment   = $num[2];    //'RelatedDep';
   $WorkOrderNo         = 'NA';    //'WO_TEMP';
   $WorkOrderCategory       = $num[3];  
   $WorkOrderSubCategory    = $num[4];  // Placeholder value
   $WorkOrderSubCategory2   = $num[5]; // Placeholder value
   $WoDepartment            = $num[6];      //YourDepartment';
   $CreatedDateTime     = $num[7];
   $CreatedUser         = $num[8];
   $AllocatedUser       = ''; // Placeholder value
   $McCategory          = $num[9];
   $MachineNo           = $num[10];
   $ValueAdd            = $num[11];
   $CreatedFaultType    = $num[12];
   $CreatedFaultLevel1  = $num[13];
   $CreatedFaultLevel2  = ''; // Placeholder value
   $CreatedFaultLevel3  = ''; // Placeholder value
   $CreatedFaultLevel4  = ''; // Placeholder value
   $RespondDateTime     = $num[7];
   $RespondUser         = ''; // Placeholder value
   $ClosedDateTime      = $num[7];
   $ClosedUser          = ''; // Placeholder value
   $ClosedFaultType     = ''; // Placeholder value
   $ClosedFaultLevel1   = ''; // Placeholder value
   $ClosedFaultLevel2   = ''; // Placeholder value
   $ClosedFaultLevel3   = ''; // Placeholder value
   $ClosedFaultLevel4   = ''; // Placeholder value
   $VerifiedDateTime    = $num[7];
   $VerifiedUser        = ''; // Placeholder value
   $ReOpenedDateTime    = $num[7];
   $ReOpenedUser        = ''; // Placeholder value
   $WoDescription       = $num[14];
   $WoEventLog          = $num[15];
   $Shift               = $num[16];
   $WoStatus            = $num[17];
   $WoVerify            = $num[18];
   $WoReOpen            = $num[19];
   $AlertSentState      = $num[20];
   $EmailSentState      = $num[21];
   $State               = $num[22];
   
   //----------- Declare Variables -----------------------    
    $Status_ary     = array();
    $ReturnData_ary = array();
    $ReturnData_ary[0]  = "NA";      
    //UPDATE tblprod_setting SET ID=?,WorkCenterNo=?,WorkCenterName=?,StyleNo=?,LowerValue=?,UpperValue=?,SMV=?,LowerColor=?,MiddleColor=?,UpperColor=?,State=? WHERE ID=?
    try
    {
        $stmt2 = $conn->prepare("SELECT ID FROM tblwo_event ORDER BY ID DESC LIMIT 1");
        $stmt2->execute();
        $lastID = $stmt2->fetchColumn();
        if ($lastID !== false) 
        {
            // Increment the last ID and format it as "WO_00000001"
            $WorkOrderNo = sprintf("WO_%08d", $lastID + 1);
        }
    } 
    catch (Exception $ex) 
    {
        $Status_ary[0] = "false";
        $Status_ary[1] = 'Error Msg: ' .$ex->getMessage(); 
    } 
    //------------------- Insert Data to WO ---------------------------------
    try 
    {
        $stmt = $conn->prepare("INSERT INTO tblwo_event(ServerDateTime, FactoryCode, Unit, RelatedDepartment, WorkOrderNo, WorkOrderCategory, WorkOrderSubCategory, WorkOrderSubCategory2, WoDepartment, CreatedDateTime, CreatedUser, AllocatedUser, McCategory, MachineNo, ValueAdd, CreatedFaultType, CreatedFaultLevel1, CreatedFaultLevel2, CreatedFaultLevel3, CreatedFaultLevel4, RespondDateTime, RespondUser, ClosedDateTime, ClosedUser, ClosedFaultType, ClosedFaultLevel1, ClosedFaultLevel2, ClosedFaultLevel3, ClosedFaultLevel4, VerifiedDateTime, VerifiedUser, ReOpenedDateTime, ReOpenedUser, WoDescription, WoEventLog, Shift, WoStatus, WoVerify, WoReOpen, AlertSentState, EmailSentState, State) 
                                VALUES (:svrdt, :faccod, :unit, :reldep, :wono, :wocat, :wosubcat, :wosubcat2, :wodep, :credt, :creusr, :alocusr, :mccat, :mcno, :valadd, :creflttyp, :crefltlvl1, :crefltlvl2, :crefltlvl3, :crefltlvl4, :respdt, :respusr, :closdt, :closusr, :clsflttyp, :clsfltlvl1, :clsfltlvl2, :clsfltlvl3, :clsfltlvl4, :veridt, :veryusr, :reopendt, :reopenusr, :wodescrip, :woevntlog, :shft, :wostats, :woveri, :woreopn, :altsntst, :emlsntst, :stat)");

        $stmt->bindParam(':svrdt', $strServerDateTime);
        $stmt->bindParam(':faccod', $FactoryCode);
        $stmt->bindParam(':unit', $Unit);
        $stmt->bindParam(':reldep', $RelatedDepartment);
        $stmt->bindParam(':wono', $WorkOrderNo);
        $stmt->bindParam(':wocat', $WorkOrderCategory);
        $stmt->bindParam(':wosubcat', $WorkOrderSubCategory);
        $stmt->bindParam(':wosubcat2', $WorkOrderSubCategory2);
        $stmt->bindParam(':wodep', $WoDepartment);
        $stmt->bindParam(':credt', $CreatedDateTime);
        $stmt->bindParam(':creusr', $CreatedUser);
        $stmt->bindParam(':alocusr', $AllocatedUser);
        $stmt->bindParam(':mccat', $McCategory);
        $stmt->bindParam(':mcno', $MachineNo);
        $stmt->bindParam(':valadd', $ValueAdd);                
        $stmt->bindParam(':creflttyp', $CreatedFaultType);
        $stmt->bindParam(':crefltlvl1', $CreatedFaultLevel1);
        $stmt->bindParam(':crefltlvl2', $CreatedFaultLevel2);
        $stmt->bindParam(':crefltlvl3', $CreatedFaultLevel3);
        $stmt->bindParam(':crefltlvl4', $CreatedFaultLevel4);
        $stmt->bindParam(':respdt', $RespondDateTime);
        $stmt->bindParam(':respusr', $RespondUser);
        $stmt->bindParam(':closdt', $ClosedDateTime);
        $stmt->bindParam(':closusr', $ClosedUser);
        $stmt->bindParam(':clsflttyp', $ClosedFaultType);
        $stmt->bindParam(':clsfltlvl1', $ClosedFaultLevel1);
        $stmt->bindParam(':clsfltlvl2', $ClosedFaultLevel2);
        $stmt->bindParam(':clsfltlvl3', $ClosedFaultLevel3);
        $stmt->bindParam(':clsfltlvl4', $ClosedFaultLevel4);
        $stmt->bindParam(':veridt', $VerifiedDateTime);
        $stmt->bindParam(':veryusr', $VerifiedUser);
        $stmt->bindParam(':reopendt', $ReOpenedDateTime);
        $stmt->bindParam(':reopenusr', $ReOpenedUser);
        $stmt->bindParam(':wodescrip', $WoDescription);
        $stmt->bindParam(':woevntlog', $WoEventLog);
        $stmt->bindParam(':shft', $Shift);
        $stmt->bindParam(':wostats', $WoStatus);
        $stmt->bindParam(':woveri', $WoVerify);
        $stmt->bindParam(':woreopn', $WoReOpen);
        $stmt->bindParam(':altsntst', $AlertSentState);
        $stmt->bindParam(':emlsntst', $EmailSentState);
        $stmt->bindParam(':stat', $State);

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
        //$data[1] = "Dats Saved Successfully";   
    } 
    catch (PDOException $ex) 
    {
        $Status_ary[0] = "false";
        $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();         
    }
    $conn = null;
    
    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;        
    //print json_encode($error);
    print json_encode($data_ary); 
   // print json_encode($ProductQuantity_ary);
?>
