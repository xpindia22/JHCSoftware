<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb"; // Use the database name you created

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = md5($_POST['password']); // Hash the entered password

// Check if the user exists in the 'users' table
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Login successful! Redirect to home page.";
} else {
    echo "Invalid credentials. Please try again.";
}

$conn->close();
?>
