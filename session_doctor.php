<?php
session_start();
if (!isset($_SESSION['doctor_id'])) {
    header("Location: 004_doctor_login.php");
    exit;
}
?>
