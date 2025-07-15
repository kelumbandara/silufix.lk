
<?php

    require_once('../../../initialize.php');
    require_once('../../../config.php');
    
    $num = $_POST["userpara"];    
    
    $strFuncType = $num[0];    
   // $strFuncType = "funGetFilteredData";
    
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
    $State = "Verified";
    $Status_ary     = array();
    $ReturnData_ary = array();
    $ReturnData_ary[0][0]  = "NA"; 
    //----------------- Function : Get Checking Details ------------------------------
    if($strFuncType === "funGetFilteredData")      //-------------- funGetCheckInDetails_byWoEpf -----------
    {
        try 
        { 
            //SELECT column_name(s) FROM table_name WHERE condition GROUP BY column_name(s) ORDER BY column_name(s);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $stmt = $conn->prepare( "SELECT * FROM tblwo_event WHERE WoStatus = :State AND DATE(VerifiedDateTime) = :strDateTime");
            $stmt->bindParam(':State', $State); 
            $stmt->bindParam(':strDateTime', $strDateTime); 
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll(); 
            foreach($result as $row)
            {           
                $ReturnData_ary[$i][0] = $row['ID'];
                $ReturnData_ary[$i][1] = $row['WorkOrderNo']; 
                $ReturnData_ary[$i][2] = $row['CreatedDateTime'];                    
                $ReturnData_ary[$i][3] = $row['CreatedDepartment']; 
                $ReturnData_ary[$i][4] = $row['ResponciblePerson']; 
                $ReturnData_ary[$i][5] = $row['WorkOrderCategory']; 
                $ReturnData_ary[$i][6] = $row['IssueType']; 
                $ReturnData_ary[$i][7] = $row['IssueDescriptionMain'];
                $ReturnData_ary[$i][8] = $row['WoStatus'];                
         
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