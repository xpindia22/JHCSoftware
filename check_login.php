<?php
session_start();
require_once 'conn.php';

if (!isset($_SESSION['userid'])) {
    header('Location: ./login/login.php');
    exit;
}
?>