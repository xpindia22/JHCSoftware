<!DOCTYPE html>
<html>
<head>
<style>
table {
  border-collapse: collapse;
  width: 100%;
  text-align: left;
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
require_once 'conn.php'; // connect to the database.

// Fetch the id from the URL
$id = $_GET['id'];

// Fetch the mobile number from the attendance table
$sql_mobile = "SELECT mobile FROM attendance WHERE id = $id";
$result_mobile = $conn->query($sql_mobile);

if ($result_mobile->num_rows > 0) {
  $row_mobile = $result_mobile->fetch_assoc();
  $mobile = $row_mobile['mobile'];
} else {
  echo "";
}

// If update button is clicked, update the record in the database
if (isset($_POST['update'])) {
  $leaves_allowed = $_POST['leaves_allowed'];
  $leaves_taken = $_POST['leaves_taken'];
  $deductions = $_POST['deductions'];
  $salary_final = $_POST['salary_final'];
  $notes = $_POST['notes'];

  $sql = "UPDATE attendance_record SET leaves_allowed='$leaves_allowed', leaves_taken='$leaves_taken', deductions='$deductions',salary_final='$salary_final', notes='$notes', mobile='$mobile' WHERE id=$id";
  if ($conn->query($sql) === TRUE) {
    echo "Record No: $id updated Successfully";
    // After successful update, redirect to the same page with the ID
  header('Location: ' . $_SERVER['PHP_SELF'] . '?id=' . $id);
  exit();

  } else {
    echo "Error updating record: " . $conn->connect_error;
  }
}

// Fetch the record for the specified id
$sql = "SELECT id, name, unit_no, age, sex, mobile, designation, date, leaves_allowed, leaves_taken, deductions,salary_final, notes FROM attendance_record WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
  echo "<h2>Employee Information</h2>
  <form method='post' action=''>
  <table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Unit No</th>
    <th>Age</th>
    <th>Sex</th>
    </tr>
        <tr>
    <td>".$row["id"]."</td>
    <td>".$row["name"]."</td>
    <td>".$row["unit_no"]."</td>
    <td>".$row["age"]."</td>
    <td>".$row["sex"]."</td>></tr>

    </tr>
    <tr>
    <th>Mobile</th>
    <th>Date</th>
    <th>Leaves Allowed</th>
    <th>Leaves Taken</th>
  </tr>
  <tr>
    <td>".$row["mobile"]."</td>
    <td>".$row["date"]."</td>
    <td>".$row["leaves_allowed"]."</td>
    <td>".$row["leaves_taken"]."</td>
  </tr>
  </table>";

  echo "<h2>Attendance and Leave Record</h2>
  <table>
  <tr><th>Leaves Allowed</th><td><textarea name='leaves_allowed'>".$row["leaves_allowed"]."</textarea></td></tr>
  <tr><td colspan='2'> </td></tr>
  <tr><th>Leaves Taken</th><td><textarea name='leaves_taken'>".$row["leaves_taken"]."</textarea></td></tr>
  <tr><td colspan='2'> </td></tr>
  <tr><th>Deductions</th><td><textarea name='deductions'>".$row["deductions"]."</textarea></td></tr>
  <tr><td colspan='2'> </td></tr>
  <tr><th>Salary Final</th><td><textarea name='salary_final'>".$row["salary_final"]."</textarea></td></tr>
  <tr><td colspan='2'> </td></tr>
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
