<?php
$servername = "localhost";
// $username = "root";
// $password = "";
// $database = "skanda";

$username = "skanda";
$password = "Anjaneya!123";
$database = "skanda";


// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
