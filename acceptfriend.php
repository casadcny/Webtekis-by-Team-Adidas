<?php
include 'database.php';

$friend = $_POST['idno'];
$myid = $_POST['myid'];
$sql = "INSERT INTO friends (f1, f2) VALUES ($friend, $myid)";
$sql2 = "INSERT INTO friends (f1, f2) VALUES ($myid, $friend)";
$sqlaccept = "UPDATE requests SET status='accepted' WHERE toid=$myid";
if ($conn->query($sql) === TRUE) {
  if ($conn->query($sql2) === TRUE){
    if ($conn->query($sqlaccept) === TRUE){
        header("Location: friends.php");
    }
  }
} else {
  echo "<h2><a href='friends.php'>Error in request. Please try again</a></h2>";
}

 ?>
