<?php
require_once 'session_check.php';
require_once 'conn.php';

// Fetch all Doctors from the doctors table
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

?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Doctor</title>
</head>
<body>
    <h2>Select Doctor for Patient: <?php echo htmlspecialchars($_GET['name']); ?></h2>
    <form method="post" action="add_visit.php">
        <input type="hidden" name="unit_no" value="<?php echo htmlspecialchars($_GET['unit_no']); ?>">
        <input type="hidden" name="name" value="<?php echo htmlspecialchars($_GET['name']); ?>">
        <input type="hidden" name="age" value="<?php echo htmlspecialchars($_GET['age']); ?>">
        <input type="hidden" name="sex" value="<?php echo htmlspecialchars($_GET['sex']); ?>">
        <input type="hidden" name="mobile" value="<?php echo htmlspecialchars($_GET['mobile']); ?>">
        <input type="hidden" name="diagnosis" value="<?php echo htmlspecialchars($_GET['diagnosis']); ?>">
        
        <label for="doctor">Select Doctor:</label>
        <select name="doctor" id="doctor">
            <?php echo $doctor_options; ?>
        </select>
        
        <label for="visit_date">Visit Date and Time:</label>
        <input type="datetime-local" name="visit_date" id="visit_date" required>
        
        <input type="submit" name="select_doctor" value="Select Doctor">
    </form>
</body>
</html>
