<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password | NGA</title>
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
<body>
    
    <a href="login.php" class="back-btn" data-aos="fade-right" data-aos-duration="800">
        <i class="fas fa-arrow-left"></i> Back to Login
    </a>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-sm" style="max-width: 400px; width: 100%; border-top: 4px solid #e65c3d;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
            
            <div class="text-center mb-3" data-aos="zoom-in" data-aos-delay="400" style="color: #e65c3d; font-size: 2rem;">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            
            <h3 class="text-center" style="color: #042a41; font-weight: 800;" data-aos="fade-up" data-aos-delay="500">Reset Password</h3>
            <p class="text-muted text-center small mb-4" data-aos="fade-up" data-aos-delay="600">Enter your email to receive a reset OTP.</p>
            
            <?php if(isset($_GET['error'])): ?>
                <div class="alert alert-danger py-2 text-center small fw-bold" data-aos="shake" data-aos-delay="650">
                    <i class="fas fa-exclamation-circle me-1"></i> <?= htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="send_reset_otp.php">
                <div class="mb-4" data-aos="fade-right" data-aos-delay="700">
                    <label class="form-label fw-bold small text-uppercase" style="color: #042a41; letter-spacing: 0.5px;">Admin Email</label>
                    <input type="email" name="email" class="form-control" placeholder="example@gmail.com" required style="padding: 10px 15px; background: #f8f9fa; border: 1px solid #edf2f7;">
                </div>
                
                <button type="submit" class="btn text-white w-100 fw-bold py-2" data-aos="fade-up" data-aos-delay="800" style="background-color: #042a41; border: none; transition: 0.3s;" onmouseover="this.style.backgroundColor='#021a28'" onmouseout="this.style.backgroundColor='#042a41'">
                    Send OTP &rarr;
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