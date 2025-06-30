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
         
        $whereClause = "WorkOrderCategory = 'Service' AND State < 6 AND ClosedDateTime IS NOT NULL AND DATE(CreatedDateTime) BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND CreatedDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND TypeOfService= '" . $strCategory . "'";
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
            $sqlString = "SELECT 
                    ServiceSection, 
                    COUNT(*) AS TotalCount
                FROM 
                    tblwo_event
                WHERE " . $whereClause . " GROUP BY ServiceSection";            
           
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            //$stmt = $conn->prepare("SELECT WorkOrderNo,CheckInUserDateTime,CheckOutUserDateTime FROM tblwo_allcheckinusers WHERE CheckInUser=:chkinusr");
            $stmt = $conn->prepare($sqlString);
            $stmt->bindParam(':sdate', $strStarDate); 
            $stmt->bindParam(':edate', $strEndDate);              
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            $i = 0;
            
            foreach($result as $row)
            {   
                $ReturnData_ary[0][$i] = $row['ServiceSection']; 
                $ReturnData_ary[1][$i] = $row['TotalCount']; 
                                          
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

    else if($strFuncType === "funGetData_PieChart2") //------------- funUpdateEventLog --------------------
    {
        
        $strStarDate       = $num[1];
        $strEndDate        = $num[2];
        $strDepartment  = $num[3];
        $strCategory    = $num[4];
        $strStatus      = $num[5];
         
        $whereClause = "WorkOrderCategory = 'Service' AND State < 6 AND ClosedDateTime IS NOT NULL AND DATE(CreatedDateTime) BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND CreatedDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND TypeOfService= '" . $strCategory . "'";
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
         
        $whereClause = "WorkOrderCategory = 'Service' AND State < 6 AND ClosedDateTime IS NOT NULL AND DATE(CreatedDateTime) BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND CreatedDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND TypeOfService= '" . $strCategory . "'";
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
            /*
            $sqlString = "
                SELECT 
                    CreatedDepartment,
                    COUNT(CASE WHEN WorkOrderSubCategory = 'Safety' THEN 1 END) AS Safety_Count,
                    COUNT(CASE WHEN WorkOrderSubCategory = 'Leakages' THEN 1 END) AS Leakages_Count,
                    COUNT(CASE WHEN WorkOrderSubCategory = 'Worn Out or Broken Part' THEN 1 END) AS Worn_Out_or_Broken_Part_Count,
                    COUNT(CASE WHEN WorkOrderSubCategory = 'Unusual Vibration/Heat' THEN 1 END) AS Unusual_Vibration_Heat_Count,
                    COUNT(CASE WHEN WorkOrderSubCategory = 'Hard to Clean Area' THEN 1 END) AS Hard_to_Clean_Area_Count,
                    COUNT(CASE WHEN WorkOrderSubCategory = 'Other' THEN 1 END) AS Other_Count
                FROM 
                    tblwo_event 
                WHERE " . $whereClause . 
                " GROUP BY 
                    CreatedDepartment;";
            */
            $sqlString = "
                SELECT 
                    CreatedDepartment, 
                    COUNT(*) AS TotalCount
                FROM 
                    tblwo_event
                WHERE " . $whereClause . " GROUP BY CreatedDepartment";


            // echo $sqlString;
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
                $ReturnData_ary[0][$i] = $row['CreatedDepartment'];
                $ReturnData_ary[1][$i] = $row['TotalCount']; 
                              
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
    else if($strFuncType === "funGetData_BarChart2") //------------- funUpdateEventLog --------------------
    {
        $strStarDate2   = $num[1];
        $strEndDate2    = $num[2];
        $strDepartment  = $num[3];
        $strCategory    = $num[4];
        $strStatus      = $num[5];
         
        $whereClause = "WorkOrderCategory = 'Service' AND State < 6 AND ClosedDateTime IS NOT NULL AND DATE(CreatedDateTime) BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND CreatedDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND TypeOfService= '" . $strCategory . "'";
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
                 Location,
                    COUNT(CASE WHEN Site = 'site 1' THEN 1 END) AS Site1_Count,
                    COUNT(CASE WHEN Site = 'site 2' THEN 1 END) AS Site2_Count,
                    COUNT(CASE WHEN Site = 'site 3' THEN 1 END) AS Site3_Count,
                    COUNT(CASE WHEN Site = 'site 4' THEN 1 END) AS Site4_Count,
                    COUNT(CASE WHEN Site = 'site 5' THEN 1 END) AS Site5_Count
                FROM 
                    tblwo_event 
                WHERE " . $whereClause . 
                " GROUP BY 
                    Location;";            
            
            // echo $sqlString;
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
                $ReturnData_ary[0][$i] = $row['Location'];
                $ReturnData_ary[1][$i] = $row['Site1_Count']; 
                $ReturnData_ary[2][$i] = $row['Site2_Count']; 
                $ReturnData_ary[3][$i] = $row['Site3_Count']; 
                $ReturnData_ary[4][$i] = $row['Site4_Count']; 
                $ReturnData_ary[5][$i] = $row['Site5_Count'];                 
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
        
        $whereClause = "wo.WorkOrderCategory = 'Service' AND State < 6 AND wo.ClosedDateTime IS NOT NULL AND DATE(wo.CreatedDateTime) BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND wo.CreatedDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND TypeOfService= '" . $strCategory . "'";
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
                     wo.CreatedDateTime,
                    wo.CreatedDepartment,               
                    wo.Site,
                    wo.Location,
                    wo.Building,
                    wo.IssueType,
                    wo.IssueDescriptionMain,
                    wo.WoStatus,
                    wo.CreatedUser,
                    wo.RespondDateTime,                    
                    wo.ClosedDateTime,
                    wo.ClosedUser,                    
                    TIMESTAMPDIFF(MINUTE, wo.CreatedDateTime, wo.ClosedDateTime) as TotTimeDuration,                    
                    wo.ReOpenedDateTime,
                    wo.ReOpenedUser,
                    wo.VerifiedDateTime,
                    wo.VerifiedUser,                    
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
                $ReturnData_ary[$i][1] = $row['CreatedDateTime']; 
                $ReturnData_ary[$i][2] = $row['CreatedDepartment']; 
                $ReturnData_ary[$i][3] = $row['Site']; 
                $ReturnData_ary[$i][4] = $row['Location'];
                $ReturnData_ary[$i][5] = $row['Building'];
                $ReturnData_ary[$i][6] = $row['IssueType'];
                $ReturnData_ary[$i][7] = $row['IssueDescriptionMain']; 
                $ReturnData_ary[$i][8] = $row['WoStatus'];    
                $ReturnData_ary[$i][9] = $row['CreatedUser'];
                $ReturnData_ary[$i][10] = $row['RespondDateTime']; 
                $ReturnData_ary[$i][11] = $row['AllocatedUsers'];                
                $ReturnData_ary[$i][12] = $row['CheckInUsers'];                
                $ReturnData_ary[$i][13] = $row['ClosedDateTime'];                
                $ReturnData_ary[$i][14] = $row['ClosedUser'];   
                $ReturnData_ary[$i][15] = number_format($row['TotTimeDuration']/ 60, 1) ;
                $ReturnData_ary[$i][16] = $row['ReOpenedDateTime']; 
                $ReturnData_ary[$i][17] = $row['ReOpenedUser']; 
                $ReturnData_ary[$i][18] = $row['VerifiedDateTime']; 
                $ReturnData_ary[$i][19] = $row['VerifiedUser'];
                                              
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
