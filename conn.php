<?php
$host = "localhost";
$user = "root";
$pwd = "";
$db = "mydb";

// Create connection
$conn = new mysqli($host, $user, $pwd, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>