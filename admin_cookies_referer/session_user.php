<?php
session_start();
require_once 'conn.php'; // Ensure the connection file is included

// Define the base URL
$base_url = 'http://localhost/githubmine/JHCSoftware/admin_cookies_referer';

// Check if user is authenticated via cookies
if (!isset($_COOKIE['userid']) || !isset($_COOKIE['username'])) {
    // Store the requested URL and redirect to login
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    header("Location: $base_url/login.php");
    exit();
}

// Fetch the logged-in user's details from cookies
$userid = $_COOKIE['userid'];
$username = $_COOKIE['username'];

// Validate session and cookies
if (!isset($_SESSION['userid']) || !isset($_SESSION['username']) ||
    $_SESSION['userid'] !== $userid || $_SESSION['username'] !== $username) {
    // Redirect to login if session and cookie values mismatch
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    header("Location: $base_url/login.php");
    exit();
}

// Fetch the user role from the database
$sql = "SELECT role FROM users WHERE userid = '$userid'";
$result = $conn->query($sql);

if ($result === false) {
    die("Database query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $role = $user['role'];
} else {
    // If no user found, force logout
    header("Location: $base_url/logout.php");
    exit();
}

// Refresh cookies to extend expiration time
setcookie("userid", $userid, time() + (86400 * 30), "/");
setcookie("username", $username, time() + (86400 * 30), "/");
?>
