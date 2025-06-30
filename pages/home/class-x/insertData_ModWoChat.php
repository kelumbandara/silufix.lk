
<?php
    session_start();
    require_once('../../../initialize.php');
    require_once('../../../config.php');
    
    $num = $_POST["userpara"];
           
    $strWorkOrderNo     = $num[0];    
    $strSendBy          = $num[1]; 
    $strChatMessage     = $num[2];
        
    //$strWorkOrderNo     = "WO_00000153";    
    //$strSendBy          = "Kelum "; 
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strServerDateTime = date("Y-m-d H:i:s");      

    $strReceiveBy       = "NA";
    $strDeliveredStatus = "NA";
    $strStatus          = "Active";   
    //----------- Declare Variables -----------------------    
    $Status_ary     = array();
    $ReturnData_ary = array();
    $ReturnData_ary[0]  = "NA";    
    //--------------- Insert Data to Wo_Event -----------------------------    
    try 
    {   
        // ID,WorkOrderNo,SendBy,ReceiveBy,SendDateTime,ChatMessage,DeliveredDateTime,DeliveredStatus,Status 	
        
        $stmt = $conn->prepare("INSERT INTO tblwo_chathistory (WorkOrderNo,SendBy,ReceiveBy,SendDateTime,ChatMessage,DeliveredDateTime,DeliveredStatus,Status) VALUES (:wono, :sndby, :rcvdby, :snddt, :chtmsg, :dvrydt, :dvryst, :stat)");
        $stmt->bindParam(':wono', $strWorkOrderNo);
        $stmt->bindParam(':sndby',$strSendBy );        
        $stmt->bindParam(':rcvdby', $strReceiveBy);
        $stmt->bindParam(':snddt', $strServerDateTime);
        $stmt->bindParam(':chtmsg', $strChatMessage);
        $stmt->bindParam(':dvrydt', $strServerDateTime);
        $stmt->bindParam(':dvryst', $strDeliveredStatus);
        $stmt->bindParam(':stat', $strStatus);       
        $stmt->execute();   
        //$stmt->close();  
        $Status_ary[0] = "true";
        $Status_ary[1] = "Data saved successfully";   
    } 
    catch (Exception $ex) 
    {
        $Status_ary[0] = "false";
        $Status_ary[1] = 'Error Msg: ' .$ex->getMessage(); 
        //$stmt->close(); 
    }
    $conn = null;
    
    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
    //print json_encode($RecordSavingState);
    //print json_encode($num); 
    print json_encode($data_ary);  
       
?>