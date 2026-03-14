<?php
include "../config/db.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    // Check if email exists in username column
    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user) {
        $otp = rand(100000, 999999);
        $_SESSION['reset_otp'] = $otp;
        $_SESSION['reset_email'] = $email;
        $_SESSION['reset_expiry'] = time() + (15 * 60); // 15 mins

        $subject = "Password Reset OTP: $otp";
        $headers = "From: NGA Security <info@nga.ac.rw>\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        $message = "<h2>Password Reset</h2>
                    <p>Your OTP for resetting your password is: <b>$otp</b></p>
                    <p>If you didn't request this, ignore this email.</p>";

        if (mail($email, $subject, $message, $headers)) {
            header("Location: verify_reset_otp.php");
            exit;
        }
    }
    header("Location: forgot_password.php?error=Email not found.");
}