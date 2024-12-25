<?php

    session_start();
    require_once('../../initialize.php');
    require_once('../../config.php');
    
    $num = $_POST["userpara"];
    
    $strFuncType = $num[0];    
    //$strFuncType = "funGetMachineTable";
       
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strServerDateTime = date("Y-m-d H:i:s");    
    //----------- Declare Variables -----------------------  
    $i = 0; 
    $j = 0;     
    $Status_ary     = array();
    $ReturnData_ary = array();
    //$ReturnData_ary[0][0]  = "NA";
    $strText    = "";
    $ReturnData_ary[0] = "NA";  
    if($strFuncType === "funGetMachineTable") //------------- funUpdateEventLog --------------------
    {
        //$strUserType         = $num[1];               
        try 
        {
            $conn_mc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $stmt = $conn_mc->prepare("SELECT * FROM tblmc_configuration");
            //$stmt->bindParam(':wono', $strWoNumber);      
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            //$i = 1;
            foreach($result as $row)
            {             
                $strText .= "<tr>";               
                $strText .= "<td>" . $row['ID'] . "</td>";
                $strText .= "<td>" . $row['ModuleNo'] . "</td>";
                $strText .= "<td>" . $row["MachineCategory"] . "</td>";
                $strText .= "<td>" . $row["MachineNumber"] . "</td>";
                $strText .= "<td>" . $row["RpmScaleFactor"] . "</td>";
                $strText .= "<td>" . $row["LengthScaleFactor"] . "</td>";
                  //$strText .= "<td><button class='btn btn-warning btn-sm' onclick='editUser(" . $row["ID"] . ")'>Edit</button> <button class='btn btn-danger btn-sm' onclick='deleteUser(" . $row["ID"] . ")'>Delete</button></td>";
                $strText .= "<td><button class='btn btn-warning btn-sm' onclick='editUser(" . $row["ID"] . ")'>Edit</button></td>";
                $strText .= "<td><button class='btn btn-danger btn-sm' onclick='deleteUser(" . $row["ID"] . ")'>Delete</button></td>";
                $strText .= "</tr>";                
                $i++;
            }  
            if($i === 0)    // No Data
            {
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not found"; 
            }
            else
            {
                $ReturnData_ary[0] = $strText;
                $Status_ary[0] = "true";
                $Status_ary[1] = "Data Available"; 
            } 
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn_mc = null;
    }
    else if($strFuncType === "funDeleteUser") //------------- funUpdateEventLog --------------------
    {
        $strUserID         = $num[1];
        //$strUserID       = 21;  
        //$strSectionData      = $num[2];  
        //$strUserType         = "admin"; 
        //$strSectionData      = "10";        
        try 
        {
            $conn_mc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            //$stmt = $conn_mc->prepare("SELECT * FROM tblusers_account WHERE ID=:usrid");
            $stmt = $conn_mc->prepare("DELETE FROM tblmc_configuration WHERE ID=:usrid");   
            $stmt->bindParam(':usrid', $strUserID);      
            $stmt->execute();
            // set the resulting array to associative
            //$stmt->setFetchMode(PDO::FETCH_ASSOC);        
            //$result = $stmt->fetchAll();
            //$i = 1;            
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
        $conn_mc = null;
    }
    else if($strFuncType === "funUpdateUser") //------------- funUpdateEventLog --------------------
    {
        $strID          = $num[1]; 
        $strModuleNo       = $num[2];
        $strMachineCategory = $num[3];
        $strMachineNumber   = $num[4];
        $strRpmScale        = $num[5];
        $strLengthScale      = $num[6];      
        //$strStatus    = "Active"; 
        
        try 
        {
            $conn_mc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn_mc->prepare("UPDATE tblmc_configuration SET ModuleNo=:assetcd, MachineCategory=:mchcat, MachineNumber=:mchno, RpmScaleFactor=:valadd, LengthScaleFactor=:department WHERE ID=:userid");
            $stmt->bindParam(':userid', $strID);
            $stmt->bindParam(':assetcd', $strModuleNo);
            $stmt->bindParam(':mchcat', $strMachineCategory);
            $stmt->bindParam(':mchno', $strMachineNumber);
            $stmt->bindParam(':valadd', $strRpmScale);
            $stmt->bindParam(':department', $strLengthScale);
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
        $conn_mc = null;
    }
    else if($strFuncType === "funNewUser") //------------- funUpdateEventLog --------------------
    {
        //$strID            = $num[1]; 
        $strModuleNo       = $num[2];
        $strMachineCategory = $num[3];
        $strMachineNumber   = $num[4];
        $strRpmScale        = $num[5];
        $strLengthScale      = $num[6];      
        $strStatus          = "Active";       
            
        try 
        {
            $conn_mc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn_mc->prepare("INSERT INTO tblmc_configuration (ModuleNo,MachineCategory,MachineNumber,RpmScaleFactor,LengthScaleFactor,State) VALUES (:assetcd, :mchcat, :mchno, :valadd, :department, :status)");
            $stmt->bindParam(':assetcd', $strModuleNo);
            $stmt->bindParam(':mchcat', $strMachineCategory);
            $stmt->bindParam(':mchno', $strMachineNumber);
            $stmt->bindParam(':valadd', $strRpmScale);
            $stmt->bindParam(':department', $strLengthScale);
            $stmt->bindParam(':status', $strStatus);            
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
        $conn_mc = null;
    } 
    if($strFuncType === "funGetMachineCategory") //------------- funUpdateEventLog --------------------
    {
        //$strUserType         = $num[1];               
        try 
        {
            $conn_mc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $stmt = $conn_mc->prepare("SELECT DISTINCT MachineCategory FROM tblmc_configuration");
            //$stmt->bindParam(':wono', $strWoNumber);      
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            $i = 0;
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
                $Status_ary[1] = "Data Available"; 
            } 
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn_mc = null;
    }

    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
        
    //print json_encode($error);
    print json_encode($data_ary); 

?>
