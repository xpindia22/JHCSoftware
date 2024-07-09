<?php
require_once 'session_check.php';
require_once 'conn.php';

// Initialize variables
$unit_no = $name = $age = $sex = $mobile = $diagnosis = $doctor = "";

// Handle form submissions and retain data
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

    if (isset($_POST['fetch_doctor']) && !empty($_POST['doctor'])) {
        $doctor_id = $_POST['doctor'];

        // Fetch doctor info for the selected doctor_id
        $sql3 = "SELECT fname, lname FROM doctors WHERE doctor_id = '$doctor_id'";
        $result3 = $conn->query($sql3);

        if ($result3->num_rows > 0) {
            $doctors = $result3->fetch_assoc();
            $doctor = $doctors['fname'] . ' ' . $doctors['lname'];
        } else {
            echo "No Doctor found!";
        }
    }
}

// Fetch all unit_no from the user_info table
$sql = "SELECT DISTINCT unit_no FROM user_info ORDER BY unit_no DESC";
$result = $conn->query($sql);

$unit_no_options = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $unit_no_option = $row["unit_no"];
        $sql2 = "SELECT name FROM user_info WHERE unit_no = '$unit_no_option'";
        $result2 = $conn->query($sql2);
        $name_option = $result2->fetch_assoc()["name"];
        $selected = ($unit_no == $unit_no_option) ? "selected" : "";
        $unit_no_options .= "<option value='$unit_no_option' $selected>$unit_no_option - $name_option</option>";
    }
} else {
    echo "No unit_no found";
}

// Fetch all Doctors from the doctors table
$sql3 = "SELECT doctor_id, fname, lname FROM doctors ORDER BY doctor_id DESC";
$result3 = $conn->query($sql3);

$doctor_options = "";
if ($result3->num_rows > 0) {
    while ($row = $result3->fetch_assoc()) {
        $doctor_id = $row["doctor_id"];
        $fname = $row["fname"];
        $lname = $row["lname"];
        $selected = (isset($_POST['doctor']) && $_POST['doctor'] == $doctor_id) ? "selected" : "";
        $doctor_options .= "<option value='$doctor_id' $selected>$fname $lname</option>";
    }
} else {
    echo "No Doctor found";
}

// Display the forms and the "Add Consultation Visit" form
echo "<form method='post' action=''>
    <h2>Select Patient</h2>
    <select name='unit_no_name'>
        <option value=''>Select unit_no</option>
        $unit_no_options
    </select>
    <input type='submit' name='fetch_patient' value='Fetch Patient Records' />
    <br><br>
    <h2>Select Doctor</h2>
    <select name='doctor'>
        <option value=''>Select Doctor</option>
        $doctor_options
    </select>
    <input type='submit' name='fetch_doctor' value='Fetch Doctor' />
    <br><br>
    <input type='hidden' name='hidden_unit_no' value='$unit_no'>
    <input type='hidden' name='hidden_name' value='$name'>
    <input type='hidden' name='hidden_age' value='$age'>
    <input type='hidden' name='hidden_sex' value='$sex'>
    <input type='hidden' name='hidden_mobile' value='$mobile'>
    <input type='hidden' name='hidden_diagnosis' value='$diagnosis'>
    <input type='hidden' name='hidden_doctor' value='$doctor'>
</form>";

if (!empty($unit_no) || !empty($doctor)) {
    echo "<h2>Add Revisit Consultation for unit_no: $unit_no </h2>
    <table class='table'>
        <form method='post' action=''>
            <tr>
                <th><label for='unit_no'>Unit No:</label></th>
                <td><input type='text' id='unit_no' name='unit_no' value='" . ($_POST['hidden_unit_no'] ?? $unit_no) . "' readonly></td>
            </tr>
            <tr>
                <th><label for='name'>Name:</label></th>
                <td><input type='text' id='name' name='name' value='" . ($_POST['hidden_name'] ?? $name) . "'></td>
            </tr>
            <tr>
                <th><label for='age'>Age:</label></th>
                <td><input type='text' id='age' name='age' value='" . ($_POST['hidden_age'] ?? $age) . "'></td>
            </tr>
            <tr>
                <th><label for='sex'>Sex:</label></th>
                <td><input type='text' id='sex' name='sex' value='" . ($_POST['hidden_sex'] ?? $sex) . "'></td>
            </tr>
            <tr>
                <th><label for='mobile'>Mobile:</label></th>
                <td><input type='text' id='mobile' name='mobile' value='" . ($_POST['hidden_mobile'] ?? $mobile) . "'></td>
            </tr>
            <tr>
                <th><label for='diagnosis'>Diagnosis:</label></th>
                <td><input type='text' id='diagnosis' name='diagnosis' value='" . ($_POST['hidden_diagnosis'] ?? $diagnosis) . "'></td>
            </tr>
            <tr>
                <th><label for='doctor'>Doctor:</label></th>
                <td><input type='text' id='doctor' name='doctor' value='" . ($_POST['hidden_doctor'] ?? $doctor) . "' readonly></td>
            </tr>
            <tr>
                <th><label for='date'>Date:</label></th>
                <td><input type='date' id='date' name='date'></td>
            </tr>
            <tr>
                <td colspan='2'><input type='submit' name='add' value='Create Consultation Visit'></td>
            </tr>
        </form>
    </table>";
}

if (isset($_POST['add'])) {
    $unit_no = $_POST['unit_no'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $mobile = $_POST['mobile'];
    $diagnosis = $_POST['diagnosis'];
    $doctor = $_POST['doctor'];
    $date = $_POST['date'];

    $sql = "INSERT INTO visits (name, unit_no, age, sex, mobile, diagnosis, doctor, date) VALUES ('$name', '$unit_no', '$age', '$sex', '$mobile', '$diagnosis', '$doctor', '$date')";
    if ($conn->query($sql) === TRUE) {
        echo "<br>Consultation Of Patient Mr/Ms $name, Unit No: $unit_no On $date created successfully.</br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
<a href="005_visitsAddEdit.php">Click Here To Edit The Record</a>
</body>
</html>
