<?php

    //$servername = "localhost";
    //$username = "sky";
    //$password = "noyoN@1234";
    //$database = "wms1760g";
    //$database2 = "wms1760g_mcdata";
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "wms1760g";
    $database2 = "wms1760g_mcdata";
    
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
        
    //----------- Machine Data Dashboard and reports--------------------
    try 
    {
        $conn_mc = new PDO("mysql:host=$servername;dbname=$database2", $username, $password);
        // set the PDO error mode to exception
        $conn_mc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    } 
    catch(PDOException $e) 
    {
        echo "Connection failed: " . $e->getMessage();
    } 
?>
