<?php
require_once "conn.php";
require_once "css/testrecall1-2.css";

// Connect to the database
$conn = new mysqli($host, $user, $pwd, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to log history
function logHistory($action, $id, $original_name, $edited_name, $original_age, $edited_age, $original_sex, $edited_sex) {
    global $conn;

    // Get current timestamp
    $timestamp = date("YmdHis");

    // Generate a unique identifier using the primary key ID, timestamp, and a random string
    $random_string = bin2hex(random_bytes(4)); // Generate a random string of 8 characters
    $unique_id = $id . '_' . $timestamp . '_' . $random_string;

    // Insert data into history table with the unique identifier
    $sql_insert_history = "INSERT INTO history (unique_id, action, id, original_name, edited_name, original_age, edited_age, original_sex, edited_sex, timestamp) 
                           VALUES ('$unique_id', '$action', '$id', '$original_name', '$edited_name', '$original_age', '$edited_age', '$original_sex', '$edited_sex', '$timestamp')";
    $result_insert_history = $conn->query($sql_insert_history);
    if (!$result_insert_history) {
        echo "Error logging history: " . $conn->error;
    }
}


// Check if form was submitted for adding a new entry
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];

    // Insert data into the test table
    $sql_insert_test = "INSERT INTO test (name, age, sex) VALUES ('$name', '$age', '$sex')";
    $result_insert_test = $conn->query($sql_insert_test);

    if ($result_insert_test) {
        echo "New record added successfully!";
    } else {
        echo "Error adding new record: " . $conn->error;
    }
}

// Check if form was submitted for editing an existing entry
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];

    // Fetch previous data before edit
    $sql_select = "SELECT * FROM test WHERE id = '$id'";
    $result_select = $conn->query($sql_select);
    $previous_data = $result_select->fetch_assoc();

    // Log the changes in the history table
    logHistory('edit', $id, $previous_data['name'], $name, $previous_data['age'], $age, $previous_data['sex'], $sex);

    // Update data in test table
    $sql_update_test = "UPDATE test SET name = '$name', age = '$age', sex = '$sex' WHERE id = '$id'";
    $result_update_test = $conn->query($sql_update_test);

    if ($result_update_test) {
        echo "Record updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Check if the delete button was clicked
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Fetch data to log history
    $sql_select = "SELECT * FROM test WHERE id = '$id'";
    $result_select = $conn->query($sql_select);
    $deleted_data = $result_select->fetch_assoc();

    // Log the deletion in the history table
    logHistory('delete', $id, $deleted_data['name'], '', $deleted_data['age'], '', $deleted_data['sex'], '');

    // Delete the record from the test table
    $sql_delete_test = "DELETE FROM test WHERE id = '$id'";
    $result_delete_test = $conn->query($sql_delete_test);

    if ($result_delete_test) {
        echo "Record deleted successfully!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Check if the edit button was clicked
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    // Fetch the record to be edited from the test table
    $sql_select_test = "SELECT * FROM test WHERE id = '$id'";
    $result_select_test = $conn->query($sql_select_test);
    $row = $result_select_test->fetch_assoc();
    if ($result_select_test->num_rows > 0) {
        echo "<h2>Edit Entry</h2><form method='post'>
            <input type='hidden' name='id' value='{$row['id']}'>
            
            <label for='name'>Name</label>
            <input type='text' id='name' name='name' value='{$row['name']}' required><br><br>

            <label for='age'>Age</label>
            <input type='number' id='age' name='age' value='{$row['age']}' required><br><br>

            <label for='sex'>Sex</label>
            <input type='text' id='sex' name='sex' value='{$row['sex']}' required><br><br>

            <input type='submit' name='submit' value='Update'>
        </form>";
    } else {
        echo "Record not found!";
    }
}

// Fetch data from test table
$sql_select_test = "SELECT * FROM test ORDER BY id DESC";
$result_select_test = $conn->query($sql_select_test);

if ($result_select_test->num_rows > 0) {
    echo "<h2>Existing Entries</h2><table><tr><th>ID</th><th>NAME</th><th>AGE</th><th>SEX</th><th>ACTION</th></tr>";
    // Output data of each row
    while ($row = $result_select_test->fetch_assoc()) {
        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['age'] . "</td><td>" . $row['sex'] . "</td><td><a href='?edit=" . $row['id'] . "'>Edit</a> | <a href='?delete=" . $row['id'] . "'>Delete</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Display form for adding a new entry
echo "<h2>Add New Entry</h2>
<form method='post'>
    <label for='name'>Name</label>
    <input type='text' id='name' name='name' required><br><br>

    <label for='age'>Age</label>
    <input type='number' id='age' name='age' required><br><br>

    <label for='sex'>Sex</label>
    <input type='text' id='sex' name='sex' required><br><br>

    <input type='submit' name='add' value='Add New Entry'>
</form>";

$conn->close();
?>
