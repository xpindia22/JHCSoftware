<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "mydb";

// // Create connection
// $conn_local = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn_local->connect_error) {
//   die("Connection failed: " . $conn_local->connect_error);
// }

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