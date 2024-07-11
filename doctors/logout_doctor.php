<?php
session_start();
session_destroy();
header('Location: doctor_login.php');
exit;
?>