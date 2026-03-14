<?php
$host = "web.c4r4q0g4u6vz.us-east-1.rds.amazonaws.com";
$user = "admin";
$password = "nga12345";
$database = "mysql";
$port = 3306;

$conn = mysqli_connect($host,$user,$password,$database,$port);

if(!$conn){
    die("Database connection failed: ".mysqli_connect_error());
}

echo "Connected successfully";

?>