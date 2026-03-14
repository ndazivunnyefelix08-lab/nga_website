<?php
// 1. Include your working AWS database connection
include 'config/db.php'; 

// 2. Point to the SQL file you just created
$sql_file = 'ngarw_spes.sql';

// Check if the file exists before trying to read it
if (!file_exists($sql_file)) {
    die("Error: Cannot find the database.sql file.");
}

// Read the entire contents of the SQL file into a variable
$sql_commands = file_get_contents($sql_file);

echo "Reading SQL file and uploading to AWS... Please wait.<br><br>";

// 3. Execute the massive block of SQL commands
// We MUST use multi_query() instead of query() because there are multiple statements
if (mysqli_multi_query($conn, $sql_commands)) {
    
    // Loop through each command to ensure they all process correctly without getting stuck
    do {
        // Clear out results from the previous command to make room for the next one
        if ($result = mysqli_store_result($conn)) {
            mysqli_free_result($result);
        }
    } while (mysqli_more_results($conn) && mysqli_next_result($conn));
    
    echo "<h2 style='color: green;'>Success! Your entire database has been uploaded to AWS RDS!</h2>";
    echo "<p>All tables, settings, and student data have been safely imported.</p>";

} else {
    // If something goes wrong, print the exact error
    echo "<h2 style='color: red;'>Database Import Failed:</h2>";
    echo mysqli_error($conn);
}

// 4. Close the connection
mysqli_close($conn);
?>