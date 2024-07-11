<?php
$host = "localhost";
$user = "jhcpl";
$password = "jhcpl";
$db = "jhcpl";

// Create connection
$conn = new mysqli($host, $user, $password, $db);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Fetch the user from the database
    $result = $conn->query("SELECT * FROM admin WHERE name = '$name'");

    if ($result->num_rows > 0) {
        // User exists, now we verify the password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            echo "Login successful!";
            // You can redirect the user to another page
             //header('Location: r.php');
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Invalid username.";
    }
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
</head>
<body>
    <form action="" method="POST">
        <label for="name">Enter Name:</label>
        <input type="text" id="name" name="name" required><br> 
        <label for="password">Enter Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
