<?php
session_start();
require_once '../config/conn.php'; // Connect to the database

// Authenticate the doctor
if (!isset($_SESSION['username']) || !isset($_SESSION['roles']) || !in_array('Doctor', $_SESSION['roles'])) {
    die('Unauthorized access. You are not logged in as a Doctor.');
}

// Fetch the logged-in doctor's username from the session
$doctor_username = $_SESSION['username'];

// Fetch all unit_no from the visits table assigned to the logged-in doctor
$sql = "SELECT DISTINCT unit_no FROM visits WHERE doctor_username = '$doctor_username' ORDER BY unit_no DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<form method='post' action=''>
          <select name='unit_no_name'>
          <option value=''>Select unit_no</option>";
    while ($row = $result->fetch_assoc()) {
        $unit_no = $row["unit_no"];
        // Fetch the patient's name using the unit_no from user_info table
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
    $sql = "SELECT id, name, unit_no, age, sex, mobile, diagnosis, visit_date, cc, hpi, pmh, obg, exam, treatment, medicines, lab, notes 
            FROM visits 
            WHERE unit_no = '$unit_no' AND doctor_username = '$doctor_username' 
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
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            // Fetch the doctor's full name from the users table
            $doctor_sql = "SELECT username FROM users WHERE username = '$doctor_username'";
            $doctor_result = $conn->query($doctor_sql);
            $doctor = $doctor_result->fetch_assoc();
            $doctor_name = $doctor['username'];

            echo "<tr>
            <td><a href='details.php?id=".$row["id"]."'>".$row["id"]."</a></td>
            <td>".$row["name"]."</td>
            <td>".$row["unit_no"]."</td>
            <td>".$row["age"]."</td>
            <td>".$doctor_name."</td>
            <td>".$row["sex"]."</td>
            <td>".$row["mobile"]."</td>
            <td>".$row["diagnosis"]."</td>
            <td>".$row["visit_date"]."</td>
            </tr>";
        }
        echo "</table>";

        echo "<h2>Medical Information</h2>";
        // Output data of each row
        $result->data_seek(0); // Reset data pointer
        while ($row = $result->fetch_assoc()) {
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
