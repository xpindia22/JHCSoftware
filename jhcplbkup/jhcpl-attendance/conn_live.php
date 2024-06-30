<?php
//Database credentials for live server
    $dbname_live = 'mydb';
    $username_live = 'root';
    $password_live = '';

    // Create connection to live server
    //$livehost = '69.49.233.70';
    $livehost = 'jhcpl.in';
    // $conn_live = new mysqli($livehost, $dbname_live, $username_live, $password_live);
   
    $conn_live = new PDO("mysql:host=$livehost;dbname=$dbname_live", $username_live, $password_live); 
    // Check connections
    if (!$conn_live) {
        die("Connection failed: " . mysqli_connect_error());
    }
    ?>