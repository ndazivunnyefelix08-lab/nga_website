<?php
// 1. Include your AWS database connection
include 'config/db.php'; 

// Make sure connection exists
if (!$conn) {
    die("Database connection failed.");
}

// 2. Fetch all tables from the database
$tables = [];
$result = mysqli_query($conn, "SHOW TABLES");
if ($result) {
    while ($row = mysqli_fetch_row($result)) {
        $tables[] = $row[0];
    }
}

// 3. Get the selected table from the URL (if clicked)
$selected_table = isset($_GET['table']) ? $_GET['table'] : null;

// SECURITY: Only allow querying if the selected table actually exists in our array
if ($selected_table && !in_array($selected_table, $tables)) {
    $selected_table = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AWS Database Viewer</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; display: flex; height: 100vh; background-color: #f8fafc; }
        
        /* Left Sidebar styling */
        .sidebar { width: 250px; background-color: #0f172a; color: white; overflow-y: auto; padding-top: 20px; }
        .sidebar h3 { text-align: center; color: #ea580c; margin-bottom: 20px; font-size: 1.2rem; }
        .sidebar a { display: block; color: #cbd5e1; padding: 10px 20px; text-decoration: none; border-bottom: 1px solid #1e293b; transition: 0.2s; font-size: 0.9rem; }
        .sidebar a:hover, .sidebar a.active { background-color: #1e293b; color: #ea580c; border-left: 4px solid #ea580c; padding-left: 16px; }
        
        /* Right Main Content styling */
        .main-content { flex: 1; padding: 30px; overflow-y: auto; }
        .main-content h2 { color: #0f172a; margin-top: 0; }
        
        /* Table styling */
        .data-table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-radius: 8px; overflow: hidden; }
        .data-table th, .data-table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        .data-table th { background-color: #f1f5f9; color: #475569; font-weight: 600; text-transform: uppercase; font-size: 0.85rem; }
        .data-table tr:hover { background-color: #f8fafc; }
        .data-table td { font-size: 0.9rem; color: #334155; max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        
        .alert { background-color: #e0f2fe; color: #0f172a; padding: 15px; border-radius: 6px; border-left: 4px solid #3b82f6; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h3>NGA AWS Database</h3>
        <?php foreach ($tables as $table): ?>
            <a href="?table=<?= urlencode($table) ?>" class="<?= ($selected_table === $table) ? 'active' : '' ?>">
                <i class="fas fa-table"></i> <?= htmlspecialchars($table) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="main-content">
        <?php if ($selected_table): ?>
            <h2>Table: <span style="color: #ea580c;"><?= htmlspecialchars($selected_table) ?></span></h2>
            
            <?php
            // Fetch data from the selected table (LIMIT to 100 so it doesn't crash on huge tables)
            $data_query = mysqli_query($conn, "SELECT * FROM `$selected_table` LIMIT 100");
            
            if (mysqli_num_rows($data_query) > 0) {
                echo "<div style='overflow-x: auto;'><table class='data-table'>";
                
                // 1. Print Column Headers dynamically
                echo "<tr>";
                $fields = mysqli_fetch_fields($data_query);
                foreach ($fields as $field) {
                    echo "<th>" . htmlspecialchars($field->name) . "</th>";
                }
                echo "</tr>";
                
                // 2. Print Rows
                while ($row = mysqli_fetch_assoc($data_query)) {
                    echo "<tr>";
                    foreach ($row as $cell_value) {
                        // htmlspecialchars prevents code injection if you have raw HTML in your database
                        echo "<td>" . htmlspecialchars((string)$cell_value) . "</td>";
                    }
                    echo "</tr>";
                }
                
                echo "</table></div>";
                echo "<p style='margin-top: 15px; font-size: 0.85rem; color: #64748b;'>Showing up to 100 rows.</p>";
                
            } else {
                echo "<div class='alert'>This table is currently empty.</div>";
            }
            ?>
            
        <?php else: ?>
            <h2>Welcome to your Database Viewer</h2>
            <div class="alert">
                ?? Please click a table name on the left menu to view its data.
            </div>
        <?php endif; ?>
    </div>

</body>
</html>

<?php mysqli_close($conn); ?>