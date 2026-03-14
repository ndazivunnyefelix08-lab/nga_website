<?php
session_start();
if(!isset($_SESSION['admin'])){ header("Location: ../login.php"); exit; }
include "../config/db.php"; 

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : null;
if (!$id) { header("Location: dashboard.php"); exit; }

// Fetch Data
$query = mysqli_query($conn, "SELECT * FROM personal_info WHERE id = '$id'");
$s = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Record - <?= $s['first_name'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f5f7fa; }
        .card { border-radius: 10px; border: none; }
        .passport-preview { width: 140px; height: 160px; object-fit: cover; border: 1px solid #eee; }
        
        /* --- PRINT STYLES: FORCE A4 PORTRAIT SINGLE PAGE --- */
        @media print {
            @page { size: A4 portrait; margin: 15mm; }
            
            /* Hide UI Elements */
            .d-print-none, .btn, .sidebar, .alert, hr { display: none !important; }
            
            body { background: white !important; padding: 0; margin: 0; font-size: 11px; line-height: 1.4; }
            .container { width: 100% !important; max-width: 100% !important; margin: 0 !important; }
            .card { border: none !important; box-shadow: none !important; }

            /* Remove Input Boxes - Show Only Text */
            input, select, textarea {
                border: none !important;
                background: transparent !important;
                padding: 0 !important;
                font-weight: 500;
                appearance: none;
                -webkit-appearance: none;
                color: black !important;
                width: auto !important;
                display: inline-block !important;
            }

            /* Labels Style for Print */
            .form-label {
                font-weight: 700;
                color: #555;
                margin-right: 5px;
                text-transform: uppercase;
                font-size: 9px;
                display: block;
                margin-bottom: 0;
            }

            /* Layout Adjustments */
            .row { margin-bottom: 8px !important; }
            .col-md-3, .col-md-4, .col-md-6, .col-md-2 {
                padding-bottom: 5px;
                border-bottom: 0.5px solid #f0f0f0; 
            }

            .passport-preview { 
                width: 110px; 
                height: 120px; 
                float: right; 
                margin-bottom: 10px;
            }
            
            h2 { font-size: 20px; color: black; margin-bottom: 15px !important; text-align: left !important; }
            h5 { font-size: 13px; color: #0d6efd; margin-top: 15px !important; border-bottom: 2px solid #0d6efd; display: inline-block; }
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 d-print-none">
        <div>
            <a href="students.php" class="btn btn-outline-secondary px-4 me-2">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
           <a href="edit_student.php?id=<?= $id ?>" class="btn btn-warning px-4">
                <i class="fas fa-edit"></i> Edit Record
            </a>
        </div>
        
        <button onclick="window.print()" class="btn btn-primary px-4">
            <i class="fas fa-print"></i> Print Official Document
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-5">
            <div class="row mb-4">
                <div class="col-8">
                    <h2 class="fw-bold">STUDENT ENROLLMENT RECORD</h2>
                    <p class="text-primary fw-bold">Program: <?= htmlspecialchars($s['reference_person_phone']) ?></p>
                </div>
                <div class="col-4 text-end">
                    <?php 
                        $photo = !empty($s['passport_photo_path']) ? "../".$s['passport_photo_path'] : '../assets/img/default-user.png';
                    ?>
                    <img src="<?= $photo ?>" class="passport-preview" alt="Student Photo">
                </div>
            </div>
            
            <form>
                <h5 class="mb-3">Personal Details</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input class="form-control" value="<?= $s['first_name'] ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input class="form-control" value="<?= $s['last_name'] ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Gender</label>
                        <input class="form-control" value="<?= $s['gender'] ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Date of Birth</label>
                        <input class="form-control" value="<?= $s['date_of_birth'] ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Marital Status</label>
                        <input class="form-control" value="<?= $s['marital_status'] ?>" readonly>
                    </div>
                </div>

                <h5 class="mt-4 mb-3">Contact & Identity</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <input class="form-control" value="<?= $s['phone_number'] ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Address</label>
                        <input class="form-control" value="<?= $s['email_address'] ?>" readonly>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">National ID / Passport Number</label>
                        <input class="form-control" value="<?= $s['national_id_number'] ?>" readonly>
                    </div>
                </div>

                <h5 class="mt-4 mb-3">Family Information</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Father / Guardian Name</label>
                        <input class="form-control" value="<?= $s['father_name'] ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Mother / Guardian Name</label>
                        <input class="form-control" value="<?= $s['mother_name'] ?>" readonly>
                    </div>
                </div>

                <h5 class="mt-4 mb-3">Residence Details</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Nationality</label>
                        <input class="form-control" value="<?= $s['nationality'] ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Country</label>
                        <input class="form-control" value="<?= $s['country_of_residence'] ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Province</label>
                        <input class="form-control" value="<?= $s['province'] ?>" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">District</label>
                        <input class="form-control" value="<?= $s['district'] ?>" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Sector</label>
                        <input class="form-control" value="<?= $s['sector'] ?>" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Cell</label>
                        <input class="form-control" value="<?= $s['cell'] ?>" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Village</label>
                        <input class="form-control" value="<?= $s['village'] ?>" readonly>
                    </div>
                </div>

                <div class="row mt-5 pt-4 d-none d-print-flex">
                    <div class="col-6 text-center">
                        <p class="border-top pt-2">Student Signature</p>
                    </div>
                    <div class="col-6 text-center">
                        <p class="border-top pt-2">Registrar Signature & Stamp</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>