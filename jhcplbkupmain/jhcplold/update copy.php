<?php
$servername = "localhost";
$username = "jhcpl";
$password = "jhcpl";
$dbname = "jhcpl";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_POST['id'])) {
    die('ID not provided');
}

$id = $_POST['id'];

$sql = "UPDATE user_info SET ";
$params = array();
$types = "";

if (isset($_POST['name']) && $_POST['name'] !== '') {
    $sql .= "name = ?, ";
    $params[] = $_POST['name'];
    $types .= "s";
}

if (isset($_POST['age']) && $_POST['age'] !== '') {
    $sql .= "age = ?, ";
    $params[] = $_POST['age'];
    $types .= "i";
}

if (isset($_POST['sex']) && $_POST['sex'] !== '') {
    $sql .= "sex = ?, ";
    $params[] = $_POST['sex'];
    $types .= "s";
}

if (isset($_POST['unit_no']) && $_POST['unit_no'] !== '') {
    $sql .= "unit_no = ?, ";
    $params[] = $_POST['unit_no'];
    $types .= "s";
}

if (isset($_POST['diagnosis']) && $_POST['diagnosis'] !== '') {
    $sql .= "diagnosis = ?, ";
    $params[] = $_POST['diagnosis'];
    $types .= "s";
}

if (isset($_POST['date']) && $_POST['date'] !== '') {
    $sql .= "date = ?, ";
    $params[] = $_POST['date'];
    $types .= "s";
}

if (isset($_POST['mobile']) && $_POST['mobile'] !== '') {
    $sql .= "mobile = ?, ";
    $params[] = $_POST['mobile'];
    $types .= "s";
}

if (isset($_POST['address']) && $_POST['address'] !== '') {
    $sql .= "address = ?, ";
    $params[] = $_POST['address'];
    $types .= "s";
}

if (isset($_POST['notes']) && $_POST['notes'] !== '') {
    $sql .= "notes = ?, ";
    $params[] = $_POST['notes'];
    $types .= "s";
}

$sql = rtrim($sql, ", ");  // Remove trailing comma
$sql .= " WHERE id = ?";
$params[] = $id;
$types .= "i";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);

if ($stmt->execute() === TRUE) {
    echo "Record updated successfully!";
} else {
    echo "Error updating record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
