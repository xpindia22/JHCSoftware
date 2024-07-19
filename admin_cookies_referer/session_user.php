<?php
session_start();

// Check if user is authenticated via cookies
if (!isset($_COOKIE['userid']) || !isset($_COOKIE['username']) || !isset($_COOKIE['role'])) {
    // Store the requested URL in a session variable
    $_SESSION['requested_url'] = $_SERVER['REQUEST_URI'];
    
    // Redirect to login page if not authenticated
    header("Location: login.php");
    exit();
}

// Fetch the logged-in user's details from cookies
$userid = $_COOKIE['userid'];
$username = $_COOKIE['username'];
$role = $_COOKIE['role'];

// Validate session and cookies
if (!isset($_SESSION['userid']) || !isset($_SESSION['username']) || !isset($_SESSION['role']) ||
    $_SESSION['userid'] !== $userid || $_SESSION['username'] !== $username || $_SESSION['role'] !== $role) {
    // Store the requested URL in a session variable
    $_SESSION['requested_url'] = $_SERVER['REQUEST_URI'];
    
    // Redirect to login if session and cookie values mismatch
    header("Location: login.php");
    exit();
}

// Refresh cookies to extend expiration time
setcookie("userid", $userid, time() + (86400 * 30), "/");
setcookie("username", $username, time() + (86400 * 30), "/");
setcookie("role", $role, time() + (86400 * 30), "/");

// Role-based redirection (optional)
// Note: You might want to handle this in the respective pages where you want to ensure role-based access
?>
