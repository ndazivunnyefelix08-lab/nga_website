<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config/db.php';

/* =========================
    LOAD SITE SETTINGS
========================= */
$settings = [];
$set = $conn->query("SELECT * FROM site_settings");
while ($row = $set->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

/* Fetch Programs for Navbar Dropdown */
$programs = [];
$prog = $conn->query("SELECT * FROM academy_programs WHERE status=1");
while ($p = $prog->fetch_assoc()) {
    $programs[] = $p;
}

/* Fetch Why Partner (used for Mission/Vision/Who We Are) */
$why_partner = [];
$why = $conn->query("SELECT * FROM why_partner_nga WHERE status=1 ORDER BY display_order ASC");
while ($w = $why->fetch_assoc()) {
    $why_partner[] = $w;
}

/* Fetch Partners */
$partners = [];
$par = $conn->query("SELECT * FROM partners WHERE status=1 ORDER BY display_order ASC");
while ($p = $par->fetch_assoc()) {
    $partners[] = $p;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($settings['site_title'] ?? 'New Generation Academy'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
/* ================= SKOOLA VARIABLES & GLOBAL ================= */
:root {
    --sk-blue: #042a41;
    --sk-darker-blue: #021a28;
    --sk-orange: #e65c3d;
    --sk-orange-hover: #cf4f33;
    --font-main: 'Manrope', sans-serif;
}

html, body {
    margin: 0;
    padding: 0;
    font-family: var(--font-main);
}

body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    overflow-x: hidden;
}

.page-content-wrapper {
    flex: 1 0 auto;
}

/* ================= SKOOLA TOP BAR ================= */
.sk-topbar {
    background-color: var(--sk-darker-blue);
    color: #ffffff;
    font-size: 0.85rem;
    padding: 10px 0;
    font-weight: 500;
}
.sk-topbar a, .sk-topbar span {
    color: #ffffff;
    text-decoration: none;
    margin-right: 25px;
    display: inline-flex;
    align-items: center;
    transition: color 0.3s;
}
.sk-topbar a:hover {
    color: var(--sk-orange);
}
.sk-topbar svg.contact-icon {
    color: var(--sk-orange);
    margin-right: 8px;
    width: 16px; height: 16px;
}

/* ================= SKOOLA MAIN NAVBAR ================= */
.sk-navbar {
    background-color: var(--sk-blue);
    padding: 0;
}
.sk-navbar .navbar-brand img {
    max-height: 50px; 
    object-fit: contain;
}
.sk-navbar .nav-link {
    color: #ffffff !important;
    font-weight: 700;
    font-size: 0.95rem;
    padding: 30px 18px !important;
    transition: 0.3s;
    position: relative;
}
.sk-navbar .nav-link:hover, 
.sk-navbar .nav-link.active,
.sk-navbar .show > .nav-link {
    color: var(--sk-orange) !important;
}

/* Active Indicator (Orange line at top) */
.sk-navbar .nav-item::before {
    content: '';
    position: absolute;
    top: 0; left: 18px; right: 18px;
    height: 3px;
    background-color: transparent;
    transition: 0.3s;
    z-index: 5;
}
.sk-navbar .nav-item:hover::before,
.sk-navbar .nav-link.active::before {
    background-color: var(--sk-orange);
}

/* Dropdown Menu Styling */
.sk-navbar .dropdown-menu {
    border-radius: 0 0 8px 8px;
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    padding: 15px 0;
    background: #ffffff;
    margin-top: 0; /* Aligns with bottom of navbar */
}
.sk-navbar .dropdown-item {
    font-weight: 700;
    color: var(--sk-blue);
    padding: 10px 25px;
    font-size: 0.9rem;
    transition: 0.3s;
}
.sk-navbar .dropdown-item:hover {
    background-color: #f8f9fa;
    color: var(--sk-orange);
}

/* Admission Button */
.btn-sk-admission {
    background-color: var(--sk-orange);
    color: #ffffff !important;
    font-weight: 800;
    padding: 12px 28px;
    border-radius: 4px;
    text-decoration: none;
    margin-left: 20px;
    transition: 0.3s;
    display: inline-block;
    border: none;
}
.btn-sk-admission:hover {
    background-color: var(--sk-orange-hover);
    transform: translateY(-2px);
}

/* Mobile Tweaks */
@media (max-width: 991px) {
    .sk-navbar { padding: 15px 0; }
    .sk-navbar .nav-link { padding: 15px 0 !important; }
    .sk-navbar .nav-item::before { display: none; }
    .btn-sk-admission { margin: 20px 0 10px 0; width: 100%; text-align: center; }
    .dropdown-menu { border-radius: 8px; box-shadow: none; background: rgba(255,255,255,0.05); }
    .dropdown-item { color: #fff; }
}
/* Highlight the active nav link */
.navbar-nav .nav-link.active,
.dropdown-item.active {
    color: var(--sk-orange) !important; /* Forces the text to turn orange */
    font-weight: 700;
}

/* Optional: Add a cool bottom line under the active top-level link */
.navbar-nav > .nav-item > .nav-link.active {
    position: relative;
}

.navbar-nav > .nav-item > .nav-link.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 10%;
    width: 80%;
    height: 3px;
    background-color: var(--sk-orange);
    border-radius: 5px;
}
</style>
</head>

<body>

<div class="page-content-wrapper">

<div class="sk-topbar d-none d-lg-block">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex">
                <a href="tel:<?= preg_replace('/[^0-9+]/', '', $settings['school_phone'] ?? ''); ?>">
                    <svg class="contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    <?= htmlspecialchars($settings['school_phone'] ?? '(250) 789-552-671'); ?>
                </a>
                <span>
                    <svg class="contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <?= htmlspecialchars($settings['school_address'] ?? 'Rugando, Kigali - Rwanda'); ?>
                </span>
            </div>
            <div class="sk-social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
</div>

<header class="sticky-top">
    <nav class="navbar navbar-expand-lg sk-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="<?= htmlspecialchars($settings['logo'] ?? 'images/logo.png'); ?>" alt="Logo" onerror="this.outerHTML='<h3 class=\'text-white m-0\'>NGA</h3>'">
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMenuMain" aria-controls="navMenuMain" aria-expanded="false" aria-label="Toggle navigation">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </button>

            <div class="collapse navbar-collapse" id="navMenuMain">
                <?php
// Get the current file name (e.g., 'index.php', 'academic.php')
$current_page = basename($_SERVER['PHP_SELF']);
?>

<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
    <li class="nav-item">
        <a class="nav-link <?= ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">Home</a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link <?= ($current_page == 'academic.php') ? 'active' : ''; ?>" href="academic.php">Academics</a>
    </li>
    
    <li class="nav-item">
    <a class="nav-link <?= ($current_page == 'innovation.php') ? 'active' : ''; ?>" href="innovation.php">Innovation</a>
        
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?= ($current_page == 'nga_events.php') ? 'active' : ''; ?>" href="#" id="navbarPages" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
        </a>
        <ul class="dropdown-menu shadow" aria-labelledby="navbarPages">
<li><a class="dropdown-item <?= ($current_page == 'student_register.php?id=15') ? 'active' : ''; ?>" href="student_register.php?id=15">Admissions</a></li>
            <li><a class="dropdown-item" href="index.php#about">About Us</a></li>
            <li><a class="dropdown-item" href="index.php#contact">Contact Us</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="https://nga.ac.rw/mis/login" target="_blank">MIS Portal</a></li>
        </ul>
    </li>
</ul>
                
                <a href="../" class="btn-sk-admission" >
                    Back to website
                </a>
            </div>
        </div>
    </nav>
</header>