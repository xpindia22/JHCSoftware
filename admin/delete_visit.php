<?php
require_once 'session_admin.php'; // Include session check for admin
require_once 'conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM visits WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Visit deleted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
