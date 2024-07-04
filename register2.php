<?php
require_once 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $userid = trim($_POST['userid']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);

    // Validate and sanitize input data
    if (empty($fname) || empty($lname)) {
        echo 'Invalid name format';
        exit;
    }

    if (!preg_match('/^[a-zA-Z0-9_]+$/', $userid)) {
        echo 'Invalid username format';
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email format';
        exit;
    }

    if (!preg_match('/^[0-9]+$/', $mobile)) {
        echo 'Invalid mobile number format';
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_ARGON2ID);

    $stmt = $conn->prepare("INSERT INTO users (fname, lname, userid, password, email, mobile) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("ssssss", $fname, $lname, $userid, $hashed_password, $email, $mobile);
    $result = $stmt->execute();

    if ($result) {
        echo 'User registered successfully!';
    } else {
        echo 'Error registering user: ' . $conn->error;
    }
}
?>

<!-- Output the HTML form -->
<html>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
</body>
</html>
