<?php
// register.php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in']!== true) {
    // User is not logged in, redirect to login page
    header('Location: login.php');
    exit;
}

// User is logged in, allow access to registration form
?>

<!-- Registration form -->
<form action="register.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name"><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>
    <input type="submit" value="Register">
</form>