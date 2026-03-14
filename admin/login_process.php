<?php
include "../config/db.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login_input = trim($_POST['username']); // This is the email from your database screenshot
    $password = $_POST['password'];

    // 1. Fetch user where 'username' matches the input email
    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE USERNAME = ?");
    $stmt->bind_param("s", $login_input);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // 2. Validate Password (Important: using plain text as per your screenshot)
    if ($user && $password === $user['password']) {
        
        // 3. Setup 2FA
        $code = rand(100000, 999999);
        $_SESSION['2fa_code'] = $code;
        $_SESSION['2fa_expiry'] = time() + (10 * 60); // 10 minutes
        $_SESSION['temp_admin_user'] = $user['username']; // Storing the email address

        // 4. Send Email to the address found in the 'username' column
        $to = $user['username']; 
        $subject = "Your Admin Verification Code: $code";
        
        // Anti-Spam Headers
        $headers = "From: New generation Academy <info@nga.ac.rw>\r\n";
        $headers .= "Reply-To: info@nga.ac.rw\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        $message = "
        <div style='font-family: Arial, sans-serif; max-width: 500px; margin: auto; border: 1px solid #eee; padding: 20px;'>
            <h2 style='color: #042a41;'>Login Verification</h2>
            <p>Use the code below to complete your login:</p>
            <div style='background: #f8f9fa; padding: 15px; text-align: center; font-size: 30px; font-weight: bold; color: #e65c3d; letter-spacing: 5px;'>
                $code
            </div>
            <p style='font-size: 12px; color: #888; margin-top: 20px;'>This code will expire in 10 minutes.</p>
        </div>";

        if (mail($to, $subject, $message, $headers)) {
            header("Location: verify_2fa.php");
            exit;
        } else {
            header("Location: login.php?error=Unable to send email. Check server configuration.");
            exit;
        }
    } else {
        header("Location: login.php?error=Invalid email or password.");
        exit;
    }
}