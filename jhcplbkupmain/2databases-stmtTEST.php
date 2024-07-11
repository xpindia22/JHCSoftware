<?php
require 'css/style.css';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database credentials for WAMP server
    require_once 'conn_local.php';
    require 'css/style.css';
    // Capture the output of print_r
    $output = print_r($_POST, true);
    
    // Append the output to a text file
    file_put_contents('output.txt', $output, FILE_APPEND);


    // Prepare and bind for local db
    $stmt_local = $conn_local->prepare("INSERT INTO user_info (name) VALUES (:name)");
    $stmt_local->bindParam(':name', $name);
;

    // Set parameters and execute
    $name = $_POST['name'];

    if ($stmt_local->execute()){
      echo "New record of $name created successfully in Local database.<br>";
    }
  }
?>

<!DOCTYPE html>
<html><body class= 'body-margin50px '>
<h2>Enter User Info</h2>
<div class='div-bglightblue'>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  
  <br>
  <tr><td><label for ='name'>Name:</label> <input type="text" name="name" id='name'></td></tr>
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
</tr>
 
  <input type="submit">
</form></div>
</body></html>
