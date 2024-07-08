
// Display the "Add Consultation Visit" form regardless of previous visits
echo "<h2>Add Revisit Consultation for unit_no: $unit_no </h2>
  
<table class='table'> <form method='post' action=''>
    <tr>
      <th><label for='unit_no'>Unit No:</label></th>
      <td><input type='text' id='unit_no' name='unit_no' value='$unit_no' readonly></td>
    </tr>
    <tr>
      <th><label for='name'>Name:</label></th>
      <td><input type='text' id='name' name='name' value='$name'></td>
    </tr>
    <tr>
      <th><label for='age'>Age:</label></th>
      <td><input type='text' id='age' name='age' value='$age'></td>
    </tr>
    <tr>
      <th><label for='sex'>Sex:</label></th>
      <td><input type='text' id='sex' name='sex' value='$sex'></td>
    </tr>
    <tr>
    <th><label for='mobile'>Mobile:</label></th>
    <td><input type='text' id='mobile' name='mobile' value='$mobile'></td>
    </tr>
    <tr>
    <th><label for='diagnosis'>Diagnosis:</label></th>
    <td><input type='text' id='diagnosis' name='diagnosis' value='$diagnosis'></td>
    </tr>
    
<tr>
  <th><label for='doctor'>Consuting Doctor:</label></th>
  <td>
    <select name='doctor'>
      <option value=''>Select Doctor</option>
      <?php
      $sql = "SELECT did, fname, lname FROM doctors";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $did = $row["did"];
          $fname = $row["fname"];
          $lname = $row["lname"];
          echo "<option value='$did'>$fname $lname</option>";
        }
      } else {
        echo "<option value=''>No doctors found</option>";
      }
     ?>
    </select>
  </td>
</tr>
    
    <th><label for='date'>Date:</label></th>
    <td><input type='date' id='date' name='date'></td>
    </tr>
    <tr>
      <td colspan='2'><input type='submit' name='add' value='Create Consultation Visit'></td>
    </tr>
</form></table>";