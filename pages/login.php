<?php
    session_start();

    require_once('../initialize.php');
    require_once('../config.php');
    
    $num = $_POST["userpara"];
    //----------- Database Connection ---------------------
    //require '../dbconnection/dbConnection.php';        
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Colombo');
    $strDateTime = date("Y-m-d");   
    //----------- Declare Variables ----------------------- 
    $i = 0; 
    $UserName = $num[0];
    $Password = $num[1]; 
    //$UserName = "kelum";
    //$Password = "1234";    
    $LoginStates    = "NA";
    //$UserType       = "NA";
    
    try 
    {
        //----------------------------------------------------------------------------------
        //------------ Read Data from tblfacstng_workcenter Table --------------------------
        //----------------------------------------------------------------------------------        
        //SELECT column_name(s) FROM table_name WHERE condition GROUP BY column_name(s) ORDER BY column_name(s);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT ID,EPF,EmpName,UserName,Password,Department,Contact,UserType,Availability FROM tblusers_account WHERE UserName=:unme");
        $stmt->bindParam(':unme', $UserName); 
        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();        
        foreach($result as $row)
        {           
            $ID_ary[$i] = $row['ID'];
            $EPF_ary[$i] = $row['EPF'];  
            $EmpName_ary[$i] = $row['EmpName'];  
            $UserName_ary[$i] = $row['UserName'];  
            $Password_ary[$i] = $row['Password'];  
            $Department_ary[$i]= $row['Department'];  
            $Contact_ary[$i]   = $row['Contact'];  
            $UserType_ary[$i]     = $row['UserType'];  
            $Availability_ary[$i]     = $row['Availability'];                      
            $i++;
            //echo $i;
        }                
        //echo $strSummaryAry;
    } 
    catch(PDOException $e) 
    {
        $error =  "Error: " . $e->getMessage();
    } 
    if($i > 0)      //--------- If username available -----------------
    {
        if($Password == $Password_ary[0])   // if password is correct
        {
            $LoginStates    = "Success";   
            $_SESSION["user_epf"]       = $EPF_ary[0];
            $_SESSION["user_name"]      = $EmpName_ary[0];
            $_SESSION["user_department"]    = $Department_ary[0];
            $_SESSION["user_contactno"]     = $Contact_ary[0];
            $_SESSION["user_type"]          = $UserType_ary[0];
            $_SESSION["user_availability"]  = $Availability_ary[0];            
            //---------------- Find User Access Levels and Store in a Array --------------------------
            try 
            {
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM tblusers_roleaccess WHERE UserType=:usrtp");
                $stmt->bindParam(':usrtp', $UserType_ary[0]); 
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);        
                $result = $stmt->fetchAll(); 
                $i = 0;
                foreach($result as $row)
                {           
                    $Sections_ary[$i]   = $row['Sections'];
                    $Areas_ary[$i]      = $row['Areas']; 
                    $Other_ary[$i]      = $row['Other']; 
                    $i++;
                }        
                $_SESSION["user_roll_sections"] = array_map('trim', explode(",", $Sections_ary[0]));
                $_SESSION["user_roll_areas"] = array_map('trim', explode(",", $Areas_ary[0]));
                $_SESSION["user_roll_other"] = array_map('trim', explode(",", $Other_ary[0]));
                //print_r($sectionsArray);
            } 
            catch(PDOException $e) 
            {
                $error =  "Error: " . $e->getMessage();
            }  
        }
        else        
        {
            $LoginStates    = "Password Error";  
            $EmpName_ary[0] = "NA";
        }     
    }
    else    // Username not available
    {
        $LoginStates    = "Username Error"; 
        $EmpName_ary[0] = "NA";
        //$data_ary = array(0);
    }
    $conn = null;  
    $data_ary['LoginDetailAry'] = array($LoginStates, $EmpName_ary[0]);    
    //print json_encode($sql2);
    //print "<br />";
    print json_encode($data_ary); 
?>
