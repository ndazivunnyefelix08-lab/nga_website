<?php
// Note: Changed the 4th parameter from "web" to "mysql"
$conn = new mysqli("web.c4r4q0g4u6vz.us-east-1.rds.amazonaws.com", "web", "Kigali@@12345!!", "mysql");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

echo "Connected successfully to AWS RDS!";
?>