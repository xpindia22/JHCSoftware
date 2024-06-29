<?php
//Database credentials for live server
    $dbname_live = 'mydb';
    $username_live = 'root';
    $password_live = ''; // If you are on a live server then pl use usernad with password for db.

    // Create connection to live server
    //$livehost = 'localhost-ip';
    $livehost = 'hosp-ip';
    // $conn_live = new mysqli($livehost, $dbname_live, $username_live, $password_live);
   
    $conn_live = new PDO("mysql:host=$livehost;dbname=$dbname_live", $username_live, $password_live); 
    // Check connections
    if (!$conn_live) {
        die("Connection failed: " . mysqli_connect_error());
    }
    ?>