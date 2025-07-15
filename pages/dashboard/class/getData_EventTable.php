
<?php
    
   // $num = $_POST["userpara"];    
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
        $conn->setAttribute(PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT Location, WorkOrderCategory, COUNT(*) AS Count FROM `tblwo_event` WHERE Date(serverDateTime)=:strDateTime and IssueType NOT IN ('RO - Electrical', 'Civil - Plumbing') 
                                        GROUP BY Location, WorkOrderCategory;");
         $stmt->bindParam(':strDateTime', $strDateTime);
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();   

        foreach($result as $row)
        {    
           if ($row['WorkOrderCategory'] == 'RedTag') {
            $IssueType_ary_RedTag[$i] = $row['Location'];
            $Count_ary_RedTag[$i]     = $row['Count'];
            $i++;
        }
        

        if ($row['WorkOrderCategory'] == 'BreakDown') {
            $IssueType_ary_Breakdown[$j] = $row['Location'];
            $Count_ary_Breakdown[$j]     = $row['Count'];
            $j++;
        }
      
        } 
    } 
    catch(PDOException $e) 
    {
        $error =  "Error: " . $e->getMessage();
    }    
    $conn = null;
    
        //------------ Update Line Balance Data ------------------------------------------------- 
       $data_ary['IssueType_ary_RedTag']    =! empty($IssueType_ary_RedTag) ? $IssueType_ary_RedTag:[0];
       $data_ary['Count_ary_RedTag']        =! empty( $Count_ary_RedTag) ? $Count_ary_RedTag:[0];
       $data_ary['IssueType_ary_Breakdown'] =! empty($IssueType_ary_Breakdown) ? $IssueType_ary_Breakdown:[0] ;
       $data_ary['Count_ary_Breakdown']     =! empty( $Count_ary_Breakdown) ? $Count_ary_Breakdown:[0];

    print json_encode($data_ary); 
      
?>