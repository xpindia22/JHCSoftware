<?php
require_once 'session_admin.php'; // Include session check for admin
<<<<<<< HEAD
require_once 'conn.php';
=======
require_once './config/conn.php'; // connect to the database.
>>>>>>> work

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $unit_no = $_POST['unit_no'];
        $age = $_POST['age'];
        $sex = $_POST['sex'];
        $mobile = $_POST['mobile'];
        $diagnosis = $_POST['diagnosis'];
        $date = $_POST['date'];
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

        $sql = "UPDATE visits SET 
                    name = '$name', 
                    unit_no = '$unit_no', 
                    age = '$age', 
                    sex = '$sex', 
                    mobile = '$mobile', 
                    diagnosis = '$diagnosis', 
                    date = '$date',
                    cc = '$cc',
                    hpi = '$hpi',
                    pmh = '$pmh',
                    obg = '$obg',
                    exam = '$exam',
                    medicines = '$medicines',
                    lab = '$lab',
                    notes = '$notes',
                    address = '$address',
                    visit_date = '$visit_date'
                WHERE id = '$id'";

        if ($conn->query($sql) === TRUE) {
            echo "Visit updated successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $sql = "SELECT * FROM visits WHERE id = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $visit = $result->fetch_assoc();
        } else {
            echo "No visit found.";
            exit();
        }
    }
} else {
    echo "No visit ID provided.";
    exit();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Visit</title>
</head>
<body>
    <h2>Edit Visit</h2>
    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $visit['name']; ?>" required><br><br>
        <label for="unit_no">Unit No:</label>
        <input type="text" id="unit_no" name="unit_no" value="<?php echo $visit['unit_no']; ?>" required><br><br>
        <label for="age">Age:</label>
        <input type="text" id="age" name="age" value="<?php echo $visit['age']; ?>" required><br><br>
        <label for="sex">Sex:</label>
        <input type="text" id="sex" name="sex" value="<?php echo $visit['sex']; ?>" required><br><br>
        <label for="mobile">Mobile:</label>
        <input type="text" id="mobile" name="mobile" value="<?php echo $visit['mobile']; ?>" required><br><br>
        <label for="diagnosis">Diagnosis:</label>
        <input type="text" id="diagnosis" name="diagnosis" value="<?php echo $visit['diagnosis']; ?>" required><br><br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo $visit['date']; ?>" required><br><br>
        <label for="cc">CC:</label>
        <input type="text" id="cc" name="cc" value="<?php echo $visit['cc']; ?>" required><br><br>
        <label for="hpi">HPI:</label>
        <input type="text" id="hpi" name="hpi" value="<?php echo $visit['hpi']; ?>" required><br><br>
        <label for="pmh">PMH:</label>
        <input type="text" id="pmh" name="pmh" value="<?php echo $visit['pmh']; ?>" required><br><br>
        <label for="obg">OBG:</label>
        <input type="text" id="obg" name="obg" value="<?php echo $visit['obg']; ?>" required><br><br>
        <label for="exam">Exam:</label>
        <input type="text" id="exam" name="exam" value="<?php echo $visit['exam']; ?>" required><br><br>
        <label for="medicines">Medicines:</label>
        <input type="text" id="medicines" name="medicines" value="<?php echo $visit['medicines']; ?>" required><br><br>
        <label for="lab">Lab:</label>
        <input type="text" id="lab" name="lab" value="<?php echo $visit['lab']; ?>" required><br><br>
        <label for="notes">Notes:</label>
        <textarea id="notes" name="notes" required><?php echo $visit['notes']; ?></textarea><br><br>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo $visit['address']; ?>" required><br><br>
        <label for="visit_date">Visit Date:</label>
        <input type="datetime-local" id="visit_date" name="visit_date" value="<?php echo date('Y-m-d\TH:i', strtotime($visit['visit_date'])); ?>" required><br><br>
        <input type="submit" value="Update Visit">
    </form>
</body>
</html>
