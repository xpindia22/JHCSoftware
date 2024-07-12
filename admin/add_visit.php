<?php
require_once '../config/session_admin.php'; // Include session check for admin
require_once '../config/conn.php'; // connect to the database.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $unit_no = $_POST['unit_no'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $mobile = $_POST['mobile'];
    $diagnosis = $_POST['diagnosis'];
    $date = $_POST['date'];
    $doctor_id = $_POST['doctor_id'];
    $cc = $_POST['cc'];
    $hpi = $_POST['hpi'];
    $pmh = $_POST['pmh'];
    $obg = $_POST['obg'];
    $exam = $_POST['exam'];
    $medicines = $_POST['medicines'];
    $lab = $_POST['lab'];
    $notes = $_POST['notes'];
    $address = $_POST['address'];
    $visit_date = $_POST['visit_date'];

    $sql = "INSERT INTO visits (name, unit_no, age, sex, mobile, diagnosis, date, doctor_id, cc, hpi, pmh, obg, exam, medicines, lab, notes, address, visit_date) 
            VALUES ('$name', '$unit_no', '$age', '$sex', '$mobile', '$diagnosis', '$date', '$doctor_id', '$cc', '$hpi', '$pmh', '$obg', '$exam', '$medicines', '$lab', '$notes', '$address', '$visit_date')";
    if ($conn->query($sql) === TRUE) {
        echo "New visit created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Visit</title>
</head>
<body>
    <h2>Add Visit</h2>
    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="unit_no">Unit No:</label>
        <input type="text" id="unit_no" name="unit_no" required><br><br>
        <label for="age">Age:</label>
        <input type="text" id="age" name="age" required><br><br>
        <label for="sex">Sex:</label>
        <input type="text" id="sex" name="sex" required><br><br>
        <label for="mobile">Mobile:</label>
        <input type="text" id="mobile" name="mobile" required><br><br>
        <label for="diagnosis">Diagnosis:</label>
        <input type="text" id="diagnosis" name="diagnosis" required><br><br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>
        <label for="cc">CC:</label>
        <input type="text" id="cc" name="cc" required><br><br>
        <label for="hpi">HPI:</label>
        <input type="text" id="hpi" name="hpi" required><br><br>
        <label for="pmh">PMH:</label>
        <input type="text" id="pmh" name="pmh" required><br><br>
        <label for="obg">OBG:</label>
        <input type="text" id="obg" name="obg" required><br><br>
        <label for="exam">Exam:</label>
        <input type="text" id="exam" name="exam" required><br><br>
        <label for="medicines">Medicines:</label>
        <input type="text" id="medicines" name="medicines" required><br><br>
        <label for="lab">Lab:</label>
        <input type="text" id="lab" name="lab" required><br><br>
        <label for="notes">Notes:</label>
        <textarea id="notes" name="notes" required></textarea><br><br>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>
        <label for="visit_date">Visit Date:</label>
        <input type="datetime-local" id="visit_date" name="visit_date" required><br><br>
        <label for="doctor_id">Doctor ID:</label>
        <input type="text" id="doctor_id" name="doctor_id" required><br><br>
        <input type="submit" value="Add Visit">
    </form>
</body>
</html>
