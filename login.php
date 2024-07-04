<?php
require_once 'conn.php';

if (isset($_POST['userid']) && isset($_POST['password'])) {
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE userid='$userid'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        if (password_verify($password, $user_data['password'])) {
            $_SESSION['userid'] = $userid;
            header('Location: ../001_register-pt.php');
            exit;
        } else {
            echo 'Invalid password';
        }
    } else {
        echo 'User not found';
    }
}

?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <label for="userid">Username:</label>
    <input type="text" id="userid" name="userid"><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Login">
</form>