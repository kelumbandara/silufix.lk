<?php

    session_start();
    require_once('../../initialize.php');
    require_once('../../config.php');
    
    $num = $_POST["userpara"];
    
    $strFuncType = $num[0];    
    //$strFuncType = "funGetData_BarChart1";
      
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
    
    if($strFuncType === "funGetData_PieChart1") {
        $strStartDate    = $num[1];
        $strEndDate      = $num[2];
        $strDepartment   = $num[3];
        $strCategory     = $num[4];
        $strMechanic     = $num[5];
        
        $whereClause = "wo.ClosedDateTime IS NOT NULL AND wo.CreatedDateTime BETWEEN :sdate AND :edate";
        
        if ($strDepartment !== "All") {
            $whereClause .= " AND wo.WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND wo.WorkOrderCategory = '" . $strCategory . "'";
        }
        if ($strMechanic !== "All") {
            $whereClause .= " AND ciu.CheckInUser ='" . $strMechanic . "'";
        }
        
        try {
            $sqlString = "
                SELECT 
                    CASE WHEN wo.WoStatus IN ('Auto-Verified', 'Verified') THEN 'Verified' ELSE wo.WoStatus END AS WoStatusGroup, 
                    COUNT(*) AS count 
                FROM 
                    tblwo_event AS wo
                    INNER JOIN tblwo_allcheckinusers AS ciu ON wo.WorkOrderNo = ciu.WorkOrderNo
                WHERE 
                    " . $whereClause . "
                GROUP BY 
                    WoStatusGroup";
    
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $stmt = $conn->prepare($sqlString);
            $stmt->bindParam(':sdate', $strStartDate); 
            $stmt->bindParam(':edate', $strEndDate); 
             
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $ReturnData_ary = array();
            $Status_ary = array();
    
            if (empty($result)) {
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not found";
            } else {
                foreach($result as $row) {
                    $ReturnData_ary[0][] = $row['WoStatusGroup'];
                    $ReturnData_ary[1][] = $row['count']; 
                }
                $Status_ary[0] = "true";
                $Status_ary[1] = "Data Available"; 
            } 
        } catch(PDOException $ex) {
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
        $strMechanic      = $num[5];
         
        $whereClause = "wo.ClosedDateTime IS NOT NULL AND wo.CreatedDateTime BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND wo.WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND wo.WorkOrderCategory = '" . $strCategory . "'";
        }  
        if ($strMechanic !== "All") 
        {
            
                $whereClause .= " AND ciu.CheckInUser ='" . $strMechanic . "'";
                      
        }
        
        try 
        {    
            $sqlString = "
            SELECT 
                wo.WorkOrderCategory, 
                SUM(CASE WHEN wo.WoStatus IN ('Auto-Verified', 'Verified') THEN 1 ELSE 0 END) AS verified_count 
            FROM 
                tblwo_event AS wo 
                INNER JOIN tblwo_allcheckinusers AS ciu ON wo.WorkOrderNo = ciu.WorkOrderNo
            WHERE " . $whereClause." GROUP BY wo.WorkOrderCategory";

                


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
                $ReturnData_ary[0][$i] = $row['WorkOrderCategory'];
                $ReturnData_ary[1][$i] = $row['verified_count']; 
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
        $strStartDate2   = $num[1];
        $strEndDate2     = $num[2];
        $strDepartment   = $num[3];
        $strCategory     = $num[4];
        $strMechanic     = $num[5];

        $whereClause = "wo.ClosedDateTime IS NOT NULL AND wo.CreatedDateTime BETWEEN :sdate AND :edate";

        if ($strDepartment !== "All") {
            $whereClause .= " AND wo.WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND wo.WorkOrderCategory = '" . $strCategory . "'";
        }
        if ($strMechanic !== "All") {
            // Assuming the table alias for tblwo_allcheckinusers is ciu
            $whereClause .= " AND ciu.CheckInUser = '" . $strMechanic . "'";
        }

        try {             
            $sqlString = "
                SELECT 
                    wo.WoDepartment,
                    SUM(CASE WHEN wo.WoStatus IN ('Auto-Verified', 'Verified') THEN 1 ELSE 0 END) AS close_count,
                    SUM(CASE WHEN wo.WoStatus = 'Inprogress' THEN 1 ELSE 0 END) AS inprogress_count
                FROM 
                    tblwo_event AS wo
                INNER JOIN 
                    tblwo_allcheckinusers AS ciu ON wo.WorkOrderNo = ciu.WorkOrderNo
                WHERE 
                    " . $whereClause . "
                GROUP BY 
                    wo.WoDepartment";

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            //$stmt = $conn->prepare("SELECT WorkOrderNo,CheckInUserDateTime,CheckOutUserDateTime FROM tblwo_allcheckinusers WHERE CheckInUser=:chkinusr");
            $stmt = $conn->prepare($sqlString);
            $stmt->bindParam(':sdate', $strStartDate2); 
            $stmt->bindParam(':edate', $strEndDate2); 
             
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            $i = 0;
            foreach($result as $row)
            {   
                $ReturnData_ary[0][$i] = $row['WoDepartment'];
                $ReturnData_ary[1][$i] = $row['close_count']; 
                $ReturnData_ary[2][$i] = $row['inprogress_count'];
                 
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
    else if($strFuncType === "funGetData_Table1") 

   
    {
        $strStarDate3       = $num[1];
        $strEndDate3        = $num[2];
        $strDepartment      = $num[3];
        $strCategory        = $num[4];
        $strMechanic          = $num[5];
        
        $whereClause = "wo.ClosedDateTime IS NOT NULL AND wo.CreatedDateTime BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND wo.WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND wo.WorkOrderCategory = '" . $strCategory . "'";
        }          
        if ($strMechanic !== "All") 
        {
            $whereClause .= " AND ciu.CheckInUser = '" . $strMechanic . "'";          
        }
        
        try 
        { 
            $sqlString = "
                SELECT             
                    wo.WorkOrderNo,
                    wo.McCategory,
                    wo.MachineNo,
                    wo.WoDepartment,
                    wo.WorkOrderCategory,
                    wo.CreatedDateTime,
                    wo.CreatedUser,
                    wo.CreatedFaultType,
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
                    wo.ClosedFaultType,
                    wo.ClosedFaultLevel1,
                    wo.ClosedFaultLevel2,
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
                    tblwo_event AS wo 
                    INNER JOIN tblwo_allcheckinusers AS ciu ON wo.WorkOrderNo = ciu.WorkOrderNo
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
                $ReturnData_ary[$i][4] = $row['McCategory']; 
                $ReturnData_ary[$i][5] = $row['MachineNo']; 
                $ReturnData_ary[$i][6] = $row['ClosedFaultType']; 
                
                $ReturnData_ary[$i][7] = $row['WoDescription']; 
                $ReturnData_ary[$i][8] = $row['RespondDateTime']; 
                $ReturnData_ary[$i][9] = $row['ClosedDateTime'];
                $ReturnData_ary[$i][10] = $row['TotTimeDuration'];

                $ReturnData_ary[$i][11] = $row['WoStatus'];     
                $ReturnData_ary[$i][12] = $row['CreatedUser'];           
                  
                
                /*$ReturnData_ary[$i][10] = $row['AllocatedUsers'];                
                $ReturnData_ary[$i][11] = $row['CheckInUsers'];
                
                                
                $ReturnData_ary[$i][13] = $row['ClosedUser'];                 
                  
                
                
                $ReturnData_ary[$i][15] = $row['ReOpenedDateTime']; 
                $ReturnData_ary[$i][16] = $row['ReOpenedUser']; 
                $ReturnData_ary[$i][17] = $row['VerifiedDateTime']; 
                $ReturnData_ary[$i][18] = $row['VerifiedUser'];*/


                

                               
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
        $conn=null;
    }

    else if($strFuncType === "funGetData_Table2") 

   
    {
        $strStarDate3       = $num[1];
        $strEndDate3        = $num[2];
        $strDepartment      = $num[3];
        $strCategory        = $num[4];
        $strMechanic          = $num[5];
        
        $whereClause = "wo.ClosedDateTime IS NOT NULL AND wo.CreatedDateTime BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND wo.WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND wo.WorkOrderCategory = '" . $strCategory . "'";
        }          
        if ($strMechanic !== "All") 
            $whereClause .= " AND ciu.CheckInUser = '" . $strMechanic . "'";    
        
        try 
        { 
            $sqlString = "
                SELECT             
                    wo.WorkOrderNo,
                    wo.McCategory,
                    wo.MachineNo,
                    wo.WoDepartment,
                    wo.WorkOrderCategory,
                    wo.CreatedDateTime,
                    wo.CreatedUser,
                    wo.CreatedFaultType,
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
                    wo.ClosedFaultType,
                    wo.ClosedFaultLevel1,
                    wo.ClosedFaultLevel2,
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
                    tblwo_event AS wo 
                    INNER JOIN tblwo_allcheckinusers AS ciu ON wo.WorkOrderNo = ciu.WorkOrderNo
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
                $ReturnData_ary[$i][4] = $row['McCategory']; 
                $ReturnData_ary[$i][5] = $row['MachineNo']; 
                $ReturnData_ary[$i][6] = $row['ClosedFaultType']; 
                
                $ReturnData_ary[$i][7] = $row['WoDescription']; 
                $ReturnData_ary[$i][8] = $row['CreatedUser']; 
                $ReturnData_ary[$i][9] = $row['AllocatedUsers'];
                $ReturnData_ary[$i][10] = $row['WoStatus'];

                $ReturnData_ary[$i][11] = $row['RespondDateTime'];     
                $ReturnData_ary[$i][12] = $row['CheckInUsers'];           
                  
                
                /*$ReturnData_ary[$i][10] = $row['AllocatedUsers'];                
                $ReturnData_ary[$i][11] = $row['CheckInUsers'];
                
                                
                $ReturnData_ary[$i][13] = $row['ClosedUser'];                 
                  
                
                
                $ReturnData_ary[$i][15] = $row['ReOpenedDateTime']; 
                $ReturnData_ary[$i][16] = $row['ReOpenedUser']; 
                $ReturnData_ary[$i][17] = $row['VerifiedDateTime']; 
                $ReturnData_ary[$i][18] = $row['VerifiedUser'];*/


                

                               
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
        $conn=null;
    }

    else if($strFuncType === "funGetData_Table3") 

   
    {
        $strStarDate3       = $num[1];
        $strEndDate3        = $num[2];
        $strDepartment      = $num[3];
        $strCategory        = $num[4];
        $strMechanic          = $num[5];
        
        $whereClause = "wo.ClosedDateTime IS NOT NULL AND wo.CreatedDateTime BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND wo.WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND wo.WorkOrderCategory = '" . $strCategory . "'";
        }          
        if ($strMechanic !== "All") 
        {
            $whereClause .= " AND ciu.CheckInUser = '" . $strMechanic . "'";           
        }
        
        try 
        { 
            $sqlString = "
                SELECT             
                    wo.WorkOrderNo,
                    wo.McCategory,
                    wo.MachineNo,
                    wo.WoDepartment,
                    wo.WorkOrderCategory,
                    wo.CreatedDateTime,
                    wo.CreatedUser,
                    wo.CreatedFaultType,
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
                    wo.ClosedFaultType,
                    wo.ClosedFaultLevel1,
                    wo.ClosedFaultLevel2,
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
                    tblwo_event AS wo 
                    INNER JOIN tblwo_allcheckinusers AS ciu ON wo.WorkOrderNo = ciu.WorkOrderNo
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
                $ReturnData_ary[$i][4] = $row['McCategory']; 
                $ReturnData_ary[$i][5] = $row['MachineNo']; 
                $ReturnData_ary[$i][6] = $row['ClosedFaultType']; 
                
                $ReturnData_ary[$i][7] = $row['WoDescription']; 
                $ReturnData_ary[$i][8] = $row['WoStatus']; 
                $ReturnData_ary[$i][9] = $row['CreatedUser'];
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
        $conn=null;
    }


    /*//------------- Table data load --------------------
    else if($strFuncType === "funGetData_Table") 
    {
        $strStarDate3       = $num[1];
        $strEndDate3        = $num[2];
        $strDepartment      = $num[3];
        $strCategory        = $num[4];
        $strMechanic          = $num[5];
         
        $whereClause = "ClosedDateTime IS NOT NULL AND CreatedDateTime BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND WorkOrderSubCategory = '" . $strCategory . "'";
        }          
        if ($strMechanic !== "All") 
        {
            if ($strMechanic === "Closed") 
            {
                $whereClause .= " AND (WoStatus = 'Closed' OR WoStatus = 'Verified' OR WoStatus = 'Auto-Verified')";
            
            }
            else
            {
                $whereClause .= " AND WoStatus = '" . $strMechanic . "'";
            }           
        }
        
        try 
        {            	 
           
            $sqlString = "
                SELECT 
                    WorkOrderNo,
                    WorkOrderCategory,
                    WorkOrderSubCategory,
                    WoDepartment,
                    CreatedDateTime,
                    CreatedUser,
                    RespondDateTime,
                    ClosedDateTime,
                    ClosedUser,
                    TIMESTAMPDIFF(MINUTE, CreatedDateTime, ClosedDateTime) as TotTimeDuration,
                    VerifiedDateTime,
                    VerifiedUser,
                    ReOpenedDateTime,
                    ReOpenedUser,
                    WoDescription,
                    WoStatus
                    
                FROM 
                    tblwo_event 
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
                $ReturnData_ary[$i][9] = $row['ClosedDateTime'];                
                $ReturnData_ary[$i][10] = $row['ClosedUser']; 
                
                $ReturnData_ary[$i][11] = $row['TotTimeDuration'];
                 
                $ReturnData_ary[$i][12] = $row['ReOpenedDateTime']; 
                $ReturnData_ary[$i][13] = $row['ReOpenedUser']; 
                $ReturnData_ary[$i][14] = $row['VerifiedDateTime']; 
                $ReturnData_ary[$i][15] = $row['VerifiedUser'];
                               
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
    }*/






        $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
        
    //print json_encode($error);
    print json_encode($data_ary); 

?>
