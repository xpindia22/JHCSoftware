<?php
require_once 'conn.php';

$unit_no = ''; // Define $unit_no here
$name = ''; // Define $name here
$age = ''; // Define $age here
$sex = ''; // Define $sex here
$mobile = ''; // Define $mobile here

// Fetch all unit_no from the user_info table
$sql = "SELECT DISTINCT unit_no  FROM user_info ORDER BY unit_no DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<form method='post' action=''>
  <select name='unit_no'>
  <option value=''>Select unit_no</option>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<option value='".$row["unit_no"]."'>".$row["unit_no"]."</option>";
  }
  echo "</select>
  <input type='submit' name='submit' value='Fetch Records' />
  </form>";
} else {
  echo "No unit_no found";
}

// If form is submitted, fetch records for the selected unit_no
if (isset($_POST['submit'])) {
  $unit_no = $_POST['unit_no'];
 
  // Fetch user info for the selected unit_no
  $sql = "SELECT name, age, sex, mobile FROM users_info WHERE unit_no = '$unit_no'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $user_info = $result->fetch_assoc();
    $name = $user_info['name'];
    $age = $user_info['age'];
    $sex = $user_info['sex'];
    $mobile = $user_info['mobile'];
  } else {
    echo "No user info found for unit_no: $unit_no";
  }
}

// Display the "Add Revisit Consultation" form regardless of previous visits
echo "<h2>Add Revisit Consultation for unit_no: $unit_no </h2>
  
<table class='table'> <form method='post' action=''>
     
    <label for='unit_no'>Unit No:</label><br>
    <input type='text' id='unit_no' name='unit_no' value='$unit_no' readonly><br>
    <label for='name'>Name:</label><br>
    <input type='text' id='name' name='name' value='$name'><br>
    <label for='age'>Age:</label><br>
    <input type='text' id='age' name='age' value='$age'><br>
    <label for='sex'>Sex:</label><br>
    <input type='text' id='sex' name='sex' value='$sex'><br>
    <label for='mobile'>Mobile:</label><br>
    <input type='text' id='mobile' name='mobile' value='$mobile'><br>
    <label for='diagnosis'>Diagnosis:</label><br>
    <input type='text' id='diagnosis' name='diagnosis'><br>
    <label for='date'>Date:</label><br>
    <input type='date' id='date' name='date'><br>
    <input type='submit' name='add' value='Add Revisit'>
</form></table>";

if (isset($_POST['add'])) {
    
    $unit_no = $_POST['unit_no'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $mobile = $_POST['mobile'];
    $diagnosis = $_POST['diagnosis'];
    $date = $_POST['date'];
    
    $sql = "INSERT INTO visits (name, unit_no, age, sex, mobile, diagnosis, date) VALUES ('$name', '$unit_no', '$age', '$sex', '$mobile', '$diagnosis', '$date')";
    if ($conn->query($sql) === TRUE) {
        echo "Revisit Consultation Record Of Unit No: $unit_no On $date created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

</body>
</html>
