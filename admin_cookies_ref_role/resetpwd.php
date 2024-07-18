<?php
require_once 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = mysqli_real_escape_string($conn, $_POST['token']);
    $new_password = password_hash(mysqli_real_escape_string($conn, $_POST['password']), PASSWORD_BCRYPT);

    $sql = "SELECT userid FROM users WHERE reset_token = '$token'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $userid = $user['userid'];

        $sql = "UPDATE users SET password = '$new_password', reset_token = NULL WHERE userid = '$userid'";
        $conn->query($sql);

        echo "Password has been reset successfully.";
    } else {
        echo "Invalid token.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form method="post" action="">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
        
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Reset Password">
    </form>
</body>
</html>
