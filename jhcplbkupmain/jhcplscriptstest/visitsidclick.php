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
$sql = "SELECT DISTINCT unit_no FROM visits ORDER BY unit_no ASC";
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
      <td><input type='text' value='".$row["name"]."' readonly></td>
      <td><input type='text' value='".$row["unit_no"]."' readonly></td>
      <td><input type='text' value='".$row["age"]."'></td>
      <td><input type='text' value='".$row["sex"]."'></td>
      <td><input type='text' value='".$row["diagnosis"]."'></td>
      <td><input type='text' value='".$row["date"]."'></td>
      </tr>";
    }
    echo "</table>";

    echo "<h2>Medical Information</h2>
    <form method='post' action='update.php'>
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
      <td><input type='text' name='cc' value='".$row["cc"]."'></td>
      <td><input type='text' name='hpi' value='".$row["hpi"]."'></td>
      <td><input type='text' name='pmh' value='".$row["pmh"]."'></td>
      <td><input type='text' name='obg' value='".$row["obg"]."'></td>
      <td><input type='text' name='exam' value='".$row["exam"]."'></td>
      <td><input type='text' name='treatment' value='".$row["treatment"]."'></td>
      <td><input type='text' name='medicines' value='".$row["medicines"]."'></td>
      <td><input type='text' name='lab' value='".$row["lab"]."'></td>
      <td><input type='text' name='notes' value='".$row["notes"]."'></td>
      </tr>";
    }
    echo "</table>
    <input type='submit' name='update' value='Update Record'>
    </form>";
  } else {
    echo "No records found for unit_no: $unit_no";
  }
}

$conn->close();
?>

</body>
</html>
