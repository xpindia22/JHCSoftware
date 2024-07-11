<?php
$servername = "localhost";
$username = "jhcpl";
$password = "jhcpl";
$dbname = "jhcpl";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['unit_no'])) {
    // Get unit_no from form 
    $unit_no = $_POST['unit_no'];

    // Fetch name from user_info table
    $result = $conn->query("SELECT name, age, sex FROM user_info WHERE unit_no = $unit_no");
    if (!$result) {
        die("Error: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $age = $row['age'];
        $sex = $row['sex'];
        // Close the result set
        $result->close();

        // Display another form with name and unit_no prefilled
        echo "<form action='visits_submit.php' method='post'>";
        echo "Unit No: <input type='text' name='unit_no' value='$unit_no' readonly><br>";
        echo "Name: <input type='text' name='name' value='$name' readonly><br>";
        echo "Age: <input type='text' name='age' value='$age'><br>";
        echo "Sex: <input type='text' name='sex' value='$sex'><br>";
        echo "Diagnosis: <input type='text' name='diagnosis'><br>";
        echo "Date: <input type='date' name='date'><br>";
        echo "CC: <input type='text' name='cc'><br>";
        echo "HPI: <input type='text' name='hpi'><br>";
        echo "PMH: <input type='text' name='pmh'><br>";
        echo "OBG: <input type='text' name='obg'><br>";
        echo "Exam: <input type='text' name='exam'><br>";
        echo "Treatment: <input type='text' name='treatment'><br>";
        echo "Medicines: <input type='text' name='medicines'><br>";
        echo "Lab: <input type='text' name='lab'><br>";
        echo "Notes: <input type='text' name='notes'><br>";
        echo "<input type='submit'>";
        echo "</form>";
    } else {
        // Patient doesn't exist, show popup
        echo "<script>alert('Patient doesn\'t exist.');</script>";
    }
} else {
    // Fetch all unit_no from user_info table
    $result = $conn->query("SELECT unit_no FROM user_info");
    if (!$result) {
        die("Error: " . $conn->error);
    }

    // Display initial form that asks for unit_no
    echo "<<h1> Retrieve</h1>";
    echo "<form action='visits_fetchuser1.php' method='post'>";
    echo "Unit No: <select name='unit_no'>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['unit_no'] . "'>" . $row['unit_no'] . "</option>";
    }
    echo "</select><br>";
    echo "<input type='submit'>";
    echo "</form>";
}

$conn->close();
?>
