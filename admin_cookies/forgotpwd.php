<?php
require_once 'conn.php';
<<<<<<< HEAD
=======
require_once 'session_user.php'; // Include session check
>>>>>>> work

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $sql = "SELECT userid, email FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $reset_token = bin2hex(random_bytes(16));
        
        // Store the token in the database (You might need to create a new column for this)
        $sql = "UPDATE users SET reset_token = '$reset_token' WHERE email = '$email'";
        $conn->query($sql);

        $reset_link = "http://yourwebsite.com/reset_password.php?token=$reset_token";

        // Send email with the reset link (assuming mail configuration is set up)
        mail($email, "Password Reset", "Click the following link to reset your password: $reset_link");

        echo "A password reset link has been sent to your email.";
    } else {
        echo "No user found with that email address.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
