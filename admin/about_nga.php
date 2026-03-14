<?php
include '../config/db.php';

/* =========================
   HANDLE ADD / UPDATE
========================= */
if (isset($_POST['save'])) {
    $id = intval($_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $status = intval($_POST['status']);
    $order = intval($_POST['display_order']);

    // Handle file upload
    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = '../uploads/why_partner/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = 'why_partner_' . time() . '.' . $ext;
        $target_file = $upload_dir . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_path = 'uploads/why_partner/' . $filename;
        }
    } elseif (isset($_POST['old_image'])) {
        $image_path = $_POST['old_image']; 
    }

    if ($id > 0) {
        $conn->query("UPDATE why_partner_nga SET title='$title', description='$description', icon='$image_path', status='$status', display_order='$order' WHERE id=$id");
    } else {
        $conn->query("INSERT INTO why_partner_nga (title, description, icon, status, display_order) VALUES ('$title','$description','$image_path','$status','$order')");
    }

    // Redirect to the current filename
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

/* =========================
   HANDLE DELETE
========================= */
if (isset($_GET['delete'])) {
    $del_id = intval($_GET['delete']);
    $res = $conn->query("SELECT icon FROM why_partner_nga WHERE id=$del_id");
    $row = $res->fetch_assoc();
    if ($row['icon'] && file_exists('../' . $row['icon'])) {
        unlink('../' . $row['icon']);
    }
    $conn->query("DELETE FROM why_partner_nga WHERE id=$del_id");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

/* =========================
   LOAD SINGLE RECORD FOR EDIT
========================= */
$edit = null;
if (isset($_GET['edit'])) {
    $eid = intval($_GET['edit']);
    $res = $conn->query("SELECT * FROM why_partner_nga WHERE id=$eid");
    $edit = $res->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage About NGA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; }
        .sidebar { min-width: 220px; max-width: 220px; background-color: #0d6efd; color: #fff; min-height: 100vh; position: sticky; top: 0; }
        .sidebar a { color: #fff; display: block; padding: 12px 20px; text-decoration: none; }
        .sidebar a:hover { background-color: #004085; }
        .main-content { flex-grow: 1; padding: 25px; }
        .preview-img { max-width: 70px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .card { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .card-header { background-color: #fff; border-bottom: 1px solid #eee; font-weight: 600; }
    </style>
</head>
<body>

<div class="d-flex">
    <?php include 'modules/sidebar.php'; ?>

    <div class="main-content">
        <h3 class="mb-4 text-dark">About NGA Management</h3>

        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fas <?php echo $edit ? 'fa-edit' : 'fa-plus'; ?> me-2"></i>
                        <?php echo $edit ? 'Edit Record' : 'Add New Entry'; ?>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $edit ? $edit['id'] : 0; ?>">
                            <input type="hidden" name="old_image" value="<?php echo $edit['icon'] ?? ''; ?>">

                            <div class="mb-3">
                                <label class="form-label fw-bold">Title</label>
                                <input type="text" name="title" class="form-control" required value="<?php echo $edit['title'] ?? ''; ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Image / Icon</label>
                                <input type="file" name="image" class="form-control">
                                <?php if(!empty($edit['icon'])): ?>
                                    <div class="mt-2 small text-muted">Current:</div>
                                    <img src="../<?php echo $edit['icon']; ?>" class="preview-img">
                                <?php endif; ?>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Order</label>
                                    <input type="number" name="display_order" class="form-control" value="<?php echo $edit['display_order'] ?? 0; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="1" <?php if(($edit['status'] ?? 1)==1) echo 'selected'; ?>>Active</option>
                                        <option value="0" <?php if(($edit['status'] ?? 1)==0) echo 'selected'; ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" rows="4" class="form-control" required><?php echo $edit['description'] ?? ''; ?></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button name="save" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Save Record
                                </button>
                                <?php if($edit): ?>
                                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary">Cancel</a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-table me-2"></i> Current Entries
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">#</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Order</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $q = $conn->query("SELECT * FROM why_partner_nga ORDER BY display_order ASC");
                                $i = 1;
                                if($q->num_rows > 0):
                                    while($r = $q->fetch_assoc()):
                                ?>
                                <tr>
                                    <td class="ps-3 text-muted"><?php echo $i++; ?></td>
                                    <td><strong><?php echo htmlspecialchars($r['title']); ?></strong></td>
                                    <td>
                                        <?php if($r['icon']): ?>
                                            <img src="../<?php echo $r['icon']; ?>" class="preview-img" style="width: 40px; height: 40px; object-fit: cover;">
                                        <?php else: ?>
                                            <span class="badge bg-light text-dark">No Image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-<?php echo $r['status'] ? 'success' : 'secondary'; ?>">
                                            <?php echo $r['status'] ? 'Active' : 'Inactive'; ?>
                                        </span>
                                    </td>
                                    <td><?php echo $r['display_order']; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="?edit=<?php echo $r['id']; ?>" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="?delete=<?php echo $r['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this record?')" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php 
                                    endwhile; 
                                else:
                                ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No records found.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>