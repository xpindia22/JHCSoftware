<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database credentials for WAMP server
    require_once 'conn_local.php';
    require_once 'conn_live.php';
    // print_r($_POST);

    
    
    // Capture the output of print_r
    $output = print_r($_POST, true);
    
    // Append the output to a text file
    file_put_contents('output.txt', $output, FILE_APPEND);




    // Prepare and bind for local db
    $stmt_local = $conn_local->prepare("INSERT INTO user_info (name, age, sex, diagnosis, date, notes) VALUES (:name, :age, :sex, :diagnosis, :date, :notes)");
    $stmt_local->bindParam(':name', $name);
    $stmt_local->bindParam(':age', $age);
    $stmt_local->bindParam(':sex', $sex);
    $stmt_local->bindParam(':diagnosis', $diagnosis);
    $stmt_local->bindParam(':date', $date);
    $stmt_local->bindParam(':notes', $notes);

    // Prepare and bind for remote server
    $stmt_live = $conn_live->prepare("INSERT INTO user_info (name, age, sex, diagnosis, date, notes) VALUES (:name, :age, :sex, :diagnosis, :date, :notes)");
    $stmt_live->bindParam(':name', $name);
    $stmt_live->bindParam(':age', $age);
    $stmt_live->bindParam(':sex', $sex);
    $stmt_live->bindParam(':diagnosis', $diagnosis);
    $stmt_live->bindParam(':date', $date);
    $stmt_live->bindParam(':notes', $notes);

    // Set parameters and execute
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $diagnosis = $_POST['diagnosis'];
    $date = $_POST['date'];
    $notes = $_POST['notes'];

    if ($stmt_local->execute()){
      echo "New record of $name created successfully in Local database.<br>";
    }

    if ($stmt_live->execute()){
      echo "New record of $name created successfully in Live database.";
    }
  }
?>

<!DOCTYPE html>
<html><body>
<h2>Enter User Info</h2>
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
