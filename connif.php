<?php

$host1 = "localhost";
$user1 = "jhcpl";
$pwd1 = "jhcgpl";
$db1 = "jhcpl";

$host2 = "localhost";
$user2 = "jhcpl";
$pwd2 = "jhcpl";
$db2 = "jhcpl";

// Create connection
$conn1 = new mysqli($host1, $user1, $pwd1, $db1);

// Check connection
if ($conn1->connect_error) {
  echo "error 1st";
  
  // Try second connection
  $conn2 = new mysqli($host2, $user2, $pwd2, $db2);

  if ($conn2->connect_error) {
    echo "error 2nd";
  } else {
    echo "second connection worked";
  }
} else {
  echo "first connection worked";
}
?>
