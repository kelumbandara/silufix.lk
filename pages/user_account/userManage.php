<?php

    session_start();
    require_once('../../initialize.php');
    require_once('../../config.php');
    
    $num = $_POST["userpara"];    
    $strFuncType = $num[0];    
    //$strFuncType = "funGetUserTable";
   
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
    if($strFuncType === "funGetUserTable") //------------- funUpdateEventLog --------------------
    {
        //$strUserType         = $num[1];               
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $stmt = $conn->prepare("SELECT * FROM tblusers_account");
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
                $strText .= "<td>" . $row['EPF'] . "</td>";
                $strText .= "<td>" . $row["EmpName"] . "</td>";
                $strText .= "<td>" . $row["UserName"] . "</td>";
                //$strTex += "<td>" . $row["Password"] . "</td>";
                $strText .= "<td data-password='" . htmlspecialchars($row["Password"], ENT_QUOTES, 'UTF-8') . "'>********</td>";
                $strText .= "<td>" . $row["Department"] . "</td>";
                $strText .= "<td>" . $row["Contact"] . "</td>";            
                $strText .= "<td>" . $row["Email"] . "</td>";
                $strText .= "<td>" . $row["UserType"] . "</td>";
                $strText .= "<td>" . $row["Availability"] . "</td>";
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
        $conn = null;
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
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            //$stmt = $conn->prepare("SELECT * FROM tblusers_account WHERE ID=:usrid");
            $stmt = $conn->prepare("DELETE FROM tblusers_account WHERE ID=:usrid");   
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
        $conn = null;
    }
    else if($strFuncType === "funUpdateUser") //------------- funUpdateEventLog --------------------
    {
        $strID          = $num[1]; 
        $strEPF         = $num[2];
        $strEmpName     = $num[3];
        $strUserName    = $num[4];
        $strPassword    = $num[5];
        $strDepartment  = $num[6];
        $strContact     = $num[7];
        $strEmail       = $num[8];
        $strUserType    = $num[9];
        $strAvailability    = $num[10];
        $strStatus    = "Active";
       
        try 
        {
            if($strPassword == "********")
            {
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("UPDATE tblusers_account SET EPF=:epf, EmpName=:empname, UserName=:username, Department=:department, Contact=:contact, Email=:email, UserType=:usertype, Availability=:availability, Status=:status WHERE ID=:userid");
                $stmt->bindParam(':epf', $strEPF);
                $stmt->bindParam(':empname', $strEmpName);
                $stmt->bindParam(':username', $strUserName);
                $stmt->bindParam(':department', $strDepartment);
                $stmt->bindParam(':contact', $strContact);
                $stmt->bindParam(':email', $strEmail);
                $stmt->bindParam(':usertype', $strUserType);
                $stmt->bindParam(':availability', $strAvailability);
                $stmt->bindParam(':status', $strStatus);
                $stmt->bindParam(':userid', $strID);
            }
            else 
            {
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("UPDATE tblusers_account SET EPF=:epf, EmpName=:empname, UserName=:username, Password=:password, Department=:department, Contact=:contact, Email=:email, UserType=:usertype, Availability=:availability, Status=:status WHERE ID=:userid");
                $stmt->bindParam(':epf', $strEPF);
                $stmt->bindParam(':empname', $strEmpName);
                $stmt->bindParam(':username', $strUserName);
                $stmt->bindParam(':password', $strPassword);
                $stmt->bindParam(':department', $strDepartment);
                $stmt->bindParam(':contact', $strContact);
                $stmt->bindParam(':email', $strEmail);
                $stmt->bindParam(':usertype', $strUserType);
                $stmt->bindParam(':availability', $strAvailability);
                $stmt->bindParam(':status', $strStatus);
                $stmt->bindParam(':userid', $strID);
            }            
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
    else if($strFuncType === "funNewUser") //------------- funUpdateEventLog --------------------
    {
        //$strID          = $num[1]; 
        $strEPF         = $num[2];
        $strEmpName     = $num[3];
        $strUserName    = $num[4];
        $strPassword    = $num[5];
        $strDepartment  = $num[6];
        $strContact     = $num[7];
        $strEmail       = $num[8];
        $strUserType    = $num[9];
        $strAvailability    = $num[10];
        $strStatus    = "Active";
       
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("INSERT INTO tblusers_account (EPF, EmpName, UserName, Password, Department, Contact, Email, UserType, Availability, Status) VALUES (:epf, :empname, :username, :password, :department, :contact, :email, :usertype, :availability, :status)");
            $stmt->bindParam(':epf', $strEPF);
            $stmt->bindParam(':empname', $strEmpName);
            $stmt->bindParam(':username', $strUserName);
            $stmt->bindParam(':password', $strPassword);
            $stmt->bindParam(':department', $strDepartment);
            $stmt->bindParam(':contact', $strContact);
            $stmt->bindParam(':email', $strEmail);
            $stmt->bindParam(':usertype', $strUserType);
            $stmt->bindParam(':availability', $strAvailability);
            $stmt->bindParam(':status', $strStatus);
            //$stmt->bindParam(':userid', $strID);
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
