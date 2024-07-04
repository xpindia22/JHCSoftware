<?php
session_start();
require_once 'conn.php';

if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
    exit;
}

?>

<p><a href="?logout=1">Logout</a></p>