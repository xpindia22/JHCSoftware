<?php
$host = "localhost";
$db = "jhcpl";
$user = "jhcpl";
$pass = "jhcpl";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $staff_id = $_POST["staff_id"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM attendance WHERE staff_id = '$staff_id' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "staff_id: " . $row["staff_id"]. " Name: " . $row["name"]. " " . $row["salary"]. "<br>";
        }
    } else {
        echo "0 results";
    }
    
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $staff_id = $_POST["staff_id"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM attendance WHERE staff_id = '$staff_id' AND password = '$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          // Check if the staff is absent
          if ($row["attendance"] == "absent") {
              // Deduct 500 from the salary
              $new_salary = $row["salary"] - 500;

              // Update the salary in the database
              $sql_update = "UPDATE attendance SET salary = '$new_salary' WHERE staff_id = '$staff_id'";
              if ($conn->query($sql_update) === TRUE) {
                  echo "Record updated successfully";
              } else {
                  echo "Error updating record: " . $conn->error;
              }
          }

          echo "staff_id: " . $row["staff_id"]. " - Name: " . $row["name"]. " " . $row["salary"]. "<br>";
      }
  } else {
      echo "0 results";
  }
  $conn->close();
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Attendance Form</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Staff ID: <input type="text" name="staff_id">
  <br>
  Password: <input type="password" name="password">
  <br>
  <input type="submit">
</form>

</body>
</html>
