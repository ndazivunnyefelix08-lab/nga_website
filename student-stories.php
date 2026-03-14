<?php
// Include your secure AWS database connection
include 'config/db.php';

/* Validate ID */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid student history ID");
}

$id = intval($_GET['id']);

/* Fetch student history */
$result = mysqli_query($conn, "SELECT * FROM students_history WHERE id = $id");
$student = mysqli_fetch_assoc($result);

if (!$student) {
    die("Student history not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($student['full_name']); ?> | Student History</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.22.0/dist/css/uikit.min.css" />

<style>
/* READER-FIRST TYPOGRAPHY */
.story-wrapper {
    max-width: 720px;          /* perfect reading width */
    margin: auto;
}

.story-text {
    font-size: 1.05rem;
    line-height: 1.9;
    color: #333;
}

.story-text p {
    margin-bottom: 1.2em;
}
.story-text {
    font-size: 1.05rem;
    line-height: 1.9;
    color: #333;

    /* FIX FOR LONG TEXT */
    word-wrap: break-word;
    overflow-wrap: break-word;
    word-break: break-word;
    hyphens: auto;
}

</style>

</head>

<body class="uk-background-muted">

<div class="uk-container uk-margin-large-top">

<a href="./" class="uk-button uk-button-text">
← Back to Histories
</a>

<div class="uk-flex uk-flex-center uk-margin-large-top">

<div class="uk-card uk-card-default uk-card-body 
            uk-box-shadow-large uk-border-rounded
            uk-animation-slide-bottom-small story-wrapper">

<?php if (!empty($student['photo'])): ?>
<div class="uk-text-center uk-margin-medium-bottom">
<img src="../uploads/<?= htmlspecialchars($student['photo']); ?>" 
     class="uk-border-circle uk-box-shadow-medium"
     width="150" height="150" alt="Student Photo">
</div>
<?php endif; ?>

<h2 class="uk-text-center uk-margin-remove-bottom">
<?= htmlspecialchars($student['full_name']); ?>
</h2>

<p class="uk-text-center uk-text-muted uk-margin-small-top">
Student Story
</p>

<hr class="uk-divider-icon">

<div class="story-text">
<?= nl2br(htmlspecialchars($student['summary'])); ?>


</div>

</div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/uikit@3.22.0/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.22.0/dist/js/uikit-icons.min.js"></script>

</body>
</html>