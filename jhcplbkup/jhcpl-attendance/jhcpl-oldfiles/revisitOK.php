<?php
require_once 'conn.php';

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
 
  $sql = "SELECT id, name, unit_no, age, sex, mobile, diagnosis, date, cc, hpi, pmh, obg, exam, treatment, medicines, lab, notes FROM visits WHERE unit_no = '$unit_no' ORDER BY id ASC";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    
    echo "<h2>Unit No: $unit_no Personal Information.</h2>
    <table>
    <tr>
      <th>Visit ID:</th>
      <th>Name</th>
      <th>Unit No</th>
      <th>Age</th>
      <th>Sex</th>
      <th>Mobile</th>
      <th>Diagnosis</th>
      <th>Date</th>
    </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr>
      <td><a href='details.php?id=".$row["id"]."'>".$row["id"]."</a></td>
      <td>".$row["name"]."</td>
      <td>".$row["unit_no"]."</td>
      <td>".$row["age"]."</td>
      <td>".$row["sex"]."</td>
      <td>".$row["mobile"]."</td>
      <td>".$row["diagnosis"]."</td>
      <td>".$row["date"]."</td>
      </tr>";
    }
    echo "</table>";

    echo "<h2>Add Revisit Consultation for unit_no: $unit_no </h2>
  
    <table class='table'> <form method='post' action=''>
         
        <label for='unit_no'>Unit No:</label><br>
        <input type='text' id='unit_no' name='unit_no' value='$unit_no' readonly><br>
        <label for='age'>Name:</label><br>
        <input type='text' id='name' name='name'><br>
        <label for='age'>Age:</label><br>
        <input type='text' id='age' name='age'><br>
        <label for='sex'>Sex:</label><br>
        <input type='text' id='sex' name='sex'><br>
        <label for='sex'>Mobile:</label><br>
        <input type='text' id='mobile' name='mobile'><br>
        <label for='diagnosis'>Diagnosis:</label><br>
        <input type='text' id='diagnosis' name='diagnosis'><br>
        <label for='date'>Date:</label><br>
        <input type='date' id='date' name='date'><br>
        <input type='submit' name='add' value='Add Revisit'>
    </form></table>";
  }
}

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
