<?php
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $diagnosis = $_POST['diagnosis'];
    $date = $_POST['date'];
    $notes = $_POST['notes'];

    // Database credentials for WAMP server
    $dbname_local = 'jhcpl';
    $username_local = 'jhcpl';
    $password_local = 'jhcpl';

    // Database credentials for live server
    $dbname_live = 'jameslkh_jhcpl';
    $username_live = 'jameslkh_user_info';
    $password_live = 'c&)WLGHiecg{';

    // Create connection to WAMP server
    $localhost = 'localhost';
    $conn_local = new PDO("mysql:host=$localhost;dbname=$dbname_local", $username_local, $password_local);

    // Create connection to live server
    //$livehost = '69.49.233.70';
    $livehost = 'jhcpl.in';
    $conn_live = new PDO("mysql:host=$livehost;dbname=$dbname_live", $username_live, $password_live);

    // Check connections
    if (!$conn_local || !$conn_live) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // SQL query
    $sql_localhost = "INSERT INTO user_info (name, age, sex, diagnosis, date, notes) VALUES (:name, :age, :sex, :diagnosis, :date, :notes)";
    $sql_live = "INSERT INTO user_info (name, age, sex, diagnosis, date, notes) VALUES (:name, :age, :sex, :diagnosis, :date, :notes)";

    // Prepare statement for local server
    $stmt_local = $conn_local->prepare($sql_localhost);

    // Bind parameters for local server
    $stmt_local->bindParam(':name', $name);
    $stmt_local->bindParam(':age', $age);
    $stmt_local->bindParam(':sex', $sex);
    $stmt_local->bindParam(':diagnosis', $diagnosis);
    $stmt_local->bindParam(':date', $date);
    $stmt_local->bindParam(':notes', $notes);

    // Execute query on local server
    $stmt_local->execute();

    // Prepare statement for live server
    $stmt_live = $conn_live->prepare($sql_live);

    // Bind parameters for live server
    $stmt_live->bindParam(':name', $name);
    $stmt_live->bindParam(':age', $age);
    $stmt_live->bindParam(':sex', $sex);
    $stmt_live->bindParam(':diagnosis', $diagnosis);
    $stmt_live->bindParam(':date', $date);
    $stmt_live->bindParam(':notes', $notes);

    // Execute query on live server
    $stmt_live->execute();

    echo "New records created successfully in both databases.";
}

?>

<!DOCTYPE html>
<html>
<body>

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

</body>
</html>
