<?php
include 'include/header.php';

// ---- DATABASE CONNECTION ----
$host = "localhost";
$user = "ngarw_spes";
$pass = "ngarw_spes";
$dbname = "ngarw_spes";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
}

// ---- GET ID FROM URL ----
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // ---- FETCH SINGLE RECORD ----
    $sql = "SELECT id, title, description, icon, status, display_order 
            FROM why_partner_nga
            WHERE status = 1 AND id = $id
            LIMIT 1";
    $result = $conn->query($sql);
} else {
    $result = false;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>About New Generation Academy</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #ffffff; color: #333; overflow-x: hidden; }

        .header {
            width: 100%;
            text-align: center;
            padding: 70px 20px;
            background: linear-gradient(135deg, #0a3d62, #3c6382);
            color: white;
            font-size: 45px;
            font-weight: bold;
        }

        .section { width: 100%; padding: 40px 8%; }

        .item-box {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 80px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            transition: 0.3s ease;
        }
        .item-box:hover { transform: translateY(-10px); }

        .item-image { width: 100%; height: 420px; object-fit: cover; }

        .item-content { padding: 40px 50px; }

        .item-title { font-size: 34px; font-weight: bold; margin-bottom: 25px; color: #0a3d62; }

        .item-desc { font-size: 20px; line-height: 1.85; white-space: pre-line; }

        .divider { width: 120px; height: 5px; background: #0a3d62; margin: 20px 0 30px 0; border-radius: 10px; }
    </style>
</head>
<body>

<div class="section">

<?php if ($result && $result->num_rows > 0): ?>
    <?php $row = $result->fetch_assoc(); ?>
        <div class="item-box">
            <img src="<?= htmlspecialchars($row['icon']) ?>" class="item-image" alt="Image">
            <div class="item-content">
                <div class="item-title"><?= htmlspecialchars($row['title']) ?></div>
                <div class="divider"></div>
                <div class="item-desc"><?= nl2br(htmlspecialchars($row['description'])) ?></div>
            </div>
        </div>
<?php else: ?>
    <p style="padding: 20px; font-size: 20px;">No content found for this ID.</p>
<?php endif; ?>

</div>

<?php include 'include/footer.php'; ?>
</body>
</html>

<?php $conn->close(); ?>