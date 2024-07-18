<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
session_start();
require_once 'conn.php';

function log_login_attempt($conn, $username, $userid, $attempted_password, $status) {
    $browser_used = $_SERVER['HTTP_USER_AGENT'];
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $mac_address = exec('getmac');
    $mac_address = strtok($mac_address, ' ');

    $sql = "INSERT INTO login_attempts (userid, username, browser_used, ip_address, mac_address, attempted_password, status) 
            VALUES ('$userid', '$username', '$browser_used', '$ip_address', '$mac_address', '$attempted_password', '$status')";
    $conn->query($sql);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ob_start(); // Start output buffering

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    $sql = "SELECT userid, username, password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Set session and cookies
            $_SESSION['userid'] = $user['userid'];
            $_SESSION['username'] = $user['username'];
            setcookie("userid", $user['userid'], time() + (86400 * 60), "/");
            setcookie("username", $user['username'], time() + (86400 * 60), "/");

            // Log successful login attempt
            log_login_attempt($conn, $user['username'], $user['userid'], $password, 'success');
            

            // Redirect to the originally requested URL if it exists, otherwise to dashboard.php
            $redirect_url = isset($_SESSION['requested_url']) ? $_SESSION['requested_url'] : 'dashboard.php';
            unset($_SESSION['requested_url']); // Clear the stored URL
            header("Location: $redirect_url");
            exit();
        } else {
            // Log failed login attempt
            log_login_attempt($conn, $username, 0, $password, 'failed');
            $error_message = "Invalid password.";
        }
    } else {
        // Log failed login attempt
        log_login_attempt($conn, $username, 0, $password, 'failed');
        $error_message = "No user found with that username.";
    }
    
    ob_end_flush(); // End and flush the output buffer
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (!empty($error_message)) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Login">
    </form>
</body>
</html>
