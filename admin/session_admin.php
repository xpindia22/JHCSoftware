<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../login/admin_login.php");
    exit();
}

$admin_username = $_SESSION['admin_username'];
?>
