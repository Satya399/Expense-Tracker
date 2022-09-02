<?php
$username = "root";
$servername = 'localhost';
$db_password = "Mysql@1";
$conn = new mysqli($servername, $username, $db_password);
if($conn->connect_error) {
  die ("Connected failed : " . $conn->connect_error);
}

 ?>
