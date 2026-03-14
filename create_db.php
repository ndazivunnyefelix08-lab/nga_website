<?php
// 1. Give PHP more time (5 minutes) and more memory to handle the huge file
ini_set('max_execution_time', '300'); 
ini_set('memory_limit', '512M');

// 2. Turn on error reporting so we can see if it crashes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 3. Include your working AWS database connection
include 'config/db.php'; 

$sql_file = 'ngarw_spes.sql';

if (!file_exists($sql_file)) {
    die("<br><br><b style='color:red;'>Error: Cannot find the database.sql file.</b>");
}

$sql_commands = file_get_contents($sql_file);

echo "<br><br>Reading SQL file and uploading to AWS... Please wait.<br><br>";

// 4. Execute the massive block of SQL commands
if (mysqli_multi_query($conn, $sql_commands)) {
    do {
        if ($result = mysqli_store_result($conn)) {
            mysqli_free_result($result);
        }
    } while (mysqli_more_results($conn) && mysqli_next_result($conn));
    
    echo "<h2 style='color: green;'>Success! Your entire database has been uploaded to AWS RDS!</h2>";
} else {
    echo "<h2 style='color: red;'>Database Import Failed:</h2>";
    echo mysqli_error($conn);
}

mysqli_close($conn);
?>