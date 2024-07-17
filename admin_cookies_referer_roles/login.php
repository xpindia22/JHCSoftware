<?php
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
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    $sql = "SELECT userid, username, password, role FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Set session and cookies
            $_SESSION['userid'] = $user['userid'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            setcookie("userid", $user['userid'], time() + (86400 * 30), "/");
            setcookie("username", $user['username'], time() + (86400 * 30), "/");

            // Log successful login attempt
            log_login_attempt($conn, $user['username'], $user['userid'], $password, 'success');

            // Redirect to the originally requested page or dashboard
            $redirect_url = isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : '/dashboard.php';
            unset($_SESSION['redirect_to']);
            header("Location: http://localhost/githubmine/JHCSoftware/admin_cookies_referer$redirect_url");
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
