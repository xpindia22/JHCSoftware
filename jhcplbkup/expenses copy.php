<?php
$servername = "localhost";
$username = "jhcpl";
$password = "jhcpl";
$dbname = "jhcpl";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add expense
if (isset($_POST['description'], $_POST['amount'], $_POST['date'])) {
    $stmt = $conn->prepare("INSERT INTO Expenses (description, amount, date) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $_POST['description'], $_POST['amount'], $_POST['date']);
    $stmt->execute();
}

// Delete expense
if (isset($_POST['delete_id'])) {
    $stmt = $conn->prepare("DELETE FROM Expenses WHERE id = ?");
    $stmt->bind_param("i", $_POST['delete_id']);
    $stmt->execute();
}

// Get all expenses
$result = $conn->query("SELECT * FROM Expenses ORDER BY date DESC");

// Calculate total expenses
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
<body>
<h1>Clinic Expenses</h1>

<form method="POST">
    <label for="description">Description:</label><br>
    <input type="text" id="description" name="description"><br>
    <label for="amount">Amount:</label><br>
    <input type="number" id="amount" name="amount" step="0.01"><br>
    <label for="date">Date:</label><br>
    <input type="date" id="date" name="date"><br>
    <input type="submit" value="Add Expense">
</form>

<h2>Expenses:</h2>
<table style="border-collapse: collapse; width: 100%;">
    <tr>
        <th style="border: 1px solid black;">ID</th>
        <th style="border: 1px solid black;">Description</th>
        <th style="border: 1px solid black;">Amount</th>
        <th style="border: 1px solid black;">Date</th>
        <th style="border: 1px solid black;">Action</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td style="border: 1px solid black;"><?php echo $row['id']; ?></td>
        <td style="border: 1px solid black;"><?php echo $row['description']; ?></td>
        <td style="border: 1px solid black;"><?php echo $row['amount']; ?></td>
        <td style="border: 1px solid black;"><?php echo $row['date']; ?></td>
        <td style="border: 1px solid black;">
            <form method="POST">
                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                <input type="submit" value="Delete">
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
    <tr>
        <td colspan="2" style="border: 1px solid black;">Total</td>
        <td colspan="3" style="border: 1px solid black;"><?php echo $total; ?></td>
    </tr>
</table>

</body>
</html>
