<?php
session_start();
require_once 'conn.php'; // Ensure you have the connection to the database

// Function to check if user is blacklisted or whitelisted
function check_user_access($conn, $userid) {
    $sql = "SELECT status FROM users WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $userid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return $row['status'];
    }
    return null;
}

// Check if user is authenticated via cookies
if (!isset($_COOKIE['userid']) || !isset($_COOKIE['username']) || !isset($_COOKIE['roles'])) {
    // Store the requested URL in a session variable
    $_SESSION['requested_url'] = $_SERVER['REQUEST_URI'];
    
    // Redirect to login page if not authenticated
    header("Location: ../admin_cookies_referer/login.php");
    exit();
}

// Fetch the logged-in user's details from cookies
$userid = $_COOKIE['userid'];
$username = $_COOKIE['username'];
$roles = explode(',', $_COOKIE['roles']);

// Validate session and cookies
if (!isset($_SESSION['userid']) || !isset($_SESSION['username']) || !isset($_SESSION['roles']) ||
    $_SESSION['userid'] !== $userid || $_SESSION['username'] !== $username || 
    !array_intersect($_SESSION['roles'], $roles)) {
    // Store the requested URL in a session variable
    $_SESSION['requested_url'] = $_SERVER['REQUEST_URI'];
    
    // Redirect to login if session and cookie values mismatch
    header("Location: ../admin_cookies_referer/login.php");
    exit();
}

// Check user access status
$access_status = check_user_access($conn, $userid);

if ($access_status === 'blacklist') {
    echo '<font color="red">Access denied. You are blacklisted. Contact Administrator for access.</font>';
    exit();
}

// Refresh cookies to extend expiration time
setcookie("userid", $userid, time() + (86400 * 30), "/");
setcookie("username", $username, time() + (86400 * 30), "/");
setcookie("roles", implode(',', $roles), time() + (86400 * 30), "/");
?>
