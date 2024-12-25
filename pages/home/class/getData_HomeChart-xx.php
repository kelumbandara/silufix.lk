
<?php
    
    $num = $_POST["userpara"];    
    //$startData = $num[0];
    //$endData = $num[1];
    //----------- Database Connection ---------------------
    require '../../../dbconnection/dbConnection.php';        
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Colombo');
    $strDateTime = date("Y-m-d");   
    //----------- Declare Variables -----------------------     
    $i = 0; 
    $j = 0; 
    $error = "NA";
    $intWoState = 6;
               
    // Calculate the start date of the last week
    $start_date = date('Y-m-d', strtotime('-6 days'));
    try 
    {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                       
        //$stmt = $conn->prepare("SELECT DATE(CreatedDateTime) AS DatePart, COUNT(WorkOrderNo) AS TotalWorkOrders FROM tblwo_event WHERE DATE(CreatedDateTime) >= :start_date GROUP BY DATE(CreatedDateTime) ORDER BY DatePart");
        $stmt = $conn->prepare("
            SELECT 
                    DATE_FORMAT(CreatedDateTime, '%m-%d') AS DatePart, 
                    COUNT(WorkOrderNo) AS TotPlacedWorkOrders,
                    SUM(CASE WHEN State > 2 THEN 1 ELSE 0 END) AS CompletedWorkOrders,
                    SUM(CASE WHEN WorkOrderCategory='Breakdown' THEN 1 ELSE 0 END) AS TotPlacedBreakDown,
                    SUM(CASE WHEN (WorkOrderCategory='Breakdown' AND State > 2) THEN 1 ELSE 0 END) AS CompletedBreakDown, 
                    SUM(CASE WHEN (WorkOrderCategory='Breakdown' AND State > 2) THEN TIMESTAMPDIFF(MINUTE, CreatedDateTime, ClosedDateTime) ELSE 0 END) AS TotalBreakDownDuration
            FROM 
                    tblwo_event
            WHERE 
                    CreatedDateTime >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                    AND State < 6
            GROUP BY 
                    DATE_FORMAT(CreatedDateTime, '%m-%d') 
            ORDER BY 
                    DatePart");

        //$stmt->bindParam(':start_date', $start_date); 
        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();        
        foreach($result as $row)
        {           
            $Date_ary[$i]                   = $row['DatePart']; 
            $TotPlacedWorkOrders_ary[$i]    = $row['TotPlacedWorkOrders']; 
            $CompletedWorkOrders_ary[$i]    = $row['CompletedWorkOrders']; 
            $TotPlacedBreakDown_ary[$i]     = $row['TotPlacedBreakDown']; 
            $CompletedBreakDown_ary[$i]     = $row['CompletedBreakDown']; 
            $TotalBreakDownDuration_ary[$i] = floor($row['TotalBreakDownDuration']/60); 
            $i++;
            //echo $i;
        }                
        //echo $strSummaryAry;
    } 
    catch(PDOException $e) 
    {
        $error =  "Error: " . $e->getMessage();
    }    
    $conn = null;
    if($i > 0)
    {
        //------------ Update Line Balance Data -------------------------------------------------   
        $data_ary['Date_Ary']                   = $Date_ary;
        $data_ary['TotPlacedWorkOrders_Ary']    = $TotPlacedWorkOrders_ary; 
        $data_ary['CompletedWorkOrders_Ary']    = $CompletedWorkOrders_ary; 
        $data_ary['TotPlacedBreakDown_Ary']     = $TotPlacedBreakDown_ary; 
        $data_ary['CompletedBreakDown_Ary']     = $CompletedBreakDown_ary; 
        $data_ary['TotalBreakDownDuration_Ary'] = $TotalBreakDownDuration_ary;
    }
    else 
    {
        $data_ary = array(0);
    }
    //print json_encode($error);
    print json_encode($data_ary); 
   // print json_encode($ProductQuantity_ary);
       
?>