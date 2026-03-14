<?php
$conn = new mysqli("web.c4r4q0g4u6vz.us-east-1.rds.amazonaws.com", "admin", "StrongPassword123", "web");
if ($conn->connect_error) {
    die("Database connection failed");
}
?>