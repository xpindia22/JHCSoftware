<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
session_start();
require_once '../config/conn.php'; // Connect to the database.

function log_login_attempt($conn, $email, $userid, $attempted_password, $status) {
    $browser_used = $_SERVER['HTTP_USER_AGENT'];
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $mac_address = exec('getmac');
    $mac_address = strtok($mac_address, ' ');

    $sql = "INSERT INTO login_attempts (userid, email, browser_used, ip_address, mac_address, attempted_password, status) 
            VALUES ('$userid', '$email', '$browser_used', '$ip_address', '$mac_address', '$attempted_password', '$status')";
    $conn->query($sql);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ob_start(); // Start output buffering

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    $sql = "SELECT userid, username, password, role FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Set session and cookies
            $_SESSION['userid'] = $user['userid'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['roles'] = explode(',', $user['role']);
            setcookie("userid", $user['userid'], time() + (86400 * 60), "/");
            setcookie("username", $user['username'], time() + (86400 * 60), "/");
            setcookie("roles", $user['role'], time() + (86400 * 60), "/");

            // Check if the user has the 'SA' role
            if (in_array('SA', $_SESSION['roles'])) {
                $_SESSION['is_super_admin'] = true;
            } else {
                $_SESSION['is_super_admin'] = false;
            }

            // Log successful login attempt
            log_login_attempt($conn, $email, $user['userid'], $password, 'success');

            // Redirect to the originally requested URL if it exists, otherwise to dashboard.php
            $redirect_url = isset($_SESSION['requested_url']) ? $_SESSION['requested_url'] : '../dashboard/dashboard.php';
            unset($_SESSION['requested_url']); // Clear the stored URL
            header("Location: $redirect_url");
            exit();
        } else {
            // Log failed login attempt
            log_login_attempt($conn, $email, 0, $password, 'failed');
            $error_message = "Invalid password.";
        }
    } else {
        // Log failed login attempt
        log_login_attempt($conn, $email, 0, $password, 'failed');
        $error_message = "No user found with that email address.";
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
    <h2>Staff Login</h2>
    <?php if (!empty($error_message)) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required value='xxx@xxx.com'><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required value="xxx"><br><br>
        
        <input type="submit" value="Login">
    </form>
 </body>
</html>
<p><a href='logout.php'>Logout</a></p>