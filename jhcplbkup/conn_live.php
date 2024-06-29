<?php
//Database credentials for live server
    $dbname_live = 'jameslkh_jhcpl'; //these usernames and pwd are virtual.
    
    $username_live = 'jameslkh_user_info';
    $password_live = 'c&)WLGHiecg{';

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