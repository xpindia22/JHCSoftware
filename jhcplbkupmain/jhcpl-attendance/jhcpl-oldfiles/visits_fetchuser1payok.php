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
    $result = $conn->query("SELECT id, name, date FROM visits WHERE unit_no = $unit_no");
    if (!$result) {
        die("Error: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $name = $row['name'];
        $date = $row['date'];
        // Close the result set
        $result->close();

        // Display another form with name and unit_no prefilled
        echo "<form action='visits_submitpay.php' method='post'>";
        echo "Unit No: <input type='text' name='unit_no' value='$unit_no' readonly><br>";
        echo "Name: <input type='text' name='name' value='$name' readonly><br>";
        echo "BillID: <input type='text' name='billid'><br>";
        echo "Date: <input type='date' name='date'value='$date'><br>";
        echo "Consultation: <input type='text' name='consultation'><br>";
        echo "ECG: <input type='text' name='ecg'><br>";
        echo "ECHO: <input type='text' name='echo'><br>";
        echo "Medicines: <input type='text' name='medicines'><br>";
        echo "Lab: <input type='text' name='lab'><br>";
        echo "Others: <input type='text' name='others'><br>";
        echo "Concession: <input type='text' name='concession'><br>";
         
        echo "<input type='submit'>";
        echo "</form>";
    } else {
        // Patient doesn't exist, show popup
        echo "<script>alert('Patient doesn\'t exist.');</script>";
        // Display initial form that asks for unit_no
        echo "<form action='visits_fetchuser1pay.php' method='post'>";
        echo "Unit No: <i   nput type='text' name='unit_no'><br>";
        echo "<input type='submit'>";
        echo "</form>";
 
    }
} else {
    // Display initial form that asks for unit_no
    echo "<<h1> Retrieve</h1>";
    echo "<form action='visits_fetchuser1pay.php' method='post'>";
    echo "Unit No: <input type='text' name='unit_no'><br>";
    echo "<input type='submit'>";
    echo "</form>";
}

$conn->close();
?>