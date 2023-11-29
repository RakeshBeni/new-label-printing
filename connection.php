<?php 

$servername = "89.117.157.168";
$username = "u359658933_authenfitplus";
$password = "G00dL1fe$$$$";
$dbname = "u359658933_authenfitplus";


$servername1 = "localhost";
$username1 = "root";
$password1 = "";
$dbname1 = "new_labelprinting";

$conn = new mysqli($servername, $username, $password, $dbname);
$con = new mysqli($servername1, $username1, $password1, $dbname1);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>

