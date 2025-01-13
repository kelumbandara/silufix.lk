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

   $site            = $num[6];      //YourDepartment';
   $building     = $num[7];
   $issuer_type         = $num[8];
   $isuer_description   = $num[9];
   $Issue_Description2  = $num[10];

   $Note            = "";
   $CreatedDateTime    = $num[11];
   $CreatedDepartment  = $num[12];
   $CreatedUser  = $num[13];
   $PlannedDateTime  = $num[14];
   $AllocatedUser  = ''; // Placeholder value
   $StartedDateTime     = $num[15];
   $StartedUser         = ''; // Placeholder value
   $CloseDateTime      = $num[16];
   $ClosedUser          = ''; // Placeholder value
   $FaultType     = ''; // Placeholder value
   $UsedSpairParts   = ''; // Placeholder value
   $Remark   = ''; // Placeholder value
   $VerifiedDateTime   = $num[17];
   $VerifiedUser   = ''; // Placeholder value
   $WoDescription    = "";
   $WoEventLog          = $num[18];
   $Shift               = $num[19];
   $WoStatus            = $num[20];
   $AlertSentState            = "";
   $Attachment            = "";
   $State      = $num[21];
   
   
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
        if($WorkOrderCategory == "BreakDown")
        {
            // Check if WoStatus is not "New" or "Inprogress" for the given MachineNo
            $sql = "SELECT COUNT(*) AS count 
                    FROM tblwo_event 
                    WHERE MachineNo = :mcno 
                        AND WoStatus IN ('New', 'Inprogress')
                        AND WorkOrderCategory = 'BreakDown'";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':mcno', $MachineNo);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row['count'] != 0) 
            {
                // WoStatus is either "New" or "Inprogress", no need to insert
                //echo "No need to insert record as WoStatus is either 'New' or 'Inprogress' for the given MachineNo.";
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data Alraedy Inserted"; 
            }
            else
            { echo("hi");
                // WoStatus is not "New" or "Inprogress", proceed with insertion
                $stmt = $conn->prepare("INSERT INTO tblwo_event(ServerDateTime, FactoryCode, Unit, RelatedDepartment, WorkOrderNo, WorkOrderCategory, WorkOrderSubCategory, WorkOrderSubCategory2, Site, Building, IssueType, IssueDescription1, Issue_Description2, Note, CreatedDateTime, CreatedDepartment, CreatedUser, PlannedDateTime, AllocatedUser, StartedDateTime, StartedUser, CloseDateTime, ClosedUser, FaultType, UsedSpairParts, Remark, VerifiedDateTime, VerifiedUser, WoDescription, WoEventLog, Shift, WoStatus, AlertSentState, Attachment, State) 
                        VALUES (:svrdt, :faccod, :unit, :reldep, :wono, :wocat, :wosubcat, :wosubcat2, :site, :bldg, :issuetype, :issuedesc1, :issuedesc2, :note, :credt, :credep, :creusr, :plndt, :alocusr, :stddt, :stdusr, :clsdt, :clsusr, :fltType, :spairparts, :remark, :veridt, :verusr, :wodescrip, :woevntlog, :shft, :wostats, :altsntst, :attach, :stat)");
                        // Bind parameters
                    $stmt->bindParam(':svrdt', $strServerDateTime);
                    $stmt->bindParam(':faccod', $FactoryCode);
                    $stmt->bindParam(':unit', $Unit);
                    $stmt->bindParam(':reldep', $RelatedDepartment);
                    $stmt->bindParam(':wono', $WorkOrderNo);
                    $stmt->bindParam(':wocat', $WorkOrderCategory);
                    $stmt->bindParam(':wosubcat', $WorkOrderSubCategory);
                    $stmt->bindParam(':wosubcat2', $WorkOrderSubCategory2);
                    $stmt->bindParam(':site', $site);
                    $stmt->bindParam(':bldg', $building);
                    $stmt->bindParam(':issuetype', $issuer_type);
                    $stmt->bindParam(':issuedesc1', $isuer_description);
                    $stmt->bindParam(':issuedesc2', $Issue_Description2);
                    $stmt->bindParam(':note', $Note);
                    $stmt->bindParam(':credt', $CreatedDateTime);
                    $stmt->bindParam(':credep', $CreatedDepartment);
                    $stmt->bindParam(':creusr', $CreatedUser);
                    $stmt->bindParam(':plndt', $PlannedDateTime);
                    $stmt->bindParam(':alocusr', $AllocatedUser);
                    $stmt->bindParam(':stddt', $StartedDateTime);
                    $stmt->bindParam(':stdusr', $StartedUser);
                    $stmt->bindParam(':clsdt', $CloseDateTime);
                    $stmt->bindParam(':clsusr', $ClosedUser);
                    $stmt->bindParam(':fltType', $FaultType);
                    $stmt->bindParam(':spairparts', $UsedSpairParts);
                    $stmt->bindParam(':remark', $Remark);
                    $stmt->bindParam(':veridt', $VerifiedDateTime);
                    $stmt->bindParam(':verusr', $VerifiedUser);
                    $stmt->bindParam(':wodescrip', $WoDescription);
                    $stmt->bindParam(':woevntlog', $WoEventLog);
                    $stmt->bindParam(':shft', $Shift);
                    $stmt->bindParam(':wostats', $WoStatus);
                    $stmt->bindParam(':altsntst', $AlertSentState);
                    $stmt->bindParam(':attach', $Attachment);
                    $stmt->bindParam(':stat', $State);

                // Execute the insertion query
                $stmt->execute();
                //echo "Record inserted successfully.";
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
        }
        else
        {
            $stmt = $conn->prepare("INSERT INTO tblwo_event(ServerDateTime, FactoryCode, Unit, RelatedDepartment, WorkOrderNo, WorkOrderCategory, WorkOrderSubCategory, WorkOrderSubCategory2, Site, Building, IssueType, IssueDescription1, Issue_Description2, Note, CreatedDateTime, CreatedDepartment, CreatedUser, PlannedDateTime, AllocatedUser, StartedDateTime, StartedUser, CloseDateTime, ClosedUser, FaultType, UsedSpairParts, Remark, VerifiedDateTime, VerifiedUser, WoDescription, WoEventLog, Shift, WoStatus, AlertSentState, Attachment, State) 
                        VALUES (:svrdt, :faccod, :unit, :reldep, :wono, :wocat, :wosubcat, :wosubcat2, :site, :bldg, :issuetype, :issuedesc1, :issuedesc2, :note, :credt, :credep, :creusr, :plndt, :alocusr, :stddt, :stdusr, :clsdt, :clsusr, :fltType, :spairparts, :remark, :veridt, :verusr, :wodescrip, :woevntlog, :shft, :wostats, :altsntst, :attach, :stat)");
                        // Bind parameters
                    $stmt->bindParam(':svrdt', $strServerDateTime);
                    $stmt->bindParam(':faccod', $FactoryCode);
                    $stmt->bindParam(':unit', $Unit);
                    $stmt->bindParam(':reldep', $RelatedDepartment);
                    $stmt->bindParam(':wono', $WorkOrderNo);
                    $stmt->bindParam(':wocat', $WorkOrderCategory);
                    $stmt->bindParam(':wosubcat', $WorkOrderSubCategory);
                    $stmt->bindParam(':wosubcat2', $WorkOrderSubCategory2);
                    $stmt->bindParam(':site', $site);
                    $stmt->bindParam(':bldg', $building);
                    $stmt->bindParam(':issuetype', $issuer_type);
                    $stmt->bindParam(':issuedesc1', $isuer_description);
                    $stmt->bindParam(':issuedesc2', $Issue_Description2);
                    $stmt->bindParam(':note', $Note);
                    $stmt->bindParam(':credt', $CreatedDateTime);
                    $stmt->bindParam(':credep', $CreatedDepartment);
                    $stmt->bindParam(':creusr', $CreatedUser);
                    $stmt->bindParam(':plndt', $PlannedDateTime);
                    $stmt->bindParam(':alocusr', $AllocatedUser);
                    $stmt->bindParam(':stddt', $StartedDateTime);
                    $stmt->bindParam(':stdusr', $StartedUser);
                    $stmt->bindParam(':clsdt', $CloseDateTime);
                    $stmt->bindParam(':clsusr', $ClosedUser);
                    $stmt->bindParam(':fltType', $FaultType);
                    $stmt->bindParam(':spairparts', $UsedSpairParts);
                    $stmt->bindParam(':remark', $Remark);
                    $stmt->bindParam(':veridt', $VerifiedDateTime);
                    $stmt->bindParam(':verusr', $VerifiedUser);
                    $stmt->bindParam(':wodescrip', $WoDescription);
                    $stmt->bindParam(':woevntlog', $WoEventLog);
                    $stmt->bindParam(':shft', $Shift);
                    $stmt->bindParam(':wostats', $WoStatus);
                    $stmt->bindParam(':altsntst', $AlertSentState);
                    $stmt->bindParam(':attach', $Attachment);
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
