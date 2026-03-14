<?php
// Include your database connection
include "config/db.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize the inputs
    $name = trim($_POST['subscriber_name'] ?? '');
    $email = trim($_POST['subscriber_email'] ?? '');

    // Validate inputs
    if (empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Redirect back with error status and jump to #newsletter
        header("Location: index.php?nl_status=error#newsletter");
        exit;
    }

    // Check if the email already exists in the database
    $checkStmt = $conn->prepare("SELECT id FROM newsletter_subscribers WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        $checkStmt->close();
        // Redirect back saying it exists and jump to #newsletter
        header("Location: index.php?nl_status=exists#newsletter");
        exit;
    }
    $checkStmt->close();

    // Insert the new subscriber
    $insertStmt = $conn->prepare("INSERT INTO newsletter_subscribers (name, email) VALUES (?, ?)");
    $insertStmt->bind_param("ss", $name, $email);

    if ($insertStmt->execute()) {
        // Redirect back with SUCCESS status and jump to #newsletter
        header("Location: index.php?nl_status=success#newsletter");
    } else {
        // Redirect back with error status and jump to #newsletter
        header("Location: index.php?nl_status=error#newsletter");
    }
    
    $insertStmt->close();
} else {
    // If someone tries to access this file directly, send them home
    header("Location: index.php");
}

$conn->close();
?>