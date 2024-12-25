
<?php
    require_once('../../initialize.php');
    require_once('../../config.php');
    
    $num = $_POST["userpara"];    
    //$startData = $num[0];
    //$endData = $num[1];
    $strFuncType = $num[0];    
    //$strFuncType = "funGet_WoAllDetails";
    
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Colombo');
    $strDateTime = date("Y-m-d");   
    //----------- Declare Variables -----------------------     
    $i = 0; 
    $j = 1; 
    //$k = 1;
    $Status_ary     = array();
    $ReturnData_ary = array();
    //$ReturnData_ary2 = array();
    
    $ReturnData_ary[0][0]  = "NA";
    
    $Status_ary[0] = "false";
    $Status_ary[1] = "Data not found"; 

    if($strFuncType === "funGet_WoCountSummary") //------------- funUpdateEventLog --------------------
    {
        //$strStartDate       = $num[1];  
        //$strEndDate         = $num[2];        		
        try 
        {            
            //-------------- 1. Work Order Count by Category  ------------------------
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $stmt = $conn->prepare("SELECT WorkOrderCategory, COUNT(CASE WHEN WoStatus = 'New' THEN 1 END) AS New, COUNT(CASE WHEN WoStatus = 'Closed' THEN 1 END) AS Closed, COUNT(CASE WHEN WoStatus = 'Inprogress' THEN 1 END) AS Inprogress FROM tblwo_event GROUP BY WorkOrderCategory");
            //$stmt->bindParam(':stat', $intState); 
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();        
            foreach($result as $row)
            {           
                $ReturnData_ary[$i][0]  = $row['WorkOrderCategory'];
                $ReturnData_ary[$i][1]  = $row['New'];  
                $ReturnData_ary[$i][2]  = $row['Inprogress']; 
                $ReturnData_ary[$i][3]  = $row['Closed'];             
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
            $Status_ary[0] = "error";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }
    else if($strFuncType === "funGet_WoAllDetails") //------------- funUpdateEventLog --------------------
    {
        $strStartDate       = $num[1];  
        $strEndDate         = $num[2];        		
        try 
        {            
            //-------------- 1. Work Order Count by Category  ------------------------
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $stmt = $conn->prepare("
                    SELECT 
                        WorkOrderNo,WorkOrderCategory,WorkOrderSubCategory,WoDepartment,
                        CreatedDateTime,CreatedUser,McCategory,MachineNo,
                        RespondDateTime,ClosedDateTime,ClosedFaultType,ClosedFaultLevel1,
                        ClosedFaultLevel2,ClosedFaultLevel3,ClosedFaultLevel4,VerifiedDateTime,
                        VerifiedUser,ReOpenedDateTime,ReOpenedUser,
                        WoStatus,WoReOpen
                    FROM 
                        tblwo_event     
                    WHERE 
                        CreatedDateTime BETWEEN :start_date AND :end_date
                    ");
            $stmt->bindParam(':start_date', $strStartDate);
            $stmt->bindParam(':end_date', $strEndDate);    
            //$stmt->bindParam(':stat', $intState); 
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();        
            foreach($result as $row)
            {     
                $ReturnData_ary[$i][0]  = $row['WorkOrderNo'];
                $ReturnData_ary[$i][1]  = $row['WorkOrderCategory'];  
                $ReturnData_ary[$i][2]  = $row['WorkOrderSubCategory']; 
                $ReturnData_ary[$i][3]  = $row['WoDepartment'];  
                
                $ReturnData_ary[$i][4]  = $row['CreatedDateTime']; 
                $ReturnData_ary[$i][5]  = $row['CreatedUser']; 
                $ReturnData_ary[$i][6]  = $row['McCategory']; 
                $ReturnData_ary[$i][7]  = $row['MachineNo'];     
                
                $ReturnData_ary[$i][8]  = $row['RespondDateTime'];                 
                $ReturnData_ary[$i][9]  = $row['ClosedDateTime']; 
                $ReturnData_ary[$i][10]  = $row['ClosedFaultType']; 
                $ReturnData_ary[$i][11]  = $row['ClosedFaultLevel1'];
                
                $ReturnData_ary[$i][12]  = $row['ClosedFaultLevel2']; 
                $ReturnData_ary[$i][13]  = $row['ClosedFaultLevel3'];
                $ReturnData_ary[$i][14]  = $row['ClosedFaultLevel4']; 
                $ReturnData_ary[$i][15]  = $row['VerifiedDateTime']; 
                
                $ReturnData_ary[$i][16]  = $row['VerifiedUser']; 
                $ReturnData_ary[$i][17]  = $row['ReOpenedDateTime']; 
                $ReturnData_ary[$i][18]  = $row['ReOpenedUser'];
                //$ReturnData_ary[$i][19]  = $row['WoDescription'];
                
                //$ReturnData_ary[$i][19]  = $row['WoEventLog'];
                $ReturnData_ary[$i][19]  = $row['WoStatus'];
                $ReturnData_ary[$i][20]  = $row['WoReOpen'];
                
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
            $Status_ary[0] = "error";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }
    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
    //$data_ary['Data_Ary2']  = $ReturnData_ary2;    
    //print json_encode($error);
    print json_encode($data_ary); 
?>