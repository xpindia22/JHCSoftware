 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>
</head>
<body>
    <h1>User Registration</h1>
    <form method="POST" action="process.php">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id"  style="margin-left: 68px;"><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required style="margin-left: 48px;"><br><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required style="margin-left: 58px;"><br><br>

        <label for="sex">Sex:</label>
        <input type="radio" id="male" name="sex" value="Male" >
        <label for="male">Male</label>
        <input type="radio" id="female" name="sex" value="Female">
        <label for="female">Female</label><br><br>

        <label for="unit_no">Unit No:</label>
        <input type="text" id="unit_no" name="unit_no" required style="margin-left: 38px;"><br><br>

        <label for="diagnosis">Diagnosis:</label>
        <textarea id="diagnosis" name="diagnosis" rows="4" cols="50" style="margin-left: 28px;"></textarea><br><br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required style="margin-left: 58px;"><br><br>

        <label for="mobile">Mobile:</label>
        <input type="text" id="mobile" name="mobile" required style="margin-left: 48px;"><br><br>

        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="4" cols="50" style="margin-left: 28px;"></textarea><br><br>

        <label for="notes">Notes:</label>
        <textarea id="notes" name="notes" rows="4" cols="50" style="margin-left: 48px;"></textarea><br><br>

        <label for="consultation">Consultation:</label>
        <input type="number" id="consultation" name="consultation" required style="margin-left: 48px;"><br><br>

        <label for="ecg">ECG:</label>
        <input type="number" id="ecg" name="ecg" required style="margin-left: 48px;"><br><br>

        <label for="echo">ECHO:</label>
        <input type="number" id="echo" name="echo" required style="margin-left: 48px;"><br><br>

        <label for="medicines">Medicines:</label>
        <input type="number" id="medicines" name="medicines" required style="margin-left: 48px;"><br><br>

        <label for="lab">Lab:</label>
        <input type="number" id="lab" name="lab" required style="margin-left: 48px;"><br><br>
 
        <input type="submit" value="Submit">
    </form>
</body>
</html>