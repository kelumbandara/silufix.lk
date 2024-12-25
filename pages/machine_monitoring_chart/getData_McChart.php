
<?php
    
    require_once('../../initialize.php');
    require_once('../../config.php');
    
    $num = $_POST["userpara"];    
    //$startData = $num[0];
    //$endData = $num[1];
     
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Colombo');
    $strDateTime = date("Y-m-d");   
    //----------- Declare Variables -----------------------     
    $i = 0; 
    $j = 0; 
    $error = "NA";
    $MachineNumber = "SB-01";
               
    try 
    {
        //SELECT column_name(s) FROM table_name WHERE condition GROUP BY column_name(s) ORDER BY column_name(s);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                       
        //$stmt = $conn->prepare("SELECT ID,WorkOrderNo,Department,WoDateTime,Description,UserName,Status,Verify,ReOpen FROM tbleventworkorder WHERE WoState=:wost");
        $stmt = $conn->prepare("SELECT ServerDatetime, Sen1Speed FROM tblmc_speedevent WHERE MachineNumber=:mcno");
        $stmt->bindParam(':mcno', $MachineNumber); 
        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();        
        foreach($result as $row)
        {           
            $ServerDatetime_ary[$i] = $row['ServerDatetime'];
            $Sen1Speed_ary[$i] = $row['Sen1Speed'];                     
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
        $data_ary['ServerDatetime_Ary'] = $ServerDatetime_ary;
        $data_ary['Sen1Speed_Ary']      = $Sen1Speed_ary;        
    }
    else 
    {
        $data_ary = array(0);
    }
    //print json_encode($error);
    print json_encode($data_ary); 
   // print json_encode($ProductQuantity_ary);
       
?>