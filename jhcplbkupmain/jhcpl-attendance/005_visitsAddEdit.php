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

// Fetch all unit_no from the attendance table
$sql = "SELECT DISTINCT unit_no  FROM attendance ORDER BY unit_no DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<form method='post' action=''>
        <select name='unit_no_name'>
        <option value=''>Select unit_no</option>";
  while ($row = $result->fetch_assoc()) {
      $unit_no = $row["unit_no"];
      $sql2 = "SELECT name FROM attendance WHERE unit_no = '$unit_no'";
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
 
  $sql = "SELECT id, name, unit_no, age, sex, mobile, designation, date, salary, leaves_allowed, leaves_taken,deductions,salary_final, notes FROM attendance_record WHERE unit_no = '$unit_no' ORDER BY id ASC";
  $result = $conn->query($sql);


  if ($result->num_rows > 0) {
    echo "<h2>Unit No: $unit_no Personal Information.</h2>
    <table>
    <tr>
      <th>Record Entry No:</th>
      <th>Name</th>
      <th>Unit No</th>
      <th>Age</th>
      <th>Sex</th>
      <th>Mobile</th>
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
      </tr>";
    }
    echo "</table>";
    
    echo "<br>"; // break line
    
    echo "<table>
    <tr>
      <th>Designation</th>
      <th>Date</th>
      <th>Salary</th>
      <th>Leaves Taken</th>
      <th>Salary Final</th>
    </tr>";
    // output data of each row
    mysqli_data_seek($result, 0); // reset data pointer
    while($row = $result->fetch_assoc()) {
      echo "<tr>
      <td>".$row["designation"]."</td>
      <td>".$row["date"]."</td>
      <td>".$row["salary"]."</td>
      <td>".$row["leaves_taken"]."</td>
      <td>".$row["salary_final"]."</td>
      </tr>";
    }
    echo "</table>";
  } else {
    echo "No unit_no found";
  }

    echo "<h2>Leave And Salary Record</h2>";
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
        <tr><th>Record Entry No:</th><td>".$row["id"].", <b>Entry Date</b> ".$row["date"]."</td></tr>
        <tr><th>Name</th><td>".$row["name"]."</td></tr>
        <tr><th>Salary</th><td>".$row["salary"]."</td></tr>
        <tr><th>Leaves Allowed</th><td>".$row["leaves_allowed"]."</td></tr>
        <tr><th>Leaves Taken</th><td>".$row["leaves_taken"]."</td></tr>
        <tr><th>Deductions</th><td>".$row["deductions"]."</td></tr>
        <tr><th>Salary Final</th><td>".$row["salary_final"]."</td></tr>
        <tr><th>Notes</th><td>".$row["notes"]."</td></tr>
        <tr><td colspan='2'>&nbsp;</td></tr> <!-- This is the empty row -->
        </align>

      </table>";
    }
    
  } else {
    
     echo "No records found for unit_no: $unit_no  <p><br>
     <a href='004_new-revisit.php'>Click Here To Create A New Record or Revist</a>";
   }


if (isset($_POST['add'])) {
    
    $unit_no = $_POST['unit_no'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $mobile = $_POST['mobile'];
    $designation = $_POST['designation'];
    $date = $_POST['date'];
    $leaves_allowed = $_POST['leaves_allowed'];
    $leaves_taken = $_POST['leaves_taken'];
    $salary_final = $_POST['salary_final'];
    $sql = "INSERT INTO attendance_record (name,unit_no, age, sex, mobile, designation, date, leaves_allowed,leaves_taken) VALUES ('$name','$unit_no', '$age', '$sex','$mobile', '$designation', '$date','$leaves_allowed','$leaves_taken','$salary_final')";
    if ($conn->query($sql) === TRUE) {
        echo "New Employee Record Of Unit No: $unit_no On $date created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

</body>
</html>