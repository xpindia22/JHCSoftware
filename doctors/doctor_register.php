<?php
require_once 'conn.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: ". $conn->connect_error);
}

// Get doctor's information from the registration form
$doctor_username = $_POST['doctor_username'];
$doctor_email = $_POST['doctor_email'];
$doctor_password = password_hash($_POST['doctor_password'], PASSWORD_DEFAULT); // Hash the password for security reasons

// Insert the doctor's information into the doctors table
$sql = "INSERT INTO doctors (username, email, password) VALUES ('$doctor_username', '$doctor_email', '$doctor_password')";

if ($conn->query($sql) === TRUE) {
  echo "New doctor registered successfully";
} else {
  echo "Error: ". $sql. "<br>". $conn->error;
}

// Close the connection
$conn->close();
?>