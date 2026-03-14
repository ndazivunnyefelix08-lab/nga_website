<?php
// 1. Host MUST be the AWS RDS Endpoint
$host = "web.c4r4q0g4u6vz.us-east-1.rds.amazonaws.com"; 
// 2. User MUST be your master username (or a specifically created user)
$user = "admin"; 
// 3. Password MUST be your master password for the admin user
$password = "Felix12345!"; 
$database = "mysql";
$port = 3306;
$conn = mysqli_connect($host, $user, $password, $database, $port);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>