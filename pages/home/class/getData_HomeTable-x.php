
<?php

    require_once('../../../initialize.php');
    require_once('../../../config.php');
    
    $num = $_POST["userpara"];    
    
    $strFuncType = $num[0];    
    //$strFuncType = "funGetFilteredData";
    
    //$num[1] = "1";
    //$num[2] = "WoDepartment";
    //$num[3] = "Engineering";       //Engineering
    //----------- Database Connection ---------------------
    //require '../../../dbconnection/dbConnection.php';   
    //----------- Error Loging Path ---------------------
    //require_once '../class/logging.php';
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Colombo');
    $strDateTime = date("Y-m-d");   
    //----------- Declare Variables -----------------------     
    $i = 0; 
    $j = 0; 
    $error = "NA";
    $intWoState = 4;   
    
    $Status_ary     = array();
    $ReturnData_ary = array();
    $ReturnData_ary[0][0]  = "NA"; 
    //----------------- Function : Get Checking Details ------------------------------
    if($strFuncType === "funGetFilteredData")      //-------------- funGetCheckInDetails_byWoEpf -----------
    {
        $strNoOfFilters     = $num[1];    
        //$strNoOfFilters = "0";
        try 
        {    
            if($strNoOfFilters == "0")
            {               
                 //SELECT column_name(s) FROM table_name WHERE condition GROUP BY column_name(s) ORDER BY column_name(s);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
              
                $stmt = $conn->prepare("
                    SELECT DISTINCT
                        e.ID, e.WorkOrderNo, 
                        e.WoDepartment, 
                        e.CreatedDateTime, 
                        e.WorkOrderCategory,
                        e.WorkOrderSubCategory, 
                        e.MachineNo, 
                        e.CreatedFaultType, 
                        e.CreatedUser,
                        e.WoDescription, 
                        e.WoStatus, 
                        e.WoVerify, 
                        e.WoReOpen,
                        CASE WHEN c.WorkOrderNo IS NOT NULL THEN 1 ELSE 0 END AS ChatState
                    FROM 
                        tblwo_event e
                    LEFT JOIN 
                        tblwo_chathistory c ON e.WorkOrderNo = c.WorkOrderNo
                    WHERE 
                        e.State < :stat
                        ");

                
                $stmt->bindParam(':stat', $intWoState); 
                //$stmt->bindParam(':stat', $intWoState);
                $stmt->execute();
                // set the resulting array to associative
                $stmt->setFetchMode(PDO::FETCH_ASSOC);        
                $result = $stmt->fetchAll();        
                foreach($result as $row)
                {           
                    $ReturnData_ary[$i][0] = $row['ID'];
                    $ReturnData_ary[$i][1] = $row['WorkOrderNo'];                     
                    $ReturnData_ary[$i][2] = $row['WoDepartment'];  
                    $ReturnData_ary[$i][3] = $row['CreatedDateTime']; 
                    $ReturnData_ary[$i][4] = $row['WorkOrderCategory']; 
                    $ReturnData_ary[$i][5] = $row['WorkOrderSubCategory'];                    
                    $ReturnData_ary[$i][6] = $row['MachineNo']; 
                    $ReturnData_ary[$i][7] = $row['CreatedFaultType'];  
                    $ReturnData_ary[$i][8] = $row['CreatedUser'];  
                    $ReturnData_ary[$i][9] = $row['WoDescription'];                    
                    $ReturnData_ary[$i][10] = $row['WoStatus'];  
                    $ReturnData_ary[$i][11] = $row['WoVerify'];  
                    $ReturnData_ary[$i][12] = $row['WoReOpen']; 
                    $ReturnData_ary[$i][13] = $row['ChatState']; 
                    $i++;
                    //echo $i;
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
            else if($strNoOfFilters == "1")
            {
                $strFilterName1      = $num[2];  // WoDepartment
                $strFilterValue1     = $num[3];  // Engineering   
                
                //SELECT column_name(s) FROM table_name WHERE condition GROUP BY column_name(s) ORDER BY column_name(s);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
                               
                $stmt = $conn->prepare("
                    SELECT DISTINCT
                        e.ID, e.WorkOrderNo, 
                        e.WoDepartment, 
                        e.CreatedDateTime, 
                        e.WorkOrderCategory,
                        e.WorkOrderSubCategory, 
                        e.MachineNo, 
                        e.CreatedFaultType, 
                        e.CreatedUser,
                        e.WoDescription, 
                        e.WoStatus, 
                        e.WoVerify, 
                        e.WoReOpen,
                        CASE WHEN c.WorkOrderNo IS NOT NULL THEN 1 ELSE 0 END AS ChatState
                    FROM 
                        tblwo_event e
                    LEFT JOIN 
                        tblwo_chathistory c ON e.WorkOrderNo = c.WorkOrderNo
                    WHERE 
                        State<:stat AND $strFilterName1=:fvalue1
                        ");                
                
                $stmt->bindParam(':stat', $intWoState); 
                $stmt->bindParam(':fvalue1', $strFilterValue1);
                $stmt->execute();
                // set the resulting array to associative
                $stmt->setFetchMode(PDO::FETCH_ASSOC);        
                $result = $stmt->fetchAll();        
                foreach($result as $row)
                {           
                    $ReturnData_ary[$i][0] = $row['ID'];
                    $ReturnData_ary[$i][1] = $row['WorkOrderNo'];                    
                    $ReturnData_ary[$i][2] = $row['WoDepartment'];  
                    $ReturnData_ary[$i][3] = $row['CreatedDateTime']; 
                    $ReturnData_ary[$i][4] = $row['WorkOrderCategory'];   
                    $ReturnData_ary[$i][5] = $row['WorkOrderSubCategory'];                    
                    $ReturnData_ary[$i][6] = $row['MachineNo']; 
                    $ReturnData_ary[$i][7] = $row['CreatedFaultType'];  
                    $ReturnData_ary[$i][8] = $row['CreatedUser'];  
                    $ReturnData_ary[$i][9] = $row['WoDescription'];                    
                    $ReturnData_ary[$i][10] = $row['WoStatus'];  
                    $ReturnData_ary[$i][11] = $row['WoVerify'];  
                    $ReturnData_ary[$i][12] = $row['WoReOpen']; 
                    $ReturnData_ary[$i][13] = $row['ChatState'];
                    $i++;
                    //echo $i;
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
            //echo $strSummaryAry;
        } 
        catch(PDOException $ex) 
        {
            $Status_ary[0] = "false";
            $Status_ary[1] = "Error: " . $ex->getMessage();
        }    
        $conn = null;
        
    }
    else if($strFuncType === "funGet_NoOfAsgnJob")      //-------------- funGetCheckInDetails_byWoEpf -----------
    {
        $strEPF    = $num[1];    
        //$strNoOfFilters = "0";
        try 
        {                  
            //SELECT column_name(s) FROM table_name WHERE condition GROUP BY column_name(s) ORDER BY column_name(s);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            //$stmt = $conn->prepare("SELECT ID,WorkOrderNo,WoDepartment,WorkOrderCategory,WorkOrderSubCategory,CreatedDateTime,MachineNo,CreatedFaultType,CreatedUser,WoDescription,WoStatus,WoVerify,WoReOpen FROM tblwo_event WHERE State<:stat");
            $stmt = $conn->prepare("
                SELECT 
                    e.ID,e.WorkOrderNo,e.WoDepartment,e.WorkOrderCategory,e.WorkOrderSubCategory,e.CreatedDateTime,e.MachineNo,e.CreatedFaultType,e.CreatedUser,e.WoDescription,e.WoStatus,e.WoVerify,e.WoReOpen
                FROM tblwo_event e
                JOIN tblwo_allocatedusers u ON e.WorkOrderNo = u.WorkOrderNo
                WHERE 
                    u.AllocatedUser = :epf AND e.State < :stat AND u.Status = 'Active';");
            
            $stmt->bindParam(':epf', $strEPF); 
            $stmt->bindParam(':stat', $intWoState);
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();        
            foreach($result as $row)
            {           
               $ReturnData_ary[$i][0] = $row['ID'];
               $ReturnData_ary[$i][1] = $row['WorkOrderNo'];                     
               $ReturnData_ary[$i][2] = $row['WoDepartment'];  
               $ReturnData_ary[$i][3] = $row['CreatedDateTime']; 
               $ReturnData_ary[$i][4] = $row['WorkOrderCategory']; 
               $ReturnData_ary[$i][5] = $row['WorkOrderSubCategory'];                    
               $ReturnData_ary[$i][6] = $row['MachineNo']; 
               $ReturnData_ary[$i][7] = $row['CreatedFaultType'];  
               $ReturnData_ary[$i][8] = $row['CreatedUser'];  
               $ReturnData_ary[$i][9] = $row['WoDescription'];                    
               $ReturnData_ary[$i][10] = $row['WoStatus'];  
               $ReturnData_ary[$i][11] = $row['WoVerify'];  
               $ReturnData_ary[$i][12] = $row['WoReOpen'];             
               $i++;
               //echo $i;
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
            $Status_ary[0] = "false";
            $Status_ary[1] = "Error: " . $ex->getMessage();
        }    
        $conn = null;
        
    }
    else if($strFuncType === "funGet_NoOfCmpltJob")      //-------------- funGet_NoOfCmpltJob -----------
    {
        $strEPF    = $num[1];   
        //$strNoOfFilters = "0";
        try 
        {                  
            //SELECT column_name(s) FROM table_name WHERE condition GROUP BY column_name(s) ORDER BY column_name(s);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $stmt = $conn->prepare("
                SELECT 
                    e.ID,e.WorkOrderNo,e.WoDepartment,e.WorkOrderCategory,e.WorkOrderSubCategory,e.CreatedDateTime,e.MachineNo,e.CreatedFaultType,e.CreatedUser,e.WoDescription,e.WoStatus,e.WoVerify,e.WoReOpen
                FROM 
                    tblwo_event e
                JOIN 
                    tblwo_allcheckinusers u ON e.WorkOrderNo = u.WorkOrderNo
                WHERE 
                    u.CheckInUser = :epf
                    AND e.State > 2 AND e.State < 6
                    AND DATE(e.ClosedDateTime) = CURDATE();
            ");            
            $stmt->bindParam(':epf', $strEPF); 
            //$stmt->bindParam(':stat', $intWoState);
          
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();        
            foreach($result as $row)
            {           
               $ReturnData_ary[$i][0] = $row['ID'];
               $ReturnData_ary[$i][1] = $row['WorkOrderNo'];                     
               $ReturnData_ary[$i][2] = $row['WoDepartment'];  
               $ReturnData_ary[$i][3] = $row['CreatedDateTime']; 
               $ReturnData_ary[$i][4] = $row['WorkOrderCategory']; 
               $ReturnData_ary[$i][5] = $row['WorkOrderSubCategory'];                    
               $ReturnData_ary[$i][6] = $row['MachineNo']; 
               $ReturnData_ary[$i][7] = $row['CreatedFaultType'];  
               $ReturnData_ary[$i][8] = $row['CreatedUser'];  
               $ReturnData_ary[$i][9] = $row['WoDescription'];                    
               $ReturnData_ary[$i][10] = $row['WoStatus'];  
               $ReturnData_ary[$i][11] = $row['WoVerify'];  
               $ReturnData_ary[$i][12] = $row['WoReOpen'];             
               $i++;
               //echo $i;
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
            $Status_ary[0] = "false";
            $Status_ary[1] = "Error: " . $ex->getMessage();
        }    
        $conn = null;
        
    }
    else if($strFuncType === "funGet_CurrCheckInWo")      //-------------- funGetCheckInDetails_byWoEpf -----------
    {
        $strWoNo    = $num[1];    
        //$strNoOfFilters = "0";
        try 
        {                  
            //SELECT column_name(s) FROM table_name WHERE condition GROUP BY column_name(s) ORDER BY column_name(s);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $stmt = $conn->prepare("SELECT ID,WorkOrderNo,WoDepartment,WorkOrderCategory,WorkOrderSubCategory,CreatedDateTime,MachineNo,CreatedFaultType,CreatedUser,WoDescription,WoStatus,WoVerify,WoReOpen FROM tblwo_event WHERE State<:stat AND WorkOrderNo=:wono");
                        
            $stmt->bindParam(':wono', $strWoNo); 
            $stmt->bindParam(':stat', $intWoState);
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();        
            foreach($result as $row)
            {           
               $ReturnData_ary[$i][0] = $row['ID'];
               $ReturnData_ary[$i][1] = $row['WorkOrderNo'];                     
               $ReturnData_ary[$i][2] = $row['WoDepartment'];  
               $ReturnData_ary[$i][3] = $row['CreatedDateTime']; 
               $ReturnData_ary[$i][4] = $row['WorkOrderCategory']; 
               $ReturnData_ary[$i][5] = $row['WorkOrderSubCategory'];                    
               $ReturnData_ary[$i][6] = $row['MachineNo']; 
               $ReturnData_ary[$i][7] = $row['CreatedFaultType'];  
               $ReturnData_ary[$i][8] = $row['CreatedUser'];  
               $ReturnData_ary[$i][9] = $row['WoDescription'];                    
               $ReturnData_ary[$i][10] = $row['WoStatus'];  
               $ReturnData_ary[$i][11] = $row['WoVerify'];  
               $ReturnData_ary[$i][12] = $row['WoReOpen'];             
               $i++;
               //echo $i;
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
            $Status_ary[0] = "false";
            $Status_ary[1] = "Error: " . $ex->getMessage();
        }    
        $conn = null;
        
    }
    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
          
    //print json_encode($error);
    print json_encode($data_ary); 
    // print json_encode($ProductQuantity_ary);
       
?>