<?php

    $servername = "localhost";
    $username = "root";
    $password = " ";
    $database = "mms1810b";
      
    //$servername = "perahara.lk";
    //$username = "kelum";
    //$password = "sKy@1234";
    //$database = "mms1810a";
    //$database2 = "wms1760g_mcdata";
    
    try 
    {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    } 
    catch(PDOException $e) 
    {
        echo "Connection failed: " . $e->getMessage();
    } 
    //----------- Only test for Excel Data update --------------------
    $conn2 = mysqli_connect($servername, $username, $password, $database);
        
    
?>
