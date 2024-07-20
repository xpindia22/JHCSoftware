<?php
// session_start();

// // Unset all session variables
// $_SESSION = array();

// // Destroy the session
// session_destroy();

// // Delete cookies by setting expiration time in the past
// if (isset($_COOKIE['userid'])) {
//     setcookie('userid', '', time() - 3600, '/');
// }
// if (isset($_COOKIE['username'])) {
//     setcookie('username', '', time() - 3600, '/');
// }

// // Redirect to login page
// header("Location: login.php");
// exit();
?>
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
