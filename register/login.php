<?php
session_start(); // Start the session
require '../header-jhcpl.php';
require_once '../config/conn.php'; // connect to the database.


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
            //header('Location: 001_pt_register.php');
            echo 'Login Successful. <a href="001_pt_register.php">Register a New Patient</a>, <a href="create_pt_appointment.php">Create an Appointment</a>, <a href="../doctors/004_doctor_login.php">Doctor Login</a>';
            exit;
        } else {
            echo 'Invalid password';
        }
    } else {
        echo 'User not found';
    }
}

?>
<html>
<style>
form{
    width:300px;
    margin:auto;
    margin-top: 100px;
    
    
}

</style>

    <body> 
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <label for="userid">Username:</label>
    <input type="text" id="userid" name="userid"><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Login">
</form></body>
</html>