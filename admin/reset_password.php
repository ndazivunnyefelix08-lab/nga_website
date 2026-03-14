<?php
session_start();
include "../config/db.php";

// Ensure they verified the OTP first
if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
    header("Location: forgot_password.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    if ($new_pass === $confirm_pass) {
        // Update the password in the database
        $email = $_SESSION['reset_email'];
        
        $stmt = $conn->prepare("UPDATE admin_users SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $new_pass, $email);
        
        if ($stmt->execute()) {
            session_destroy();
            header("Location: login.php?success=Password updated! Please login.");
            exit;
        } else {
            $error = "Failed to update password. Please try again.";
        }
    } else {
        $error = "Passwords do not match. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Password | NGA Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --sk-blue: #042a41;
            --sk-orange: #e65c3d;
            --sk-bg-gray: #f8f9fa;
        }
        body {
            font-family: 'Manrope', sans-serif;
            background-color: var(--sk-bg-gray);
            overflow-x: hidden; /* Prevents horizontal scrollbar during AOS animations */
        }
        .input-icon-wrapper {
            position: relative;
        }
        .input-icon-wrapper i {
            position: absolute;
            left: 15px;
            top: 14px;
            color: #a0aec0;
        }
        .input-icon-wrapper input {
            padding: 10px 15px 10px 45px;
            background: var(--sk-bg-gray);
            border: 1px solid #edf2f7;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <main class="flex-grow-1 d-flex justify-content-center align-items-center py-5" style="background-image: radial-gradient(rgba(0,0,0,0.05) 1px, transparent 1px); background-size: 4px 4px;">
        <div class="card p-5 shadow-lg border-0" data-aos="fade-up" data-aos-duration="800" style="max-width: 450px; width: 100%; border-top: 4px solid var(--sk-orange) !important;">
            
            <div class="text-center mb-4">
                <div class="mb-3" data-aos="zoom-in" data-aos-delay="200" style="color: var(--sk-orange); font-size: 2.5rem;">
                    <i class="fas fa-lock"></i>
                </div>
                <h3 style="color: var(--sk-blue); font-weight: 800;" data-aos="fade-up" data-aos-delay="300">Create New Password </h3>
                <p class="text-muted small" data-aos="fade-up" data-aos-delay="400">Enter your new password below.</p>
            </div>
            
            <?php if ($error): ?>
                <div class="alert alert-danger py-2 text-center small fw-bold" data-aos="shake">
                    <i class="fas fa-exclamation-circle me-1"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3 text-start" data-aos="fade-right" data-aos-delay="500">
                <label class="form-label fw-bold small text-uppercase" style="color: var(--sk-blue); letter-spacing: 0.5px;">Enter New Password</label>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-key"></i>
                        <input type="password" name="new_password" class="form-control" placeholder="" required minlength="6">
                    </div>
                </div>

                <div class="mb-4 text-start" data-aos="fade-right" data-aos-delay="600">
        <label class="form-label fw-bold small text-uppercase" style="color: var(--sk-blue); letter-spacing: 0.5px;">Confirm New Password</label>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-check-circle"></i>
                        <input type="password" name="confirm_password" class="form-control" placeholder="" required minlength="6">
                    </div>
                </div>

                <button type="submit" class="btn text-white w-100 fw-bold py-2" data-aos="fade-up" data-aos-delay="700" style="background-color: var(--sk-orange); transition: 0.3s;" onmouseover="this.style.backgroundColor='#cf4f33'" onmouseout="this.style.backgroundColor='var(--sk-orange)'">
                    Update Password &rarr;
                </button>
            </form>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true, // Animation happens only once
            offset: 50, // Offset (in px) from the original trigger point
        });
    </script>
</body>
</html>