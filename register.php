<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb"; // Use the database name you created

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

// Validate that passwords match
if ($password1 !== $password2) {
    echo "Passwords do not match. Please try again.";
    exit;
}

// Hash the password
$password = md5($password1);

// Insert user data into the 'users' table
$sql = "INSERT INTO users (fname, lname, username, email, password) 
        VALUES ('$fname', '$lname', '$username', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "User registered successfully";
} else {
    echo "Error registering user: " . $conn->error;
}

$conn->close();
?>
