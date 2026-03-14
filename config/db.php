<?php
$host = "172.31.92.156";
$user = "web";
$password = "nga12345";
$database = "mysql";
$port = 3306;

$conn = mysqli_connect($host,$user,$password,$database,$port);

if(!$conn){
    die("Database connection failed: ".mysqli_connect_error());
}

echo "Connected successfully";

?>