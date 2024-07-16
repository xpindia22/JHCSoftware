<?php
include('conn.php');
if(isset($_POST['submit'])){
    $username = $_POST['user'];
    $password = $_POST['pass'];


    $sql = "select * from users where username = '$username'and password = '$password'"; 
    $result = mysqli_query($conn, $sql); 
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);  
     if($count==1){
        header("Location:welcome.php");
     }
     else{
        echo`<script>
        window.location.href = "index.php";
        alert("LOgin failed");
        </script>`;
     }
}
?>
<?php
  include("conn.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    <div id="form">
        <h1>Login Form</h1>
        <form name="form"action="" method="POST">
            <label>Username: </label>
            <input type="text" id="user" name="user">
            <br>
            <br>
            <label>Password</label>
            <input type="password" id="pass" name="pass">
<br>
<br>

            <input type="submit" id="btn" value="login" name="submit"/>
</form>
</div>

</body>
</html>
