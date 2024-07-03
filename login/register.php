<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];

    if ($pwd1 == $pwd2) {
        $hashedpwd = password_hash($pwd1, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (name, email, mobile, pwd1, pwd2, hashedpwd) VALUES ('$name', '$email', '$mobile', '$pwd1', '$pwd2', '$hashedpwd')";
        $result = $conn->query($query);

        if ($result) {
            echo "User registered successfully!";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    } else {
        echo "Passwords do not match!";
    }
}
?>

<!-- HTML form for user registration -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    <label for="mobile">Mobile:</label>
    <input type="tel" id="mobile" name="mobile" required><br><br>
    <label for="pwd1">Password:</label>
    <input type="password" id="pwd1" name="pwd1" required><br><br>
    <label for="pwd2">Confirm Password:</label>
    <input type="password" id="pwd2" name="pwd2" required><br><br>
    <input type="submit" value="Register">
</form>