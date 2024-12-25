
<?php
    session_start();
    require_once('../../initialize.php');
    require_once('../../config.php');
    
    $num = $_POST["userpara"];
    
    $strFuncType = $num[0];    
    //$strFuncType = "funUpdateUserSections";
    
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strServerDateTime = date("Y-m-d H:i:s");    
    //----------- Declare Variables -----------------------  
    $i = 0; 
    $j = 0;     
    $Status_ary     = array();
    $ReturnData_ary = array();
    $ReturnData_ary[0]  = "NA";  
    
    if($strFuncType === "funUpdateUserSections") //------------- funUpdateEventLog --------------------
    {
        $strUserType         = $num[1]; 
        $strSectionData      = $num[2];
  
        //$strUserType         = "admin"; 
        //$strSectionData      = "10";        
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
            $stmt = $conn->prepare("UPDATE tblusers_roleaccess SET Sections= :secdata WHERE UserType=:usrtp");
            $stmt->bindParam(':secdata', $strSectionData); 
            $stmt->bindParam(':usrtp', $strUserType); 
            $stmt->execute();
            
            $Status_ary[0] = "true";
            $Status_ary[1] = "Update Success Eventlog"; 
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }
    else if($strFuncType === "funUpdateUserAreas") //------------- funUpdateEventLog --------------------
    {
        $strUserType      = $num[1]; 
        $strAreaData      = $num[2];
  
        //$strUserType         = "admin"; 
        //$strSectionData      = "10";        
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
            $stmt = $conn->prepare("UPDATE tblusers_roleaccess SET Areas= :areadata WHERE UserType=:usrtp");
            $stmt->bindParam(':areadata', $strAreaData); 
            $stmt->bindParam(':usrtp', $strUserType); 
            $stmt->execute();
            
            $Status_ary[0] = "true";
            $Status_ary[1] = "Update Success Eventlog"; 
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }
    else if($strFuncType === "funUpdateUserOther") //------------- funUpdateEventLog --------------------
    {
        $strUserType      = $num[1]; 
        $strOtherData      = $num[2];  
        //$strUserType         = "admin"; 
        //$strSectionData      = "10";        
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
            $stmt = $conn->prepare("UPDATE tblusers_roleaccess SET Other= :othdata WHERE UserType=:usrtp");
            $stmt->bindParam(':othdata', $strOtherData); 
            $stmt->bindParam(':usrtp', $strUserType); 
            $stmt->execute();
            
            $Status_ary[0] = "true";
            $Status_ary[1] = "Update Success Eventlog"; 
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }    
    else if($strFuncType === "funDeleteUser") //------------- funUpdateEventLog --------------------
    {        
        $strUserType         = $num[1];
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            //$stmt = $conn->prepare("SELECT * FROM tblusers_account WHERE ID=:usrid");
            $stmt = $conn->prepare("DELETE FROM tblusers_roleaccess WHERE UserType=:usrtp");   
            $stmt->bindParam(':usrtp', $strUserType);      
            $stmt->execute();          
            $affectedRows = $stmt->rowCount();
            if ($affectedRows > 0) 
            {
                // Deletion was successful
                $ReturnData_ary[0] = "NA";
                $Status_ary[0] = "true";
                $Status_ary[1] = "Delete Success"; 
            }
            else
            {
                // No matching user found for deletion
                $Status_ary[0] = "false";
                $Status_ary[1] = "Delete Not Success";
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
    else if($strFuncType === "funInsertUserType") //------------- funUpdateEventLog --------------------
    {        
        $strUserType        = $num[1];
        $strRoleDescription = $num[2];
        $strSections        = "1";
        $strAreas           = "1";
        $strOther           = "1";
        $strStatus          = "1";
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("INSERT INTO tblusers_roleaccess (UserType, RoleDescription, Sections, Areas, Other, Status) VALUES (:usrtp, :roldes, :sec, :area, :oth, :stat)");
            $stmt->bindParam(':usrtp', $strUserType);
            $stmt->bindParam(':roldes', $strRoleDescription);
            $stmt->bindParam(':sec', $strSections);
            $stmt->bindParam(':area', $strAreas);
            $stmt->bindParam(':oth', $strOther);
            $stmt->bindParam(':stat', $strStatus);            
            $stmt->execute();
            $Status_ary[0] = "true";
            $Status_ary[1] = "Update Success Eventlog"; 
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