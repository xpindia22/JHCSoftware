<!-- process_login.php -->
<?php
session_start();

// Predefined username and password
$validUsername = 'xxx';
$validPassword = 'xxx';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredUsername = $_POST['username'];
    $enteredPassword = $_POST['password'];

    if ($enteredUsername === $validUsername && $enteredPassword === $validPassword) {
        // Set session or cookie here (e.g., $_SESSION['user'] = $enteredUsername)
        header('Location: output.php'); // Redirect to output.php
        exit;
    } else {
        echo 'Invalid credentials. Please try again.';
    }
}
?>
