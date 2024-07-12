<?php
require_once '../config/session_check.php';
require_once '../config/conn.php'; // connect to the database.

// Fetch patient details from POST data
$unit_no = $_POST['unit_no'];
$name = $_POST['name'];
$age = $_POST['age'];
$sex = $_POST['sex'];
$mobile = $_POST['mobile'];
$diagnosis = $_POST['diagnosis'];
$date = $_POST['date'];

// Fetch all doctors from the doctors table
$sql = "SELECT doctor_id, fname, lname FROM doctors ORDER BY doctor_id DESC";
$result = $conn->query($sql);

$doctor_options = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $doctor_id = $row["doctor_id"];
        $fname = $row["fname"];
        $lname = $row["lname"];
        $doctor_options .= "<option value='$doctor_id'>$fname $lname</option>";
    }
} else {
    echo "No Doctor found";
}

// Display the form to select a doctor
echo "<h2>Select Doctor for Patient: $name</h2>
<form method='post' action='add_visit.php'>
    <select name='doctor'>
        <option value=''>Select Doctor</option>
        $doctor_options
    </select>
    <input type='hidden' name='unit_no' value='$unit_no'>
    <input type='hidden' name='name' value='$name'>
    <input type='hidden' name='age' value='$age'>
    <input type='hidden' name='sex' value='$sex'>
    <input type='hidden' name='mobile' value='$mobile'>
    <input type='hidden' name='diagnosis' value='$diagnosis'>
    <input type='hidden' name='date' value='$date'>
    <input type='submit' name='assign_doctor' value='Assign Doctor'>
</form>";

$conn->close();
?>
