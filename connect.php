<?php
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "fruitsandvegetables";

// Create connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
