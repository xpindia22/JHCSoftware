<?php
 

 // Database credentials for WAMP server
 $dbname_local = 'mydb';
 $username_local = 'root';
 $password_local = '';

  // Create connection to WAMP server
  $localhost = 'localhost';
  $conn_local = new PDO("mysql:host=$localhost;dbname=$dbname_local", $username_local, $password_local);

   // Check connections
   if (!$conn_local) {
    die("Connection failed: " . mysqli_connect_error());
}

?>