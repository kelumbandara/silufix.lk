<?php

    session_start();
    require_once('../../initialize.php');
    require_once('../../config.php');
    
    $num = $_POST["userpara"];
    
    $strFuncType = $num[0];    
    //$strFuncType = "funGetData_McRunDurationChart";
      
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
    
    if($strFuncType === "funGetData_McRunDurationChart") //------------- funUpdateEventLog --------------------
    {        
        $strStarDate       = $num[1];  
        //$strStarDate    = '2024-12-20';
        //$strMachineNo   = 'SD-07';
        //$strModuleNo   = "7000";
        //$strState   = "Active";
        try 
        {       
            //------------------ get CheckIn Data -------------------------------------
            $conn_mc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $sqlString = "SELECT
                MachineNumber,  
                Sen1Speed,
                ServerDatetime
            FROM
                tblmc_speedevent
            WHERE
                DATE(ServerDatetime) = :start_date                
            ORDER BY
                MachineNumber ASC,
                ServerDatetime ASC";
                      
            //$stmt = $conn_mc->prepare("SELECT WorkOrderNo,CheckInUserDateTime,CheckOutUserDateTime FROM tblwo_allcheckinusers WHERE CheckInUser=:chkinusr");
            $stmt = $conn_mc->prepare($sqlString);
            $stmt->bindParam(':start_date', $strStarDate); // Assuming $strStarDate is already in correct format
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            $i = 0;
            $currSpeed = 0;
            $currStartDate;
            $currEndDate;
            $intState = 0;
            foreach($result as $row)
            {   
                $currSpeed = $row['Sen1Speed'];
                //------------- 1st (Start) Record -------------------------------------
                if($intState === 0)   // ist ROW 
                {   
                    if($currSpeed > 0)
                    {
                        $datetime = new DateTime($row['ServerDatetime']);
                        //$ReturnData_ary[$i][0] = $datetime->format('Y-m-d'); // Change format as needed
                        $ReturnData_ary[$i][0] = $row['MachineNumber'];
                        $ReturnData_ary[$i][1] = $row['ServerDatetime']; // Start Date
                        $ReturnData_ary[$i][2] = $row['ServerDatetime']; // End Date
                        $intState = 1;
                    }
                    else
                    {
                        $intState = 2;
                    }                    
                }
                else if($intState === 1)   // ist ROW 
                {   
                    if($currSpeed === 0)
                    {
                        //$currStartDate =  $row['ServerDatetime'];
                        //$ReturnData_ary[$i][0] = $row['ServerDatetime'];
                        //$ReturnData_ary[$i][1] = $row['MachineNumber'];
                        //$ReturnData_ary[$i][2] = $row['ServerDatetime']; // Start Date
                        $ReturnData_ary[$i][2] = $row['ServerDatetime']; // End Date
                        $i++;
                        $intState = 2;
                    }                
                }             
                //------------- Other Records (Starting from 0) -------------------------------------
                else if($intState === 2)   // Machine Speed = 0
                {   
                    if($currSpeed > 0)
                    {
                        $datetime = new DateTime($row['ServerDatetime']);
                        //$ReturnData_ary[$i][0] = $datetime->format('Y-m-d'); // Change format as needed
                        $ReturnData_ary[$i][0] = $row['MachineNumber'];
                        $ReturnData_ary[$i][1] = $row['ServerDatetime']; // Start Date
                        $ReturnData_ary[$i][2] = $row['ServerDatetime']; // End Date
                        $intState = 3;
                    }                
                }  
                else if($intState === 3)   // Machine Speed > 0
                {   
                    if($currSpeed === 0)
                    {
                        //$currStartDate =  $row['ServerDatetime'];
                        //$ReturnData_ary[$i][0] = $row['ServerDatetime'];
                        //$ReturnData_ary[$i][1] = $row['MachineNumber'];
                        //$ReturnData_ary[$i][2] = $row['ServerDatetime']; // Start Date
                        $ReturnData_ary[$i][2] = $row['ServerDatetime']; // End Date
                        $i++;
                        $intState = 2;
                    }                
                }                
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
        $conn_mc = null;
    }
    /*
    else if($strFuncType === "funGetData_AllocatePieChart") //------------- funUpdateEventLog --------------------
    {
        $strModuleNo         = $num[1]; 
        $strStarDate       = $num[2];
        $strEndDate        = $num[3];
        
        //$strModuleNo   = "7000";
        //$strState   = "Active";
        try 
        {       
            //------------------ get CheckOut Data -------------------------------------
            $conn_mc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $sqlString = "SELECT WorkOrderNo,AllocatedUserStartDateTime,AllocatedUserEndDateTime
                FROM tblwo_allocatedusers 
                WHERE AllocatedUser = :allousr
                AND Status ='Active'
                AND AllocatedUserStartDateTime BETWEEN :start_date AND :end_date
                ORDER BY AllocatedUserStartDateTime ASC";
        
            $stmt = $conn_mc->prepare($sqlString);
            $stmt->bindParam(':allousr', $strModuleNo); 
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
        $conn_mc = null;
    }
     * 
     */
    else if($strFuncType === "funGetMechanicData") //------------- funCheckUserCredentials --------------------
    {
        //$num[1] = "Level1";       
        $strSQL = "SELECT EPF, EmpName FROM tblusers_account WHERE UserType='MC'";      
        try 
        {
            $conn_mc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                       
            $stmt = $conn_mc->prepare($strSQL);
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
        $conn_mc = null;
    }
    else if($strFuncType === "funGetData_TotalCheckInTime") //------------- funUpdateEventLog --------------------
    {
        $strModuleNo         = $num[1]; 
        $strStarDate       = $num[2];
        $strEndDate        = $num[3];        
        try 
        {       
            //------------------ get Allocated Data -------------------------------------
            $conn_mc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                    
            $sqlString = "SELECT
                SUM(TIMESTAMPDIFF(MINUTE, AllocatedUserStartDateTime, AllocatedUserEndDateTime)) AS TotalAllocateDuration
                FROM tblwo_allocatedusers 
                WHERE AllocatedUser = :allousr
                AND Status ='Active'
                AND AllocatedUserStartDateTime BETWEEN :start_date AND :end_date
                ORDER BY AllocatedUserStartDateTime ASC";
      
            
            $stmt = $conn_mc->prepare($sqlString);
            $stmt->bindParam(':allousr', $strModuleNo); 
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
            $conn_mc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $sqlString = "SELECT 
                SUM(TIMESTAMPDIFF(MINUTE, CheckInUserDateTime, CheckOutUserDateTime)) AS TotalCheckInDuration
                FROM tblwo_allcheckinusers 
                WHERE CheckInUser = :chkinusr
                AND CheckInUserDateTime BETWEEN :start_date AND :end_date
                ORDER BY CheckInUserDateTime ASC";
            
            //$stmt = $conn_mc->prepare("SELECT WorkOrderNo,CheckInUserDateTime,CheckOutUserDateTime FROM tblwo_allcheckinusers WHERE CheckInUser=:chkinusr");
            $stmt = $conn_mc->prepare($sqlString);
            $stmt->bindParam(':chkinusr', $strModuleNo); 
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
        $conn_mc = null;
    }     
    
    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
        
    //print json_encode($error);
    print json_encode($data_ary); 

?>
