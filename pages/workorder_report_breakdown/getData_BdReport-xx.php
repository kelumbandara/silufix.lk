<?php

    session_start();
    require_once('../../initialize.php');
    require_once('../../config.php');
    
    $num = $_POST["userpara"];    
    $strFuncType = $num[0];    
    //$strFuncType = "funGetData_PieChart1";
      
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
    
    if($strFuncType === "funGetData_PieChart3") //------------- funUpdateEventLog --------------------
    {
        $strStarDate    = $num[1];
        $strEndDate     = $num[2];
        $strDepartment  = $num[3];
        $strCategory    = $num[4];
        $strStatus      = $num[5];
         
        $whereClause = "WorkOrderCategory = 'BreakDown' AND State < 6 AND ClosedDateTime IS NOT NULL AND DATE(CreatedDateTime) BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND McCategory = '" . $strCategory . "'";
        }  
        if ($strStatus !== "All") {
                $whereClause .= " AND ClosedFaultType  = '" . $strStatus . "'";          
        } 
        try 
        {   
            $sqlString = "
                SELECT
                WoDepartment, COUNT(*) AS Total_Count
                FROM 
                    tblwo_event 
                WHERE " . $whereClause." GROUP BY WoDepartment";
            
            
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

    else if($strFuncType === "funGetData_PieChart4") //------------- funUpdateEventLog --------------------
    {
        
        $strStarDate       = $num[1];
        $strEndDate        = $num[2];
        $strDepartment  = $num[3];
        $strCategory    = $num[4];
        $strStatus      = $num[5];
         
        $whereClause = "WorkOrderCategory = 'BreakDown' AND State < 6 AND ClosedDateTime IS NOT NULL AND DATE(CreatedDateTime) BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND McCategory = '" . $strCategory . "'";
        }  
        if ($strStatus !== "All") {
            $whereClause .= " AND ClosedFaultType  = '" . $strStatus . "'";          
        } 
        
        try 
        {    
            $sqlString = "
                SELECT 
                    ClosedFaultType,
                    SUM(TIMESTAMPDIFF(MINUTE, CreatedDateTime, ClosedDateTime)) AS Time_Duration 
                FROM 
                    tblwo_event 
                WHERE " . $whereClause." GROUP BY ClosedFaultType";
                

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
                $ReturnData_ary[0][$i] = $row['ClosedFaultType'];
                $ReturnData_ary[1][$i] = number_format($row['Time_Duration'] / 60, 1);
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
    else if($strFuncType === "funGetData_PieChartNew1") //------------- funUpdateEventLog --------------------
    {
        $strStarDate    = $num[1];
        $strEndDate     = $num[2];
        $strDepartment  = $num[3];
        $strCategory    = $num[4];
        $strStatus      = $num[5];
         
        $whereClause = "WorkOrderCategory = 'BreakDown' AND State < 6 AND ClosedDateTime IS NOT NULL AND DATE(CreatedDateTime) BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND McCategory = '" . $strCategory . "'";
        }  
        if ($strStatus !== "All") {
            $whereClause .= " AND ClosedFaultType  = '" . $strStatus . "'";          
        } 
        try 
        {   
            $sqlString = "
                SELECT 
                    WoDepartment, 
                    SUM(TIMESTAMPDIFF(MINUTE, CreatedDateTime, ClosedDateTime)) AS Time_Duration 
                FROM 
                    tblwo_event 
               WHERE " . $whereClause." GROUP BY WoDepartment";
            
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
                $ReturnData_ary[0][$i] = $row['WoDepartment'];
                $ReturnData_ary[1][$i] = number_format($row['Time_Duration'] / 60, 1);
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
    else if($strFuncType === "funGetData_PieChartNew2") //------------- funUpdateEventLog --------------------
    {
        $strStarDate    = $num[1];
        $strEndDate     = $num[2];
        $strDepartment  = $num[3];
        $strCategory    = $num[4];
        $strStatus      = $num[5];
         
        $whereClause = "WorkOrderCategory = 'BreakDown' AND State < 6 AND ClosedDateTime IS NOT NULL AND DATE(CreatedDateTime) BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND McCategory = '" . $strCategory . "'";
        }  
        if ($strStatus !== "All") {
            $whereClause .= " AND ClosedFaultType  = '" . $strStatus . "'";          
        } 
        try 
        {   
            $sqlString = "
                SELECT 
                    WoDepartment, 
                    SUM(TIMESTAMPDIFF(MINUTE, CreatedDateTime, RespondDateTime)) AS Time_Duration 
                FROM 
                    tblwo_event 
               WHERE " . $whereClause." GROUP BY WoDepartment";
            
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
                $ReturnData_ary[0][$i] = $row['WoDepartment'];
                $ReturnData_ary[1][$i] = number_format($row['Time_Duration'] / 60, 1); 
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
    else if($strFuncType === "funGetData_BarChart1") //------------- funUpdateEventLog --------------------
    {   



        
        $strStarDate2   = $num[1];
        $strEndDate2    = $num[2];
        $strDepartment  = $num[3];
        $strCategory    = $num[4];
        $strStatus      = $num[5];
         
        $whereClause = "WorkOrderCategory = 'BreakDown' AND State < 6 AND ClosedDateTime IS NOT NULL AND DATE(CreatedDateTime) BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND McCategory = '" . $strCategory . "'";
        }  
        if ($strStatus !== "All") {
            $whereClause .= " AND ClosedFaultType  = '" . $strStatus . "'";          
        } 
        
        try 
        {           
          
        
            $sqlString = " 
                SELECT 
                McCategory,
                    COUNT(CASE WHEN ClosedFaultType = 'Electrical' THEN 1 END) AS Electrical_Count,
                    COUNT(CASE WHEN ClosedFaultType = 'Mechanical' THEN 1 END) AS Mechanical_Count,
                    COUNT(CASE WHEN ClosedFaultType = 'Select data' THEN 1 END) AS Rust_Corrosion_Count,
                    COUNT(CASE WHEN ClosedFaultType = 'Pneumatic' THEN 1 END) AS Contamination_Count,
                    COUNT(CASE WHEN ClosedFaultType = 'NA' THEN 1 END) AS Other_Count
                FROM 
                    tblwo_event 
                WHERE " . $whereClause . 
                " GROUP BY 
                McCategory;";
            
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
                $ReturnData_ary[0][$i] = $row['McCategory'];
                $ReturnData_ary[1][$i] = $row['Electrical_Count']; 
                $ReturnData_ary[2][$i] = $row['Mechanical_Count']; 
                $ReturnData_ary[3][$i] = $row['Rust_Corrosion_Count']; 
                $ReturnData_ary[4][$i] = $row['Contamination_Count']; 
                $ReturnData_ary[5][$i] = $row['Other_Count']; 
                 
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
         
        $whereClause = "WorkOrderCategory = 'BreakDown' AND State < 6 AND ClosedDateTime IS NOT NULL AND DATE(CreatedDateTime) BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND McCategory = '" . $strCategory . "'";
        }  
        if ($strStatus !== "All") {
            $whereClause .= " AND ClosedFaultType  = '" . $strStatus . "'";          
        } 
        
        try 
        {            	 
            $sqlString = "
                
                SELECT 
                    WoDepartment, 
                    AVG(TIMESTAMPDIFF(MINUTE, CreatedDateTime, RespondDateTime)) AS Time_Duration 
                FROM 
                    tblwo_event 
               WHERE " . $whereClause." GROUP BY WoDepartment";
           
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
                $ReturnData_ary[1][$i] = number_format($row['Time_Duration'] / 60, 1); 
                 
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
    else if($strFuncType === "funGetData_BarChart3") //------------- funUpdateEventLog --------------------
    {
        $strStarDate2   = $num[1];
        $strEndDate2    = $num[2];
        $strDepartment  = $num[3];
        $strCategory    = $num[4];
        $strStatus      = $num[5];
         
        $whereClause = "WorkOrderCategory = 'BreakDown' AND State < 6 AND ClosedDateTime IS NOT NULL AND DATE(CreatedDateTime) BETWEEN :sdate AND :edate";
                
        if ($strDepartment !== "All") {
            $whereClause .= " AND WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND McCategory = '" . $strCategory . "'";
        }  
        if ($strStatus !== "All") {
            $whereClause .= " AND ClosedFaultType  = '" . $strStatus . "'";          
        } 
        
        try 
        {            	 
            $sqlString = "                
            SELECT 
            MachineNo,
                 COUNT(CASE WHEN ClosedFaultType = 'Electrical' THEN 1 END) AS Electrical_Count,
                 COUNT(CASE WHEN ClosedFaultType = 'Mechanical' THEN 1 END) AS Mechanical_Count,
                 COUNT(CASE WHEN ClosedFaultType = 'Select data' THEN 1 END) AS Rust_Corrosion_Count,
                 COUNT(CASE WHEN ClosedFaultType = 'Pneumatic' THEN 1 END) AS Contamination_Count,
                 COUNT(CASE WHEN ClosedFaultType = 'NA' THEN 1 END) AS Other_Count
             FROM 
                 tblwo_event 
               WHERE " . $whereClause." GROUP BY MachineNo";

               

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
                $ReturnData_ary[0][$i] = $row['MachineNo'];
                $ReturnData_ary[1][$i] = $row['Electrical_Count']; 
                $ReturnData_ary[2][$i] = $row['Mechanical_Count']; 
                $ReturnData_ary[3][$i] = $row['Rust_Corrosion_Count']; 
                $ReturnData_ary[4][$i] = $row['Contamination_Count']; 
                $ReturnData_ary[5][$i] = $row['Other_Count']; 
                 
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

        $whereClause = "wo.WorkOrderCategory = 'BreakDown' AND State < 6 AND wo.ClosedDateTime IS NOT NULL AND DATE(wo.CreatedDateTime) BETWEEN :sdate AND :edate";

        if ($strDepartment !== "All") {
            $whereClause .= " AND wo.WoDepartment = '" . $strDepartment . "'";
        }
        if ($strCategory !== "All") {
            $whereClause .= " AND wo.McCategory = '" . $strCategory . "'";
        }          
        if ($strStatus !== "All") {
            $whereClause .= " AND ClosedFaultType  = '" . $strStatus . "'";          
        } 

        try 
        { 
            $sqlString = "
                SELECT             
                    wo.WorkOrderNo,
                    wo.McCategory,
                    wo.MachineNo,
                    wo.WoDepartment,
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
                $ReturnData_ary[$i][3] = $row['McCategory']; 
                $ReturnData_ary[$i][4] = $row['MachineNo']; 
                $ReturnData_ary[$i][5] = $row['CreatedFaultType']; 

                $ReturnData_ary[$i][6] = $row['WoDescription']; 
                $ReturnData_ary[$i][7] = $row['WoStatus'];     
                $ReturnData_ary[$i][8] = $row['CreatedUser'];           
                $ReturnData_ary[$i][9] = $row['RespondDateTime'];   

                $ReturnData_ary[$i][10] = $row['AllocatedUsers'];                
                $ReturnData_ary[$i][11] = $row['CheckInUsers'];

                $ReturnData_ary[$i][12] = $row['ClosedDateTime'];                
                $ReturnData_ary[$i][13] = $row['ClosedUser'];                 
                $ReturnData_ary[$i][14] = number_format($row['TotTimeDuration']/ 60, 1) ;  
                $ReturnData_ary[$i][15] = $row['ClosedFaultType']; 
                $ReturnData_ary[$i][16] = $row['ClosedFaultLevel1']; 
                $ReturnData_ary[$i][17] = $row['ClosedFaultLevel2'];  

                $ReturnData_ary[$i][18] = $row['ReOpenedDateTime']; 
                $ReturnData_ary[$i][19] = $row['ReOpenedUser']; 
                $ReturnData_ary[$i][20] = $row['VerifiedDateTime']; 
                $ReturnData_ary[$i][21] = $row['VerifiedUser'];

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

    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
        
    //print json_encode($error);
    print json_encode($data_ary); 

?>
