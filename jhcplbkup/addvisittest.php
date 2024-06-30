<?php
require_once 'conn.php';

// Fetch all unit_no from the user_info table
$sql = "SELECT DISTINCT unit_no  FROM user_info ORDER BY unit_no DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<form method='post' action=''>
  <select name='unit_no'>
  <option value=''>Select unit_no</option>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<option value='".$row["unit_no"]."'>".$row["unit_no"]."</option>";
  }
  echo "</select>
  <input type='submit' name='submit' value='Fetch Records' />
  </form>";
} else {
  echo "No unit_no found";
}


// If form is submitted, fetch records for the selected unit_no
if (isset($_POST['submit'])) {
  $unit_no = $_POST['unit_no'];
 
  $sql = "SELECT id, name, unit_no, age, sex, mobile, diagnosis, date, cc, hpi, pmh, obg, exam, treatment, medicines, lab, notes FROM visits WHERE unit_no = '$unit_no' ORDER BY id ASC";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    
    echo "<h2>Unit No: $unit_no Personal Information.</h2>
    <table>
    <tr>
      <th>Visit ID:</th>
      <th>Name</th>
      <th>Unit No</th>
      <th>Age</th>
      <th>Sex</th>
      <th>Mobile</th>
      <th>Diagnosis</th>
      <th>Date</th>
    </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr>
      <td><a href='details.php?id=".$row["id"]."'>".$row["id"]."</a></td>
      <td>".$row["name"]."</td>
      <td>".$row["unit_no"]."</td>
      <td>".$row["age"]."</td>
      <td>".$row["sex"]."</td>
      <td>".$row["mobile"]."</td>
      <td>".$row["diagnosis"]."</td>
      <td>".$row["date"]."</td>
      </tr>";
    }
    echo "</table>";

    echo "<h2>Medical Information</h2>";
    // output data of each row
    $result->data_seek(0); // reset data pointer
    while($row = $result->fetch_assoc()) {
      echo "<style>
      th {
          text-align: left;
          width: 200px; /* Adjust as needed */
      }
      td {
          text-align: left;
          padding-left: 0.3cm; /* Adjust as needed */
      }
  </style>
      <table>
        
      <tr><th>Visit ID No:</th><td>".$row["id"].", <b>Visit Date</b> ".$row["date"]."</td></tr>
        <tr><th>Chief Complaint</th><td>".$row["cc"]."</td></tr>
        <tr><th>History Of Present Illness</th><td>".$row["hpi"]."</td></tr>
        <tr><th>Past Medical History</th><td>".$row["pmh"]."</td></tr>
        <tr><th>Obstetrics & Gyne</th><td>".$row["obg"]."</td></tr>
        <tr><th>Examination</th><td>".$row["exam"]."</td></tr>
        <tr><th>Treatment</th><td>".$row["treatment"]."</td></tr>
        <tr><th>Medicines</th><td>".$row["medicines"]."</td></tr>
        <tr><th>Laboratory</th><td>".$row["lab"]."</td></tr>
        <tr><th>Notes</th><td>".$row["notes"]."</td></tr>
        <tr><td colspan='2'> </td></tr> <!-- This is the empty row -->
        </align>

      </table>";
    }
    
  } else {
    
     echo "No records found for unit_no: $unit_no  <p><br>
     <a href='004_new-revisit.php'>Click Here To Create A New Record or Revist</a>";
   }
}

if (isset($_POST['add'])) {
    
    $unit_no = $_POST['unit_no'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $mobile = $_POST['mobile'];
    $diagnosis = $_POST['diagnosis'];
    $date = $_POST['date'];
    
    $sql = "INSERT INTO visits (name,unit_no, age, sex, mobile, diagnosis, date) VALUES ('$name','$unit_no', '$age', '$sex','$mobile', '$diagnosis', '$date')";
    if ($conn->query($sql) === TRUE) {
        echo "New Consultation Record Of Unit No: $unit_no On $date created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['update'])) {
    
    $id = $_POST['id'];
    $unit_no = $_POST['unit_no'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $mobile = $_POST['mobile'];
    $diagnosis = $_POST['diagnosis'];
    $date = $_POST['date'];
    
    $sql = "UPDATE visits SET name='$name', unit_no='$unit_no', age='$age', sex='$sex', mobile='$mobile', diagnosis='$diagnosis', date='$date' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        
        // Fetch the updated record
        $sql = "SELECT * FROM visits WHERE id = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Name: " . $row["name"]. " - Unit No: " . $row["unit_no"]. "<br>";
            }
        } else {
            echo "No results found";
        }
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
