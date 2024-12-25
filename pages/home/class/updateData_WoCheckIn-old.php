
<?php
    session_start();
    $num = $_POST["userpara"];
    //----------- Database Connection ---------------------
    require '../../../dbconnection/dbConnection.php';     
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strServerDateTime = date("Y-m-d H:i:s");    
    //----------- Declare Variables -----------------------  
    $WorkOrderNo    = $num[0]; 
    $UserName      = $num[2]; 
    //$WorkOrderNo   = "WO_00000098";
    //$UserName      = "Tara";    
    //$RespondUser      = $_SESSION["user_name"];   

    $WoState    = "Inprogress";
    $WoVerify   = "-";
    $State      = 2;
           
    $data = array();
    $data[0] = "Test1";
    $data[1] = "Test2";       
    try 
    {
        //$stmt = $conn->prepare("UPDATE tblwo_event SET RespondDateTime=:respdt, RespondUser=:respusr, WoStatus =:wost, State=:stat WHERE WorkOrderNo=:wono");
        $stmt = $conn->prepare("UPDATE tblwo_event SET RespondDateTime=:respdt,RespondUser=:respuser,WoStatus=:wostat,WoVerify=:wovery,State=:stat WHERE WorkOrderNo=:wono");
        
        $stmt->bindParam(':wono', $WorkOrderNo);
        $stmt->bindParam(':respdt', $strServerDateTime);
        $stmt->bindParam(':respuser', $UserName); 
        $stmt->bindParam(':wostat', $WoState);
        $stmt->bindParam(':wovery', $WoVerify);
        $stmt->bindParam(':stat', $State);
        
        $stmt->execute();   
        //$stmt->close();
        $data[1] = "Save Successfully"; 
    } 
    catch (Exception $ex) 
    {
        $data[1] = 'Error Msg: ' .$ex->getMessage();
        //$stmt->close(); 
    }
   $conn = null;
   //print json_encode($RecordSavingState);
   //print json_encode($num); 
   print json_encode($data);  
       
?>