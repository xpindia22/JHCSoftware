<!DOCTYPE html>
<html>
<head>
<style>
table {
  border-collapse: collapse;
  width: 100%;
  background-color: #f2f2f2; /* light gray */
}

th, td {
  border: 1px solid #ddd; /* light gray */
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #ddd; /* darker gray for every other row */
}
</style>
</head>
<body>

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
        echo "<div><form action='visits_submit.php' method='post'>";
        echo "Unit No: <input type='text' name='unit_no' value='$unit_no' readonly><br>";
        echo "Name: <input type='text' name='name' value='$name' readonly><br>";
        echo "Age: <input type='text' name='age' value='$age'><br>";
        echo "Sex: <input type='text' name='sex' value='$sex'><br>";
        echo "Diagnosis: <textarea name='diagnosis'></textarea><br>";
        echo "Date: <input type='date' name='date'><br>";
        echo "CC: <textarea name='cc'></textarea><br>";
        echo "HPI: <textarea name='hpi'></textarea><br>";
        echo "PMH: <textarea name='pmh'></textarea><br>";
        echo "OBG: <textarea name='obg'></textarea><br>";
        echo "Exam: <textarea name='exam'></textarea><br>";
        echo "Treatment: <textarea name='treatment'></textarea><br>";
        echo "Medicines: <textarea name='medicines'></textarea><br>";
        echo "Lab: <textarea name='lab'></textarea><br>";
        echo "Notes: <textarea name='notes'></textarea><br>";
        echo "<input type='submit'>";
        echo "</form></div>";
    } else {
        // Patient doesn't exist, show popup
        echo "<script>alert('Patient doesn\'t exist.');</script>";
        // Display initial form that asks for unit_no
        echo "<div><form action='visits_fetchuser1.php' method='post'>";
        echo "Unit No: <input type='text' name='unit_no'><br>";
        echo "<input type='submit'>";
        echo "</form></div>";
 
    }
} else {
    // Display initial form that asks for unit_no
    echo "<h1>Retrieve</h1>";
    echo "<div><form action='visits_fetchuser1.php' method='post'>";
    echo "Unit No: <input type='text' name='unit_no'><br>";
    echo "<input type='submit'>";
    echo "</form></div>";
}

$conn->close();
?>

</body>
</html>
