

<!DOCTYPE html>
<html>
<body>
<form method="POST">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>
    <input type="submit" value="Login">
</form>
<?php if (isset($error)): ?>
<p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>
</body>
</html>
