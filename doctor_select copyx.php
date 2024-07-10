<?php
// Enable error reporting to see any PHP errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'session_check.php';
require_once 'conn.php';

// Initialize variables
$unit_no = $name = $age = $sex = $mobile = $diagnosis = "";
$doctor_id = "";

// Handle form submission to fetch patient data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['fetch_patient']) && !empty($_POST['unit_no_name'])) {
        $unit_no = $_POST['unit_no_name'];

        // Fetch user info for the selected unit_no
        $sql = "SELECT name, age, sex, mobile, diagnosis FROM user_info WHERE unit_no = '$unit_no'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user_info = $result->fetch_assoc();
            $name = $user_info['name'];
            $age = $user_info['age'];
            $sex = $user_info['sex'];
            $mobile = $user_info['mobile'];
            $diagnosis = $user_info['diagnosis'];
        } else {
            echo "No user info found for unit_no: $unit_no";
        }
    }

    // Handle form submission to select a doctor for the patient
    if (isset($_POST['select_doctor']) && !empty($_POST['doctor'])) {
        $doctor_id = $_POST['doctor'];
    }
}

// Fetch all unit_no from the user_info table
$sql = "SELECT DISTINCT unit_no FROM user_info ORDER BY unit_no DESC";
$result = $conn->query($sql);

$unit_no_options = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $unit_no_option = $row["unit_no"];
        $selected = ($unit_no == $unit_no_option) ? "selected" : "";
        $unit_no_options .= "<option value='$unit_no_option' $selected>$unit_no_option</option>";
    }
} else {
    echo "No unit_no found";
}

// Display the form to select a patient
echo "<form method='post' action='doctor_select.php'>
    <h2>Select Patient</h2>
    <select name='unit_no_name'>
        <option value=''>Select unit_no</option>
        $unit_no_options
    </select>
    <input type='submit' name='fetch_patient' value='Fetch Patient Records' />
</form>";

// Display the patient's details if selected
if (!empty($name)) {
    echo "<h2>Patient Details</h2>
    <p><strong>Unit No:</strong> $unit_no</p>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Age:</strong> $age</p>
    <p><strong>Sex:</strong> $sex</p>
    <p><strong>Mobile:</strong> $mobile</p>
    <p><strong>Diagnosis:</strong> $diagnosis</p>";

    // Form to select a doctor for the patient
    echo "<form method='post' action='add_visit.php'>
        <input type='hidden' name='unit_no' value='$unit_no'>
        <input type='hidden' name='name' value='$name'>
        <input type='hidden' name='age' value='$age'>
        <input type='hidden' name='sex' value='$sex'>
        <input type='hidden' name='mobile' value='$mobile'>
        <input type='hidden' name='diagnosis' value='$diagnosis'>
        <h2>Select Doctor</h2>
        <select name='doctor'>
            <option value=''>Select Doctor</option>";

    // Fetch all Doctors from the doctors table
    $sql3 = "SELECT doctor_id, fname, lname FROM doctors ORDER BY doctor_id DESC";
    $result3 = $conn->query($sql3);

    if ($result3->num_rows > 0) {
        while ($row = $result3->fetch_assoc()) {
            $doctor_id = $row["doctor_id"];
            $fname = $row["fname"];
            $lname = $row["lname"];
            $selected = ($doctor_id == $doctor_id) ? "selected" : "";
            echo "<option value='$doctor_id' $selected>$fname $lname</option>";
        }
    } else {
        echo "No Doctor found";
    }

    echo "</select>
        <br><br>
        <input type='submit' name='select_doctor' value='Select Doctor' />
    </form>";
}

$conn->close();
?>
