<!DOCTYPE html>
<html>
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
}

tr:nth-child(even) {
  background-color: #ddd; /* darker gray for every other row */
}
</style>
</head>
<body>

<?php
$servername = "localhost";
$username = "jhcpl";
$password = "jhcpl";
$dbname = "jhcpl";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch all unit_no from the visits table
$sql = "SELECT DISTINCT unit_no FROM user_info ORDER BY unit_no ASC";
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
  $sql = "SELECT id, name, unit_no, age, sex, diagnosis, date, cc, hpi, pmh, obg, exam, treatment, medicines, lab, notes FROM visits WHERE unit_no = '$unit_no' ORDER BY id ASC";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "<h2>Personal Information</h2>
    <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Unit No</th>
      <th>Age</th>
      <th>Sex</th>
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
      <td>".$row["diagnosis"]."</td>
      <td>".$row["date"]."</td>
      </tr>";
    }
    echo "</table>";

    echo "<h2>Medical Information</h2>
    <table>
    <tr>
      <th>CC</th>
      <th>HPI</th>
      <th>PMH</th>
      <th>OBG</th>
      <th>Exam</th>
      <th>Treatment</th>
      <th>Medicines</th>
      <th>Lab</th>
      <th>Notes</th>
    </tr>";
    // output data of each row
    $result->data_seek(0); // reset data pointer
    while($row = $result->fetch_assoc()) {
      echo "<tr>
      <td>".$row["cc"]."</td>
      <td>".$row["hpi"]."</td>
      <td>".$row["pmh"]."</td>
      <td>".$row["obg"]."</td>
      <td>".$row["exam"]."</td>
      <td>".$row["treatment"]."</td>
      <td>".$row["medicines"]."</td>
      <td>".$row["lab"]."</td>
      <td>".$row["notes"]."</td>
      </tr>";
    }
    echo "</table>";
  } else {
    echo "No records found for unit_no: $unit_no";
    echo "<h2>Add New Record</h2>
    <form method='post' action=''>
        <label for='name'>Name:</label><br>
        <input type='text' id='name' name='name'><br>
        <label for='unit_no'>Unit No:</label><br>
        <input type='text' id='unit_no' name='unit_no'><br>
        <label for='age'>Age:</label><br>
        <input type='text' id='age' name='age'><br>
        <label for='sex'>Sex:</label><br>
        <input type='text' id='sex' name='sex'><br>
        <label for='diagnosis'>Diagnosis:</label><br>
        <input type='text' id='diagnosis' name='diagnosis'><br>
        <label for='date'>Date:</label><br>
        <input type='date' id='date' name='date'><br>
        <input type='submit' name='add' value='Add Record'>
    </form>";
  }
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $unit_no = $_POST['unit_no'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $diagnosis = $_POST['diagnosis'];
    $date = $_POST['date'];

    $sql = "INSERT INTO visits (name, unit_no, age, sex, diagnosis, date) VALUES ('$name', '$unit_no', '$age', '$sex', '$diagnosis', '$date')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

</body>
</html>