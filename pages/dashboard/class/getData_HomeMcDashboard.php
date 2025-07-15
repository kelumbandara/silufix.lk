
<?php
    
    $num = $_POST["userpara"];    
    
    $strFuncType = $num[0];    
    //$strFuncType = "funGetMcDashboardData";
    
    //$num[1] = "1";
    //$num[2] = "WoDepartment";
    //$num[3] = "Engineering";       //Engineering
    //----------- Database Connection ---------------------
    require '../../../dbconnection/dbConnection.php';   
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
    $ReturnData_ary[0]  = "NA"; 
    //----------------- Function : Get Checking Details ------------------------------
    if($strFuncType === "funGetMcDashboardData")      //-------------- funGetCheckInDetails_byWoEpf -----------
    {
        $strEPF     = $num[1];    
        //$strWoCategory     = "BreakDown";    
        try 
        {   
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //------------- Count Assign Jobs -------------------------------------
            $stmt = $conn->prepare("
                SELECT COUNT(*) AS CountAssignJob
                FROM tblwo_allocatedusers
                JOIN tblwo_event ON tblwo_allocatedusers.WorkOrderNo = tblwo_event.WorkOrderNo
                WHERE tblwo_allocatedusers.AllocatedUser = :epf
                AND tblwo_allocatedusers.Status = 'Active'
                AND tblwo_event.State < 3;
            ");
            $stmt->bindParam(':epf', $strEPF); 
            $stmt->execute();  
            if ($stmt->rowCount() > 0){
                $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result
                $ReturnData_ary[0] = $result['CountAssignJob']; // Corrected assignment
            }
            else {
                $ReturnData_ary[0] = 0;
            }
            //------------- Count Completed Jobs -------------------------------------
            $stmt = $conn->prepare("
                SELECT COUNT(*) AS CountCompletedJob
                FROM tblwo_allcheckinusers
                JOIN tblwo_event ON tblwo_allcheckinusers.WorkOrderNo = tblwo_event.WorkOrderNo
                WHERE tblwo_allcheckinusers.CheckInUser = :epf
                AND tblwo_event.State > 2
                AND DATE(tblwo_event.ClosedDateTime) = CURDATE();
            ");

            $stmt->bindParam(':epf', $strEPF); 
            $stmt->execute();  
            if ($stmt->rowCount() > 0){
                $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result
                $ReturnData_ary[1] = $result['CountCompletedJob']; // Corrected assignment
            }
            else {
                $ReturnData_ary[1] = 0;
            }
            //-------------Total Checking Time -------------------------------------
            $stmt = $conn->prepare("
                SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(tblwo_allcheckinusers.CheckOutUserDateTime, tblwo_allcheckinusers.CheckInUserDateTime)))) AS TotalCheckInDuration
                FROM tblwo_allcheckinusers
                JOIN tblwo_event ON tblwo_allcheckinusers.WorkOrderNo = tblwo_event.WorkOrderNo
                WHERE tblwo_allcheckinusers.CheckInUser = :epf
                AND DATE(tblwo_allcheckinusers.CheckInServerDateTime) = CURDATE();
            ");

            $stmt->bindParam(':epf', $strEPF); 
            $stmt->execute();  
            if ($stmt->rowCount() > 0)
            {
                $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result
                               
                if ($result['TotalCheckInDuration'] !== null){
                    $ReturnData_ary[2] = $result['TotalCheckInDuration']; 
                } else {
                    $ReturnData_ary[2] = '0'; // Default value
                }
            }
            else {
                $ReturnData_ary[2] = 0;
            }
            //------------- Current Work Order Number -------------------------------------
            $stmt = $conn->prepare("
                SELECT WorkOrderNo 
                FROM tblwo_allcheckinusers                
                WHERE tblwo_allcheckinusers.CheckInUser = :epf
                AND Status = 'Active';
            ");

            $stmt->bindParam(':epf', $strEPF); 
            $stmt->execute();  
            if ($stmt->rowCount() > 0){
                $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result
                $ReturnData_ary[3] = $result['WorkOrderNo']; // Corrected assignment
            }
            else {
                $ReturnData_ary[3] = "N/A";
            }
            //------------------ END -------------------------------------
            $Status_ary[0] = "true";
            $Status_ary[1] = "Delete Success";            
        } 
        catch(PDOException $e) 
        {
            $error =  "Error: " . $e->getMessage();            
            //writeToLogFile($error);
        }    
        $conn = null;        
    }
    
    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
          
    //print json_encode($error);
    print json_encode($data_ary); 
    // print json_encode($ProductQuantity_ary);
       
?>