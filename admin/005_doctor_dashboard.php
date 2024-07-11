<?php
require_once 'session_doctor.php';
require 'header-jhcpl-doctor.php';
?>

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
<body style='margin: 50px;'>

<?php
require_once 'conn.php';

// Fetch the logged-in doctor's ID from the session
$doctor_id = $_SESSION['doctor_id'];

// Fetch all unit_no from the user_info table assigned to the logged-in doctor
$sql = "SELECT DISTINCT unit_no FROM visits WHERE doctor_id = '$doctor_id' ORDER BY unit_no DESC";
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
        <input type='submit' name='submit' value='Fetch Record.' />
        </form>";
} else {
  echo "No unit_no found";
}

// If form is submitted, fetch records for the selected unit_no
if (isset($_POST['submit'])) {
  $unit_no = $_POST['unit_no_name'];
  $sql = "SELECT id, name, unit_no, age, sex, doctor_fname, doctor_lname, mobile, diagnosis, visit_date, cc, hpi, pmh, obg, exam, treatment, medicines, lab, notes 
          FROM visits 
          WHERE unit_no = '$unit_no' AND doctor_id = '$doctor_id' 
          ORDER BY id ASC";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "<h2>Unit No: $unit_no Personal Information.</h2>
    <table>
    <tr>
      <th>Visit ID:</th>
      <th>Name</th>
      <th>Unit No</th>
      <th>Age</th>
      <th>Doctor</th>
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
      <td>".$row["doctor_fname"]." ".$row["doctor_lname"]."</td>
      <td>".$row["sex"]."</td>
      <td>".$row["mobile"]."</td>
      <td>".$row["diagnosis"]."</td>
      <td>".$row["visit_date"]."</td>
      </tr>";
    }
    echo "</table>";

    echo "<h2>Medical Information</h2>";
    // output data of each row
    $result->data_seek(0); // reset data pointer
    while($row = $result->fetch_assoc()) {
      echo "<style>
      th {
          text-align: left;
          width: 200px; /* Adjust as needed */
      }
      td {
          text-align: left;
          padding-left: 0.3cm; /* Adjust as needed */
      }
  </style>
      <table>
        
      <tr><th>Visit ID No:</th><td>".$row["id"].", <b>Visit Date</b> ".$row["visit_date"]."</td></tr>
        <tr><th>Chief Complaint</th><td>".$row["cc"]."</td></tr>
        <tr><th>History Of Present Illness</th><td>".$row["hpi"]."</td></tr>
        <tr><th>Past Medical History</th><td>".$row["pmh"]."</td></tr>
        <tr><th>Obstetrics & Gyne</th><td>".$row["obg"]."</td></tr>
        <tr><th>Examination</th><td>".$row["exam"]."</td></tr>
        <tr><th>Treatment</th><td>".$row["treatment"]."</td></tr>
        <tr><th>Medicines</th><td>".$row["medicines"]."</td></tr>
        <tr><th>Laboratory</th><td>".$row["lab"]."</td></tr>
        <tr><th>Notes</th><td>".$row["notes"]."</td></tr>
        <tr><td colspan='2'>&nbsp;</td></tr> <!-- This is the empty row -->
        </align>
      </table>";
    }
  } else {
    echo "No records found for unit_no: $unit_no";
  }
}

$conn->close();
?>

</body>
</html>
