<?php
// Turn on error reporting just in case there are other hidden issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../config/db.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login_input = trim($_POST['username']); 
    $password = $_POST['password'];

    // Ensure the database connection exists
    if (!isset($conn) || !$conn) {
        die("Database connection failed. Please check config/db.php.");
    }

    // 1. Fetch user (Using exact column name to be safe)
    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
    
    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("s", $login_input);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Fix the Uppercase/Lowercase Trap: Force all array keys to lowercase
    if ($user) {
        $user = array_change_key_case($user, CASE_LOWER);
    }

    // 2. Validate Password (using plain text as per your screenshot)
    if ($user && $password === $user['password']) {
        
        // 3. Setup 2FA
        $code = rand(100000, 999999);
        $_SESSION['2fa_code'] = $code;
        $_SESSION['2fa_expiry'] = time() + (10 * 60); // 10 minutes
        $_SESSION['temp_admin_user'] = $user['username']; 

        // 4. Send Email
        $to = $user['username']; 
        $subject = "Your Admin Verification Code: $code";
        
        $headers = "From: New Generation Academy <info@nga.ac.rw>\r\n";
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

        // Suppress the raw PHP warning if mail() is not configured on AWS yet
        $mail_sent = @mail($to, $subject, $message, $headers);

        if ($mail_sent) {
            header("Location: verify_2fa.php");
            exit;
        } else {
            // THE AWS WORKAROUND: If mail fails, send the code in the URL just for testing!
            // (Note: You should remove the code from the URL once you configure AWS email via SMTP)
            header("Location: verify_2fa.php?error=AWS Mail not configured yet. TESTING CODE: " . $code);
            exit;
        }
    } else {
        header("Location: login.php?error=Invalid email or password.");
        exit;
    }
}
?>