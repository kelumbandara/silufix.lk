
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
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT IssueType, COUNT(*) AS RedTag_Count FROM `tblwo_event` WHERE WorkOrderCategory = 'RedTag' GROUP BY IssueType");
        //$stmt->bindParam(':start_date', $start_date); 
        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();   

        foreach($result as $row)
        {           
           
            $RedTag_Count_ary[$i]       = $row['RedTag_Count']; 
            $IssueType_ary[$i]  = $row['IssueType']; 
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
        $data_ary['RedTag_Count_ary']                   = $RedTag_Count_ary;
        $data_ary['IssueType_ary']    = $IssueType_ary; 

    }
    else 
    {
        $data_ary = array(0);
    }
    //print json_encode($error);
    print json_encode($data_ary); 
   // print json_encode($ProductQuantity_ary);
       
?>