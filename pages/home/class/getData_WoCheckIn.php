
<?php
    
    $num = $_POST["userpara"];    
    //$startData = $num[0];
    $strFuncType = $num[0];    
    //$strFuncType = "funUpdateEventLog"; 
    
    
    //$strWoNumber    = "WO_00000098";
    //----------- Database Connection ---------------------
    require '../../../dbconnection/dbConnection.php';         
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Colombo');
    $strDateTime = date("Y-m-d");   
    //----------- Declare Variables -----------------------     
    $i = 0; 
    $j = 0; 
    $Status_ary     = array();
    $ReturnData_ary = array();
    $ReturnData_ary[0]  = "NA";   
    //----------------- Function : Get Checking Details ------------------------------
    if($strFuncType === "funGetCheckInDetails_byWoEpf")      //-------------- funGetCheckInDetails_byWoEpf -----------
    {
        $strWoNumber = $num[1];
        $error = "NA";
        $intUserState = "Active";
        /*
        try 
        {
            //SELECT column_name(s) FROM table_name WHERE condition GROUP BY column_name(s) ORDER BY column_name(s);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                       
            //$stmt = $conn->prepare("SELECT ID,WorkOrderNo,Department,WoDateTime,Description,UserName,Status,Verify,ReOpen FROM tbleventworkorder WHERE WoState=:wost");
            $stmt = $conn->prepare("SELECT ID, RespondUser FROM tblwo_event WHERE WorkOrderNo =:wono");
            $stmt->bindParam(':wono', $strWoNumber); 
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();        
            foreach($result as $row)
            {           
                $ID_ary[$i] = $row['ID'];
                $RespondUser_ary[$i] = $row['RespondUser'];                               
                $i++;
                //echo $i;
            }                
            //echo $strSummaryAry;
        } 
        catch(PDOException $e) 
        {
            $error =  "Error: " . $e->getMessage();
        }    
        $conn = null;
        if($i > 0)
        {
            //------------ Update Line Balance Data -------------------------------------------------   
            $data_ary['ID_Ary']             = $ID_ary;
            $data_ary['RespondUser_Ary']  = $RespondUser_ary;        
        }
        else 
        {
            $data_ary = array(0);
        }
         
         */
    }
    if($strFuncType === "funGet_MachineDepartment")      //-------------- funGetCheckInDetails_byWoEpf -----------
    {
        $strWoNumber    = $num[1]; 
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $strSQL = "SELECT
                        e.MachineNo,
                        m.Department
                    FROM
                        tblwo_event e
                    JOIN
                        tblwo_machinemanagement m ON e.MachineNo = m.MachineNumber
                    WHERE
                        e.WorkOrderNo = :wono";
                        
            $stmt = $conn->prepare($strSQL);
            $stmt->bindParam(':wono', $strWoNumber);            
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            foreach($result as $row)
            {                            
                $ReturnData_ary[0]    = $row['MachineNo']; 
                $ReturnData_ary[1]    = $row['Department'];                          
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
               
    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
        
    //print json_encode($error);
    print json_encode($data_ary); 
    // print json_encode($ProductQuantity_ary);
       
?>