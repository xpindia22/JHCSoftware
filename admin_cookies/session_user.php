<?php 
session_start();

// Check if user is authenticated via cookies
if (!isset($_COOKIE['userid']) || !isset($_COOKIE['username'])) {
    // Redirect to login page if not authenticated
    header("Location: login.php");
    exit();
}

// Fetch the logged-in user's details from cookies
$userid = $_COOKIE['userid'];
$username = $_COOKIE['username'];

// Validate session and cookies
if (!isset($_SESSION['userid']) || !isset($_SESSION['username']) ||
    $_SESSION['userid'] !== $userid || $_SESSION['username'] !== $username) {
    // Redirect to login if session and cookie values mismatch
    header("Location: login.php");
    exit();
}

// Refresh cookies to extend expiration time
setcookie("userid", $userid, time() + (86400 * 30), "/");
setcookie("username", $username, time() + (86400 * 30), "/");
?>
