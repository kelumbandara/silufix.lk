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
    
    if($strFuncType === "funGetData_PieChart1") //------------- funUpdateEventLog --------------------
    {
        $strStarDate    = $num[1];
        $strEndDate     = $num[2];
        $strDepartment  = $num[3];
        $strCategory    = $num[4];
        $strStatus      = $num[5];
         
        $whereClause = "WorkOrderCategory = 'BuildingMaintenance' AND State < 6 AND ClosedDateTime IS NOT NULL AND DATE(CreatedDateTime) BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND WorkOrderSubCategory = '" . $strCategory . "'";
        }  
        if ($strStatus !== "All") 
        {
            if ($strStatus === "Closed"){
                $whereClause .= " AND (WoStatus = 'Closed' OR WoStatus = 'Verified' OR WoStatus = 'Auto-Verified')";
            }
            else{
                $whereClause .= " AND WoStatus = '" . $strStatus . "'";
            }           
        } 
        try 
        {   
            $sqlString = "
                SELECT
                WorkOrderSubCategory, COUNT(*) AS Total_Count
                FROM 
                    tblwo_event 
                WHERE " . $whereClause." GROUP BY WorkOrderSubCategory";
           /* $sqlString = "
                SELECT 
                    COUNT(CASE WHEN WorkOrderSubCategory = 'Fabrication' THEN 1 END) AS Fabrication_Count,
                    COUNT(CASE WHEN WorkOrderSubCategory = 'Civil' THEN 1 END) AS Civil_Count,
                    COUNT(CASE WHEN WorkOrderSubCategory = 'Plumbing' THEN 1 END) AS Plumbingh_Count,
                    COUNT(CASE WHEN WorkOrderSubCategory = 'Other' THEN 1 END) AS Other_Count
                FROM 
                    tblwo_event
                WHERE " . $whereClause;*/
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            //$stmt = $conn->prepare("SELECT WorkOrderNo,CheckInUserDateTime,CheckOutUserDateTime FROM tblwo_allcheckinusers WHERE CheckInUser=:chkinusr");
            $stmt = $conn->prepare($sqlString);
            $stmt->bindParam(':sdate', $strStarDate); 
            $stmt->bindParam(':edate', $strEndDate); 
             
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            $i = 0;
            foreach($result as $row)
            {   
                $ReturnData_ary[0][$i] = $row['WorkOrderSubCategory'];
                $ReturnData_ary[1][$i] = $row['Total_Count']; 
                               
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
                $Status_ary[1] = $sqlString;            //"Data Available"; 
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

    else if($strFuncType === "funGetData_PieChart2") //------------- funUpdateEventLog --------------------
    {
        
        $strStarDate       = $num[1];
        $strEndDate        = $num[2];
        $strDepartment  = $num[3];
        $strCategory    = $num[4];
        $strStatus      = $num[5];
         
        $whereClause = "WorkOrderCategory = 'BuildingMaintenance' AND State < 6 AND ClosedDateTime IS NOT NULL AND DATE(CreatedDateTime) BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND WorkOrderSubCategory = '" . $strCategory . "'";
        }  
        if ($strStatus !== "All") 
        {
            if ($strStatus === "Closed"){
                $whereClause .= " AND (WoStatus = 'Closed' OR WoStatus = 'Verified' OR WoStatus = 'Auto-Verified')";
            }
            else{
                $whereClause .= " AND WoStatus = '" . $strStatus . "'";
            }           
        }
        
        try 
        {    
            $sqlString = "
                SELECT 
                COUNT(CASE WHEN (WoStatus = 'Closed' OR WoStatus = 'Verified' OR WoStatus = 'Auto-Verified') THEN 1 END) AS Completed_Count,
                COUNT(CASE WHEN (WoStatus = 'New' OR WoStatus = 'Inprogress') THEN 1 END) AS Pending_Count
            FROM 
                 tblwo_event
            WHERE " . $whereClause;
       
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            //$stmt = $conn->prepare("SELECT WorkOrderNo,CheckInUserDateTime,CheckOutUserDateTime FROM tblwo_allcheckinusers WHERE CheckInUser=:chkinusr");
            $stmt = $conn->prepare($sqlString);
            $stmt->bindParam(':sdate', $strStarDate); 
            $stmt->bindParam(':edate', $strEndDate); 
             
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            $i = 0;
            foreach($result as $row)
            {   
                $ReturnData_ary[0][0] = $row['Completed_Count'];
                $ReturnData_ary[0][1] = $row['Pending_Count']; 
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

    else if($strFuncType === "funGetData_BarChart1") //------------- funUpdateEventLog --------------------
    {
        $strStarDate2   = $num[1];
        $strEndDate2    = $num[2];
        $strDepartment  = $num[3];
        $strCategory    = $num[4];
        $strStatus      = $num[5];
         
        $whereClause = "WorkOrderCategory = 'BuildingMaintenance' AND State < 6 AND ClosedDateTime IS NOT NULL AND DATE(CreatedDateTime) BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND WorkOrderSubCategory = '" . $strCategory . "'";
        }  
        if ($strStatus !== "All") 
        {
            if ($strStatus === "Closed"){
                $whereClause .= " AND (WoStatus = 'Closed' OR WoStatus = 'Verified' OR WoStatus = 'Auto-Verified')";
            }
            else{
                $whereClause .= " AND WoStatus = '" . $strStatus . "'";
            }           
        }
        
        try 
        {            	 
            $sqlString = "
            SELECT 
                WoDepartment, COUNT(*) AS Total_Count 
             FROM 
                tblwo_event 
            WHERE " . $whereClause .  
                    
            " GROUP BY 
                WoDepartment;
                ";
           
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            //$stmt = $conn->prepare("SELECT WorkOrderNo,CheckInUserDateTime,CheckOutUserDateTime FROM tblwo_allcheckinusers WHERE CheckInUser=:chkinusr");
            $stmt = $conn->prepare($sqlString);
            $stmt->bindParam(':sdate', $strStarDate2); 
            $stmt->bindParam(':edate', $strEndDate2); 
             
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            $i = 0;
            foreach($result as $row)
            {   
                $ReturnData_ary[0][$i] = $row['WoDepartment'];
                $ReturnData_ary[1][$i] = $row['Total_Count']; 
                 
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
    //------------- Table data load --------------------
    else if($strFuncType === "funGetData_Table") 
    {
        $strStarDate3       = $num[1];
        $strEndDate3        = $num[2];
        $strDepartment      = $num[3];
        $strCategory        = $num[4];
        $strStatus          = $num[5];
                 
        $whereClause = "wo.WorkOrderCategory = 'BuildingMaintenance' AND State < 6 AND wo.ClosedDateTime IS NOT NULL AND DATE(wo.CreatedDateTime) BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND wo.WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND wo.WorkOrderSubCategory = '" . $strCategory . "'";
        }          
        if ($strStatus !== "All") 
        {
            if ($strStatus === "Closed") {
                $whereClause .= " AND (wo.WoStatus = 'Closed' OR wo.WoStatus = 'Verified' OR wo.WoStatus = 'Auto-Verified')";
            }
            else{
                $whereClause .= " AND wo.WoStatus = '" . $strStatus . "'";
            }           
        }
        
        try 
        { 
            $sqlString = "
                SELECT             
                    wo.WorkOrderNo,
                    wo.WorkOrderCategory,
                    wo.WorkOrderSubCategory,
                    wo.WoDepartment,
                    wo.CreatedDateTime,
                    wo.CreatedUser,
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
                $ReturnData_ary[$i][1] = $row['WorkOrderCategory'];
                $ReturnData_ary[$i][2] = $row['WorkOrderSubCategory']; 
                $ReturnData_ary[$i][3] = $row['WoDepartment']; 
                $ReturnData_ary[$i][4] = $row['CreatedDateTime']; 
                $ReturnData_ary[$i][5] = $row['CreatedUser']; 
                
                $ReturnData_ary[$i][6] = $row['WoDescription']; 
                $ReturnData_ary[$i][7] = $row['WoStatus'];                
                $ReturnData_ary[$i][8] = $row['RespondDateTime'];   
                
                $ReturnData_ary[$i][9] = $row['AllocatedUsers'];                
                $ReturnData_ary[$i][10] = $row['CheckInUsers'];
                
                $ReturnData_ary[$i][11] = $row['ClosedDateTime'];                
                $ReturnData_ary[$i][12] = $row['ClosedUser'];                 
                $ReturnData_ary[$i][13] = number_format($row['TotTimeDuration']/ 60, 1) ;                 
                $ReturnData_ary[$i][14] = $row['ReOpenedDateTime']; 
                $ReturnData_ary[$i][15] = $row['ReOpenedUser']; 
                $ReturnData_ary[$i][16] = $row['VerifiedDateTime']; 
                $ReturnData_ary[$i][17] = $row['VerifiedUser'];
                               
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

    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
        
    //print json_encode($error);
    print json_encode($data_ary); 

?>
