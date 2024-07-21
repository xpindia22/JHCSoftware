<?php
// session_start();

// // Check if user is authenticated via cookies
// if (!isset($_COOKIE['userid']) || !isset($_COOKIE['username']) || !isset($_COOKIE['roles'])) {
//     // Store the requested URL in a session variable
//     $_SESSION['requested_url'] = $_SERVER['REQUEST_URI'];
    
//     // Redirect to login page if not authenticated
//     header("Location: ../admin_cookies_referer/login.php");

//     exit();
// }

// // Fetch the logged-in user's details from cookies
// $userid = $_COOKIE['userid'];
// $username = $_COOKIE['username'];
// $roles = explode(',', $_COOKIE['roles']);

// // Validate session and cookies
// if (!isset($_SESSION['userid']) || !isset($_SESSION['username']) || !isset($_SESSION['roles']) ||
//     $_SESSION['userid'] !== $userid || $_SESSION['username'] !== $username || array_diff($_SESSION['roles'], $roles) != array_diff($roles, $_SESSION['roles'])) {
//     // Store the requested URL in a session variable
//     $_SESSION['requested_url'] = $_SERVER['REQUEST_URI'];
    
//     // Redirect to login if session and cookie values mismatch
//     header("Location: ../admin_cookies_referer/login.php");

//     exit();
// }

// // Refresh cookies to extend expiration time
// setcookie("userid", $userid, time() + (86400 * 30), "/");
// setcookie("username", $username, time() + (86400 * 30), "/");
// setcookie("roles", implode(',', $roles), time() + (86400 * 30), "/");
?>

<?php
session_start();

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

// Refresh cookies to extend expiration time
setcookie("userid", $userid, time() + (86400 * 30), "/");
setcookie("username", $username, time() + (86400 * 30), "/");
setcookie("roles", implode(',', $roles), time() + (86400 * 30), "/");
?>
