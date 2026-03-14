<?php
session_start();
if(!isset($_SESSION['admin'])){ header("Location: ../login.php"); exit; }

include "../config/db.php"; 

$message = "";
$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : null;

if (!$id) { header("Location: dashboard.php"); exit; }

// -------------------------------------------------------
// 1. Handle Form Update Submission
// -------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name   = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name    = mysqli_real_escape_string($conn, $_POST['last_name']);
    $father_name  = mysqli_real_escape_string($conn, $_POST['father_name']);
    $mother_name  = mysqli_real_escape_string($conn, $_POST['mother_name']);
    $gender       = mysqli_real_escape_string($conn, $_POST['gender']);
    $dob          = mysqli_real_escape_string($conn, $_POST['dob']);
    $marital_status = mysqli_real_escape_string($conn, $_POST['marital_status']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
    $national_id  = mysqli_real_escape_string($conn, $_POST['national_id']);
    $nationality  = mysqli_real_escape_string($conn, $_POST['nationality']);
    $country_residence = mysqli_real_escape_string($conn, $_POST['country_residence']);
    $sponsor      = mysqli_real_escape_string($conn, $_POST['sponsor']);
    $province     = mysqli_real_escape_string($conn, $_POST['province']);
    $district     = mysqli_real_escape_string($conn, $_POST['district']);
    $sector       = mysqli_real_escape_string($conn, $_POST['sector']);
    $cell         = mysqli_real_escape_string($conn, $_POST['cell']); // Added Cell
    $village      = mysqli_real_escape_string($conn, $_POST['village']); // Added Village
    $disability   = mysqli_real_escape_string($conn, $_POST['disability']);

    // Photo Update Logic
    $photo_query = "";
    if (!empty($_FILES['passport_photo']['name'])) {
        $file_name = time() . '_' . basename($_FILES['passport_photo']['name']);
        $target_file = "../uploads/passports/" . $file_name;
        if (move_uploaded_file($_FILES['passport_photo']['tmp_name'], $target_file)) {
            $photo_path = "uploads/passports/" . $file_name;
            $photo_query = ", passport_photo_path = '$photo_path'";
        }
    }

    $sql = "UPDATE personal_info SET 
            first_name='$first_name', last_name='$last_name', father_name='$father_name', 
            mother_name='$mother_name', gender='$gender', date_of_birth='$dob', 
            marital_status='$marital_status', phone_number='$phone_number', email_address='$email_address', 
            national_id_number='$national_id', nationality='$nationality', country_of_residence='$country_residence', 
            sponsor='$sponsor', province='$province', district='$district', sector='$sector', 
            cell='$cell', village='$village',
            disability='$disability' $photo_query 
            WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        $message = '<div class="alert alert-success d-print-none">Student record updated successfully!</div>';
    } else {
        $message = '<div class="alert alert-danger d-print-none">Error: ' . mysqli_error($conn) . '</div>';
    }
}

// -------------------------------------------------------
// 2. Fetch Existing Data
// -------------------------------------------------------
$query = mysqli_query($conn, "SELECT * FROM personal_info WHERE id = '$id'");
$student = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student - <?= $student['first_name'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f5f7fa; }
        .card { border-radius: 10px; border: none; }
        .passport-upload-area {
            width: 100%; height: 170px; background: #e9ecef;
            border: 2px dashed #999; border-radius: 10px;
            display:flex; align-items:center; justify-content:center;
            overflow: hidden; cursor:pointer;
        }
        .passport-upload-area img { width: 100%; height: 100%; object-fit: cover; }
        
        @media print {
            .d-print-none, .btn, footer { display: none !important; }
            body { background: white; }
            .card { box-shadow: none !important; border: 1px solid #eee; }
            input, select { border: none !important; background: transparent !important; appearance: none; -webkit-appearance: none; }
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-3 d-print-none">
                <a href="students.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <h2 class="text-center mb-1">Student Record Detail</h2>
                    <p class="text-center text-primary fw-bold mb-4">Program: <?= htmlspecialchars($student['reference_person_phone']); ?></p>

                    <?= $message; ?>

                    <form method="POST" enctype="multipart/form-data">
                        <h5 class="text-primary mb-3">Student Enrollment Information</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 mb-3 text-center">
                                <div id="passport_preview" class="passport-upload-area">
                                    <?php if(!empty($student['passport_photo_path'])): ?>
                                        <img src="../<?= $student['passport_photo_path'] ?>">
                                    <?php else: ?>
                                        <span>Click to Upload</span>
                                    <?php endif; ?>
                                </div>
                                <input type="file" name="passport_photo" id="passport_photo" accept="image/*" class="d-none">
                                <small class="text-muted d-print-none">Click photo to change</small>
                            </div>

                            <div class="col-md-9">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">First Name</label>
                                        <input name="first_name" class="form-control" value="<?= $student['first_name'] ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Last Name</label>
                                        <input name="last_name" class="form-control" value="<?= $student['last_name'] ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Gender</label>
                                        <select name="gender" class="form-select" required>
                                            <option <?= $student['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                            <option <?= $student['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Date of Birth</label>
                                        <input id="dob" name="dob" class="form-control" value="<?= $student['date_of_birth'] ?>" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Marital Status</label>
                                        <select name="marital_status" class="form-select" required>
                                            <option <?= $student['marital_status'] == 'Single' ? 'selected' : '' ?>>Single</option>
                                            <option <?= $student['marital_status'] == 'Married' ? 'selected' : '' ?>>Married</option>
                                            <option <?= $student['marital_status'] == 'Divorced' ? 'selected' : '' ?>>Divorced</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="text-primary mt-4 mb-3">Guardian & Contact Info</h5>
                        <hr>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Father's Name</label>
                                <input name="father_name" class="form-control" value="<?= $student['father_name'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mother's Name</label>
                                <input name="mother_name" class="form-control" value="<?= $student['mother_name'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input name="phone_number" class="form-control" value="<?= $student['phone_number'] ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email_address" class="form-control" value="<?= $student['email_address'] ?>" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">National ID / Passport</label>
                                <input name="national_id" class="form-control" value="<?= $student['national_id_number'] ?>" required>
                            </div>
                        </div>

                        <h5 class="text-primary mt-4 mb-3">Address & Other Details</h5>
                        <hr>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Nationality</label>
                                <input name="nationality" class="form-control" value="<?= $student['nationality'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Country</label>
                                <input name="country_residence" class="form-control" value="<?= $student['country_of_residence'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Province</label>
                                <input name="province" class="form-control" value="<?= $student['province'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">District</label>
                                <input name="district" class="form-control" value="<?= $student['district'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Sector</label>
                                <input name="sector" class="form-control" value="<?= $student['sector'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Cell</label>
                                <input name="cell" class="form-control" value="<?= $student['cell'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Village</label>
                                <input name="village" class="form-control" value="<?= $student['village'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Sponsor</label>
                                <input name="sponsor" class="form-control" value="<?= $student['sponsor'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Disability Status</label>
                                <select name="disability" class="form-select">
                                    <option <?= $student['disability'] == 'None' ? 'selected' : '' ?>>None</option>
                                    <option <?= $student['disability'] == 'Physical' ? 'selected' : '' ?>>Physical</option>
                                    <option <?= $student['disability'] == 'Visual' ? 'selected' : '' ?>>Visual</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-end mt-4 d-print-none">
                            <button type="submit" class="btn btn-primary px-5 py-2">Update Student Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.js"></script>

<script>
    flatpickr("#dob", { dateFormat: "Y-m-d", altInput: true, altFormat: "F j, Y" });

    document.getElementById('passport_preview').onclick = () => document.getElementById('passport_photo').click();
    
    document.getElementById('passport_photo').onchange = function () {
        if (this.files[0]) {
            document.getElementById('passport_preview').innerHTML =
                `<img src="${URL.createObjectURL(this.files[0])}">`;
        }
    };
</script>
</body>
</html>