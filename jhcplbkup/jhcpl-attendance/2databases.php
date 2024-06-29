<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $diagnosis = $_POST['diagnosis'];
    $date = $_POST['date'];
    $notes = $_POST['notes']; 

    // Database credentials for WAMP server
    require_once 'conn_local.php';
    require_once 'conn_live.php';
    require 'css/style.css';
    // SQL query for loacl db
    $sql_localhost = "INSERT INTO user_info (name, age, sex, diagnosis, date, notes) VALUES ('$name', '$age', '$sex', '$diagnosis', '$date', '$notes')";
    
    if ($conn_local->query($sql_localhost)){
      echo "New records created successfully in Local database.<br>";
    }
  
    // SQL query for remote server
    $sql_live = "INSERT INTO user_info (name, age, sex, diagnosis, date, notes) VALUES ('$name', '$age', '$sex', '$diagnosis', '$date', '$notes')";

    if ($conn_live->query($sql_live)){
      echo "New records created successfully in Live database.";
    }
  }
?>

<!DOCTYPE html>
<html><body>
<h2 class='text-green bg-black'>Enter User Info</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  
  <br>
  Name: <input type="text" name="name">
  <br>
  Age: <input type="text" name="age">
  <br>
  Sex: <input type="text" name="sex">
  <br>
  Diagnosis: <input type="text" name="diagnosis">
  <br>
  Date: <input type="date" name="date">
  <br>
  Notes: <textarea name="notes"></textarea>
  <br>
 
  <input type="submit">
</form>


</body></html>