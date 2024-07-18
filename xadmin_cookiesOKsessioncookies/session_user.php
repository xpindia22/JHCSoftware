<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start(); // Start output buffering
session_start();

echo "Checking session and cookies...<br>";

// Check if user is authenticated via cookies
if (!isset($_COOKIE['userid']) || !isset($_COOKIE['username'])) {
    echo "Cookies not set. Redirecting to login.php<br>";
    ob_flush(); // Ensure output is sent before redirection
    header("Location: login.php");
    exit();
}

$userid = $_COOKIE['userid'];
$username = $_COOKIE['username'];

echo "Cookie values - userid: $userid, username: $username<br>";

// Validate session and cookies
if (!isset($_SESSION['userid']) || !isset($_SESSION['username']) ||
    $_SESSION['userid'] !== $userid || $_SESSION['username'] !== $username) {
    echo "Session and cookie values mismatch. Redirecting to login.php<br>";
    ob_flush(); // Ensure output is sent before redirection
    header("Location: login.php");
    exit();
}

// Refresh cookies to extend expiration time
setcookie("userid", $userid, time() + (86400 * 30), "/");
setcookie("username", $username, time() + (86400 * 30), "/");

echo "Session and cookies validated successfully.<br>";
ob_flush(); // Ensure output is sent before continuing
?>
