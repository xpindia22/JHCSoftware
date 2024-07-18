<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);
    
    $sql = "SELECT userid, username, password, role FROM users WHERE username = '$username' AND department = '$department' AND specialization = '$specialization'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Set session and cookies
            $_SESSION['userid'] = $user['userid'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['roles'] = explode(',', $user['role']); // Assuming roles are stored as comma-separated values
            setcookie("userid", $user['userid'], time() + (86400 * 60), "/");
            setcookie("username", $user['username'], time() + (86400 * 60), "/");

            // Log successful login attempt
            log_login_attempt($conn, $user['username'], $user['userid'], $password, 'success');

            // Debugging information
            echo "Session roles: ";
            print_r($_SESSION['roles']);
            echo "<br>";

            // Role-based redirection
            if (in_array('Admin', $_SESSION['roles'])) {
                header("Location: dashboard_admin.php");
            } elseif (in_array('Doctor', $_SESSION['roles'])) {
                header("Location: dashboard_doctor.php");
            } elseif (in_array('Lab', $_SESSION['roles'])) {
                header("Location: dashboard_lab.php");
            } elseif (in_array('Pharmacy', $_SESSION['roles'])) {
                header("Location: dashboard_pharmacy.php");
            } elseif (in_array('Accounts', $_SESSION['roles'])) {
                header("Location: dashboard_accounts.php");
            } else {
                header("Location: dashboard.php");
            }
            exit();
        } else {
            // Log failed login attempt
            log_login_attempt($conn, $username, 0, $password, 'failed');
            $error_message = "Invalid password.";
        }
    } else {
        // Log failed login attempt
        log_login_attempt($conn, $username, 0, $password, 'failed');
        $error_message = "No user found with that username and department.";
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

        <label for="department">Department:</label>
        <select id="department" name="department" required>
            <option value="Internal Medicine">Internal Medicine</option>
            <option value="Cardiology">Cardiology</option>
            <option value="Dietary">Dietary</option>
            <option value="Gynecology">Gynecology</option>
            <option value="Paediatrics">Paediatrics</option>
            <option value="Orthopedics">Orthopedics</option>
        </select><br><br>
        
        <label for="specialization">Specialization:</label>
        <input type="text" id="specialization" name="specialization" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
