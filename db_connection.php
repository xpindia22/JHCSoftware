<?php
// Database connection settings
$db_host = 'localhost';
$db_username = 'mydb';
$db_password = 'mydb';
$db_name = 'mydb';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>