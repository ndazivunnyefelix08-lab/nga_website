<?php
$conn = mysqli_connect("localhost", "ngarw_spes", "ngarw_spes", "ngarw_spes");

$full_name = $_POST['full_name'];
$summary = $_POST['summary'];

/* Check if edit */
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = intval($_POST['id']);

    /* If new photo uploaded */
    if (isset($_FILES['photo']) && $_FILES['photo']['tmp_name'] != "") {
        $photoName = time() . "_" . $_FILES['photo']['name'];
        $photoTmp = $_FILES['photo']['tmp_name'];
        move_uploaded_file($photoTmp, "../uploads/" . $photoName);

        /* Get old photo and delete it */
        $old = mysqli_query($conn, "SELECT photo FROM students_history WHERE id=$id");
        $oldData = mysqli_fetch_assoc($old);
        if ($oldData && file_exists("../uploads/" . $oldData['photo'])) {
            unlink("../uploads/" . $oldData['photo']);
        }

        $stmt = mysqli_prepare($conn, "UPDATE students_history SET full_name=?, summary=?, photo=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "sssi", $full_name, $summary, $photoName, $id);
    } else {
        /* No new photo, keep old one */
        $stmt = mysqli_prepare($conn, "UPDATE students_history SET full_name=?, summary=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "ssi", $full_name, $summary, $id);
    }

    mysqli_stmt_execute($stmt);
    header("Location: add_history.php?success=1");
    exit;
}

/* ADD NEW */
if (isset($_FILES['photo']) && $_FILES['photo']['tmp_name'] != "") {
    $photoName = time() . "_" . $_FILES['photo']['name'];
    $photoTmp = $_FILES['photo']['tmp_name'];
    move_uploaded_file($photoTmp, "../uploads/" . $photoName);

    $stmt = mysqli_prepare($conn, "INSERT INTO students_history (full_name, summary, photo) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $full_name, $summary, $photoName);
    mysqli_stmt_execute($stmt);

    header("Location: add_history.php?success=1");
    exit;
}