
<?php
    session_start(); 
    require_once('../../initialize.php');
    require_once('../../config.php');
    
    $num = $_POST["userpara"];     
    $strFuncType = $num[0];    
    //$strFuncType = "funUpdateEventLog";
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Colombo');
    $strServerDateTime = date("Y-m-d H:i:s");   
    //----------- Declare Variables -----------------------     
    $i = 0; 
    $j = 0;     
    $Status_ary     = array();
    $ReturnData_ary = array();
    $ReturnData_ary[0]  = "NA";   
    //----------------- Function : Get Checking Details ------------------------------
    if($strFuncType === "funGetCheckInDetails_byWoEpf")      //-------------- funGetCheckInDetails_byWoEpf -----------
    {
        $strWoNumber    = $num[1]; 
        $strEPF         = $num[2];
        $strStatus      = "Active";
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $stmt = $conn->prepare("SELECT ID, CheckInDateTime, CheckOutDateTime FROM tblwo_allcheckinusers  WHERE WorkOrderNo=:wono AND CheckInUser=:epf AND Status=:stat");
            $stmt->bindParam(':wono', $strWoNumber); 
            $stmt->bindParam(':epf', $strEPF); 
            $stmt->bindParam(':stat', $strStatus);
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            foreach($result as $row)
            {                            
                $ReturnData_ary[0]    = $row['ID']; 
                $ReturnData_ary[1]    = $row['CheckInDateTime'];
                $ReturnData_ary[2]    = $row['CheckOutDateTime'];                
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
            //echo $strSummaryAry;
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }  
    else if($strFuncType === "funUpdateEventLog") //------------- funUpdateEventLog --------------------
    {
        $strWorkOrderNo         = $num[1]; 
        $strCurrentUserName     = $num[2];
        $strCurrentUserContact  = $num[3];
        $strEventText           = $num[4];        
        $strEventLog = $strEventText . $strServerDateTime . " By " . $strCurrentUserName . "[" . $strCurrentUserContact . "]";
        //Work Order Placed - On 2024-02-02T17:38 By Kelum Bandara(0772628859)
        //$strWorkOrderNo = "WO_00000138";    //$num[1]; 
        //$strEventLog    = "Removed All-2";    // $num[2]; 
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
            //    $stmt = $conn->prepare("UPDATE tblwo_event SET WoEventLog=CONCAT(WoEventLog, :evtlog),WoVerify=:wovery,State=:stat WHERE WorkOrderNo=:wono");
            //$stmt = $conn->prepare("UPDATE tblwo_event SET WoEventLog=CONCAT(WoEventLog, :evtlog) WHERE WorkOrderNo=:wono");
            $stmt = $conn->prepare("UPDATE tblwo_event SET WoEventLog=CONCAT(WoEventLog, :evtlg) WHERE WorkOrderNo=:wono");
            $stmt->bindParam(':evtlg', $strEventLog); 
            $stmt->bindParam(':wono', $strWorkOrderNo); 
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
    else if($strFuncType === "funCheckUserCredentials") //------------- funCheckUserCredentials --------------------
    {
        $strUserName = $num[1]; 
        $strPassword = $num[2]; 
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                       
            $stmt = $conn->prepare("SELECT EPF, EmpName, Password FROM tblusers_account  WHERE UserName=:unme");
            $stmt->bindParam(':unme', $strUserName); 
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            foreach($result as $row)
            {                            
                $ReturnData_ary[0]      = $row['EPF']; 
                $ReturnData_ary[1]      = $row['EmpName'];
                $strReturnedPassword    = $row['Password'];
                $i++;
            }  
            if($i === 0)    // No Data
            {
                $Status_ary[0] = "false";
                $Status_ary[1] = "Username not found"; 
            }
            else
            {
                if($strReturnedPassword === $strPassword)   // PAssword Correct
                {
                    $Status_ary[0] = "true";
                    $Status_ary[1] = "Login Success"; 
                }
                else    // PAssword Error
                {
                    $Status_ary[0] = "false";
                    $Status_ary[1] = "Password Error"; 
                }
            }            
            //echo $strSummaryAry;
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }  
    else if($strFuncType === "funGetUserDetails_byEPF") //------------- funCheckUserCredentials --------------------
    {
        $strEPF     = $num[1];      
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                       
            $stmt = $conn->prepare("SELECT ID,EPF,EmpName,UserName,Department,Contact,Email,UserType,Availability,Status FROM tblusers_account  WHERE EPF=:uepf");
            $stmt->bindParam(':uepf', $strEPF); 
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            foreach($result as $row)
            {                            
                $ReturnData_ary[0]      = $row['ID']; 
                $ReturnData_ary[1]      = $row['EPF'];
                $ReturnData_ary[2]      = $row['EmpName']; 
                $ReturnData_ary[3]      = $row['UserName'];
                $ReturnData_ary[4]      = $row['Department']; 
                $ReturnData_ary[5]      = $row['Contact'];
                $ReturnData_ary[6]      = $row['Email']; 
                $ReturnData_ary[7]      = $row['UserType'];
                $ReturnData_ary[8]      = $row['Availability'];
                $ReturnData_ary[9]      = $row['Status'];
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
            //echo $strSummaryAry;
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }  
    else if($strFuncType === "funGetSessionVariables") //------------- Get Session Variables -------------------
    {        
        // Check if session is set and the user is logged in
        if (!isset($_SESSION["user_name"]))     // Session not set
        {
            $Status_ary[0] = "false";
            $Status_ary[1] = "Session variables not found";                     
        }
        else    // Session is set
        {            
            $Status_ary[0] = "true";
            $Status_ary[1] = "Success";
           
            $ReturnData_ary[0]      = $_SESSION["user_epf"]; 
            $ReturnData_ary[1]      = $_SESSION["user_name"];
            $ReturnData_ary[2]      = $_SESSION["user_department"];
            $ReturnData_ary[3]      = $_SESSION["user_contactno"];
            $ReturnData_ary[4]      = $_SESSION["user_type"];
            $ReturnData_ary[5]      = $_SESSION["user_availability"];  
        }        
    } 
    else if($strFuncType === "funGetFilteredData") //------------- funCheckUserCredentials --------------------
    {
        //$num[1] = "Level1";
        //$num[2] = "tblwo_errorlevel";
        //$num[3] = "0";
        //$num[4] = "FaultType";
        //$num[5] = "pneumatic";
        
        $strFieldName   = $num[1];  
        $strTableName   = $num[2];  
        $intNoOfSearchParameters    = intval($num[3]); 
        $strSQL = "NA";
        if($intNoOfSearchParameters == 0)    // No WHERE Condition
        {
            $strSQL = "SELECT DISTINCT " . $strFieldName . " FROM " . $strTableName;            
        }
        else if($intNoOfSearchParameters == 1)
        {
            $strSearchField = $num[4]; 
            $strSearchValue = $num[5];
            $strSQL = "SELECT DISTINCT " . $strFieldName . " FROM " . $strTableName . " WHERE " . $strSearchField . "='" . $strSearchValue . "'";
        }
        else
        {
            $strSearchField1 = $num[4]; 
            $strSearchValue1 = $num[5];
            
            $strSearchField2 = $num[6]; 
            $strSearchValue2 = $num[7];            
            
            $strSQL = "SELECT DISTINCT " . $strFieldName . " FROM " . $strTableName . " WHERE " . $strSearchField1 . "='" . $strSearchValue1 . "' AND " . $strSearchField2 . "='" . $strSearchValue2 . "'";
        }
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                       
            $stmt = $conn->prepare($strSQL);
            //$stmt->bindParam(':uepf', $strEPF); 
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            /*
            foreach($result as $row) 
            {           
                // Dynamically build the associative array for each row
                $rowData = array();
                foreach ($row as $colName => $colValue) 
                {
                    $rowData[$colName] = $colValue;
                }
                $tmp_dataary[] = $rowData;
                $i++;
            }  
            */
            foreach ($result as $row) 
            {
                // Iterate through each column value in the row
                foreach ($row as $colValue) 
                {
                    // Append each value to the $tmp_dataary array
                    $tmp_dataary[] = $colValue;
                }
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
                $ReturnData_ary = $tmp_dataary;
            }            
            //echo $strSummaryAry;
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }
    else if($strFuncType === "funGetCheckInUserData") //------------- funGetCheckInUserData --------------------
    {
        $strWorkOrderNo   = $num[1];  

        $strSQL =   "SELECT DISTINCT 
                        tblwo_allcheckinusers.WorkOrderNo,
                        tblwo_allcheckinusers.CheckInUser,
                        tblusers_account.Contact,
                        tblusers_account.EmpName
                    FROM
                        tblwo_allcheckinusers
                    JOIN
                        tblusers_account ON tblwo_allcheckinusers.CheckInUser = tblusers_account.EPF
                    WHERE
                        tblwo_allcheckinusers.WorkOrderNo = :wono AND tblwo_allcheckinusers.Status ='Active'";
        
        //$strSQL = "NA";
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                       
            $stmt = $conn->prepare($strSQL);
            $stmt->bindParam(':wono', $strWorkOrderNo); 
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            
            foreach($result as $row) 
            {           
                // Dynamically build the associative array for each row
                $rowData = array();
                foreach ($row as $colName => $colValue) 
                {
                    $rowData[$colName] = $colValue;
                }
                $tmp_dataary[] = $rowData;
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
                $ReturnData_ary = $tmp_dataary;
            }            
            //echo $strSummaryAry;
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }    
    else if($strFuncType === "funGetAllocatedUserData") //------------- funGetCheckInUserData --------------------
    {
        $strWorkOrderNo   = $num[1];  

        $strSQL =   "SELECT DISTINCT 
                        tblwo_allocatedusers.WorkOrderNo,
                        tblwo_allocatedusers.AllocatedUser,
                        tblwo_allocatedusers.AllocatedDateTime,
                        tblusers_account.Contact,
                        tblusers_account.EmpName
                    FROM
                        tblwo_allocatedusers
                    JOIN
                        tblusers_account ON tblwo_allocatedusers.AllocatedUser = tblusers_account.EPF
                    WHERE
                        tblwo_allocatedusers.WorkOrderNo = :wono AND tblwo_allocatedusers.Status= 'Active'";
        
        //$strSQL = "NA";
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                       
            $stmt = $conn->prepare($strSQL);
            $stmt->bindParam(':wono', $strWorkOrderNo); 
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            
            foreach($result as $row) 
            {           
                // Dynamically build the associative array for each row
                $rowData = array();
                foreach ($row as $colName => $colValue) 
                {
                    $rowData[$colName] = $colValue;
                }
                $tmp_dataary[] = $rowData;
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
                $ReturnData_ary = $tmp_dataary;
            }            
            //echo $strSummaryAry;
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }
    else if($strFuncType === "funGetChatHistoryData") //------------- funGetChatHistoryData --------------------
    {
        $strWorkOrderNo   = $num[1];  

        $strSQL =   "SELECT DISTINCT 
                        tblwo_chathistory.WorkOrderNo,
                        tblwo_chathistory.SendBy,
                        tblwo_chathistory.SendDateTime,
                        tblwo_chathistory.ChatMessage,
                        tblusers_account.Contact,
                        tblusers_account.EmpName
                    FROM
                        tblwo_chathistory
                    JOIN
                        tblusers_account ON tblwo_chathistory.SendBy = tblusers_account.EPF
                    WHERE
                        tblwo_chathistory.WorkOrderNo = :wono AND tblwo_chathistory.Status= 'Active'";
        
        //$strSQL = "NA";
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                       
            $stmt = $conn->prepare($strSQL);
            $stmt->bindParam(':wono', $strWorkOrderNo); 
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            
            foreach($result as $row) 
            {           
                // Dynamically build the associative array for each row
                $rowData = array();
                foreach ($row as $colName => $colValue) 
                {
                    $rowData[$colName] = $colValue;
                }
                $tmp_dataary[] = $rowData;
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
                $ReturnData_ary = $tmp_dataary;
            }            
            //echo $strSummaryAry;
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }
    else    // No function found
    {
        $Status_ary[0] = "false";
        $Status_ary[1] = "Function not found"; 
    }
    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
        
    //print json_encode($error);
    print json_encode($data_ary); 
   // print json_encode($ProductQuantity_ary);
       
?>