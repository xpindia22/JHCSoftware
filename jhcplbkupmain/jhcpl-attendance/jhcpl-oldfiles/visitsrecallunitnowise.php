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
    echo "<table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Unit No</th>
      <th>Age</th>
      <th>Sex</th>
      <th>Diagnosis</th>
      <th>Date</th>
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
    while($row = $result->fetch_assoc()) {
      echo "<tr>
      <td>".$row["id"]."</td>
      <td>".$row["name"]."</td>
      <td>".$row["unit_no"]."</td>
      <td>".$row["age"]."</td>
      <td>".$row["sex"]."</td>
      <td>".$row["diagnosis"]."</td>
      <td>".$row["date"]."</td>
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
  }
}

$conn->close();
?>

</body>
</html>
