
<?php    

    require_once('../../../initialize.php');
    require_once('../../../config.php');
    
    $num = $_POST["userpara"];    
    $strFilterType   = $num[0];
    //$strFilterType   = "Level1";
               
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strStopDateTime = date("Y-m-d H:i:s");
    //----------- Declare Variables -----------------------     
     //----------- Declare Variables -----------------------     
    $i = 0; 
    $j = 0;     
    $Status_ary     = array();
    $ReturnData_ary = array();
    $ReturnData_ary[0]  = "Select data";  
   
    $strDep = $num[1];   
    //$strDep = "Planning";
    $i = 1;
    if($strFilterType === "MachineCategory")
    {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($strDep == "Engineering")
        {
            $sqlString = "SELECT DISTINCT MachineCategory FROM tblwo_machinemanagement";        
        }
        else
        {
           $sqlString = "SELECT DISTINCT MachineCategory FROM tblwo_machinemanagement WHERE Department='" . $strDep . "'" ; 
        }
        $stmt = $conn->prepare($sqlString);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();        
        foreach($result as $row)
        {                            
            $ReturnData_ary[$i]    = $row['MachineCategory'];                         
            $i++;
        }  
        if($i === 0)    // No Data
        {
            $Status_ary[0] = "false";
            $Status_ary[1] = "Data not found"; 
        }
        else
        {
            $Status_ary[0] = "true";
            $Status_ary[1] = "Data available"; 
        }        
    }    
    else if($strFilterType === "FaultType")
    {
        $strMcCategory  = $num[2];
        //$strMcCategory  = "Electric Forklift";        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $sqlString = "SELECT DISTINCT FaultType FROM tblwo_errorlevel_breakdown WHERE McCategory='". $strMcCategory . "'"; 
        
        $stmt = $conn->prepare($sqlString);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();        
        foreach($result as $row)
        {                            
            $ReturnData_ary[$i]    = $row['FaultType'];                         
            $i++;
        }  
        
       
        if($i === 0)    // No Data
        {
            $Status_ary[0] = "false";
            $Status_ary[1] = $sqlString; 
        }
        else
        {
            $Status_ary[0] = "true";
            $Status_ary[1] = $sqlString; 
        }        
    }
    else if($strFilterType === "Level1")
    {
        $strMcCategory  = $num[2];
        $strFaultType   = $num[3];        
        //$strMcCategory  = "Electric Forklift";
        //$strFaultType  = "Electrical";        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sqlString = "SELECT DISTINCT Level1 FROM tblwo_errorlevel_breakdown WHERE McCategory='" . $strMcCategory . "' AND FaultType='". $strFaultType . "'" ; 
        $stmt = $conn->prepare($sqlString);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();        
        foreach($result as $row)
        {                            
            $ReturnData_ary[$i]    = $row['Level1'];                         
            $i++;
        }  
        if($i === 0)    // No Data
        {
            $Status_ary[0] = "false";
            $Status_ary[1] = "Data not found"; 
        }
        else
        {
            $Status_ary[0] = "true";
            $Status_ary[1] = "Data Available"; 
        }        
    }
    
    //----------- Load Arrays -------------------------
    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
      
   //print json_encode($sql);
   print json_encode($data_ary);  
       
?>