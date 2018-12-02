<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS SOCIALMEDIA";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

// Change database to "test"
mysqli_select_db($conn,"SOCIALMEDIA");

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS USER (
user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(30) NOT NULL UNIQUE,
username VARCHAR(30) NOT NULL UNIQUE,
password VARCHAR(50) NOT NULL,
registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
last_login_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table USER created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
