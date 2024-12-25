
<?php    
    $num = $_POST["userpara"];  
    
    require_once('../../../initialize.php');
    require_once('../../../config.php');
    
    $strWoNumber        = $num[0];
    //$strWoDepartment    = $num[1];   
    //$strWoNumber = "WO_00000062";
        
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strStopDateTime = date("Y-m-d H:i:s");
    //----------- Declare Variables -----------------------     
    $i = 0; 
    $tmpValue = 0;
    
    //$data = array();
    //$McCategory_Ary = array();	
    //$Level1_Ary = array();	
    //$MachineNumber_Ary = array();
    
    $WorkOrderNo_ary        = array(); 
    $CreatedDateTime_ary    = array();
    
    $FaultType_ary              = array();
    $WorkOrderCategory_ary      = array();
    $WorkOrderSubCategory_ary   = array();
    
    $WoDescription_ary      = array();
    $WoDepartment_ary       = array();    
    $MachineNo_ary          = array(); 
    $AllocatedUser_ary      = array();         
    $WoEventLog_ary         = array();

    //$data[0]  = $strWoNumber;
    //$Level3_ary[0]      = "Select data";
    //$MachineNumber_ary[0]  = "Select data";
    
    //-------------- Machine Category Disinct Values ----------------------- 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT WorkOrderNo,CreatedDateTime,CreatedFaultType,WorkOrderCategory,WorkOrderSubCategory,WoDescription,WoDepartment,MachineNo,AllocatedUser,WoEventLog FROM tblwo_event WHERE WorkOrderNo =:wono");
    $stmt->bindParam(':wono', $strWoNumber);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);        
    $result = $stmt->fetchAll();        
    foreach($result as $row)
    {           
        $WorkOrderNo_ary[$i]      = $row['WorkOrderNo'];
        $CreatedDateTime_ary[$i]  = $row['CreatedDateTime'];          
        $FaultType_ary[$i]              = $row['CreatedFaultType'];
        $WorkOrderCategory_ary[$i]      = $row['WorkOrderCategory'];
        $WorkOrderSubCategory_ary[$i]   = $row['WorkOrderSubCategory']; 
        $WoDescription_ary[$i]    = $row['WoDescription'];      
        $WoDepartment_ary[$i]     = $row['WoDepartment'];
        $MachineNo_ary[$i]        = $row['MachineNo'];
        $AllocatedUser_ary[$i]    = $row['AllocatedUser'];        
        $WoEventLog_ary[$i]       = explode(',', $row['WoEventLog']);   //$row['WoEventLog'];        
        $i++;
    }             
    //----------- Load Arrays -------------------------
    $data_ary['WorkOrderNo_Ary']        = $WorkOrderNo_ary;    
    $data_ary['CreatedDateTime_Ary']    = $CreatedDateTime_ary;      
    $data_ary['FaultType_Ary']              = $FaultType_ary;
    $data_ary['WorkOrderCategory_Ary']      = $WorkOrderCategory_ary;
    $data_ary['WorkOrderSubCategory_Ary']   = $WorkOrderSubCategory_ary;
    $data_ary['WoDescription_Ary']  = $WoDescription_ary; 
    $data_ary['WoDepartment_Ary']   = $WoDepartment_ary;    
    $data_ary['MachineNo_Ary']      = $MachineNo_ary;  
    $data_ary['AllocatedUser_Ary']  = $AllocatedUser_ary;  
    $data_ary['WoEventLog_Ary']     = $WoEventLog_ary; 
      
   //print json_encode($sql);
   print json_encode($data_ary);  
       
?>