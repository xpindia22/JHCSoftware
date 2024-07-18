<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../config/session_check.php';
require_once '../config/conn.php'; // connect to the database.

// Initialize variables
$unit_no = $name = $age = $sex = $mobile = $diagnosis = $userid = $username = $visit_date = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['assign_doctor'])) {
    // Validate and sanitize inputs
    $unit_no = isset($_POST['unit_no']) ? mysqli_real_escape_string($conn, $_POST['unit_no']) : '';
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
    $age = isset($_POST['age']) ? mysqli_real_escape_string($conn, $_POST['age']) : '';
    $sex = isset($_POST['sex']) ? mysqli_real_escape_string($conn, $_POST['sex']) : '';
    $mobile = isset($_POST['mobile']) ? mysqli_real_escape_string($conn, $_POST['mobile']) : '';
    $diagnosis = isset($_POST['diagnosis']) ? mysqli_real_escape_string($conn, $_POST['diagnosis']) : '';
    $userid = isset($_POST['doctor']) ? mysqli_real_escape_string($conn, $_POST['doctor']) : '';
    $visit_date = isset($_POST['date']) ? mysqli_real_escape_string($conn, $_POST['date']) : '';
    $date = isset($_POST['date']) ? mysqli_real_escape_string($conn, $_POST['date']) : '';

    // Debugging: Print the values being used for the query
    echo "User ID from form: $userid<br>";

    // Fetch doctor's username based on userid and role 'Doctor'
    $sql = "SELECT username FROM users WHERE userid = '$userid' AND FIND_IN_SET('Doctor', role)";
    $result = $conn->query($sql);

    // Debugging: Check the number of rows returned
    echo "Number of rows returned: " . $result->num_rows . "<br>";

    if ($result->num_rows > 0) {
        $doctor = $result->fetch_assoc();
        $username = $doctor['username'];
        echo "Doctor found: $username<br>"; // Debugging: Print the found doctor's username
    } else {
        echo "Error: Doctor not found.";
        exit;
    }

    // Insert into database
    $sql = "INSERT INTO visits (name, unit_no, age, sex, mobile, diagnosis, doctor_username, visit_date, date) 
            VALUES ('$name', '$unit_no', '$age', '$sex', '$mobile', '$diagnosis', '$username', '$visit_date', '$date')";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment for Patient: $name, created for Dr. $username ($userid) on $visit_date";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>

<!-- HTML form for adding a visit -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label for="unit_no">Unit No:</label><br>
    <input type="text" id="unit_no" name="unit_no" required><br>
    
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br>
    
    <label for="age">Age:</label><br>
    <input type="number" id="age" name="age" required><br>
    
    <label for="sex">Sex:</label><br>
    <input type="text" id="sex" name="sex" required><br>
    
    <label for="mobile">Mobile:</label><br>
    <input type="tel" id="mobile" name="mobile" required><br>
    
    <label for="diagnosis">Diagnosis:</label><br>
    <textarea id="diagnosis" name="diagnosis" required></textarea><br>
    
    <label for="doctor">Doctor:</label><br>
    <select id="doctor" name="doctor" required>
        <?php
        // Fetch doctors from the users table where role includes 'Doctor'
        $sql = "SELECT userid, username FROM users WHERE FIND_IN_SET('Doctor', role)";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['userid'] . "'>" . $row['username'] . "</option>";
            }
        } else {
            echo "<option value=''>No doctors found</option>"; // Debugging: Handle case where no doctors are found
        }
        ?>
    </select><br><br>
    
    <label for="date">Visit Date:</label><br>
    <input type="datetime-local" id="date" name="date" required><br><br>
    
    <input type="submit" name="assign_doctor" value="Assign Doctor">
</form>
