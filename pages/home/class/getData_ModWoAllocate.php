
<?php    
    $num = $_POST["userpara"];    
    require_once('../../../initialize.php');
    require_once('../../../config.php');
    
    $strWoNumber = $num[0];  
    //$strWoNumber = "WO_00000104";    
   
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strStopDateTime = date("Y-m-d H:i:s");
    //----------- Declare Variables -----------------------     
    $i = 0; 
    $tmpValue   = 0;
    $data       = array();
    $EPF_Ary    = array();
    $EmpName_Ary = array();
    $Contact_Ary = array();	
    $AllocatedUsers_Ary = array();
    
    //$McCategory_Ary[0]  = "Select data";     
    //-------------- Read All Mechanics from Users List ----------------------- 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT EPF,EmpName,Contact FROM tblusers_account WHERE UserType = 'mc'");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);        
    $result = $stmt->fetchAll();        
    foreach($result as $row)
    {           
        $EPF_Ary[$i]        = $row['EPF'];
        $EmpName_Ary[$i]    = $row['EmpName'];
        $Contact_Ary[$i]    = $row['Contact'];
        $i++;
    }  
    //-------------- Read Allocate User List  ----------------------- 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt2 = $conn->prepare("SELECT AllocatedUser FROM tblwo_event WHERE WorkOrderNo=:wono");
    $stmt2->bindParam(':wono', $strWoNumber); 
    $stmt2->execute();
    $stmt2->setFetchMode(PDO::FETCH_ASSOC);        
    $result2 = $stmt2->fetchAll();   
    $i  = 0;
    foreach($result2 as $row)
    {           
        $AllocatedUser_ary[$i] = $row['AllocatedUser'];          
        $i++;
    }  
    $AllocatedUsers_Ary = explode(',', $AllocatedUser_ary[0]);
    
    //----------- Load Arrays -------------------------
    $data_ary['EPF_Ary']     = $EPF_Ary; 
    $data_ary['EmpName_Ary'] = $EmpName_Ary;    
    $data_ary['Contact_Ary'] = $Contact_Ary;  
    $data_ary['AllocatedUsers_Ary'] = $AllocatedUsers_Ary;  
   //print json_encode($sql);
   print json_encode($data_ary); 
   
?>