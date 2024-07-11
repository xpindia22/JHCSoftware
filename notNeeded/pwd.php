<?php
require 'css/style.css';
// Set the password
$password = "xxx";

// Check if the password entered by the user matches the set password
if (isset($_POST["password"]) && ($_POST["password"] == $password)) {
    // The password is correct, the user can access the page
    // Your PHP code goes here
} else {
    // The password is incorrect or not entered yet, show the password form
    echo '
    <head>
     
    </head>
    <body class="body-margin50px">
    <div>
<form  method="post">
  <tr><label for="password" class="email-label">Enter Your Email ID:</label></tr>
  <tr><td><input type="password" id="password" name="password"></td></tr>
  <input type="submit" value="Submit">
</form>
    </body></html>
          ';
    exit;
}


?>

