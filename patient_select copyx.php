<?php
require_once 'session_check.php';
require_once 'conn.php';

// Initialize variables
$unit_no = $name = $age = $sex = $mobile = $diagnosis = "";

// Handle form submission and retain data
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
}

// Fetch all unit_no from the user_info table
$sql = "SELECT DISTINCT unit_no, name FROM user_info ORDER BY unit_no DESC";
$result = $conn->query($sql);

$unit_no_options = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $unit_no_option = $row["unit_no"];
        $name_option = $row["name"];
        $selected = ($unit_no == $unit_no_option) ? "selected" : "";
        $unit_no_options .= "<option value='$unit_no_option' $selected>$unit_no_option - $name_option</option>";
    }
} else {
    echo "No unit_no found";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Patient</title>
</head>
<body>
    <h2>Select Patient</h2>
    <form method="post" action="doctor_select.php">
        <select name="unit_no_name">
            <option value="">Select unit_no</option>
            <?php echo $unit_no_options; ?>
        </select>
        <input type="submit" name="fetch_patient" value="Fetch Patient Records">
    </form>

    <?php if (!empty($name)) : ?>
        <h3>Patient Details:</h3>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
        <p><strong>Age:</strong> <?php echo htmlspecialchars($age); ?></p>
        <p><strong>Sex:</strong> <?php echo htmlspecialchars($sex); ?></p>
        <p><strong>Mobile:</strong> <?php echo htmlspecialchars($mobile); ?></p>
        <p><strong>Diagnosis:</strong> <?php echo htmlspecialchars($diagnosis); ?></p>
    <?php endif; ?>

    <br>
    <a href="005_visitsAddEdit.php">Click Here To Edit The Record</a>
</body>
</html>

<?php
$conn->close();
?>
