<?php 
include "../config/db.php"; 

/* =========================
    LOAD SITE SETTINGS
========================= */
$settings = [];
if (isset($conn)) {
    $set = $conn->query("SELECT * FROM site_settings");
    if ($set) {
        while ($row = $set->fetch_assoc()) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | <?= htmlspecialchars($settings['site_title'] ?? 'NGA'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* ================= NGA EXACT COLORS & VARIABLES ================= */
        :root {
            --sk-blue: #042a41;
            --sk-darker-blue: #021a28;
            --sk-orange: #e65c3d;
            --sk-orange-hover: #cf4f33;
            --sk-bg-gray: #f8f9fa;
            --sk-text: #6b7a85;
            --font-main: 'Manrope', sans-serif;
        }

        body {
            font-family: var(--font-main);
            background-color: var(--sk-bg-gray);
            color: var(--sk-text);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            color: var(--sk-blue);
            font-weight: 800;
        }

        /* ================= BACK BUTTON ================= */
        .back-btn {
            position: absolute;
            top: 30px;
            left: 30px;
            z-index: 10;
            color: var(--sk-blue);
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
            background: var(--sk-orange);
            transform: translateX(-5px); /* Gentle slide left on hover */
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

        /* ================= LOGIN PORTAL HERO & CARD ================= */
        .admin-hero {
            flex-grow: 1;
            position: relative;
            background-color: var(--sk-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
        }
        
        /* The signature dot matrix overlay */
        .admin-hero::before {
            content: '';
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background-image: radial-gradient(rgba(0,0,0,0.2) 1px, transparent 1px);
            background-size: 4px 4px;
            z-index: 1;
        }
        
        .login-wrapper {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 450px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 4px;
            border-top: 4px solid var(--sk-orange);
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            padding: 50px 40px;
            text-align: center;
        }

        .login-icon-box {
            width: 70px; height: 70px;
            background: rgba(230, 92, 61, 0.1);
            color: var(--sk-orange);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px auto;
            font-size: 1.8rem;
        }

        .login-card h3 { font-size: 1.8rem; margin-bottom: 5px; }
        .login-card p { color: var(--sk-text); font-size: 0.95rem; margin-bottom: 30px; }

        .form-group { text-align: left; margin-bottom: 20px; position: relative; }
        .form-group label { display: block; font-size: 0.85rem; font-weight: 700; color: var(--sk-blue); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-control-icon { position: absolute; left: 15px; top: 41px; color: #a0aec0; }
        
        .form-control {
            background: var(--sk-bg-gray);
            border: 1px solid #edf2f7;
            border-radius: 4px;
            padding: 12px 15px 12px 45px;
            font-size: 0.95rem;
            color: var(--sk-blue);
            font-weight: 500;
            width: 100%;
            transition: 0.3s;
        }
        .form-control:focus {
            background: #ffffff;
            border-color: var(--sk-orange);
            box-shadow: 0 0 0 3px rgba(230, 92, 61, 0.1);
            outline: none;
        }

        .btn-sk-login {
            background-color: var(--sk-orange);
            color: #ffffff;
            border: none;
            width: 100%;
            padding: 14px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            margin-top: 10px;
            cursor: pointer;
        }
        .btn-sk-login:hover {
            background-color: var(--sk-orange-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(230, 92, 61, 0.2);
        }

        .alert-error {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.2);
            padding: 12px;
            border-radius: 4px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 25px;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
    </style>
</head>
<body>

    <main class="admin-hero">
        
        <a href="../index.php" class="back-btn" data-aos="fade-right" data-aos-duration="800">
            <i class="fas fa-arrow-left"></i> Back to Website
        </a>

        <div class="login-wrapper">
            <div class="login-card" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                
                <div class="login-icon-box" data-aos="zoom-in" data-aos-delay="400">
                    <i class="fas fa-shield-alt"></i>
                </div>
               
                <h3 data-aos="fade-up" data-aos-delay="500">Admin Portal</h3>
                <p data-aos="fade-up" data-aos-delay="600">Secure access to the management dashboard.</p>

                <?php if(isset($_GET['error'])): ?>
                    <div class="alert-error" data-aos="flip-up" data-aos-delay="650">
                        <i class="fas fa-exclamation-circle"></i>
                        <?= htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php endif; ?>

                <?php if(isset($_GET['success'])): ?>
                    <div class="alert alert-success py-2 text-center small fw-bold" data-aos="flip-up" data-aos-delay="650">
                        <i class="fas fa-check-circle"></i>
                        <?= htmlspecialchars($_GET['success']); ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="login_process.php">
                    <div class="form-group" data-aos="fade-right" data-aos-delay="700">
                        <label for="username">Email</label>
                        <i class="fas fa-user form-control-icon"></i>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group mb-2" data-aos="fade-right" data-aos-delay="800"> 
                        <label for="password">Password</label>
                        <i class="fas fa-lock form-control-icon"></i>
                        <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                    </div>

                    <div class="text-end mb-4" data-aos="fade-left" data-aos-delay="900">
                        <a href="forgot_password.php" class="text-decoration-none fw-bold small" style="color: var(--sk-orange); transition: 0.3s;" onMouseOver="this.style.color='var(--sk-orange-hover)'" onMouseOut="this.style.color='var(--sk-orange)'">
                            Forgot Password?
                        </a>
                    </div>

                    <button type="submit" class="btn-sk-login" data-aos="fade-up" data-aos-delay="1000">
                        Sign In &rarr;
                    </button>
                </form>

            </div>
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