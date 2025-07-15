
<?php
    
    $num = $_POST["userpara"];    
    //$startData = $num[0];
    //$endData = $num[1];
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
               
    try 
    {
        //SELECT column_name(s) FROM table_name WHERE condition GROUP BY column_name(s) ORDER BY column_name(s);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                       
        //$stmt = $conn->prepare("SELECT ID,WorkOrderNo,Department,WoDateTime,Description,UserName,Status,Verify,ReOpen FROM tbleventworkorder WHERE WoState=:wost");
        $stmt = $conn->prepare("SELECT ID,EPF,EmpName,Password,Department,Contact,UserType FROM tblusers_account WHERE Status<:stat");
        $stmt->bindParam(':stat', $intUserState); 
        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();        
        foreach($result as $row)
        {           
            $ID_ary[$i] = $row['ID'];
            $EPF_ary[$i] = $row['EPF']; 
            $EmpName_ary[$i] = $row['EmpName'];  
            $Password_ary[$i] = $row['Password'];  
            $Department_ary[$i] = $row['Department'];  
            $Contact_ary[$i]= $row['Contact'];  
            $UserType_ary[$i]   = $row['UserType'];                     
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
        $data_ary['ID_Ary']         = $ID_ary;
        $data_ary['EPF_Ary']        = $EPF_ary; 
        $data_ary['EmpName_Ary']    = $EmpName_ary; 
        $data_ary['Password_Ary']   = $Password_ary;  
        $data_ary['Department_Ary'] = $Department_ary;  
        $data_ary['Contact_Ary']    = $Contact_ary;  
        $data_ary['UserType_Ary']   = $UserType_ary;  
    }
    else 
    {
        $data_ary = array(0);
    }
    //print json_encode($error);
    print json_encode($data_ary); 
   // print json_encode($ProductQuantity_ary);
       
?>