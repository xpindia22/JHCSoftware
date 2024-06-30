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

textarea {
  width: 70%;
  height: 100px;
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

// Fetch the id from the URL
$id = $_GET['id'];

// If update button is clicked, update the record in the database
if (isset($_POST['update'])) {
  $cc = $_POST['cc'];
  $hpi = $_POST['hpi'];
  $pmh = $_POST['pmh'];
  $obg = $_POST['obg'];
  $exam = $_POST['exam'];
  $diagnosis = $_POST['diagnosis'];
  $treatment = $_POST['treatment'];
  $medicines = $_POST['medicines'];
  $lab = $_POST['lab'];
  $notes = $_POST['notes'];
  

  $sql = "UPDATE visits SET cc='$cc', hpi='$hpi', pmh='$pmh', obg='$obg', exam='$exam', diagnosis='$diagnosis', treatment='$treatment', medicines='$medicines', lab='$lab',notes='$notes' WHERE id=$id";
  if ($conn->query($sql) === TRUE) {
    echo "Record No: $id updated Successfully";
    header('location: visitsAddEdit.php?id=$id');
  } else {
    echo "Error updating record: " . $conn->connect_error;
  }
}

// Fetch the record for the specified id
$sql = "SELECT id, name, unit_no, age, sex, diagnosis, date, cc, hpi, pmh, obg, exam, treatment, medicines, lab, notes FROM visits WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
  echo "<h2>Personal Information</h2>
  <form method='post' action=''>
  <table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Unit No</th>
    <th>Age</th>
    <th>Sex</th>
    <th>Date</th>
  </tr>
  <tr>
    
    <td>".$row["id"]."</td>
    <td>".$row["name"]."</td>
    <td>".$row["unit_no"]."</td>
    <td>".$row["age"]."</td>
    <td>".$row["sex"]."</td>
    <td>".$row["date"]."</td>
 
  </tr>
  </table>";

  echo "<h2>Medical Information</h2>
  <table>
  <tr><th>CC</th><td><textarea name='cc'>".$row["cc"]."</textarea></td></tr>
  <tr><td colspan='2'> </td></tr>
  <tr><th>HPI</th><td><textarea name='hpi'>".$row["hpi"]."</textarea></td></tr>
  <tr><td colspan='2'> </td></tr>
  <tr><th>PMH</th><td><textarea name='pmh'>".$row["pmh"]."</textarea></td></tr>
  <tr><td colspan='2'> </td></tr>
  <tr><th>OBG</th><td><textarea name='obg'>".$row["obg"]."</textarea></td></tr>
  <tr><td colspan='2'> </td></tr>
  <tr><th>Exam</th><td><textarea name='exam'>".$row["exam"]."</textarea></td></tr>
  <tr><td colspan='2'> </td></tr>
  <tr><th>Diagnosis</th><td><textarea name='diagnosis'>".$row["diagnosis"]."</textarea></td></tr>
  <tr><td colspan='2'> </td></tr>
  <tr><th>Treatment</th><td><textarea name='treatment'>".$row["treatment"]."</textarea></td></tr>
  <tr><td colspan='2'> </td></tr>
  <tr><th>Medicines</th><td><textarea name='medicines'>".$row["medicines"]."</textarea></td></tr>
  <tr><td colspan='2'> </td></tr>
  <tr><th>Lab</th><td><textarea name='lab'>".$row["lab"]."</textarea></td></tr>
  <tr><td colspan='2'> </td></tr>
  <tr><th>Notes</th><td><textarea name='notes'>".$row["notes"]."</textarea></td></tr>
  </table>
  <input type='submit' name='update' value='Update Record'>
  </form>";
} else {
  echo "No records found for id: $id";
}

$conn->close();
?>

</body>
</html>
