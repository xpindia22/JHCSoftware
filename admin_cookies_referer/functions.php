<?php
// Function to suggest a new username
function suggest_username($username, $conn) {
    $suggested_username = $username;
    $i = 1;
    while (true) {
        $suggested_username = $username . $i;
        $sql = "SELECT 1 FROM users WHERE username = '$suggested_username'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            break;
        }
        $i++;
    }
    return $suggested_username;
}
?>
