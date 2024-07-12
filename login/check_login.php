<?php
session_start();
require_once './config/conn.php'; // connect to the database.
if (!isset($_SESSION['userid'])) {
    header('Location:login.php');
    exit;
}
?>