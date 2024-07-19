<?php
session_start();
require_once 'conn.php';

if (!isset($_SESSION['userid'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Fetch user roles from the database
$userid = $_SESSION['userid'];
$sql = "SELECT role FROM users WHERE userid='$userid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['roles'] = explode(',', $row['role']);
} else {
    echo "Error: User roles not found.";
    exit();
}

// Do not close the connection here
?>
