<?php
// admin_header.php

// Start session and handle security check
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    min-height: 100vh;
}
.sidebar {
    /* Fixed width for sidebar */
    min-width: 220px;
    max-width: 220px;
    background-color: #0d6efd;
    color: #fff;
    /* Use height: 100% to fill the flex container height */
    height: 100%; 
}
.sidebar a {
    color: #fff;
    display: block;
    padding: 12px 20px;
    text-decoration: none;
    font-size: 1.0rem;
    transition: background-color 0.2s;
}
.sidebar a:hover {
    background-color: #004085;
}
.header {
    background-color: #f8f9fa;
    padding: 15px 20px;
    border-bottom: 1px solid #dee2e6;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
.content {
    padding: 20px;
}
/* Ensure the main container wraps the whole viewport height */
.main-wrapper {
    min-height: 100vh;
}
</style>

</head>
<body>

<div class="d-flex main-wrapper">

    <div class="sidebar d-flex flex-column">
        <h4 class="text-center py-3 border-bottom border-light opacity-75">Admin Panel</h4>
        
        <a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active-link' : ''; ?>"><i class="fas fa-home me-2"></i> Dashboard</a>
        <a href="modules/events.php"><i class="fas fa-calendar-alt me-2"></i> Manage Events</a>
        <a href="modules/teachers.php"><i class="fas fa-chalkboard-teacher me-2"></i> Manage Teachers</a>
        <a href="settings.php"><i class="fas fa-cog me-2"></i> Settings</a>
        
        <a href="logout.php" class="mt-auto border-top border-light opacity-75"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
    </div>

    <div class="flex-grow-1 d-flex flex-column">
        <div class="header d-flex justify-content-between align-items-center">
            <h5>Welcome, <?php echo htmlspecialchars($_SESSION['admin']); ?></h5>
            <span><i class="fas fa-user-circle me-2"></i><?php echo htmlspecialchars($_SESSION['admin']); ?></span>
        </div>

        <div class="content flex-grow-1"> 
        <div class="container-fluid">
            ```

## 2. `admin_footer.php` (Reusable Closing Tags)

Create this file to handle the closing tags and scripts.

```php
<?php
// admin_footer.php
?>

            </div> </div> </div> </div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>