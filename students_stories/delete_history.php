<?php
// Connect to database
$conn = mysqli_connect("localhost", "ngarw_spes", "ngarw_spes", "ngarw_spes");
if (!$conn) {
    die("Database connection failed");
}

// Get the ID from URL
if (!isset($_GET['id'])) {
    header("Location: add_history.php");
    exit;
}

$id = intval($_GET['id']); // sanitize

// Get the student photo file name
$q = mysqli_query($conn, "SELECT photo FROM students_history WHERE id=$id");
$data = mysqli_fetch_assoc($q);

// Delete photo from uploads folder
if ($data && file_exists("../uploads/" . $data['photo'])) {
    unlink("../uploads/" . $data['photo']);
}

// Delete record from database
mysqli_query($conn, "DELETE FROM students_history WHERE id=$id");

// Redirect back to dashboard
header("Location: add_history.php");
exit;