<?php
session_start();
require_once '../config/conn.php'; // connect to the database.
<<<<<<< HEAD
=======

// Capture the referring page before processing the form
if (!isset($_SESSION['referer']) && isset($_SERVER['HTTP_REFERER']) && !strpos($_SERVER['HTTP_REFERER'], 'admin_login.php')) {
    $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
}
>>>>>>> 016c17eb434cb318dcaf672fc0c6f8ee90c6299d

// Check if the admin is already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: " . (isset($_SESSION['referer']) ? $_SESSION['referer'] : 'admin_dashboard.php'));
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = mysqli_real_escape_string($conn, $_POST['admin_username']);
    $admin_password = mysqli_real_escape_string($conn, $_POST['admin_password']);

    // Verify admin credentials
    $admin_sql = "SELECT * FROM admin WHERE username = '$admin_username'";
    $admin_result = $conn->query($admin_sql);

    if ($admin_result->num_rows > 0) {
        $admin = $admin_result->fetch_assoc();
        if (password_verify($admin_password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['username'];

            // Redirect to the referer page or the admin dashboard if no referer is set
            $redirect_url = isset($_SESSION['referer']) ? $_SESSION['referer'] : 'admin_dashboard.php';
            unset($_SESSION['referer']);
            header("Location: $redirect_url");
            exit;
        } else {
            echo "Invalid admin password.";
        }
    } else {
        echo "No admin found with that username.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <form method="post" action="">
        <label for="admin_username">Username:</label>
        <input type="text" id="admin_username" name="admin_username" required><br><br>
        <label for="admin_password">Password:</label>
        <input type="password" id="admin_password" name="admin_password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
