
<?php
    
    $num = $_POST["userpara"];    
    
    $strFuncType = $num[0];    
    //$strFuncType = "funGet_Summary_Last30";
    
    //$num[1] = "1";
    //$num[2] = "WoDepartment";
    //$num[3] = "Engineering";       //Engineering
    //----------- Database Connection ---------------------
    require '../../../dbconnection/dbConnection.php';   
    //----------- Error Loging Path ---------------------
    //require_once '../class/logging.php';
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Colombo');
    $strDateTime = date("Y-m-d");   
    //----------- Declare Variables -----------------------     
    $i = 0; 
    $j = 0; 
    $error = "NA";
    $intWoState = 4;   
    
    $Status_ary     = array();
    $ReturnData_ary = array();
    $ReturnData_ary[0]  = "NA"; 
    //----------------- Function : Get Checking Details ------------------------------
    if($strFuncType === "funGet_Summary_Last30")      //-------------- funGetCheckInDetails_byWoEpf -----------
    {
        //$strWoState     = $num[1];    
        $strWoCategory     = "BreakDown";    
        try 
        {    
    
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //--------- Breakdown Data ---------------------------------------------
            $stmt = $conn->prepare("
                SELECT 
                    COUNT(*) AS BreakDownCount,                    
                    SUM(CASE WHEN State > 2 THEN TIMESTAMPDIFF(MINUTE, CreatedDateTime, ClosedDateTime) ELSE 0 END) AS TotalBreakDownDuration,
                    SUM(CASE WHEN State > 2 THEN TIMESTAMPDIFF(MINUTE, CreatedDateTime, RespondDateTime) ELSE 0 END) AS TotalAttendingDelay
                FROM 
                    tblwo_event 
                WHERE
                    WorkOrderCategory=:wocat
                    AND CreatedDateTime >= DATE_SUB(NOW(), INTERVAL 7 DAY)
                    AND State < 6;
            ");
            $stmt->bindParam(':wocat', $strWoCategory); 
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);     
            // If you want to assign these values to an array as in the original code
            $ReturnData_ary[0] = $result['BreakDownCount'];
            $ReturnData_ary[1] = $result['TotalBreakDownDuration'];
            $ReturnData_ary[2] = $result['TotalAttendingDelay'];
            
            //--------- WorkOrder Data ---------------------------------------------
            $stmt = $conn->prepare("
                SELECT 
                    COUNT(*) AS TotalWorkOrdersCount,
                    SUM(CASE WHEN State > 2 THEN 1 ELSE 0 END) AS TotalCompletedCount
               FROM 
                    tblwo_event 
                WHERE 
                    CreatedDateTime >= DATE_SUB(NOW(), INTERVAL 7 DAY)
                    AND State < 6;
            ");
            //$stmt->bindParam(':wocat', $strWoCategory); 
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);     
            // If you want to assign these values to an array as in the original code
            $ReturnData_ary[3] = $result['TotalWorkOrdersCount'];
            $ReturnData_ary[4] = $result['TotalCompletedCount'];
            
            $i++;
            if($i === 0)    // No Data
            {
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not found"; 
            }
            else
            {
                $Status_ary[0] = "true";
                $Status_ary[1] = "Data Available"; 
            }  
            
            //echo $strSummaryAry;
        } 
        catch(PDOException $e) 
        {
            $error =  "Error: " . $e->getMessage();            
            //writeToLogFile($error);
        }    
        $conn = null;        
    }
    else if($strFuncType === "funGet_Summary_Today")      //-------------- funGetCheckInDetails_byWoEpf -----------
    {
        //$strWoState     = $num[1];    
        $strWoCategory     = "BreakDown";    
        try 
        {    
    
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //--------- Breakdown Data ---------------------------------------------
            $stmt = $conn->prepare("
                SELECT 
                    COUNT(*) AS BreakDownCount,                    
                    SUM(CASE WHEN State > 2 THEN TIMESTAMPDIFF(MINUTE, CreatedDateTime, ClosedDateTime) ELSE 0 END) AS TotalBreakDownDuration,
                    SUM(CASE WHEN State > 2 THEN TIMESTAMPDIFF(MINUTE, CreatedDateTime, RespondDateTime) ELSE 0 END) AS TotalAttendingDelay
                FROM 
                    tblwo_event 
                WHERE
                    WorkOrderCategory=:wocat
                    AND DATE(CreatedDateTime) = CURDATE()
                    AND State < 6;
            ");
            $stmt->bindParam(':wocat', $strWoCategory); 
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);     
            // If you want to assign these values to an array as in the original code
            $ReturnData_ary[0] = $result['BreakDownCount'];
            $ReturnData_ary[1] = $result['TotalBreakDownDuration'];
            $ReturnData_ary[2] = $result['TotalAttendingDelay'];
            
            //--------- WorkOrder Data ---------------------------------------------
            $stmt = $conn->prepare("
                SELECT 
                    COUNT(*) AS TotalWorkOrdersCount,
                    SUM(CASE WHEN State > 2 THEN 1 ELSE 0 END) AS TotalCompletedCount
               FROM 
                    tblwo_event 
                WHERE 
                    DATE(CreatedDateTime) = CURDATE()
                    AND State < 6;
            ");
            //$stmt->bindParam(':wocat', $strWoCategory); 
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);     
            // If you want to assign these values to an array as in the original code
            $ReturnData_ary[3] = $result['TotalWorkOrdersCount'];
            $ReturnData_ary[4] = $result['TotalCompletedCount'];
            
            $i++;
            if($i === 0)    // No Data
            {
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not found"; 
            }
            else
            {
                $Status_ary[0] = "true";
                $Status_ary[1] = "Data Available"; 
            }  
            
            //echo $strSummaryAry;
        } 
        catch(PDOException $e) 
        {
            $error =  "Error: " . $e->getMessage();            
            //writeToLogFile($error);
        }    
        $conn = null;        
    }
    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
          
    //print json_encode($error);
    print json_encode($data_ary); 
    // print json_encode($ProductQuantity_ary);
       
?>