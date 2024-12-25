
<?php    
    $num = $_POST["userpara"];  
    require_once('../../../initialize.php');
    require_once('../../../config.php');
    
    $strFilterType   = $num[0];
    //$strFilterType   = "FaultType";
   
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strStopDateTime = date("Y-m-d H:i:s");
    //----------- Declare Variables -----------------------     
    $i = 0; 
    $tmpValue = 0;
    $data = array();
    
    $ReturnData_ary = array();	
   
    $ReturnData_ary[0]  = "Select data";
       
    if($strFilterType === "FaultType")
    {        
        //-------------- Machine Category Disinct Values ----------------------- 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT DISTINCT FaultType FROM tblwo_errorlevel_breakdown");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();        
        foreach($result as $row)
        {           
            $ReturnData_ary[$i+1] = $row['FaultType'];
            $i++;
        }        
    }
    else if($strFilterType === "Level1")
    {
        $strFaultType    = $num[1];
        //-------------- Machine Category Disinct Values ----------------------- 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT DISTINCT Level1 FROM tblwo_errorlevel_breakdown WHERE FaultType=:flttp");
        $stmt->bindParam(':flttp', $strFaultType);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();        
        foreach($result as $row)
        {           
            $ReturnData_ary[$i+1] = $row['Level1'];
            $i++;
        }
    }        
    else if($strFilterType === "Level2")
    {
        $strFaultType    = $num[1];
        $strLevel1    = $num[2];
        //-------------- Machine Category Disinct Values ----------------------- 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT DISTINCT Level2 FROM tblwo_errorlevel_breakdown WHERE FaultType=:flttp AND Level1=:lvl1");
        $stmt->bindParam(':flttp', $strFaultType);
        $stmt->bindParam(':lvl1', $strLevel1);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();        
        foreach($result as $row)
        {           
            $ReturnData_ary[$i+1] = $row['Level2'];
            $i++;
        }
    }
    else if($strFilterType === "Level3")
    {
        $strFaultType = $num[1];
        $strLevel1    = $num[2];
        $strLevel2    = $num[3];
        //-------------- Machine Category Disinct Values ----------------------- 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT DISTINCT Level3 FROM tblwo_errorlevel_breakdown WHERE FaultType=:flttp AND Level1=:lvl1 AND Level2=:lvl2");
        $stmt->bindParam(':flttp', $strFaultType);
        $stmt->bindParam(':lvl1', $strLevel1);
        $stmt->bindParam(':lvl2', $strLevel2);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();        
        foreach($result as $row)
        {           
            $ReturnData_ary[$i+1] = $row['Level3'];
            $i++;
        }
    }
    else if($strFilterType === "Level4")
    {
        $strFaultType = $num[1];
        $strLevel1    = $num[2];
        $strLevel2    = $num[3];
        $strLevel3    = $num[4];
        //-------------- Machine Category Disinct Values ----------------------- 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT DISTINCT Level4 FROM tblwo_errorlevel_breakdown WHERE FaultType=:flttp AND Level1=:lvl1 AND Level2=:lvl2 AND Level3=:lvl3");
        $stmt->bindParam(':flttp', $strFaultType);
        $stmt->bindParam(':lvl1', $strLevel1);
        $stmt->bindParam(':lvl2', $strLevel2);
        $stmt->bindParam(':lvl3', $strLevel3);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();        
        foreach($result as $row)
        {           
            $ReturnData_ary[$i+1] = $row['Level4'];
            $i++;
        }
    }     
    //----------- Load Arrays -------------------------
    $data_ary['Data_Ary']   = $ReturnData_ary;
      
   //print json_encode($sql);
   print json_encode($data_ary);  
       
?>