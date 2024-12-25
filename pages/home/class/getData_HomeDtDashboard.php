
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
    $i = 1; 
    $j = 1; 
    $k = 1;
    $RunDT_ID_ary          = array();
    $RunDT_MachineNo_ary   = array();
    $RunDT_Downtime_ary    = array(); 
    
    $AttnDT_ID_ary          = array();
    $AttnDT_MachineNo_ary   = array();
    $AttnDT_Downtime_ary    = array();    
    $RepDT_Downtime_ary     = array();
    $TotDT_Downtime_ary     = array();
    
    $RunDT_ID_ary[0]           = "NA";
    $RunDT_MachineNo_ary[0]    = "NA";
    $RunDT_Downtime_ary[0]     = "NA"; 
    
    $AttnDT_ID_ary[0]          = "NA";
    $AttnDT_MachineNo_ary[0]   = "NA";
    $AttnDT_Downtime_ary[0]    = "NA";
    $RepDT_Downtime_ary[0]     = "NA";
    $TotDT_Downtime_ary[0]     = "NA";
    
    $error = "NA";
    $strWoState = "New"; 
    $strWoState1 = "Inprogress"; 
    $strWoState2 = "Inprogress";
    $strWorkOrderCategory   = "BreakDown";
    //$i = 1;
    try 
    {
        //-------------- Read Running Downtime , WoState="Open" ------------------------
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                       
        $stmt = $conn->prepare("SELECT ID, MachineNo, TIMEDIFF(NOW(), CreatedDateTime) AS RunDowntime FROM tblwo_event WHERE WoStatus =:wost AND WorkOrderCategory =:wocat");
        $stmt->bindParam(':wost', $strWoState);
        $stmt->bindParam(':wocat', $strWorkOrderCategory);
        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();        
        foreach($result as $row)
        {           
            $RunDT_ID_ary[$i] = $row['ID'];
            $RunDT_MachineNo_ary[$i] = $row['MachineNo'];  
            $RunDT_Downtime_ary[$i] = $row['RunDowntime'];            
            $i++;
        }
        //-------------- Read Time for Attend , WoState="Acknoladged" AND "Inprogress"  ------------------------
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                       
        //$stmt = $conn->prepare("SELECT ID, MachineNo, TIMEDIFF(NOW(), RespondDateTime) AS RunDowntime FROM tblwo_event WHERE WoStatus =:wostat1 OR WoStatus =:wostat2");
        $stmt2 = $conn->prepare("SELECT ID, MachineNo, TIMEDIFF(RespondDateTime, CreatedDateTime) AS AttnDowntime, TIMEDIFF(NOW(), RespondDateTime) AS RepDowntime, TIMEDIFF(NOW(), CreatedDateTime) AS TotDowntime FROM tblwo_event WHERE (WoStatus =:wostat1 OR WoStatus =:wostat2) AND WorkOrderCategory =:wocatgo");
        $stmt2->bindParam(':wostat1', $strWoState1); 
        $stmt2->bindParam(':wostat2', $strWoState2); 
        $stmt2->bindParam(':wocatgo', $strWorkOrderCategory);
        $stmt2->execute();
        // set the resulting array to associative
        $stmt2->setFetchMode(PDO::FETCH_ASSOC);        
        $result2 = $stmt2->fetchAll();        
        foreach($result2 as $row)
        {           
            $AttnDT_ID_ary[$j] = $row['ID'];
            $AttnDT_MachineNo_ary[$j] = $row['MachineNo'];  
            $AttnDT_Downtime_ary[$j] = $row['AttnDowntime']; 
            $RepDT_Downtime_ary[$j] = $row['RepDowntime']; 
            $TotDT_Downtime_ary[$j] = $row['TotDowntime']; 
            $j++;
        }       
    } 
    catch(PDOException $e) 
    {
        $error =  "Error: " . $e->getMessage();
    }    
    $conn = null;

    //------------ Running Downtime Data -------------------------------------------------   
    $data_ary['RunDT_ID_Ary']             = $RunDT_ID_ary;
    $data_ary['RunDT_MachineNo_Ary']      = $RunDT_MachineNo_ary; 
    $data_ary['RunDT_RunDowntime_Ary']    = $RunDT_Downtime_ary;   
    //------------ Attn, Repair and Total Downtime Data -------------------------------------------------   
    $data_ary['AttnDT_ID_Ary']             = $AttnDT_ID_ary;
    $data_ary['AttnDT_MachineNo_Ary']      = $AttnDT_MachineNo_ary; 
    $data_ary['AttnDT_Downtime_Ary']      = $AttnDT_Downtime_ary;   
    $data_ary['RepDT_Downtime_Ary']    = $RepDT_Downtime_ary;   
    $data_ary['TotDT_Downtime_Ary']    = $TotDT_Downtime_ary;
    
    //print json_encode($error);
    print json_encode($data_ary); 
   // print json_encode($ProductQuantity_ary);
       
?>