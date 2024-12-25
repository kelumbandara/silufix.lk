
<?php
    session_start();
    $num = $_POST["userpara"];

    //----------- Database Connection ---------------------
    require '../../../dbconnection/dbConnection.php';       
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strServerDateTime = date("Y-m-d H:i:s");    
    //----------- Declare Variables -----------------------  
    $WorkOrderNo      = $num[0];        
    $RespondDateTime  = $num[1];
    $Note             = $num[2];
    $RespondUser      = $_SESSION["user_name"];   
    //$WorkOrderStatusChange  = "Respond";
    $WorkOrderStatusChange  = $num[3];
    $WoState    ="NA";
    $WoVerify   ="NA";
    if($WorkOrderStatusChange == "Acknowledged")
    {
        $State  = 2;
        $WoState    ="Acknowledged";
        $WoVerify   ="";
    }
    else if($WorkOrderStatusChange == "Inprogress")
    {
        $State  = 3;
        $WoState    ="Inprogress";
        $WoVerify   ="";        
    }
    else if($WorkOrderStatusChange == "Closed")
    {
        $State  = 4;
        $WoState    ="Closed";
        $WoVerify   ="";
    }
    else if($WorkOrderStatusChange == "Verified")
    {
        $State      = 5;
        $WoState    ="Closed";
        $WoVerify   ="Verified";
    }
    else 
    {
        $State  = 10;
    }
    $data = array();
    $data[0] = "Test1";
    $data[1] = "Test2";       
    try 
    {
        //$stmt = $conn->prepare("UPDATE tblwo_event SET RespondDateTime=:respdt, RespondUser=:respusr, WoStatus =:wost, State=:stat WHERE WorkOrderNo=:wono");
        $stmt = $conn->prepare("UPDATE tblwo_event SET RespondDateTime=:respdt, RespondUser=:respusr, WoStatus =:wost, WoVerify=:woveri, State=:stat WHERE WorkOrderNo=:wono");
        $stmt->bindParam(':respdt', $RespondDateTime);
        $stmt->bindParam(':respusr', $RespondUser);        
        $stmt->bindParam(':wost', $WoState);  
        $stmt->bindParam(':woveri', $WoVerify);          
        $stmt->bindParam(':stat', $State);        
        $stmt->bindParam(':wono', $WorkOrderNo);     
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