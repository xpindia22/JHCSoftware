<?php
include('conn.php');

if (isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        // Start a session
        session_start();

        // Set a session variable
        $_SESSION['username'] = $username;

        // Set a cookie with the username (example: valid for 1 day)
        setcookie('user_cookie', $username, time() + (86400 * 1), "/");

        // Redirect to welcome.php
        header("Location: dashboard.php");
        exit();
    } else {
        echo '<script>
                alert("Login failed");
                window.location.href = "index.php";
              </script>';
    }
}
?>
