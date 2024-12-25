
<?php
    
    $num = $_POST["userpara"];    
    
    $strFuncType = $num[0];    
    //$strFuncType = "Get_runtime_value"; 
    
    //$num[1] = "1";
    //$num[2] = "WoDepartment";
    //$num[3] = "Engineering";       //Engineering
    //----------- Database conn_mcection ---------------------
    require_once('../../initialize.php');
    require_once('../../config.php');  
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
    
    //----------------- Function : Get Realtime runtime data ------------------------------
    if($strFuncType === "Get_runtime_value")   
    {   
        date_default_timezone_set('Asia/Colombo'); // Set the timezone to Colombo
    
        $currentTime = new DateTime(); // Get the current date and time
    
        // Define 7 AM and 7 PM times for the same day
        $sevenAM = new DateTime('07:00:00');
        $sevenPM = new DateTime('19:00:00');
    
        // Initialize the WHERE clause
        $whereClause = "DATE(ServerDatetime) = (SELECT LatestServerDate FROM LatestDate) AND Sen1Speed > 0";
    
        // Check if the current time is between 7 AM and 7 PM
        if ($currentTime >= $sevenAM && $currentTime < $sevenPM) {
            // Daytime: 7 AM to 6:59 PM
            $whereClause .= " AND TIME(ServerDatetime) BETWEEN '07:00:00' AND '18:59:59'
                                    ";
        } else {
            // Nighttime: 7 PM to 6:59 AM
            $whereClause .= " AND (
                                    TIME(ServerDatetime) BETWEEN '19:00:00' AND '23:59:59'
                                    OR TIME(ServerDatetime) BETWEEN '00:00:00' AND '06:59:59'
                                )";
        }
        try 
        {
                       
            $conn_mc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Corrected SQL Query
            $stmt = $conn_mc->prepare("
                WITH LatestDate AS (
                    SELECT MAX(DATE(ServerDatetime)) AS LatestServerDate
                    FROM tblmc_speedevent
                ),
                DurationData AS (
                    SELECT 
                        MachineNumber,
                        Sen1Speed,
                        TIMESTAMPDIFF(SECOND, ServerDatetime, LEAD(ServerDatetime) OVER (PARTITION BY MachineNumber ORDER BY ServerDatetime)) / 3600 AS Duration
                    FROM 
                        tblmc_speedevent
                    WHERE 
                        $whereClause
                )
                SELECT 
                    MachineNumber,
                    SUM(Duration) AS TotalDurationHours,
                    SUM(Sen1Speed) AS TotalSen1Speed
                FROM 
                    DurationData
                GROUP BY 
                    MachineNumber;
            ");
          
            // Execute the statement
            $stmt->execute();
      
            // Fetch the results as an associative array
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
    
            foreach($result as $row)
            {        
       
                $MachineID_ary[$i]      = $row['MachineNumber'];
                $MachineNumber_ary[$i]  = $row['TotalDurationHours'];  
                 
                $i++;
                //echo $i;
            }                
            //echo $strSummaryAry;
        } 
        catch(PDOException $e) 
        {
            $error =  "Error: " . $e->getMessage();
            //echo $error;
        }    
        $conn_mc = null;
        if($i > 0)
        {
            //------------ Update Line Balance Data -------------------------------------------------   
            $data_ary['MachineNumber']      = $MachineID_ary;
            $data_ary['TotalDurationHours']  = $MachineNumber_ary; 
              
        }
        else 
        {
            $data_ary = array(0);
        }        
    }

    else if($strFuncType === "ColorChange")   
    {   
        
        date_default_timezone_set('Asia/Colombo'); // Set the timezone to Colombo
    
        $currentTime = new DateTime(); // Get the current date and time
    
        // Define 7 AM and 7 PM times for the same day
        $sevenAM = new DateTime('07:00:00');
        $sevenPM = new DateTime('19:00:00');
    
        // Initialize the WHERE clause
        $whereClause = "DATE(ServerDatetime) = (SELECT LatestServerDate FROM LatestDate) AND Sen1Speed > 0";
    
        // Check if the current time is between 7 AM and 7 PM
        if ($currentTime >= $sevenAM && $currentTime < $sevenPM) {
            // Daytime: 7 AM to 6:59 PM
            $whereClause .= " AND TIME(ServerDatetime) BETWEEN '07:00:00' AND '18:59:59'
                                    ";
        } else {
            // Nighttime: 7 PM to 6:59 AM
            $whereClause .= " AND (
                                    TIME(ServerDatetime) BETWEEN '19:00:00' AND '23:59:59'
                                    OR TIME(ServerDatetime) BETWEEN '00:00:00' AND '06:59:59'
                                )";
        }
    
        try 
        {
            $conn_mc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Corrected SQL Query
            $stmt = $conn_mc->prepare("
                WITH LatestDate AS (
                    SELECT MAX(DATE(ServerDatetime)) AS LatestServerDate
                    FROM tblmc_speedevent
                ),
                DurationData AS (
                    SELECT 
                        MachineNumber,
                        Sen1Speed,
                        TIMESTAMPDIFF(SECOND, ServerDatetime, LEAD(ServerDatetime) OVER (PARTITION BY MachineNumber ORDER BY ServerDatetime)) / 3600 AS Duration
                    FROM 
                        tblmc_speedevent
                    WHERE 
                        $whereClause
                )
                SELECT 
                    MachineNumber,
                    SUM(Duration) AS TotalDurationHours,
                    SUM(Sen1Speed) AS TotalSen1Speed
                FROM 
                    DurationData
                GROUP BY 
                    MachineNumber;
            ");
    
            // Execute the statement
            $stmt->execute();
    
            // Fetch the results as an associative array
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
    
           
    
            foreach($result as $row)
            {           
                $MachineID_ary[$i]      = $row['MachineNumber'];
                $MachineNumber_ary[$i]  = $row['TotalDurationHours'];  
                 
                $i++;
                //echo $i;
            }                
            //echo $strSummaryAry;
        } 
        catch(PDOException $e) 
        {
            $error =  "Error: " . $e->getMessage();
        }    
        $conn_mc = null;
        if($i > 0)
        {
            //------------ Update Line Balance Data -------------------------------------------------   
            $data_ary['MachineNumber']      = $MachineID_ary;
            $data_ary['TotalDurationHours']  = $MachineNumber_ary; 
              
        }
        else 
        {
            $data_ary = array(0);
        }        
    }
    


          
    //print json_encode($error);
    print json_encode($data_ary); 
    // print json_encode($ProductQuantity_ary);
       
?>
