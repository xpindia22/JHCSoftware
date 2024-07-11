<?php
session_start(); // Start the session
require 'header-jhcpl.php';
require_once 'conn.php';


if (isset($_POST['userid']) && isset($_POST['password'])) {
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    // Prepare a parameterized query to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE userid=?");
    $stmt->bind_param("s", $userid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        if (password_verify($password, $user_data['password'])) {
            $_SESSION['userid'] = $userid;
            header('Location: 001_register-pt.php');
            exit;
        } else {
            echo 'Invalid password';
        }
    } else {
        echo 'User not found';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="(link unavailable)">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
        }
        .login-form {
            max-width: 300px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="login-form">
        <h2 class="text-center">Login</h2>
        <div class="form-group">
            <label for="userid" class="sr-only">Username:</label>
            <input type="text" id="userid" name="userid" class="form-control" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">Password:</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
</body>
</html>
