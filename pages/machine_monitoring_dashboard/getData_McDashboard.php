
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
    $intWoState = 1;
    //$tmpValue = 0;
    //$data = array();
    //$StoppedDtCat1Ary = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);	
    $ProductQuantity_ary = array(array());
    
     //echo $ProductQuantity_ary[1][1];
     //echo $ProductQuantity_ary[1][0];
                
    try 
    {
        //----------------------------------------------------------------------------------
        //------------ Read Data from tblfacstng_workcenter Table --------------------------
        //----------------------------------------------------------------------------------        
        //SELECT column_name(s) FROM table_name WHERE condition GROUP BY column_name(s) ORDER BY column_name(s);
        $conn_mc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //SELECT `ID`, `MachineID`, `MachineNumber`, `LastUpdatedTime`, `Sen1Speed`, `Sen2Speed`, `Sen3Speed`, `Sen4Speed`, `State` FROM `tblmcspeed_dashboard` WHERE 1
                
        $stmt = $conn_mc->prepare("SELECT MachineID,MachineNumber,Sen1Speed,Sen2Speed,Sen3Speed,Sen4Speed FROM tblmc_speeddashboard");
        //$stmt->bindParam(':wost', $intWoState); 
        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();        
        foreach($result as $row)
        {           
            $MachineID_ary[$i]      = $row['MachineID'];
            $MachineNumber_ary[$i]  = $row['MachineNumber'];  
            $Sen1Speed_ary[$i]     = $row['Sen1Speed'];  
            $Sen2Speed_ary[$i]     = $row['Sen2Speed'];  
            $Sen3Speed_ary[$i]     = $row['Sen3Speed'];  
            $Sen4Speed_ary[$i]     = $row['Sen4Speed'];  
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
        $data_ary['MachineID_Ary']      = $MachineID_ary;
        $data_ary['MachineNumber_Ary']  = $MachineNumber_ary; 
        $data_ary['Sen1Speed_Ary']      = $Sen1Speed_ary;  
        $data_ary['Sen2Speed_Ary']      = $Sen2Speed_ary;  
        $data_ary['Sen3Speed_Ary']      = $Sen3Speed_ary;  
        $data_ary['Sen4Speed_Ary']      = $Sen4Speed_ary;  
    }
    else 
    {
        $data_ary = array(0);
    }
    //print json_encode($error);
    print json_encode($data_ary); 
   // print json_encode($ProductQuantity_ary);
       
?>