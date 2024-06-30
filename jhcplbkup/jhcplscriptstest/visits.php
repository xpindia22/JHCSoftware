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
    $result = $conn->query("SELECT name, age, sex, diagnosis,date FROM user_info WHERE unit_no = $unit_no");
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $age = $row['age'];
    $sex = $row['sex'];
    $diagnosis = $row['diagnosis'];
    $date = $row['date'];
    

    // Display another form with name and unit_no prefilled
    echo "<form action='visits.php' method='post'>";
    
    echo "Unit No: <input type='text' name='unit_no' value='$unit_no'><br>";
    echo "Name: <input type='text' name='name' value='$name'><br>";
    echo "Age: <input type='text' name='age' value='$age' ><br>";
    echo "Sex: <input type='text' name='sex' value='$sex'><br>";
    echo "Diagnosis: <input type='text' name='diagnosis' value='$diagnosis'><br>";
    echo "Date: <input type='date' name='date' value='$date'><br>";
    echo "CC: <input type='text' name='cc'><br>";
    echo "HPI: <input type='text' name='hpi'><br>";
    echo "PMH: <input type='text' name='pmh'><br>";
    echo "OBG: <input type='text' name='obg'><br>";
    echo "Exam: <input type='text' name='exam'><br>";
    echo "Treatment: <input type='text' name='treatment'><br>";
    echo "Medicines: <input type='text' name='medicines'><br>";
    echo "Lab: <input type='text' name='lab'><br>";
    echo "<input type='submit'>";
    echo "</form>";
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from second form
    $unit_no = $_POST['unit_no'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $diagnosis = $_POST['diagnosis'];
    $date = $_POST['date'];
    $cc = $_POST['cc'];
    $hpi = $_POST['hpi'];
    $pmh = $_POST['pmh'];
    $obg = $_POST['obg'];
    $exam = $_POST['exam'];
    $treatment = $_POST['treatment'];
    $medicines = $_POST['medicines'];
    $lab = $_POST['lab'];

    // Insert data into visits table
    $sql = "INSERT INTO visits (unit_no, name,  age, sex, diagnosis, date, cc, hpi, pmh, obg, exam, treatment, medicines, lab)
            VALUES ('$unit_no','$name' '$age', '$sex', '$diagnosis', '$date', '$cc', '$hpi', '$pmh', '$obg', '$exam', '$treatment', '$medicines', '$lab')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Display initial form that asks for unit_no
    echo "<form action='visits.php' method='post'>";
    echo "Unit No: <input type='text' name='unit_no'><br>";
    echo "<input type='submit'>";
    echo "</form>";
}

$conn->close();
?>
