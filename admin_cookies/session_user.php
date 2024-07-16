<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_COOKIE['userid']) || !isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit();
}

$userid = $_COOKIE['userid'];
$username = $_COOKIE['username'];

if (!isset($_SESSION['userid']) || !isset($_SESSION['username']) ||
    $_SESSION['userid'] !== $userid || $_SESSION['username'] !== $username) {
    header("Location: login.php");
    exit();
}

setcookie("userid", $userid, time() + (86400 * 30), "/");
setcookie("username", $username, time() + (86400 * 30), "/");
?>
