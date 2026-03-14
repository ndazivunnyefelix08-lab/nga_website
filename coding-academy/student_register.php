<?php
include "config/db.php"; 
include 'include/header.php'; 

$message = "";

// -------------------------------------------------------
// 1. Fetch Program details based on ID from URL
// -------------------------------------------------------
$program_id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : null;
$program_name = "General Registration";

if ($program_id) {
    $p_query = mysqli_query($conn, "SELECT title FROM programs WHERE id = '$program_id'");
    if ($p_res = mysqli_fetch_assoc($p_query)) {
        $program_name = $p_res['title'];
    }
}

// -------------------------------------------------------
// 2. Handle Form Submission
// -------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Upload passport photo
    $photo_path = null;
    if (!empty($_FILES['passport_photo']['name']) && $_FILES['passport_photo']['error'] == 0) {
        $file_tmp  = $_FILES['passport_photo']['tmp_name'];
        $file_name = time() . '_' . basename($_FILES['passport_photo']['name']);
        $target_dir = "uploads/passports/";

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . $file_name;
        if (move_uploaded_file($file_tmp, $target_file)) {
            $photo_path = $target_file;
        }
    }

    // Collect form data safely
    $selected_program_id = mysqli_real_escape_string($conn, $_POST['program_id']);
    $first_name   = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name    = mysqli_real_escape_string($conn, $_POST['last_name']);
    $father_name  = mysqli_real_escape_string($conn, $_POST['father_name']);
    $mother_name  = mysqli_real_escape_string($conn, $_POST['mother_name']);
    $gender       = mysqli_real_escape_string($conn, $_POST['gender']);
    $dob          = mysqli_real_escape_string($conn, $_POST['dob']);
    $marital_status = mysqli_real_escape_string($conn, $_POST['marital_status']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
    $ref_phone    = mysqli_real_escape_string($conn, $_POST['ref_phone']);
    $national_id  = mysqli_real_escape_string($conn, $_POST['national_id']);
    $nationality  = mysqli_real_escape_string($conn, $_POST['nationality']);
    $country_residence = mysqli_real_escape_string($conn, $_POST['country_residence']);
    $sponsor      = mysqli_real_escape_string($conn, $_POST['sponsor']);
    $province     = mysqli_real_escape_string($conn, $_POST['province']);
    $district     = mysqli_real_escape_string($conn, $_POST['district']);
    $sector       = mysqli_real_escape_string($conn, $_POST['sector']);
    $cell         = mysqli_real_escape_string($conn, $_POST['cell']); // Added Cell
    $village      = mysqli_real_escape_string($conn, $_POST['village']); // Added Village
    $residence_district = mysqli_real_escape_string($conn, $_POST['residence_district'] ?? '');
    $disability   = mysqli_real_escape_string($conn, $_POST['disability']);

    // Insert into database
    $sql = "INSERT INTO personal_info (
                program_id, first_name, last_name, father_name, mother_name, gender, date_of_birth,
                marital_status, phone_number, email_address, reference_person_phone,
                national_id_number, nationality, country_of_residence, sponsor,
                province, district, sector, cell, village, residence_district, disability, passport_photo_path
            ) VALUES (
                '$selected_program_id', '$first_name', '$last_name', '$father_name', '$mother_name', '$gender', '$dob',
                '$marital_status', '$phone_number', '$email_address', '$ref_phone', '$national_id',
                '$nationality', '$country_residence', '$sponsor', '$province', '$district',
                '$sector', '$cell', '$village', '$residence_district', '$disability', '$photo_path'
            )";

    if (mysqli_query($conn, $sql)) {
        $message = '<div class="alert alert-success">Registration for <strong>'.$program_name.'</strong> successful!</div>';
    } else {
        $message = '<div class="alert alert-danger">Error: ' . mysqli_error($conn) . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $settings['site_title'] ?? 'New Generation Academy'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <style>
        /* ================= BACKGROUND AND GLASSMORPHISM ================= */
        .registration-bg-wrapper {
            /* REPLACE 'images/your-background.jpg' with your actual image path */
            background-image: url('images/IMG_2484-min.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed; /* Creates a nice parallax effect when scrolling */
            min-height: 100vh;
            position: relative;
        }

        /* Dark overlay so the form remains readable against bright backgrounds */
        .registration-bg-wrapper::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(4, 42, 65, 0.6); /* sk-blue with 60% opacity */
            z-index: 1;
        }

        /* Ensure content stays above the dark overlay */
        .registration-bg-wrapper .container {
            position: relative;
            z-index: 2;
        }

        /* The transparent glass card */
        .glass-card {
            background: rgba(255, 255, 255, 0.90) !important; /* 90% white, 10% transparent */
            backdrop-filter: blur(15px); /* Blurs the background image behind the card */
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 12px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

<div class="registration-bg-wrapper">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <div class="card shadow-lg glass-card">
                    <div class="card-body p-4 p-md-5">
                        
                        <h2 class="text-center mb-1" style="color: var(--sk-blue);">Student Registration</h2>
                        <p class="text-center text-primary fw-bold mb-4">
                            Program: <?= htmlspecialchars($program_name); ?>
                        </p>

                        <?php echo $message; ?>

                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="program_id" value="<?= htmlspecialchars($program_id); ?>">

                            <h5 class="text-primary mb-3">Student Enrollment Information</h5>
                            <hr>

                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div id="passport_preview" class="passport-upload-area" style="background: rgba(255,255,255,0.5); border: 2px dashed #ccc; height: 150px; display: flex; align-items: center; justify-content: center; cursor: pointer; border-radius: 8px;">
                                        Click to Upload Passport
                                    </div>
                                    <input type="file" name="passport_photo" id="passport_photo" accept="image/*" class="d-none">
                                </div>

                                <div class="col-md-9">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">First Name *</label>
                                            <input name="first_name" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Last Name *</label>
                                            <input name="last_name" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Gender *</label>
                                            <select name="gender" class="form-select" required>
                                                <option value="">Select</option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Date of Birth *</label>
                                            <input id="dob" name="dob" class="form-control" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Marital Status *</label>
                                            <select name="marital_status" class="form-select" required>
                                                <option value="">Select</option>
                                                <option>Single</option>
                                                <option>Married</option>
                                                <option>Divorced</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h5 class="text-primary mt-4 mb-3">Parent / Guardian Information</h5>
                            <hr>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Father / Guardian Name</label>
                                    <input name="father_name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Mother / Guardian Name</label>
                                    <input name="mother_name" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Parent / Guardian National ID / Passport *</label>
                                    <input name="national_id" class="form-control" required>
                                </div>
                                <input type="hidden" name="ref_phone" value="<?php echo $program_name ?>">
                            </div>

                            <h5 class="text-primary mt-4 mb-3">Contact Details</h5>
                            <hr>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Phone Number *</label>
                                    <input name="phone_number" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Email Address *</label>
                                    <input type="email" name="email_address" class="form-control" required>
                                </div>
                            </div>

                            <h5 class="text-primary mt-4 mb-3">Address & Residence Information</h5>
                            <hr>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nationality *</label>
                                    <input name="nationality" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Country of Residence *</label>
                                    <input name="country_residence" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Province</label>
                                    <input name="province" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">District</label>
                                    <input name="district" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Sector</label>
                                    <input name="sector" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Cell</label>
                                    <input name="cell" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Village</label>
                                    <input name="village" class="form-control">
                                </div>
                            </div>

                            <h5 class="text-primary mt-4 mb-3">Other Information</h5>
                            <hr>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Sponsor</label>
                                    <input name="sponsor" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Disability</label>
                                    <select name="disability" class="form-select">
                                        <option value="None">None</option>
                                        <option value="Physical">Physical</option>
                                        <option value="Visual">Visual</option>
                                    </select>
                                </div>
                            </div>

                            <div class="text-end mt-5">
                                <button type="submit" class="btn btn-primary px-5 py-2 shadow-sm" style="background-color: var(--sk-orange); border: none;">Submit Application</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.js"></script>

<script>
    flatpickr("#dob", {
        dateFormat: "Y-m-d",
        maxDate: "today",
        altInput: true,
        altFormat: "F j, Y",
        defaultDate: "2000-01-01"
    });

    document.getElementById('passport_preview').onclick = () => document.getElementById('passport_photo').click();
    
    document.getElementById('passport_photo').onchange = function () {
        if (this.files[0]) {
            document.getElementById('passport_preview').innerHTML =
                `<img src="${URL.createObjectURL(this.files[0])}" style="width:100%;height:100%;object-fit:cover;border-radius:8px;">`;
        }
    };
</script>

<?php include 'include/footer.php'; ?>
</body>
</html>