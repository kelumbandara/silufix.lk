
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
        $CurrentUserEPF         = $num[1]; 
        $CurrentUserDepartment  = $num[2]; 
        $CurrentUserType        = $num[3]; 
        $CurrentIssueType       = $num[4];        
        //$strNoOfFilters = "0";
        try 
        { 
            //SELECT column_name(s) FROM table_name WHERE condition GROUP BY column_name(s) ORDER BY column_name(s);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            
            $query = "
                    SELECT DISTINCT
                        tblwo_event.ID, 
                        tblwo_event.WorkOrderNo, 
                        tblwo_event.CreatedDepartment, 
                        tblwo_event.CreatedDateTime, 
                        tblwo_event.WorkOrderCategory, 
                        tblwo_event.WorkOrderSubCategory, 
                        tblusers_account.EmpName AS CreatedEmpName, 
                        tblwo_event.IssueDescriptionMain, 
                        tblwo_event.Site, 
                        tblwo_event.WoStatus, 
                        tblwo_event.VerifiedUser, 
                        tblwo_event.WoReOpen
                    FROM 
                        tblwo_event
                    LEFT JOIN 
                        tblusers_account
                    ON 
                        tblwo_event.CreatedUser = tblusers_account.EPF
                    WHERE 
                        tblwo_event.State < :stat                
                    ";    
            if($CurrentUserDepartment != "PMD") // Only show own workorders
            {  
                $query .= " AND tblwo_event.CreatedUser = :creusr"; 
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':stat', $intWoState); 
                $stmt->bindParam(':creusr', $CurrentUserEPF);
            }
            else if($CurrentUserDepartment == "PMD")
            {
                if(($CurrentUserType == "Manager")||($CurrentUserType == "Executive")||($CurrentUserType == "Supper Admin")||($CurrentUserType == "admin"))   // Show all workorders
                {
                    //$query .= " AND tblwo_event.CreatedUser = :creusr"; 
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(':stat', $intWoState); 
                }
                else if($CurrentUserType == "Assistance")   // Filter by Issue Type
                {
                    $query .= " AND tblwo_event.IssueType = :isutp"; 
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(':stat', $intWoState); 
                    $stmt->bindParam(':isutp', $CurrentIssueType);
                }
                else if($CurrentUserType == "TeamMember")   // Filter by Allocated Table 
                {
                    $query .= "
                            AND tblwo_event.IssueType = :isutp 
                            AND EXISTS (
                                SELECT 1 
                                FROM 
                                    tblwo_allocatedusers 
                                WHERE 
                                    tblwo_allocatedusers.AllocatedUser = :creusr 
                                    AND tblwo_allocatedusers.Status = 'Active'
                            )
                        ";

                        $stmt = $conn->prepare($query);
                        $stmt->bindParam(':stat', $intWoState); 
                        $stmt->bindParam(':isutp', $CurrentIssueType);
                        $stmt->bindParam(':creusr', $CurrentUserEPF); 

                }
                else
                {
                    $query .= " AND tblwo_event.CreatedUser = :creusr"; 
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(':stat', $intWoState); 
                    $stmt->bindParam(':creusr', $CurrentUserEPF);
                }
            }                 
            //$stmt = $conn->prepare($query);
            //$stmt->bindParam(':stat', $intWoState); 
            //$stmt->bindParam(':creusr', $CurrentUserEPF);
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();        
            foreach($result as $row)
            {           
                $ReturnData_ary[$i][0] = $row['ID'];
                $ReturnData_ary[$i][1] = $row['WorkOrderNo'];                     
                $ReturnData_ary[$i][2] = $row['CreatedDepartment'];  
                $ReturnData_ary[$i][3] = $row['CreatedDateTime']; 
                $ReturnData_ary[$i][4] = $row['WorkOrderCategory']; 
                $ReturnData_ary[$i][5] = $row['WorkOrderSubCategory'];                    
                $ReturnData_ary[$i][6] = $row['IssueDescriptionMain']; 
                $ReturnData_ary[$i][7] = $row['Site'];  
                $ReturnData_ary[$i][8] = $row['CreatedEmpName'];  
                $ReturnData_ary[$i][9] = $row['IssueDescriptionMain'];                    
                $ReturnData_ary[$i][10] = $row['WoStatus'];  
                $ReturnData_ary[$i][11] = $row['VerifiedUser'];  
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