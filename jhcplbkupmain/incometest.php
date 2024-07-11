<?php
$servername = "localhost";
$username = "jhcpl";
$password = "jhcpl";
$dbname = "jhcpl";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if not exists
$conn->query("CREATE TABLE IF NOT EXISTS Income (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    source VARCHAR(255) NOT NULL,
    amount DOUBLE NOT NULL,
    date date NOT NULL,
    FOREIGN KEY (patient_id) REFERENCES user_info(id)
)");

// Add income
if (isset($_POST['patient_id'], $_POST['source'], $_POST['amount'], $_POST['date'])) {
    $date = DateTime::createFromFormat('Y-m-d', $_POST['date']);
    if ($date === false) {
        die('Invalid date format. Please use "Y-m-d".');
    }
    $date = $date->format('Y-m-d');
    $stmt = $conn->prepare("INSERT INTO Income (patient_id, source, amount, date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issd", $_POST['patient_id'], $_POST['source'], $_POST['amount'], $date);
    $stmt->execute();
    header("Location: ".$_SERVER['PHP_SELF']); // Redirect to the same page
    exit;
}

// Get all income
$result = $conn->query("SELECT user_info.name, Income.source, Income.amount, Income.date FROM Income INNER JOIN user_info ON Income.patient_id=user_info.id ORDER BY date ASC");
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Calculate total income
$total = 0;
while($row = $result->fetch_assoc()) {
    $total += $row['amount'];
}

// Reset data pointer
$result->data_seek(0);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-color: #F5F5F5;
            color: #333;
        }
        h1, h2 {
            color: #6B9080;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            border-color: #A4C3B2;
        }
        th, td {
            border: 1px solid #A4C3B2;
            padding: 8px;
            text-align: left;
        }
        input[type="submit"] {
            background-color: #6B9080;
            color: white;
            border: none;
            padding: 5px 10px;
        }
        input[type="submit"]:hover {
            background-color: #8FBDB0;
        }
    </style>
</head>
<body>
<h1>JHCPL Clinic Income</h1>

<form method="POST">
    <label for="patient_id">Patient ID:</label><br>
    <input type="number" id="patient_id" name="patient_id"><br>
    <label for="source">Source:</label><br>
    <select id="source" name="source">
        <option value="Consultation">Consultation</option>
        <option value="ECG">ECG</option>
        <option value="ECHO">ECHO</option>
        <option value="Lab">Lab</option>
        <option value="Medicines">Medicines</option>
        <option value="Day Care">Day Care</option>
        <option value="Misc">Misc</option>
    </select><br>
    <label for="amount">Amount:</label><br>
    <input type="number" id="amount" name="amount" step="0.01"><br>
    <label for="date">Date:</label><br>
    <input type="date" id="date" name="date"><br>
    <input type="submit" value="Add Income">
</form>

<h2>Income:</h2>
<table>
    <tr>
        <th>Patient Name</th>
        <th>Source</th>
        <th>Amount</th>
        <th>Date</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['source']; ?></td>
        <td><?php echo $row['amount']; ?></td>
        <td><?php echo $row['date']; ?></td>
    </tr>
    <?php endwhile; ?>
    <tr>
        <td colspan="2">Total</td>
        <td><?php echo $total; ?></td>
    </tr>
</table>

</body>
</html>
