<!DOCTYPE html>
<html lang="en">
<head>
<style>
table {
  border-collapse: collapse;
  width: 100%;
  background-color: #f2f2f2; /* light gray */
}

th, td {
  border: 1px solid #ddd; /* light gray */
  padding: 8px;
  background-color: #add8e6; /* light blue */
}

tr:nth-child(even) {
  background-color: #ddd; /* darker gray for every other row */
}
.body-class{
            margin: 50px;
        }
</style>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body class='body-class'>

<?php
require 'header-jhcpl.php';
require_once 'conn.php';

$unit_no = ''; // Define $unit_no here
$name = ''; // Define $name here
$age = ''; // Define $age here
$sex = ''; // Define $sex here
$mobile = ''; // Define $mobile here
$diagnosis = ''; // Define $diagnosis here

// Fetch all unit_no from the user_info table
$sql = "SELECT DISTINCT unit_no  FROM user_info ORDER BY unit_no DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<form method='post' action=''>
        <select name='unit_no_name'>
        <option value=''>Select unit_no</option>";
  while ($row = $result->fetch_assoc()) {
      $unit_no = $row["unit_no"];
      $sql2 = "SELECT name FROM user_info WHERE unit_no = '$unit_no'";
      $result2 = $conn->query($sql2);
      $name = $result2->fetch_assoc()["name"];
      echo "<option value='$unit_no'>$unit_no - $name</option>";
  }
  echo "</select>
        <input type='submit' name='submit' value='Fetch Employee Records' />
        </form>";
} else {
  echo "No unit_no found";
}


 
// If form is submitted, fetch records for the selected unit_no
if (isset($_POST['submit'])) {
  $unit_no = $_POST['unit_no_name'];
 
  // Fetch user info for the selected unit_no
  $sql = "SELECT name, age, sex, mobile, diagnosis FROM user_info WHERE unit_no = '$unit_no'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $user_info = $result->fetch_assoc();
    $name = $user_info['name'];
    $age = $user_info['age'];
    $sex = $user_info['sex'];
    $mobile = $user_info['mobile'];
    $diagnosis = $user_info['diagnosis'];
  } else {
    echo "No user info found for unit_no: $unit_no";
  }
}

// Display the "Add Revisit Consultation" form regardless of previous visits
echo "<h2>Add Revisit Consultation for unit_no: $unit_no </h2>
  
<table class='table'> <form method='post' action=''>
    <tr>
      <th><label for='unit_no'>Unit No:</label></th>
      <td><input type='text' id='unit_no' name='unit_no' value='$unit_no' readonly></td>
    </tr>
    <tr>
      <th><label for='name'>Name:</label></th>
      <td><input type='text' id='name' name='name' value='$name'></td>
    </tr>
    <tr>
      <th><label for='age'>Age:</label></th>
      <td><input type='text' id='age' name='age' value='$age'></td>
    </tr>
    <tr>
      <th><label for='sex'>Sex:</label></th>
      <td><input type='text' id='sex' name='sex' value='$sex'></td>
    </tr>
    <tr>
      <th><label for='mobile'>Mobile:</label></th>
      <td><input type='text' id='mobile' name='mobile' value='$mobile'></td>
    </tr>
    <tr>
      <th><label for='diagnosis'>Diagnosis:</label></th>
      <td><input type='text' id='diagnosis' name='diagnosis' value='$diagnosis'></td>
    </tr>
    <tr>
      <th><label for='date'>Date:</label></th>
      <td><input type='date' id='date' name='date'></td>
    </tr>
    <tr>
      <td colspan='2'><input type='submit' name='add' value='Create Consultation Visit'></td>
    </tr>
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
       echo "<br>Consultation Of Patient Mr/Ms  $name, Unit No: $unit_no On $date created successfully.</br>";
       //echo "<a href="https://www.example.com">Link text</a> ";
         } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
<a href="005_visitsAddEdit.php"> Click Here To Edit The Record</a>
</body>
</html>
