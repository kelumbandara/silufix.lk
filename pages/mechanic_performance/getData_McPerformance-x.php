<?php

    session_start();
    require_once('../../initialize.php');
    require_once('../../config.php');
    
    $num = $_POST["userpara"];
    
    $strFuncType = $num[0];    
    //$strFuncType = "funGetData_CheckInTable";
      
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
    $ReturnData_ary[0][0] = "NA"; 
    $ReturnData_ary[0][1] = "NA";
    //$ReturnData_ary[1][0] = "NA"; 
    //$ReturnData_ary[1][1] = "NA";
    
    $intWoState = 4;
    
    if($strFuncType === "funGetData_CheckInTable") //------------- funUpdateEventLog --------------------
    {
        $strEmpEPF         = $num[1]; 
        $strStarDate       = $num[2];
        $strEndDate        = $num[3];
        
        //$strEmpEPF   = "7000";
        //$strState   = "Active";
        try 
        {            	 
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $sqlString = "SELECT au.WorkOrderNo, 
                                au.CheckInUserDateTime, 
                                au.CheckOutUserDateTime,
                                TIME_FORMAT(TIMEDIFF(au.CheckOutUserDateTime, au.CheckInUserDateTime), '%H:%i') AS WorkedDuration,
                                e.WoDescription
                         FROM tblwo_allcheckinusers AS au
                         JOIN tblwo_event AS e ON au.WorkOrderNo = e.WorkOrderNo
                         WHERE au.CheckInUser = :chkinusr
                         AND au.CheckInUserDateTime BETWEEN :startDt AND :endDt";
            
            //$stmt = $conn->prepare("SELECT WorkOrderNo,CheckInUserDateTime,CheckOutUserDateTime FROM tblwo_allcheckinusers WHERE CheckInUser=:chkinusr");
            $stmt = $conn->prepare($sqlString);
            $stmt->bindParam(':chkinusr', $strEmpEPF); 
            $stmt->bindParam(':startDt', $strStarDate); 
            $stmt->bindParam(':endDt', $strEndDate); 
             
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            $i = 0;
            foreach($result as $row)
            {   
                $ReturnData_ary[$i][0] = $row['WorkOrderNo'];
                $ReturnData_ary[$i][1] = $row['WoDescription']; 
                $ReturnData_ary[$i][2] = $row['CheckInUserDateTime'];
                $ReturnData_ary[$i][3] = $row['CheckOutUserDateTime'];  
                $ReturnData_ary[$i][4] = $row['WorkedDuration'];  
                 
                $i++;
            }  
            if($i === 0)    // No Data
            {
                $ReturnData_ary[0] = $strText;
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not found"; 
            }
            else
            {
                //$ReturnData_ary[0] = $strText;
                $Status_ary[0] = "true";
                $Status_ary[1] = "Data Available"; 
            } 
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "error";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }
    else if($strFuncType === "funGetData_CheckInAllocateTimeChart") //------------- funUpdateEventLog --------------------
    {
        $strEmpEPF         = $num[1]; 
        $strStarDate       = $num[2];
        $strEndDate        = $num[3];
        
        //$strEmpEPF   = "7000";
        //$strState   = "Active";
        try 
        {       
            //------------------ get CheckOut Data -------------------------------------
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $sqlString = "SELECT WorkOrderNo,AllocatedUserStartDateTime,AllocatedUserEndDateTime
                FROM tblwo_allocatedusers 
                WHERE AllocatedUser = :allousr
                AND Status ='Active'
                AND AllocatedUserStartDateTime BETWEEN :start_date AND :end_date
                ORDER BY AllocatedUserStartDateTime ASC";
        
            $stmt = $conn->prepare($sqlString);
            $stmt->bindParam(':allousr', $strEmpEPF); 
            $stmt->bindParam(':start_date', $strStarDate); // Assuming $strStarDate is already in correct format
            $stmt->bindParam(':end_date', $strEndDate);

            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            $i = 0;
            foreach($result as $row)
            {   
                $ReturnData_ary[$i][0] = "Allocated Time";
                $ReturnData_ary[$i][1] = $row['WorkOrderNo'];
                $ReturnData_ary[$i][2] = $row['AllocatedUserStartDateTime']; 
                $ReturnData_ary[$i][3] = $row['AllocatedUserEndDateTime'];
                $i++;
            }
            //------------------ get CheckIn Data -------------------------------------
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $sqlString = "SELECT WorkOrderNo,CheckInUserDateTime, CheckOutUserDateTime
                FROM tblwo_allcheckinusers 
                WHERE CheckInUser = :chkinusr
                AND CheckInUserDateTime BETWEEN :start_date AND :end_date
                ORDER BY CheckInUserDateTime ASC";
            
            //$stmt = $conn->prepare("SELECT WorkOrderNo,CheckInUserDateTime,CheckOutUserDateTime FROM tblwo_allcheckinusers WHERE CheckInUser=:chkinusr");
            $stmt = $conn->prepare($sqlString);
            $stmt->bindParam(':chkinusr', $strEmpEPF); 
            $stmt->bindParam(':start_date', $strStarDate); // Assuming $strStarDate is already in correct format
            $stmt->bindParam(':end_date', $strEndDate);
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            //$i = 0;
            foreach($result as $row)
            {   
                $ReturnData_ary[$i][0] = "CheckIn Time";
                $ReturnData_ary[$i][1] = $row['WorkOrderNo'];
                $ReturnData_ary[$i][2] = $row['CheckInUserDateTime']; 
                $ReturnData_ary[$i][3] = $row['CheckOutUserDateTime'];
                $i++;
            }  
              
            //------------- Check for Error ----------------------------
            
            if($i === 0)    // No Data
            {
                $ReturnData_ary[0] = $strText;
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not found"; 
            }
            else
            {
                //$ReturnData_ary[0] = $strText;
                $Status_ary[0] = "true";
                $Status_ary[1] = "Data Available"; 
            } 
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "error";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }
    else if($strFuncType === "funGetMechanicData") //------------- funCheckUserCredentials --------------------
    {
        //$num[1] = "Level1";       
        $strSQL = "SELECT EPF, EmpName FROM tblusers_account WHERE UserType='MC'";      
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                       
            $stmt = $conn->prepare($strSQL);
            //$stmt->bindParam(':uepf', $strEPF); 
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            $i = 0;                
            foreach($result as $row)
            {   
                $ReturnData_ary[$i][0] = $row['EPF'];
                $ReturnData_ary[$i][1] = $row['EmpName']; 
                $i++;
            }                
            //------------- Check for Error ----------------------------            
            if($i === 0)    // No Data
            {
                $ReturnData_ary[0] = $strText;
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not found"; 
            }
            else
            {
                //$ReturnData_ary[0] = $strText;
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
    else if($strFuncType === "funGetData_TotalCheckInTime") //------------- funUpdateEventLog --------------------
    {
        $strEmpEPF         = $num[1]; 
        $strStarDate       = $num[2];
        $strEndDate        = $num[3];        
        try 
        {       
            //------------------ get CheckOut Data -------------------------------------
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $sqlString = "SELECT
                SUM(TIMESTAMPDIFF(MINUTE, AllocatedUserStartDateTime, AllocatedUserEndDateTime)) AS TotalAllocateDuration
                FROM tblwo_allocatedusers 
                WHERE AllocatedUser = :allousr
                AND Status ='Active'
                AND AllocatedUserStartDateTime BETWEEN :start_date AND :end_date
                ORDER BY AllocatedUserStartDateTime ASC";
        
            $stmt = $conn->prepare($sqlString);
            $stmt->bindParam(':allousr', $strEmpEPF); 
            $stmt->bindParam(':start_date', $strStarDate); // Assuming $strStarDate is already in correct format
            $stmt->bindParam(':end_date', $strEndDate);

            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            $i = 0;
            foreach($result as $row)
            {
                $ReturnData_ary[$i][0] = $row['TotalAllocateDuration'];
                $i++;
            }
            //------------------ get CheckIn Data -------------------------------------
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $sqlString = "SELECT 
                SUM(TIMESTAMPDIFF(MINUTE, CheckInUserDateTime, CheckOutUserDateTime)) AS TotalCheckInDuration
                FROM tblwo_allcheckinusers 
                WHERE CheckInUser = :chkinusr
                AND CheckInUserDateTime BETWEEN :start_date AND :end_date
                ORDER BY CheckInUserDateTime ASC";
            
            //$stmt = $conn->prepare("SELECT WorkOrderNo,CheckInUserDateTime,CheckOutUserDateTime FROM tblwo_allcheckinusers WHERE CheckInUser=:chkinusr");
            $stmt = $conn->prepare($sqlString);
            $stmt->bindParam(':chkinusr', $strEmpEPF); 
            $stmt->bindParam(':start_date', $strStarDate); // Assuming $strStarDate is already in correct format
            $stmt->bindParam(':end_date', $strEndDate);
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            //$i = 0;
            foreach($result as $row)
            {   
                $ReturnData_ary[$i][0] = $row['TotalCheckInDuration'];
                $i++;
            }  
              
            //------------- Check for Error ----------------------------
            
            if($i === 0)    // No Data
            {
                $ReturnData_ary[0] = $strText;
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not found"; 
            }
            else
            {
                //$ReturnData_ary[0] = $strText;
                $Status_ary[0] = "true";
                $Status_ary[1] = "Data Available"; 
            } 
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "error";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }
    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
        
    //print json_encode($error);
    print json_encode($data_ary); 

?>
