<?php

//---------- Write to log file ------------------
//------  require_once '../class/logging.php';
//------- JS --> writeToLogFile("Test error log"); -----------------


/*
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Retrieve data from POST parameters
    $data = $_POST["data"];
    $logFilePath = "logs/error_client.log";
    date_default_timezone_set('Asia/Colombo');
    $fileHandle = fopen($logFilePath, 'a');
    if ($fileHandle) 
    {
        $dateTime = date('Y-m-d H:i:s');
        $logMessage = "[{$dateTime}] {$data}\n";
        fwrite($fileHandle, $logMessage);
        fclose($fileHandle);
        http_response_code(200); // Success response
    } 
    else
    {
        http_response_code(500); // Internal server error
    }
}
else 
{
    http_response_code(405); // Method not allowed
}
 */
//-------- Request comming through function ------------------------------------
function writeToLogFile($message) 
{
    
    $message2 = "Test";
    $logFilePath = '../includes/log/error_server.log';  
    date_default_timezone_set('Asia/Colombo');
    //--------------- Sve the log ---------------------------
    $fileHandle = fopen($logFilePath, 'a');
    if ($fileHandle) 
    {
        $dateTime = date('Y-m-d H:i:s');
        $logMessage = "[{$dateTime}] {$message2}\n";
        fwrite($fileHandle, $logMessage);
        fclose($fileHandle);
    }
    else
    {
        // Failed to open the log file
        error_log("Failed to open log file: {$logFilePath}");
    }
}

?>
