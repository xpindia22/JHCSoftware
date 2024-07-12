<?php
require_once 'session_doctor.php';
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
require_once '../config/conn.php'; // connect to the database.
// Get the current doctor's ID from the session
$doctor_username = $_SESSION['doctor_username'];
$sql = "SELECT doctor_id FROM doctors WHERE username = '$doctor_username'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$doctor_id = $row['doctor_id'];

// Fetch all unit_no from the user_info table for the current doctor
$sql = "SELECT DISTINCT ui.unit_no FROM user_info ui INNER JOIN doctors d ON ui.doctor_id = d.doctor_id WHERE d.doctor_id = '$doctor_id' ORDER BY ui.unit_no DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<form method='post' action=''>
        <select name='unit_no_name'>
        <option value=''>Select unit_no</option>";
  while ($row = $result->fetch_assoc()) {
      $unit_no = $row["unit_no"];
      $sql2 = "SELECT ui.name FROM user_info ui INNER JOIN doctors d ON ui.doctor_id = d.doctor_id WHERE ui.unit_no = '$unit_no' AND d.doctor_id = '$doctor_id'";
      $result2 = $conn->query($sql2);
      $name = $result2->fetch_assoc()["name"];
      echo "<option value='$unit_no'>$unit_no - $name</option>";
  }
  echo "</select>
        <input type='submit' name='submit' value='Fetch Record.' />
        </form>";
} else {
  echo "No unit_no found for doctor $doctor_username";
}


// If form is submitted, fetch records for the selected unit_no
if (isset($_POST['submit'])) {
  $unit_no = $_POST['unit_no_name'];
  $sql = "SELECT v.id, v.name, v.unit_no, v.age, v.sex, v.mobile, v.diagnosis, v.date, v.cc, v.hpi, v.pmh, v.obg, v.exam, v.treatment, v.medicines, v.lab, v.notes 
          FROM visits v 
          INNER JOIN user_info ui ON v.unit_no = ui.unit_no 
          INNER JOIN doctors d ON ui.doctor_id = d.doctor_id 
          WHERE v.unit_no = '$unit_no' AND d.doctor_id = '$doctor_id' 
          ORDER BY v.id ASC";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // ... rest of the code ...
  } else {
    echo "No records found for unit_no: $unit_no  <p><br>
     <a href='004_createconsultation.php'>Click Here To Create A New Record or Revist</a>";
  }
}

// ... rest of the code ...

// ... rest of the code ...
if (isset($_POST['add'])) {
    
    $unit_no = $_POST['unit_no'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $mobile = $_POST['mobile'];
    $diagnosis = $_POST['diagnosis'];
    $date = $_POST['date'];
    
    $sql = "INSERT INTO visits (name,unit_no, age, sex, mobile, diagnosis, date) VALUES ('$name','$unit_no', '$age', '$sex','$mobile', '$diagnosis', '$date')";
    if ($conn->query($sql) === TRUE) {
        echo "New Consultation Record Of Unit No: $unit_no On $date created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

</body>
</html>