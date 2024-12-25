<?php
    require_once('../../initialize.php');
    require_once('../../config.php');
    
    session_start();
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
    $ReturnData_ary2 = array();
    
    //$ReturnData_ary[0][0]  = "NA";
    $strText    = "";
    $ReturnData_ary[0] = "NA";     
    $ReturnData_ary2[0][0] = "NA";     
    $ReturnData_ary2[0][1] = "NA";
    //error_log("Your log message", 3, "/logs/file.log");
        
    if($strFuncType === "funGetMttrData") //------------- funUpdateEventLog --------------------
    {
        $strStartDate       = $num[1];  
        $strEndDate         = $num[2];
        
        $strMcCategory      = $num[3];
        $strFaultType       = $num[4];
        $strLevel1          = $num[5];
        $strLevel2          = $num[6];
        $strLevel3          = $num[7];
      
        $whereClause = "WorkOrderCategory = 'Breakdown' AND State < 6 AND ClosedDateTime IS NOT NULL AND CreatedDateTime >= :start_date AND CreatedDateTime <= :end_date";
        
        if ($strMcCategory !== "All") {
            $whereClause .= " AND McCategory = '" . $strMcCategory . "'";
        }
        if ($strFaultType !== "All") {
            $whereClause .= " AND ClosedFaultType = '" . $strFaultType . "'";
        }  
        if ($strLevel1 !== "All") {
            $whereClause .= " AND ClosedFaultLevel1 = '" . $strLevel1 . "'";
        }   
        if ($strLevel2 !== "All") {
            $whereClause .= " AND ClosedFaultLevel2 = '" . $strLevel2 . "'";
        } 
        if ($strLevel3 !== "All") {
            $whereClause .= " AND ClosedFaultLevel3 = '" . $strLevel3 . "'";
        } 
        			
        try 
        {
            $sqlString = "SELECT
                            COUNT(*) AS NumFailures,
                            SUM(TIMESTAMPDIFF(MINUTE, CreatedDateTime, ClosedDateTime)) AS TotalDowntime,
                            AVG(TIMESTAMPDIFF(MINUTE, CreatedDateTime, ClosedDateTime)) AS MTTR
                        FROM
                            tblwo_event
                        WHERE " . $whereClause;
                        
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $stmt = $conn->prepare($sqlString);
            //$stmt->bindParam(':wono', $strWoNumber);  
            $stmt->bindParam(':start_date', $strStartDate);
            $stmt->bindParam(':end_date', $strEndDate);
    
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            //$i = 1;
           
            foreach($result as $row)
            {          
                if( (isset($row['NumFailures'])) && (isset($row['TotalDowntime']))&& (isset($row['MTTR'])))
                {
                    $ReturnData_ary[1]   = strval($row['NumFailures']);
                    $ReturnData_ary[2]   = $row['TotalDowntime'];
                    $ReturnData_ary[3]   = number_format($row['MTTR'], 2); 
                    $i++;
                }
                //else 
               // {
               //     $ReturnData_ary[1] = "N/A"; // Or any other default value you prefer
               //}   
                
            }  
            if($i === 0)    // No Data
            {
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not found"; 
            }
            else
            {
                $ReturnData_ary[0] = $strText;
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
        //2024-03-13,2024-03-28,All,All,All,All,All
        $strStartDate       = $num[1];  
        $strEndDate         = $num[2];        
        $strMcCategory      = $num[3];
        $strFaultType       = $num[4];
        $strLevel1          = $num[5];
        $strLevel2          = $num[6];
        $strLevel3          = $num[7];
        /*
        $strStartDate       = '2024-03-01'; //$num[1];  
        $strEndDate         = '2024-03-28'; //$num[2];        
        $strMcCategory      = 'All';   //$num[3];
        $strFaultType       = 'All';   // $num[4];
        $strLevel1          = 'All';   // $num[5];
        $strLevel2          = 'All';   // $num[6];
        $strLevel3          = 'All';   // $num[7];
        */
        $whereClause = "WorkOrderCategory = 'Breakdown' AND State < 6 AND ClosedDateTime IS NOT NULL AND CreatedDateTime >= :start_date AND CreatedDateTime <= :end_date";

        if ($strMcCategory !== "All") {
            $whereClause .= " AND McCategory = '" . $strMcCategory . "'";
        }
        if ($strFaultType !== "All") {
            $whereClause .= " AND ClosedFaultType = '" . $strFaultType . "'";
        }  
        if ($strLevel1 !== "All") {
            $whereClause .= " AND ClosedFaultLevel1 = '" . $strLevel1 . "'";
        }   
        if ($strLevel2 !== "All") {
            $whereClause .= " AND ClosedFaultLevel2 = '" . $strLevel2 . "'";
        } 
        if ($strLevel3 !== "All") {
            $whereClause .= " AND ClosedFaultLevel3 = '" . $strLevel3 . "'";
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
            $stmt->bindParam(':start_date', $strStartDate); 
            $stmt->bindParam(':end_date', $strEndDate);
            
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            $i = 0;
  
            foreach($result as $row)
            {           
                $ReturnData_ary2[$i][0] = $row['WorkOrderNo'];
                $ReturnData_ary2[$i][1] = $row['CreatedDateTime'];
                $ReturnData_ary2[$i][2] = $row['WoDepartment']; 
                $ReturnData_ary2[$i][3] = $row['McCategory']; 
                $ReturnData_ary2[$i][4] = $row['MachineNo']; 
                $ReturnData_ary2[$i][5] = $row['CreatedFaultType']; 

                $ReturnData_ary2[$i][6] = utf8_encode($row['WoDescription']);
                $ReturnData_ary2[$i][7] = $row['WoStatus'];     
                $ReturnData_ary2[$i][8] = $row['CreatedUser'];           
                $ReturnData_ary2[$i][9] = $row['RespondDateTime'];   

                $ReturnData_ary2[$i][10] = $row['AllocatedUsers'];                
                $ReturnData_ary2[$i][11] = $row['CheckInUsers'];

                $ReturnData_ary2[$i][12] = $row['ClosedDateTime'];                
                $ReturnData_ary2[$i][13] = $row['ClosedUser'];                 
                $ReturnData_ary2[$i][14] = $row['TotTimeDuration'];  
                $ReturnData_ary2[$i][15] = $row['ClosedFaultType']; 
                $ReturnData_ary2[$i][16] = $row['ClosedFaultLevel1']; 
                $ReturnData_ary2[$i][17] = $row['ClosedFaultLevel2'];  

                $ReturnData_ary2[$i][18] = $row['ReOpenedDateTime']; 
                $ReturnData_ary2[$i][19] = $row['ReOpenedUser']; 
                $ReturnData_ary2[$i][20] = $row['VerifiedDateTime']; 
                $ReturnData_ary2[$i][21] = $row['VerifiedUser'];
                    
                $i++;
            }  
            if($i === 0)    // No Data
            {
                $ReturnData_ary2[0][0] = $strText;
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not found"; 
            }
            else
            {
                //$ReturnData_ary2[0] = $strText;
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
    //error_log("Test error log: ", 3, "/logs/server/error.log");     
    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
    $data_ary['Data_Ary2']  = $ReturnData_ary2;  

    print json_encode($data_ary); 

?>
