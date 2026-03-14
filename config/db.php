<?php
$conn = new mysqli("localhost", "root", "", "nga_deployment");
if ($conn->connect_error) {
    die("Database connection failed");
}
?>