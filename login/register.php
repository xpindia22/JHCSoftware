<?php
require_once '../conn.php';

if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['userid']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['mobile'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $userid = $_POST['userid'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO users (fname, lname, userid, password, email, mobile) VALUES ('$fname', '$lname', '$userid', '$hashed_password', '$email', '$mobile')";
    $result = $conn->query($query);

    if ($result) {
        echo 'User registered successfully!';
    } else {
        echo 'Error registering user: '. $conn->error;
    }
}

?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <label for="fname">First Name:</label>
    <input type="text" id="fname" name="fname"><br><br>
    <label for="lname">Last Name:</label>
    <input type="text" id="lname" name="lname"><br><br>
    <label for="userid">Username:</label>
    <input type="text" id="userid" name="userid"><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>
    <label for="mobile">Mobile:</label>
    <input type="tel" id="mobile" name="mobile"><br><br>
    <input type="submit" value="Register">
</form>