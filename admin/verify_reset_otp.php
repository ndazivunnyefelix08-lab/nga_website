<?php
session_start();

// If they haven't asked for a reset, send them back
if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entered_otp = trim($_POST['otp']);
    
    // Check if OTP is expired
    if (time() > $_SESSION['reset_expiry']) {
        $error = "This code has expired. Please request a new one.";
    } 
    // Check if OTP matches
    elseif ($entered_otp == $_SESSION['reset_otp']) {
        $_SESSION['otp_verified'] = true; // Give them the "key" to change password
        header("Location: reset_password.php");
        exit;
    } 
    else {
        $error = "Invalid 6-digit code. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify OTP | NGA Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        /* ================= BACK BUTTON ================= */
        .back-btn {
            position: absolute;
            top: 30px;
            left: 30px;
            z-index: 10;
            color: #042a41;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #ffffff;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .back-btn:hover {
            color: #ffffff;
            background: #e65c3d;
            transform: translateX(-5px);
            box-shadow: 0 6px 20px rgba(230, 92, 61, 0.2);
        }

        @media (max-width: 576px) {
            .back-btn {
                top: 15px;
                left: 15px;
                padding: 8px 15px;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body class="bg-light d-flex align-items-center vh-100">

    <a href="forgot_password.php" class="back-btn" data-aos="fade-right" data-aos-duration="800">
        <i class="fas fa-arrow-left"></i> Change Email
    </a>

    <div class="container d-flex justify-content-center">
        <div class="card p-5 shadow-sm" style="max-width: 450px; width: 100%; border-top: 4px solid #e65c3d;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
            
            <div class="text-center mb-4">
                <div class="mb-3" data-aos="zoom-in" data-aos-delay="400" style="color: #e65c3d; font-size: 2.5rem;">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 style="color: #042a41; font-weight: 800;" data-aos="fade-up" data-aos-delay="500">Check Your Email</h3>
                <p class="text-muted small" data-aos="fade-up" data-aos-delay="600">We sent a 6-digit code to <br><strong><?= htmlspecialchars($_SESSION['reset_email']); ?></strong></p>
            </div>
            
            <?php if($error): ?>
                <div class="alert alert-danger py-2 text-center small fw-bold" data-aos="shake" data-aos-delay="650">
                    <i class="fas fa-exclamation-circle me-1"></i> <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-4" data-aos="fade-up" data-aos-delay="700">
                    <input type="text" name="otp" class="form-control form-control-lg text-center fw-bold" placeholder="000000" maxlength="6" required autofocus style="letter-spacing: 5px; font-size: 1.5rem;">
                </div>
                
                <button type="submit" class="btn text-white w-100 fw-bold py-2" data-aos="fade-up" data-aos-delay="800" style="background-color: #042a41; transition: 0.3s;" onmouseover="this.style.backgroundColor='#021a28'" onmouseout="this.style.backgroundColor='#042a41'">
                    Verify Code &rarr;
                </button>
            </form>
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            offset: 50,
        });
    </script>
</body>
</html>