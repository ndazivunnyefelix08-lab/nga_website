<?php
session_start();
if(!isset($_SESSION['admin'])) { header("Location: ../login.php"); exit; }

$conn = new mysqli("localhost", "ngarw_spes", "ngarw_spes", "ngarw_spes");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// --- AJAX DELETE LOGIC ---
if (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $stmt = $conn->prepare("DELETE FROM personal_info WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
    exit; // Stop execution here for AJAX requests
}

// Filter logic
$program_filter = isset($_GET['program']) ? $_GET['program'] : 'all';
$sql = "SELECT * FROM personal_info";
if ($program_filter !== 'all') {
    $sql .= " WHERE reference_person_phone = '" . $conn->real_escape_string($program_filter) . "'";
}
$result = $conn->query($sql);

$prog_result = $conn->query("SELECT DISTINCT reference_person_phone FROM personal_info WHERE reference_person_phone IS NOT NULL");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar { min-width: 240px; background: #0d6efd; color: white; min-height: 100vh; }
        .sidebar a { color: white; text-decoration: none; padding: 12px 20px; display: block; }
        .sidebar a:hover { background: #004085; }
        .student-img { width: 45px; height: 45px; object-fit: cover; border-radius: 50%; border: 1px solid #ddd; }
        /* Fade out animation for deleted row */
        .fade-out { opacity: 0; transition: opacity 0.5s ease; }
    </style>
</head>
<body class="bg-light">
<div class="d-flex">
    <div class="sidebar">
        <h4 class="text-center py-4"> Admin</h4>
        <a href="dashboard.php"><i class="fas fa-users me-2"></i> Dashboard</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
    </div>

    <div class="flex-grow-1 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Applied Students</h2>
            <div class="text-muted">Admin: <strong><?= $_SESSION['admin'] ?></strong></div>
        </div>

        <div class="table-responsive bg-white p-3 rounded shadow-sm">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Photo</th>
                        <th>Full Name</th>
                        <th>Program</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr id="row-<?= $row['id'] ?>">
                        <td>
                            <?php $photo = !empty($row['passport_photo_path']) ? "../".$row['passport_photo_path'] : "https://via.placeholder.com/50"; ?>
                            <img src="<?= $photo ?>" class="student-img">
                        </td>
                        <td><?= $row['first_name'].' '.$row['last_name'] ?></td>
                        <td><span class="badge bg-info text-dark"><?= $row['reference_person_phone'] ?></span></td>
                        <td><?= $row['email_address'] ?></td>
                        <td><?= $row['phone_number'] ?></td>
                        <td class="text-center">
                            <a href="print.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            
                            <button onclick="deleteStudent(<?= $row['id'] ?>)" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function deleteStudent(studentId) {
    if (confirm('Are you sure you want to delete this record? This cannot be undone.')) {
        // Use Fetch API to send data to the same page
        const formData = new FormData();
        formData.append('action', 'delete');
        formData.append('id', studentId);

        fetch(window.location.href, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === 'success') {
                // Animate and remove the row from the table
                const row = document.getElementById('row-' + studentId);
                row.classList.add('fade-out');
                setTimeout(() => row.remove(), 500);
            } else {
                alert('Error deleting record. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('A network error occurred.');
        });
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>