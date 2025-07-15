
<?php
    
    $num = $_POST["userpara"];    
    
    $strTableName = $num[0];
    $strSerchParameters = $num[1];
    
    //$strTableName       = "tblwo_allocatedusers";
    //$strSerchParameters = "WorkOrderNo = 'WO_00000097'";
    $strSqlString       = "";
    //----------- Database Connection ---------------------
    require '../../../dbconnection/dbConnection.php';          
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Colombo');
    $strDateTime = date("Y-m-d");   
    //----------- Declare Variables -----------------------     
    $i = 0; 
    $j = 0; 
    $error = "NA";
    $intUserState = "Active";
    
    $data_ary = array();
    //$data_ary[0] = "Test1";
    //$data_ary[1] = "Test2";        
    try 
    {
        $strSqlString = "SELECT * FROM " . $strTableName . " WHERE " . $strSerchParameters;
        //echo $strSqlString;
        
        //SELECT column_name(s) FROM table_name WHERE condition GROUP BY column_name(s) ORDER BY column_name(s);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                       
        $stmt = $conn->prepare($strSqlString);
        //$stmt = $conn->prepare("$strSqlString");
        //$stmt->bindParam(':stat', $intUserState); 
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
            $data_ary[] = $rowData;
            $i++;
        }   
        //echo $strSummaryAry;
    } 
    catch(PDOException $e) 
    {
        //$error =  "Error: " . $e->getMessage();
        $data_ary[0] = 'Error Msg: ' .$ex->getMessage();        
    }    
    $conn = null;
    if($i === 0)
    {
        $data_ary[0] = "NA";   
    }
    //print json_encode($error);
    print json_encode($data_ary); 
   // print json_encode($ProductQuantity_ary);
       
?>