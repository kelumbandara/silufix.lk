
<?php
    require_once('../../initialize.php');
    require_once('../../config.php');
    
    $num = $_POST["userpara"];    
    //$startData = $num[0];
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Colombo');
    $strDateTime = date("Y-m-d");   
    //----------- Declare Variables -----------------------     
    $i = 0; 
    $j = 1; 
    $k = 1;
                
    $WorkOrderCategory_ary  = array();
    $WorkOrderCount_ary     = array();  
    $FaultType_ary          = array();
    $FaultTypeCount_ary     = array();    
    $McCategoryName_ary     = array();
    $McCategoryCount_ary    = array();
          
    $WorkOrderDateName_ary     = array();
    $WorkOrderDateCount_ary    = array();
               
    $WorkOrderCategory_ary[0] = "0";
    $WorkOrderCount_ary[0]    = 0;
    $FaultType_ary[0]         = "0";
    $FaultTypeCount_ary[0]    = 0;    
    $McCategoryName_ary[0]    = "0";
    $McCategoryCount_ary[0]   = 0;
                           
    $WorkOrderDateName_ary[0]    = "0";
    $WorkOrderDateCount_ary[0]   = 0;
    
    $error      = "NA";
    $intState   = 1;
    $strWoState = "Open"; 
    $strWoState1 = "Acknowledged"; 
    $strWoState2 = "Inprogress";
    $strWorkOrderCategory = "BreakDown";
    //$i = 1;
    try 
    {
        //-------------- 1. Work Order Category  ------------------------
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        $stmt = $conn->prepare("SELECT WorkOrderCategory, COUNT(WorkOrderNo) AS WorkOrderCount FROM tblwo_event GROUP BY WorkOrderCategory");
        //$stmt->bindParam(':stat', $intState); 
        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();        
        foreach($result as $row)
        {           
            $WorkOrderCategory_ary[$i] = $row['WorkOrderCategory'];
            $WorkOrderCount_ary[$i] = $row['WorkOrderCount'];                     
            $i++;
        }
        $i = 0;
        //-------------- 2. Fault Type  ------------------------
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        $stmt2 = $conn->prepare("SELECT ClosedFaultType, COUNT(WorkOrderNo) AS WorkOrderCount FROM tblwo_event GROUP BY ClosedFaultType");
        //$stmt2->bindParam(':stat', $intState); 
        //$stmt2->bindParam(':wocat', $strWorkOrderCategory); 
        $stmt2->execute();
        // set the resulting array to associative
        $stmt2->setFetchMode(PDO::FETCH_ASSOC);        
        $result2 = $stmt2->fetchAll();        
        foreach($result2 as $row2)
        {           
            $FaultType_ary[$i] = $row2['ClosedFaultType'];
            $FaultTypeCount_ary[$i] = $row2['WorkOrderCount'];                     
            $i++;
        }
        $i = 0;
        //-------------- 3. Machine Category Wise Downtime ------------------------
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        $stmt3 = $conn->prepare("SELECT McCategory, COUNT(WorkOrderNo) AS WorkOrderCount FROM tblwo_event GROUP BY McCategory ");
        $stmt3->bindParam(':stat', $intState); 
        $stmt3->bindParam(':wocat', $strWorkOrderCategory); 
        $stmt3->execute();
        // set the resulting array to associative
        $stmt3->setFetchMode(PDO::FETCH_ASSOC);        
        $result3 = $stmt3->fetchAll();        
        foreach($result3 as $row3)
        {           
            $McCategoryName_ary[$i] = $row3['McCategory'];
            $McCategoryCount_ary[$i] = $row3['WorkOrderCount'];                     
            $i++;
        }
        $i = 0;
        //-------------- 4. Date wise No of WorkOrders  ------------------------
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        $stmt4 = $conn->prepare("SELECT DATE(ServerDateTime) AS Date, COUNT(WorkOrderNo) AS WorkOrderCount FROM tblwo_event GROUP BY Date");
        //$stmt4->bindParam(':stat', $intState); 
        //$stmt4->bindParam(':wocat', $strWorkOrderCategory); 
        $stmt4->execute();
        // set the resulting array to associative
        $stmt4->setFetchMode(PDO::FETCH_ASSOC);        
        $result4 = $stmt4->fetchAll();        
        foreach($result4 as $row4)
        {           
            $WorkOrderDateName_ary[$i]  = $row4['Date'];
            $WorkOrderDateCount_ary[$i] = $row4['WorkOrderCount'];                     
            $i++;
        }
        $i = 0;
        //-------------- Read Machine Category Wise Downtime ------------------------
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        $stmt5 = $conn->prepare("SELECT DATE(ServerDateTime) AS Date, SUM(TIMESTAMPDIFF(MINUTE, CreatedDateTime, RespondDateTime)) AS AttnDowntime, SUM(TIMESTAMPDIFF(MINUTE, CreatedDateTime, ClosedDateTime)) AS McRepTime FROM tblwo_event WHERE WorkOrderCategory =:wocat AND State != 1 GROUP BY Date");
        $stmt5->bindParam(':stat', $intState); 
        $stmt5->bindParam(':wocat', $strWorkOrderCategory); 
        $stmt5->execute();
        // set the resulting array to associative
        $stmt5->setFetchMode(PDO::FETCH_ASSOC);        
        $result5 = $stmt5->fetchAll();        
        foreach($result5 as $row5)
        {           
            $DateWise_DtName_ary[$i]  = $row5['Date'];
            $DateWise_AttnDt_ary[$i]      = $row5['AttnDowntime'];  
            $DateWise_McRepDt_ary[$i]      = $row5['McRepTime'];             
            $i++;
        }
    } 
    catch(PDOException $e) 
    {
        $error =  "Error: " . $e->getMessage();
    }    
    $conn = null;
    //------------ Fault Type Downtime Data -------------------------------------------------  
    $data_ary['CategoryColorAry'] = array('#008000','#FF0000','#FFFF00','#EE82EE','#FFA500','#0000FF');
    $data_ary['WorkOrderCategory_Ary']  = $WorkOrderCategory_ary;
    $data_ary['WorkOrderCount_Ary']     = $WorkOrderCount_ary;     
    $data_ary['FaultType_Ary']          = $FaultType_ary;
    $data_ary['FaultTypeCount_Ary']     = $FaultTypeCount_ary;     
    $data_ary['McCategoryName_Ary']     = $McCategoryName_ary;
    $data_ary['McCategoryCount_Ary']    = $McCategoryCount_ary;     
    
    $data_ary['WorkOrderDateName_Ary']     = $WorkOrderDateName_ary;
    $data_ary['WorkOrderDateCount_Ary']    = $WorkOrderDateCount_ary;
                
    //print json_encode($error);
    print json_encode($data_ary); 
    // print json_encode($ProductQuantity_ary);
       
?>