<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User Record</title>
    <script>
        function getIDandSubmit() {
            var id = prompt("Please enter the ID of the record to be deleted:");
            if (id != null) {
                document.getElementById('id').value = id;
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
</head>
<body>
    <h1>Delete User Record</h1>
    <form id="deleteForm" method="POST" action="">
        <input type="hidden" id="id" name="id">
    </form>
    <button onclick="getIDandSubmit()">Delete Record</button>

    <?php
    $servername = "localhost";
    $username = "jhcpl";
    $password = "jhcpl";
    $dbname = "jhcpl";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM user_info WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute() === TRUE) {
            echo "<p>Record with ID {$id} deleted successfully!</p>";
        } else {
            echo "<p>Error deleting record: " . $conn->error . "</p>";
        }

        $stmt->close();
    }

    $conn->close();
    ?>
</body>
</html>
