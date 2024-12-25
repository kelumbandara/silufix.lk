
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
    $j = 1; 
    $k = 1;
    $FaultType_DtName_ary   = array();
    $FaultType_Dt_ary       = array();    
    $FaultType_OccName_ary  = array();
    $FaultType_Occ_ary      = array();
    $McCategory_DtName_ary  = array();
    $McCategory_Dt_ary      = array();                           
    $McCategory_OccName_ary  = array();
    $McCategory_Occ_ary      = array();
    $DateWise_DtName_ary  = array();
    $DateWise_AttnDt_ary      = array();  
    $DateWise_McRepDt_ary      = array();
    
    $DateWise_OccName_ary  = array();
    $DateWise_Occ_ary      = array();
        
    $FaultType_DtName_ary[0] = "0";
    $FaultType_Dt_ary[0]     = 0;
    $FaultType_OccName_ary[0] = "0";
    $FaultType_Occ_ary[0]     = 0;
    $McCategory_DtName_ary[0] = "0";
    $McCategory_Dt_ary[0]     = 0;    
    $McCategory_OccName_ary[0] = "0";
    $McCategory_Occ_ary[0]     = 0;
    $DateWise_DtName_ary[0] = "0";
    $DateWise_AttnDt_ary[0]     = 0; 
    $DateWise_McRepDt_ary[0]     = 0;     
    
    $DateWise_OccName_ary[0] = "0";
    $DateWise_Occ_ary[0]     = 0;
        
    $error      = "NA";
    $intState   = 1;
    $strWoState = "Open"; 
    $strWoState1 = "Acknowledged"; 
    $strWoState2 = "Inprogress";
    $strWorkOrderCategory = "BreakDown";
    //$i = 1;
    try 
    {
        //-------------- Read Fault Type Wise Downtime ------------------------
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        $stmt = $conn->prepare("SELECT ClosedFaultType, SUM(TIMEDIFF(ClosedDateTime, CreatedDateTime)) AS Downtime FROM tblwo_event WHERE WorkOrderCategory =:wocat AND State !=:stat GROUP BY ClosedFaultType");
        $stmt->bindParam(':stat', $intState); 
        $stmt->bindParam(':wocat', $strWorkOrderCategory); 
        
        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();        
        foreach($result as $row)
        {           
            $FaultType_DtName_ary[$i] = $row['ClosedFaultType'];
            $FaultType_Dt_ary[$i] = $row['Downtime'];                     
            $i++;
        }
        $i = 0;
        //-------------- Read Fault Type Wise Occurance ------------------------
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        $stmt2 = $conn->prepare("SELECT ClosedFaultType, COUNT(WoDepartment) FROM tblwo_event WHERE WorkOrderCategory =:wocat AND State !=:stat GROUP BY ClosedFaultType");
        $stmt2->bindParam(':stat', $intState); 
        $stmt2->bindParam(':wocat', $strWorkOrderCategory); 
        $stmt2->execute();
        // set the resulting array to associative
        $stmt2->setFetchMode(PDO::FETCH_ASSOC);        
        $result2 = $stmt2->fetchAll();        
        foreach($result2 as $row2)
        {           
            $FaultType_OccName_ary[$i] = $row2['ClosedFaultType'];
            $FaultType_Occ_ary[$i] = $row2['COUNT(WoDepartment)'];                     
            $i++;
        }
        $i = 0;
        //-------------- Read Machine Category Wise Downtime ------------------------
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        $stmt3 = $conn->prepare("SELECT McCategory, SUM(TIMEDIFF(ClosedDateTime, CreatedDateTime)) AS Downtime FROM tblwo_event WHERE WorkOrderCategory =:wocat AND State !=:stat GROUP BY McCategory ");
        $stmt3->bindParam(':stat', $intState); 
        $stmt3->bindParam(':wocat', $strWorkOrderCategory); 
        $stmt3->execute();
        // set the resulting array to associative
        $stmt3->setFetchMode(PDO::FETCH_ASSOC);        
        $result3 = $stmt3->fetchAll();        
        foreach($result3 as $row3)
        {           
            $McCategory_DtName_ary[$i] = $row3['McCategory'];
            $McCategory_Dt_ary[$i] = $row3['Downtime'];                     
            $i++;
        }
        $i = 0;
        //-------------- Read Fault Type Wise Occurance ------------------------
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        $stmt4 = $conn->prepare("SELECT McCategory, COUNT(WoDepartment) FROM tblwo_event WHERE WorkOrderCategory =:wocat AND State !=:stat GROUP BY McCategory");
        $stmt4->bindParam(':stat', $intState); 
        $stmt4->bindParam(':wocat', $strWorkOrderCategory); 
        $stmt4->execute();
        // set the resulting array to associative
        $stmt4->setFetchMode(PDO::FETCH_ASSOC);        
        $result4 = $stmt4->fetchAll();        
        foreach($result4 as $row4)
        {           
            $McCategory_OccName_ary[$i] = $row4['McCategory'];
            $McCategory_Occ_ary[$i] = $row4['COUNT(WoDepartment)'];                     
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
    $data_ary['FaultType_DtName_Ary']  = $FaultType_DtName_ary;
    $data_ary['FaultType_Dt_Ary']      = $FaultType_Dt_ary;     
    $data_ary['FaultType_OccName_Ary'] = $FaultType_OccName_ary;
    $data_ary['FaultType_Occ_Ary']     = $FaultType_Occ_ary;    
    
    $data_ary['McCategory_DtName_Ary'] = $McCategory_DtName_ary;
    $data_ary['McCategory_Dt_Ary']     = $McCategory_Dt_ary;           
    $data_ary['McCategory_OccName_Ary'] = $McCategory_OccName_ary;
    $data_ary['McCategory_Occ_Ary']     = $McCategory_Occ_ary;
    
    $data_ary['DateWise_DtName_Ary']    = $DateWise_DtName_ary;
    $data_ary['DateWise_AttnDt_Ary']    = $DateWise_AttnDt_ary;
    $data_ary['DateWise_McRepDt_Ary']   = $DateWise_McRepDt_ary;
    
    //print json_encode($error);
    print json_encode($data_ary); 
    // print json_encode($ProductQuantity_ary);
       
?>