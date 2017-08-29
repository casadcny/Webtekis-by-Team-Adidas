<?php
include 'database.php';
$toid = $_POST['toid'];
$fromid = $_POST['fromid'];

echo $fromid . " " . $toid;

$sql = "INSERT INTO requests (fromid, toid, status) VALUES ('$fromid', '$toid', 'pending')";

if ($conn->query($sql) === TRUE) {
  echo "<h1><a href='friends.php'>Request Sent! Please wait for confirmation.</a></h1>";
} else {
  echo "<h1><a href='friends.php'>Error in request. Please try again</a></h1>";
}

 ?>
