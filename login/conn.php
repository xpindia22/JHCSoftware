<?php
$host = "localhost";
$user = "mydb";
$pwd = "mydb";//password should never be left blank on a live server.
$db = "mydb";

// Create connection
$conn = new mysqli($host, $user, $pwd, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>