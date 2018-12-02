<?php
$servername = "localhost";
$connUsername = "root";
$connPassword = "";
$dbname = "SOCIALMEDIA";

// Create connection
$conn = mysqli_connect($servername, $connUsername, $connPassword, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
