<?php
include "../../config/db.php";

/* DELETE FEATURE */
if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM spes_features WHERE id=$id");
    header("Location: feature.php");
    exit;
}

/* LOAD FEATURE FOR EDIT */
$edit_id = 0;
$feature = "";
$status  = 1;

if(isset($_GET['edit'])){
    $edit_id = (int)$_GET['edit'];
    $q = mysqli_query($conn, "SELECT * FROM spes_features WHERE id=$edit_id");
    if(mysqli_num_rows($q) > 0){
        $row = mysqli_fetch_assoc($q);
        $feature = $row['feature'];
        $status  = $row['status'];
    }
}

/* ADD OR UPDATE */
if(isset($_POST['save'])){
    $id      = (int)$_POST['id'];
    $feature = mysqli_real_escape_string($conn, $_POST['feature']);
    $status  = (int)$_POST['status'];

    if($id > 0){
        mysqli_query($conn, "UPDATE spes_features SET feature='$feature', status=$status WHERE id=$id");
    } else {
        mysqli_query($conn, "INSERT INTO spes_features (feature, status) VALUES ('$feature', $status)");
    }
    header("Location: feature.php");
    exit;
}

/* FETCH ALL FEATURES */
$list = mysqli_query($conn, "SELECT * FROM spes_features ORDER BY id DESC");
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Manage Events</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<style>
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    /* Ensure the body is a flex container for full height layout */
    min-height: 100vh;
}
.sidebar {
    min-width: 220px;
    max-width: 220px;
    background-color: #0d6efd;
    color: #fff;
    height: 100vh; /* Lock height to viewport, or use height: 100% if parent is taller */
    position: sticky; /* Keep sidebar visible when scrolling content */
    top: 0;
    padding-top: 0;
    z-index: 1000;
}
.sidebar a {
    color: #fff;
    display: block;
    padding: 12px 20px;
    text-decoration: none;
    transition: background-color 0.2s;
}
.sidebar a:hover {
    background-color: #004085;
}
.main-content-wrapper {
    flex-grow: 1;
    padding: 0;
}
.content-header {
    background-color: #f8f9fa;
    padding: 15px 20px;
    border-bottom: 1px solid #dee2e6;
    margin-bottom: 20px;
}
.content-body {
    padding: 0 20px 20px;
}
textarea {
    resize: vertical;
}
</style>
</head>
<body>

<div class="d-flex">
    
    <div class="sidebar d-flex flex-column">
        <h4 class="text-center py-3 border-bottom border-light opacity-75">Admin Panel</h4>
        
         <a href="../dashboard.php"><i class="fas fa-home me-2"></i> Dashboard</a>
        <a href="events.php" class="active-link" style="background-color: #004085;"><i class="fas fa-calendar-alt me-2"></i> Manage Events</a>
        <a href="about_sections.php"><i class="fas fa-grip-horizontal me-2"></i> Manage Sections</a>
        
        <a href="programs.php"><i class="fas fa-book me-2"></i> Manage Programs</a>
        <a href="partners.php"><i class="fas fa-handshake me-2"></i> Manage Partners</a>
        <a href="why_partner_nga.php"><i class="fas fa-book me-2"></i> Why Partners</a>
        
        <a href="../logout.php" class="mt-auto border-top border-light opacity-75"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
    </div>

<body class="bg-light">

<div class="container mt-5">
<h3 class="mb-4">Feature Management</h3>

<div class="row">

<!-- FORM -->
<div class="col-md-4">
<div class="card">
<div class="card-header bg-primary text-white">
<?php echo $edit_id ? "Edit Feature" : "Add Feature"; ?>
</div>
<div class="card-body">

<form method="post">
<input type="hidden" name="id" value="<?php echo $edit_id; ?>">

<label>Feature</label>
<input type="text" name="feature" class="form-control mb-3" 
value="<?php echo htmlspecialchars($feature); ?>" required>

<label>Status</label>
<select name="status" class="form-control mb-3">
<option value="1" <?php if($status==1) echo "selected"; ?>>Active</option>
<option value="0" <?php if($status==0) echo "selected"; ?>>Inactive</option>
</select>

<button name="save" class="btn btn-primary w-100">
<?php echo $edit_id ? "Update" : "Save"; ?>
</button>

</form>

</div>
</div>
</div>

<!-- TABLE -->
<div class="col-md-8">
<div class="card">
<div class="card-header">Feature List</div>
<div class="card-body p-0">

<table class="table table-striped mb-0">
<tr>
<th>ID</th>
<th>Feature</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php if(mysqli_num_rows($list)==0): ?>
<tr><td colspan="4" class="text-center">No data</td></tr>
<?php endif; ?>

<?php while($row = mysqli_fetch_assoc($list)): ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo htmlspecialchars($row['feature']); ?></td>
<td>
<?php echo $row['status'] ? "Active" : "Inactive"; ?>
</td>
<td>
<a href="?edit=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
<a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
onclick="return confirm('Delete this feature?')">Delete</a>
</td>
</tr>
<?php endwhile; ?>

</table>

</div>
</div>
</div>

</div>
</div>

</body>
</html>