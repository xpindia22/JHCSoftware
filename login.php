<?php
// login.php
session_start();

// Authenticate user credentials
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Replace with your own authentication logic
    if ($username == 'xxx' && $password == 'xxx') {
        // Set session variable to indicate user is logged in
        $_SESSION['logged_in'] = true;
        // Redirect to protected area
        header('Location: register.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!-- Login form -->
<form action="login.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Login">
</form>

<?php if (isset($error)) { echo $error; } ?>