<?php
session_start();

// Unset all of the session variables
$_SESSION = [];

// Destroy the session.
session_destroy();

// Delete the cookies by setting their expiration date to a past date
setcookie("userid", "", time() - 3600, "/");
setcookie("username", "", time() - 3600, "/");
setcookie("roles", "", time() - 3600, "/");

// Redirect to the login page
header("Location: login.php");
exit;
?>
