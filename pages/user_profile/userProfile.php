<?php

    session_start();
    require_once('../../initialize.php');
    require_once('../../config.php');
    
    $num = $_POST["userpara"];
    
    //$strFuncType = $num[0];    
    $strFuncType = "funUpdateUser";
   
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strServerDateTime = date("Y-m-d H:i:s");    
    //----------- Declare Variables -----------------------  
    $i = 0; 
    $j = 0;     
    $Status_ary     = array();
    $ReturnData_ary = array();
    $Password_ary   = array();
    //$ReturnData_ary[0][0]  = "NA";
    $strText    = "NA";
    $ReturnData_ary[0]  = "NA";  
    $Password_ary[0]    = "NA";
    
    if($strFuncType === "funUpdateUser") //------------- funUpdateEventLog --------------------
    {
        $strEPF             = $num[1]; 
        $strCurrPassword    = $num[2];
        $strNewPassword     = $num[3];    
        //$strEPF             = "10393";          
        //$strCurrPassword    = "1234";
        try 
        {            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
            $stmt = $conn->prepare("SELECT Password FROM tblusers_account WHERE EPF=:epf");
            $stmt->bindParam(':epf', $strEPF);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();        
            foreach($result as $row)
            {           
                $Password_ary[$i] = $row['Password'];           
            } 
            //echo $Password_ary[0];
            
            if($strCurrPassword != $Password_ary[0] )   // Current Password not Match
            {
                $Status_ary[0] = "false";
                $Status_ary[1] = "Current Password Error.";      
            }
            else
            {                 
                $stmt = $conn->prepare("UPDATE tblusers_account SET Password=:newpw WHERE EPF=:epf");
                $stmt->bindParam(':epf', $strEPF);
                $stmt->bindParam(':newpw', $strNewPassword);                
                $stmt->execute();                
                $Status_ary[0] = "true";
                $Status_ary[1] = "Password Update Successfully."; 
            }
        }
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }    

    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
        
    //print json_encode($error);
    print json_encode($data_ary); 

?>
