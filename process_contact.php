<?php
// Process only if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Sanitize and fetch the input data (Updated for modern PHP 8+)
    $name = htmlspecialchars(trim($_POST["contact_name"]), ENT_QUOTES, 'UTF-8');
    $email = filter_var(trim($_POST["contact_email"]), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST["contact_subject"]), ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars(trim($_POST["contact_message"]), ENT_QUOTES, 'UTF-8');

    // The URL of the page where your contact form lives 
    $redirect_url = "index.php";

    // 2. Validate the data
    if (empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // If validation fails, redirect back with an error status
        header("Location: " . $redirect_url . "?contact_status=error#contact");
        exit;
    }

    // 3. Set up the email details
    $recipient = "info@nga.ac.rw"; 

    // Build the email content
    $email_subject = "New Contact Form Message: $subject";
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers
    $email_headers = "From: $name <$email>";

    // 4. Send the email and redirect based on success/failure
    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        // Success! Redirect with the success status (Order fixed: ? before #)
        header("Location: " . $redirect_url . "?contact_status=success#contact");
        exit;
    } else {
        // Failed to send the email
        header("Location: " . $redirect_url . "?contact_status=error#contact");
        exit;
    }

} else {
    // If someone tries to access this file directly without submitting the form, send them back
    header("Location: index.php");
    exit;
}
?>