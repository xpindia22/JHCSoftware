<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Delete cookies by setting expiration time in the past
if (isset($_COOKIE['userid'])) {
    setcookie('userid', '', time() - 3600, '/');
}
if (isset($_COOKIE['username'])) {
    setcookie('username', '', time() - 3600, '/');
}

// Redirect to login page
header("Location: login.php");
exit();
?>
