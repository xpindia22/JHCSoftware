<?php
$servername = "localhost";
$username = "jhcpl";
$password = "jhcpl";
$dbname = "jhcpl";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from second form
    $name = $_POST['name'];
    $unit_no = $_POST['unit_no'];
    $date = $_POST['date'];
    $consultation = $_POST['consultation'];
    $ecg = $_POST['ecg'];
    $echo = $_POST['echo'];
    $medicines = $_POST['medicines'];
    $lab = $_POST['lab'];
    $others = $_POST['others'];
    $concession = $_POST['concession'];
    $lab = $_POST['lab'];
    
    // Calculate total for the row
    $total = $consultation + $ecg + $echo + $medicines + $lab + $others - $concession;

    // Insert data into visits table
    $sql = "INSERT INTO payments (unit_no, name, date, consultation, ecg, echo, medicines, lab, others, concession, total)
            VALUES ('$unit_no', '$name', '$date', '$consultation', '$ecg', '$echo', '$medicines', '$lab', '$others', '$concession', '$total')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} 

// Display all entries and calculate and display total of all individual columns and grand total
$sql = "SELECT * FROM payments";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1' cellspacing='0' cellpadding='5'>";
    echo "<tr><th>Unit No</th><th>Name</th><th>BillID</th><th>Date</th><th>Consultation</th><th>ECG</th><th>Echo</th><th>Medicines</th><th>Lab</th><th>Others</th><th>Concession</th><th>Total</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["unit_no"] . "</td><td>" . $row["name"] . "</td><td>" . $row["billid"] . "</td><td>" . $row["date"] . "</td><td>" . $row["consultation"] . "</td><td>" . $row["ecg"] . "</td><td>" . $row["echo"] . "</td><td>" . $row["medicines"] . "</td><td>" . $row["lab"] . "</td><td>" . $row["others"] . "</td><td>" . $row["concession"] . "</td><td>" . $row["total"] . "</td></tr>";
    }

    $sql = "SELECT SUM(consultation), SUM(ecg), SUM(echo), SUM(medicines), SUM(lab), SUM(others), SUM(concession), SUM(total) FROM payments";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><td colspan='3'><b>Total</b></td><td>" . $row["SUM(consultation)"] . "</td><td>" . $row["SUM(ecg)"] . "</td><td>" . $row["SUM(echo)"] . "</td><td>" . $row["SUM(medicines)"] . "</td><td>" . $row["SUM(lab)"] . "</td><td>" . $row["SUM(others)"] . "</td><td>" . $row["SUM(concession)"] . "</td><td>" . $row["SUM(total)"] . "</td></tr>";
        }
    } else {
        echo "No data found";
    }

    $sql = "SELECT SUM(consultation + ecg + echo + medicines + lab + others - concession) AS GrandTotal FROM payments";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><td colspan='10'><b>Grand Total</b></td></td><td colspan='2'>" . $row["GrandTotal"] . "</td></tr>";
            //echo "<tr><td colspan='10'><b>Grand Total</b></td><td colspan='2'>" . $row["GrandTotal"] . "</td></tr>";
        }
    } else {
        echo "No data found";
    }

    echo "</table>";
} else {
    echo "No data found";
}

$conn->close();
?>
