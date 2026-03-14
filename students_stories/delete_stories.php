<?php
$conn = mysqli_connect("localhost", "ngarw_spes", "ngarw_spes", "ngarw_spes");
if (!$conn) die("Connection failed");

/* Check if we are editing */
$editMode = false;
$student = [
    'id' => '',
    'full_name' => '',
    'summary' => '',
    'photo' => ''
];

if (isset($_GET['edit'])) {
    $editMode = true;
    $id = intval($_GET['edit']);
    $res = mysqli_query($conn, "SELECT * FROM students_history WHERE id=$id");
    $student = mysqli_fetch_assoc($res);
}

/* Fetch all students */
$result = mysqli_query($conn, "SELECT * FROM students_history ORDER BY id DESC");
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Stories Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.22.0/dist/css/uikit.min.css" />
</head>

<body class="uk-background-muted">

<div class="uk-container uk-margin-large-top">

<!-- SUCCESS MESSAGE -->
<?php if (isset($_GET['success'])): ?>
<div class="uk-alert-success uk-border-rounded" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    Student history <?= $editMode ? 'updated' : 'added'; ?> successfully!
</div>
<?php endif; ?>

<!-- FORM CARD -->
<div class="uk-flex uk-flex-center uk-margin-large-bottom">
<div class="uk-card uk-card-default uk-card-body 
            uk-width-1-1 uk-width-1-2@m uk-width-1-3@l
            uk-box-shadow-large uk-border-rounded uk-card-hover
            uk-animation-slide-bottom-small">

<h3 class="uk-card-title uk-text-center">
<?= $editMode ? 'Edit Student History' : 'NGA StudentS Stories'; ?>
</h3>

<form action="save_history.php" method="POST" enctype="multipart/form-data" class="uk-form-stacked">

<?php if($editMode): ?>
<input type="hidden" name="id" value="<?= $student['id']; ?>">
<?php endif; ?>

<div class="uk-margin">
<label class="uk-form-label">Student Full Name</label>
<div class="uk-form-controls">
<input class="uk-input uk-border-rounded" type="text" name="full_name" required
value="<?= htmlspecialchars($student['full_name']); ?>">
</div>
</div>

<div class="uk-margin">
<label class="uk-form-label">Story</label>
<div class="uk-form-controls">
<textarea class="uk-textarea uk-border-rounded" rows="3" name="summary" required><?= htmlspecialchars($student['summary']); ?></textarea>
</div>
</div>

<div class="uk-margin">
<label class="uk-form-label">Student Photo</label>
<div class="uk-form-controls">
<input class="uk-input uk-border-rounded" type="file" name="photo" accept="image/*">
</div>

<?php if($editMode && $student['photo']): ?>
<img src="../uploads/<?= $student['photo']; ?>" width="90"
class="uk-border-circle uk-margin-small-top">
<?php endif; ?>
</div>

<button class="uk-button uk-button-primary uk-border-pill uk-width-1-1">
<?= $editMode ? 'Update History' : 'Save Story'; ?>
</button>

<?php if($editMode): ?>
<a href="add_history.php"
class="uk-button uk-button-default uk-border-pill uk-width-1-1 uk-margin-small-top">
Cancel
</a>
<?php endif; ?>

</form>
</div>
</div>

<!-- TABLE CARD--> 
<div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-box-shadow-medium">

<h3 class="uk-card-title">Manage Student Stories</h3>

<table class="uk-table uk-table-divider uk-table-striped uk-table-middle uk-table-hover">
<thead>
<tr>
<th>#</th>
<th>Photo</th>
<th>Full Name</th>
<th>Summary</th>
<th>Actions</th>
</tr>
</thead>

<tbody>
<?php if(count($students)==0): ?>
<tr>
<td colspan="5" class="uk-text-center uk-text-muted">No records found</td>
</tr>
<?php endif; ?>

<?php foreach($students as $s): ?>
<tr>
<td><?= $s['id']; ?></td>
<td>
<img src="../uploads/<?= $s['photo']; ?>" width="60" class="uk-border-circle">
</td>
<td><?= htmlspecialchars($s['full_name']); ?></td>
<td><?= htmlspecialchars(substr($s['summary'],0,60)); ?>...</td>
<td>
<a href="add_history.php?edit=<?= $s['id']; ?>"
class="uk-button uk-button-warning uk-button-small uk-border-pill">Edit</a>

<a href="delete_history.php?id=<?= $s['id']; ?>"
class="uk-button uk-button-danger uk-button-small uk-border-pill"
onclick="return confirm('Delete this history?')">Delete</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/uikit@3.22.0/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.22.0/dist/js/uikit-icons.min.js"></script>

</body>
</html>