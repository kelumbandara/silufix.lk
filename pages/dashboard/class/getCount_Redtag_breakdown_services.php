
<?php
    
   $num = $_POST["userpara"];    
    //$startData = $num[0];
   // $endData = $num[1];
    //----------- Database Connection ---------------------
    require '../../../dbconnection/dbConnection.php';        
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Colombo');
    $strDateTime = date(format: "Y-m-d");   
    //----------- Declare Variables -----------------------     
    $i = 0; 
    $j = 0; 

    $error = "NA";
    $intWoState = 6;
    // Calculate the start date of the last week
    $start_date = date('Y-m-d', strtotime('-6 days'));

    try 
    {
        $conn->setAttribute(PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT
                                        COUNT(*) AS total_Count,
                                        SUM(CASE WHEN WorkOrderCategory = 'RedTag' THEN 1 ELSE 0 END) AS RedtagCount,
                                        SUM(CASE WHEN WorkOrderCategory = 'BreakDown' THEN 1 ELSE 0 END) AS BreakDown_count,
                                        SUM(CASE WHEN WorkOrderCategory = 'Service' THEN 1 ELSE 0 END) AS Service_count
                                        FROM
                                        `tblwo_event` 
                                        WHERE Date(ServerDateTime) =:strDateTime
                                        ;
                                        ");
         $stmt->bindParam(':strDateTime', $strDateTime);  
        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();   

        foreach($result as $row)
        {    
            $RedtagCount[$i]     = $row['RedtagCount'];
            $BreakDown_count[$i] = $row['BreakDown_count'];
            $Service_count[$i]   = $row['Service_count'];
        }
    } 
    catch(PDOException $e) 
    {
        $error =  "Error: " . $e->getMessage();
    }    
    $conn = null;
        //------------ Update Line Balance Data ------------------------------------------------- 
    //   $data_ary['RedtagCount']     =! not null ($RedtagCount) ? $RedtagCount : 0;
    //   $data_ary['BreakDown_count'] =! empty( $BreakDown_count) ? $BreakDown_count:[0];
    //   $data_ary['Service_count']   =! empty($Service_count) ? $Service_count:[0];

    $data_ary['RedtagCount']     =! empty($RedtagCount) ? $RedtagCount : 0;
    $data_ary['BreakDown_count'] =! empty( $BreakDown_count) ? $BreakDown_count:[0];
    $data_ary['Service_count']   =! empty($Service_count) ? $Service_count:[0];

      print json_encode($data_ary); 
      
?>