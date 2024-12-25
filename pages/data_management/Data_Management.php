<?php

    session_start();
    require_once('../../initialize.php');
    require_once('../../config.php');
    
    $num = $_POST["userpara"];
    
    $strFuncType = $num[0];    
    //$strFuncType = "funGetData_Table";
      
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strServerDateTime = date("Y-m-d H:i:s");    
    //----------- Declare Variables -----------------------  
    $i = 0; 
    $j = 0;     
    $Status_ary     = array();
    $ReturnData_ary = array();
    //$ReturnData_ary[0][0]  = "NA";
    $strText    = "";
    $ReturnData_ary[0][0] = "NA"; 
    //$ReturnData_ary[0][1] = "NA";
    //$ReturnData_ary[1][0] = "NA"; 
    //$ReturnData_ary[1][1] = "NA";
    
    $intWoState = 4;
        
    //------------- Delete Record --------------------
    if($strFuncType === "funDelete_Record") 
    {
        $strWorkOrderNo     = $num[1];       
                  
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
            $stmt = $conn->prepare("UPDATE tblwo_event SET WoStatus = 'Clear',State = 9 WHERE WorkOrderNo=:wono");
            $stmt->bindParam(':wono', $strWorkOrderNo); 
            //$stmt->bindParam(':usrtp', $strUserType); 
            $stmt->execute();

            $Status_ary[0] = "true";
            $Status_ary[1] = "Update Success."; 
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }  
        $conn = null;
    }
    else if($strFuncType === "funChange_Record") 
    {
        $strWorkOrderNo     = $num[1];       
        $strNewCategory     = $num[2];           
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
            $stmt = $conn->prepare("UPDATE tblwo_event SET WorkOrderCategory =:wocat WHERE WorkOrderNo=:wono");
            $stmt->bindParam(':wono', $strWorkOrderNo); 
            $stmt->bindParam(':wocat', $strNewCategory); 
            $stmt->execute();

            $Status_ary[0] = "true";
            $Status_ary[1] = "Update Success."; 
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }  
        $conn = null;
    }
    else if($strFuncType === "funGetData_Table") 
    {
        $strStarDate3       = $num[1];
        $strEndDate3        = $num[2];
        $strDepartment      = $num[3];
        $strCategory        = $num[4];
       
        //$strStarDate3       = '2024-08-05';
        //$strEndDate3        = '2024-08-06';
        //$strDepartment      = 'All';
        //$strCategory        = 'All';
                 
            
        $whereClause = "State < 6 AND wo.ClosedDateTime IS NOT NULL AND wo.CreatedDateTime BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND wo.WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND wo.WorkOrderCategory = '" . $strCategory . "'";
        }          
               
        try 
        { 
            /*
            $sqlString = "
                SELECT             
                    wo.WorkOrderNo,
                    wo.WorkOrderCategory,
                    wo.WorkOrderSubCategory,
                    wo.WoDepartment,
                    wo.CreatedDateTime,
                    wo.CreatedUser,  
                    wo.McCategory,	
                    wo.MachineNo,
                    wo.RespondDateTime,
                    wo.ClosedDateTime,
                    wo.ClosedUser,
                    TIMESTAMPDIFF(MINUTE, wo.CreatedDateTime, wo.ClosedDateTime) as TotTimeDuration,
                    wo.VerifiedDateTime,
                    wo.VerifiedUser,                    
                    wo.ReOpenedDateTime,
                    wo.ReOpenedUser,
                    wo.WoDescription,
                    wo.WoStatus,
                    (
                        SELECT GROUP_CONCAT(DISTINCT ua.EmpName SEPARATOR ', ') 
                        FROM tblwo_allocatedusers AS acu
                        LEFT JOIN tblusers_account AS ua ON acu.AllocatedUser = ua.EPF
                        WHERE acu.WorkOrderNo = wo.WorkOrderNo
                    ) AS AllocatedUsers,
                    (
                        SELECT GROUP_CONCAT(DISTINCT ua.EmpName SEPARATOR ', ') 
                        FROM tblwo_allcheckinusers AS ciu
                        LEFT JOIN tblusers_account AS ua ON ciu.CheckInUser = ua.EPF
                        WHERE ciu.WorkOrderNo = wo.WorkOrderNo
                    ) AS CheckInUsers
                FROM 
                    tblwo_event as wo
                WHERE " . $whereClause;
            */
            $sqlString = "
                SELECT             
                    wo.WorkOrderNo,
                    wo.WorkOrderCategory,
                    wo.WorkOrderSubCategory,
                    wo.WoDepartment,
                    wo.CreatedDateTime,
                    wo.CreatedUser,  
                    wo.McCategory,	
                    wo.MachineNo,
                    wo.RespondDateTime,
                    wo.ClosedDateTime,
                    wo.ClosedUser,
                    TIMESTAMPDIFF(MINUTE, wo.CreatedDateTime, wo.ClosedDateTime) as TotTimeDuration,
                    wo.VerifiedDateTime,
                    wo.VerifiedUser,                    
                    wo.ReOpenedDateTime,
                    wo.ReOpenedUser,
                    wo.WoDescription,
                    wo.WoStatus,
                    (
                        SELECT GROUP_CONCAT(DISTINCT ua.EmpName SEPARATOR ', ') 
                        FROM tblwo_allocatedusers AS acu
                        LEFT JOIN tblusers_account AS ua ON acu.AllocatedUser = ua.EPF
                        WHERE acu.WorkOrderNo = wo.WorkOrderNo
                    ) AS AllocatedUsers,
                    (
                        SELECT GROUP_CONCAT(DISTINCT ua.EmpName SEPARATOR ', ') 
                        FROM tblwo_allcheckinusers AS ciu
                        LEFT JOIN tblusers_account AS ua ON ciu.CheckInUser = ua.EPF
                        WHERE ciu.WorkOrderNo = wo.WorkOrderNo
                    ) AS CheckInUsers,
                    (
                        SELECT GROUP_CONCAT(CONCAT(ch.ChatMessage) SEPARATOR ' , ') 
                        FROM tblwo_chathistory AS ch 
                        WHERE ch.WorkOrderNo = wo.WorkOrderNo
                    ) AS ChatHistory
                FROM 
                    tblwo_event as wo
                WHERE " . $whereClause;
                    
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $stmt = $conn->prepare($sqlString);
            $stmt->bindParam(':sdate', $strStarDate3); 
            $stmt->bindParam(':edate', $strEndDate3);
            
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            $i = 0;
            foreach($result as $row)
            {
                $ReturnData_ary[$i][0] = $row['WorkOrderNo'];
                $ReturnData_ary[$i][1] = $row['CreatedDateTime']; 
                $ReturnData_ary[$i][2] = $row['WoDepartment'];                 
                $ReturnData_ary[$i][3] = $row['WorkOrderCategory'];
                $ReturnData_ary[$i][4] = $row['WorkOrderSubCategory']; 
                //$ReturnData_ary[$i][5] = $row['WoDescription'];                
                $cleanedString = preg_replace('/[^\w\s,]/', '', $row['WoDescription']);
                $ReturnData_ary[$i][5] = explode(',', $cleanedString);
    
                $ReturnData_ary[$i][6] = $row['WoStatus'];                 
                $ReturnData_ary[$i][7] = $row['CreatedUser']; 
                $ReturnData_ary[$i][8] = $row['McCategory']; 
                $ReturnData_ary[$i][9] = $row['MachineNo']; 
                $ReturnData_ary[$i][10] = $row['RespondDateTime'];   
                $ReturnData_ary[$i][11] = $row['AllocatedUsers'];                
                $ReturnData_ary[$i][12] = $row['CheckInUsers'];
                $ReturnData_ary[$i][13] = $row['ClosedDateTime'];                
                $ReturnData_ary[$i][14] = $row['ClosedUser'];                 
                $ReturnData_ary[$i][15] = $row['TotTimeDuration'];                 
                $ReturnData_ary[$i][16] = $row['ReOpenedDateTime']; 
                $ReturnData_ary[$i][17] = $row['ReOpenedUser']; 
                $ReturnData_ary[$i][18] = $row['VerifiedDateTime']; 
                $ReturnData_ary[$i][19] = $row['VerifiedUser'];
                //$ReturnData_ary[$i][20] = $row['ChatHistory'];
                
                $cleanedString2 = preg_replace('/[^\w\s,]/', '', $row['ChatHistory']);
                $ReturnData_ary[$i][20] = explode(',', $cleanedString2);
                
                $i++;
            }  
            if($i === 0)    // No Data
            {
                $ReturnData_ary[0] = $strText;
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not found"; 
            }
            else
            {
                //$ReturnData_ary[0] = $strText;
                $Status_ary[0] = "true";
                $Status_ary[1] = "Data Available"; 
            } 
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "error";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }   
    //print_r($ReturnData_ary);
   
    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
        
    //print json_encode($error);
    print json_encode($data_ary); 

?>
