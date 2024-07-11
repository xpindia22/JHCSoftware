<?php
// Database connection parameters
$host = "localhost";
$user = "jhcpl";
$pwd = "jhcpl";
$db = "jhcpl";

// Connect to the database
$conn = new mysqli($host, $user, $pwd, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create medicines table if not exists
$sql_create_table = "CREATE TABLE IF NOT EXISTS medicines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    expiry_date DATE,
    description TEXT
)";
$conn->query($sql_create_table);

// Check if form was submitted to add a new medicine
if (isset($_POST['add_medicine'])) {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $expiry_date = $_POST['expiry_date'];
    $description = $_POST['description'];

    // Insert data into medicines table
    $sql_insert_medicine = "INSERT INTO medicines (name, quantity, expiry_date, description) VALUES ('$name', '$quantity', '$expiry_date', '$description')";
    $result_insert_medicine = $conn->query($sql_insert_medicine);

    if ($result_insert_medicine) {
        echo "New medicine added successfully!";
    } else {
        echo "Error adding new medicine: " . $conn->error;
    }
}

// Fetch data from medicines table
$sql_select_medicines = "SELECT * FROM medicines ORDER BY id DESC";
$result_select_medicines = $conn->query($sql_select_medicines);

// Check for medicines about to expire (within one month from today)
$current_date = date("Y-m-d");
$one_month_later = date("Y-m-d", strtotime("+1 month"));
$sql_about_to_expire = "SELECT * FROM medicines WHERE expiry_date BETWEEN '$current_date' AND '$one_month_later'";
$result_about_to_expire = $conn->query($sql_about_to_expire);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Medicines Stock</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .about-to-expire {
            color: red;
        }
    </style>
</head>
<body>
    <h2>Add New Medicine</h2>
    <form method="post">
        <label for="name">Medicine Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br><br>

        <label for="expiry_date">Expiry Date:</label>
        <input type="date" id="expiry_date" name="expiry_date"><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>

        <input type="submit" name="add_medicine" value="Add Medicine">
    </form>

    <h2>Medicines in Stock</h2>
    <?php if ($result_select_medicines->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Expiry Date</th>
                <th>Description</th>
            </tr>
            <?php while ($row = $result_select_medicines->fetch_assoc()): ?>
                <tr <?php echo (strtotime($row['expiry_date']) <= strtotime($one_month_later)) ? 'class="about-to-expire"' : ''; ?>>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['expiry_date']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No medicines available in stock.</p>
    <?php endif; ?>

    <h2>About to Expire Medicines (Within 1 month)</h2>
    <?php if ($result_about_to_expire->num_rows > 0): ?>
        <table>
            <tr>
                <th>Name</th>
                <th>Expiry Date</th>
                <th>Quantity Left</th>
            </tr>
            <?php while ($row = $result_about_to_expire->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['expiry_date']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No medicines are about to expire within one month.</p>
    <?php endif; ?>

</body>
</html>

<?php
// Close database connection
$conn->close();
?>
