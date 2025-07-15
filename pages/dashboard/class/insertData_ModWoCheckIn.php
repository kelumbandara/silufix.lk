
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
    
    $strWorkOrderNo         = $num[0];    
    $strCheckInUser         = $num[1]; 
    $strCheckInDateTime     = $num[2];
    $strCheckOutDateTime    = $num[3];
    $strStatus              = "Active";      

    //----------- Declare Variables -----------------------    
    $Status_ary     = array();
    $ReturnData_ary = array();
    $ReturnData_ary[0]  = "NA";
    
    //--------------- Insert Data to Wo_Event -----------------------------    
    try 
    {   
        //------ Check WorkOrder State < 3 (If Workorder closed , can not verify) ------------------
        $checkStateStmt = $conn->prepare("SELECT State FROM tblwo_event WHERE WorkOrderNo = :wono");
        $checkStateStmt->bindParam(':wono', $strWorkOrderNo);
        $checkStateStmt->execute();
        $row = $checkStateStmt->fetch(PDO::FETCH_ASSOC);
        // Check if the State is less than 3
        if ($row['State'] < 3) 
        {
            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO tblwo_allcheckinusers (WorkOrderNo, CheckInUser, CheckInServerDateTime, CheckInUserDateTime, CheckOutServerDateTime, CheckOutUserDateTime, Status) VALUES (:wono, :chkinusr, :chkinsvrdtm, :chkindtm, :chkoutsvrdtm, :chkoutdtm, :stat)");

            // Bind parameters
            $stmt->bindParam(':wono', $strWorkOrderNo);
            $stmt->bindParam(':chkinusr', $strCheckInUser);
            $stmt->bindParam(':chkinsvrdtm', $strServerDateTime); // Server datetime for check-in
            $stmt->bindParam(':chkindtm', $strCheckInDateTime);
            $stmt->bindParam(':chkoutsvrdtm', $strServerDateTime); // Server datetime for check-out
            $stmt->bindParam(':chkoutdtm', $strCheckInDateTime);
            $stmt->bindParam(':stat', $strStatus);

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