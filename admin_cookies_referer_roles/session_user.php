<?php
session_start();
require_once 'conn.php'; // Ensure the database connection is included

// Debugging: Check if database connection is established
if ($conn->connect_error) {
    die("Database connection not established: " . $conn->connect_error);
} else {
    echo "Database connection established.<br>";
}

// Check if user is authenticated via cookies
if (!isset($_COOKIE['userid']) || !isset($_COOKIE['username'])) {
    echo "Cookies not set. Redirecting to login.php";
    header("Location: login.php");
    exit();
}

// Fetch the logged-in user's details from cookies
$userid = $_COOKIE['userid'];
$username = $_COOKIE['username'];

// Debugging: Print the cookies
echo "Cookies - userid: $userid, username: $username<br>";

// Validate session and cookies
if (!isset($_SESSION['userid']) || !isset($_SESSION['username']) ||
    $_SESSION['userid'] !== $userid || $_SESSION['username'] !== $username) {
    echo "Session and cookie values mismatch. Redirecting to login.php";
    header("Location: login.php");
    exit();
}

// Refresh cookies to extend expiration time
setcookie("userid", $userid, time() + (86400 * 30), "/");
setcookie("username", $username, time() + (86400 * 30), "/");

// Debugging: Query to check user's roles
$sql = "SELECT role FROM users WHERE userid = '$userid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['roles'] = explode(',', $row['role']); // Store roles as an array
    echo "User roles: " . implode(', ', $_SESSION['roles']) . "<br>";
} else {
    echo "No user found with userid $userid. Redirecting to login.php";
    header("Location: login.php");
    exit();
}

// Debugging: Check session roles
echo "Session roles: " . implode(', ', $_SESSION['roles']) . "<br>";

// Close the connection
$conn->close();
?>
