<?php
   include 'database.php';

   $sql = "SELECT * FROM friends JOIN users on idno=f2 WHERE f1='$_SESSION[idno]'";
   $result = $conn->query($sql);

     ?>
<!DOCTYPE html>
<html>
 <head>
   <meta charset="utf-8">
   <title>Friends</title>
 </head>
 <body>
   <?php
   include 'navbar.php';

   $reqsql = "SELECT * FROM requests JOIN users ON requests.fromid=users.idno WHERE (requests.toid=$_SESSION[idno] AND requests.status='pending')";

   $reqresult = $conn->query($reqsql);

   if($reqresult->num_rows > 0){
     ?>
     <table>
       <thead>
         <th>ID Number</th>
         <th>Name</th>
         <th>Action</th>
       </thead>
     <?php
   while ($reqrows = $reqresult->fetch_assoc()) {
     ?>
     <tr>
       <td><?php echo $reqrows['idno'] ?></td>
       <td><?php echo $reqrows['firstname'] . " " . $reqrows['lastname'] ?></td>
       <form action="acceptfriend.php" method="post">
         <input type="hidden" name="idno" value="<?php echo $reqrows['idno'] ?>">
         <input type="hidden" name="myid" value="<?php echo $_SESSION['idno'] ?>">
         <td><input type="submit" value="Accept Friend"></td>
       </form>
     </tr>
     <?php
   }
 } else {
   echo "<h2>No pending friend requests.</h2>";
 }

   if($result->num_rows > 0){
     ?>
     <table>
       <thead>
         <th>ID Number</th>
         <th>Name</th>
         <th>Action</th>
       </thead>
     <?php
   while ($rows = $result->fetch_assoc()) {
     ?>
     <tr>
       <td><?php echo $rows['idno'] ?></td>
       <td><?php echo $rows['firstname'] . " " . $rows['lastname'] ?></td>
       <form action="unfriend.php" method="post">
         <input type="hidden" name="idno" value="<?php echo $rows['idno'] ?>">
         <input type="hidden" name="myid" value="<?php echo $_SESSION['idno'] ?>">
         <td><input type="submit" value="Unfriend"></td>
       </form>
     </tr>
     <?php
   }
 } else {
   echo "<h2>Forever Alone???</h2>";
 }
?>
   </table>
 </body>
</html>
