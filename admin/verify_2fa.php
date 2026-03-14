<?php
session_start();
if (!isset($_SESSION['temp_admin_user'])) {
    header("Location: login.php");
    exit;
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entered_code = trim($_POST['auth_code']);
    
    if (time() > $_SESSION['2fa_expiry']) {
        $error = "Code expired. Please login again.";
    } elseif ($entered_code == $_SESSION['2fa_code']) {
        // SUCCESS
        $_SESSION['admin'] = $_SESSION['temp_admin_user'];
        unset($_SESSION['2fa_code'], $_SESSION['2fa_expiry'], $_SESSION['temp_admin_user']);
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid code. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Two-Step Verification | NGA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body style="background-color: #f8f9fa; display: flex; align-items: center; min-height: 100vh;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg border-0" style="border-top: 4px solid #e65c3d !important;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-4" style="color: #e65c3d; font-size: 3rem;">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 style="color: #042a41; font-weight: 800;">Verify Your Identity</h3>
                        <p class="text-muted">A code was sent to: <br><strong><?= htmlspecialchars($_SESSION['temp_admin_user']) ?></strong></p>

                        <?php if($error): ?>
                            <div class="alert alert-danger py-2 small"><?= $error ?></div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-4">
                                <label class="form-label d-block text-start fw-bold small text-uppercase">Enter 6-Digit Code</label>
                                <input type="text" name="auth_code" class="form-control form-control-lg text-center fw-bold" placeholder="000000" maxlength="6" required autofocus>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 fw-bold py-3" style="background-color: #e65c3d; border: none;">
                                Verify and Sign In
                            </button>
                        </form>
                        
                        <div class="mt-4">
                            <a href="login.php" class="text-decoration-none small text-muted">Cancel and go back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script>
</body>
</html>