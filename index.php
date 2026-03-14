<?php
// TEMPORARY ERROR REPORTING (Helps you see why a page is blank in XAMPP)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Make sure your DB connection and data fetching happen here or in header.php
include 'include/header.php'; 

// Fallback data fetching if not included in header.php
if (!isset($programs)) {
    $programs = [];
    // Added is_object() to prevent fatal errors if the DB connection fails
    if (isset($conn) && is_object($conn)) {
        $prog = $conn->query("SELECT * FROM programs WHERE status=1");
        if ($prog) { 
            while ($p = $prog->fetch_assoc()) { 
                $programs[] = $p; 
            } 
        }
    }
}

if (!isset($why_partner)) {
    $why_partner = [];
    if (isset($conn) && is_object($conn)) {
        $why = $conn->query("SELECT * FROM why_partner_nga WHERE status=1 ORDER BY display_order ASC");
        if ($why) { 
            while ($w = $why->fetch_assoc()) { 
                $why_partner[] = $w; 
            } 
        }
    }
}

if (!isset($partners)) {
    $partners = [];
    if (isset($conn) && is_object($conn)) {
        $par = $conn->query("SELECT * FROM partners WHERE status=1 ORDER BY display_order ASC");
        if ($par) { 
            while ($p = $par->fetch_assoc()) { 
                $partners[] = $p; 
            } 
        }
    }
}

// Fetch 3 Events for the 2x2 Grid Section
$grid_events = [];
if (isset($conn) && is_object($conn)) {
    $eg_query = $conn->query("SELECT * FROM events WHERE is_display = 'yes' ORDER BY created_at DESC LIMIT 3");
    if ($eg_query) { 
        while ($e = $eg_query->fetch_assoc()) { 
            $grid_events[] = $e; 
        } 
    }
}
?>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* ================= SKOOLA EXACT COLORS & VARIABLES ================= */
    :root {
        --sk-blue: #042a41;
        --sk-orange: #e65c3d;
        --sk-orange-hover: #cf4f33;
        --sk-bg-gray: #f8f9fa;
        --sk-text: #6b7a85;
    }

    body { 
        color: var(--sk-text);
        background-color: #ffffff;
        overflow-x: hidden;
    }

    h1, h2, h3, h4, h5, h6 {
        color: var(--sk-blue);
        font-weight: 800;
    }

    /* Buttons */
    .btn-sk-orange {
        background-color: var(--sk-orange);
        color: #ffffff;
        border: none;
        padding: 12px 32px;
        border-radius: 4px;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }
    .btn-sk-orange:hover {
        background-color: var(--sk-orange-hover);
        color: #ffffff;
    }
    
    .btn-sk-outline {
        background-color: transparent;
        color: var(--sk-orange);
        border: 1px solid var(--sk-orange);
        padding: 12px 32px;
        border-radius: 4px;
        font-weight: 700;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }
    .btn-sk-outline:hover { background: var(--sk-orange); color: white; }

    /* Typography Styles */
    .sk-subtitle {
        color: var(--sk-orange);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 700;
        display: block;
        margin-bottom: 15px;
    }
    .sk-title {
        font-size: 3rem;
        line-height: 1.2;
        margin-bottom: 25px;
        letter-spacing: -1px;
    }

    /* ================= HERO SECTION & OVERLAPPING BANNER ================= */
    .hero {
        position: relative;
        height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .hero video {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0;
    }
    .hero-overlay {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(4, 42, 65, 0.75);
        background-image: radial-gradient(rgba(0,0,0,0.2) 1px, transparent 1px);
        background-size: 4px 4px;
        z-index: 1;
    }
    
    /* ================= HERO SECTION TEXT VISIBILITY ================= */
    .hero-content {
        position: relative; 
        z-index: 2; 
        max-width: 800px; 
        padding: 40px; 
        margin-bottom: 80px;
        background: rgba(4, 42, 65, 0.4); 
        border-radius: 12px;
        backdrop-filter: blur(3px);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    .hero h1 {
        color: #ffffff; 
        font-size: 4.5rem; 
        line-height: 1.1; 
        margin-bottom: 20px;
        text-shadow: 2px 4px 10px rgba(0, 0, 0, 0.9); 
    }
    .sk-text-highlight {
        color: var(--sk-orange);
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8);
    }
    .hero p { 
        color: #ffffff; 
        font-size: 1.2rem; 
        font-weight: 500;
        margin-bottom: 30px; 
        text-shadow: 1px 2px 6px rgba(0, 0, 0, 0.9);
        line-height: 1.6;
    }

    /* Bottom banner */
    .hero-bottom-banner {
        position: absolute;
        bottom: 0; left: 0; width: 100%;
        background: rgba(4, 42, 65, 0.88);
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        z-index: 3;
        padding: 35px 0;
    }
    .hero-feature-item { border-right: 1px solid rgba(255, 255, 255, 0.1); padding: 0 40px; text-align: left; }
    .hero-feature-item:last-child { border-right: none; }
    .hero-feature-item h6 { color: var(--sk-orange); font-size: 1.1rem; margin-bottom: 12px; font-weight: 700; }
    .hero-feature-item p { color: #a0aec0; font-size: 0.85rem; margin: 0; line-height: 1.7; font-weight: 500; }

    /* ================= 2x2 GRID SECTION ================= */
    .grid-section { padding: 120px 0 80px 0; }
    .sk-grid-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 1fr 1fr;
        height: 500px;
    }
    .grid-box { position: relative; padding: 40px; display: flex; flex-direction: column; justify-content: flex-end; align-items: flex-start; overflow: hidden; }
    .grid-box-orange { background: var(--sk-orange); color: white; }
    .grid-box-orange h3 { color: white; margin-bottom: 15px; font-size: 1.8rem; }
    .grid-box-img { background: #ccc; position: relative; }
    .grid-box-img img { position: absolute; top:0; left:0; width:100%; height:100%; object-fit:cover; transition: transform 0.5s ease; }
    .grid-box-img:hover img { transform: scale(1.05); }
    .grid-box-img::after { content:''; position:absolute; top:0; left:0; width:100%; height:100%; background: linear-gradient(to top, rgba(4, 42, 65, 0.9) 0%, rgba(4, 42, 65, 0.3) 100%); }
    .grid-box-content { position: relative; z-index: 2; color: white; }
    .grid-box-content h3 { color: white; margin-bottom: 15px; font-size: 1.4rem; line-height: 1.3; }
    .grid-box-btn {
        border: 1px solid white; color: white; padding: 6px 16px; border-radius: 4px; text-decoration: none; font-size: 0.85rem; font-weight: 600; transition: 0.3s;
    }
    .grid-box-btn:hover { background: white; color: var(--sk-orange); }

    /* ================= PROGRAMS/FACULTIES ================= */
    .programs-section { padding: 80px 0; background: #ffffff; }
    .faculty-card {
        border: 1px solid #edf2f7;
        border-radius: 4px;
        position: relative;
        background: #ffffff;
        transition: all 0.3s ease;
        height: 100%;
        display: flex; flex-direction: column;
    }
    .faculty-card:hover { box-shadow: 0 15px 30px rgba(0,0,0,0.05); transform: translateY(-5px); }
    .faculty-img {
        width: 100%; height: 220px; object-fit: cover;
        border-top-left-radius: 4px; border-top-right-radius: 4px;
    }
    .faculty-content { padding: 40px 30px 30px 30px; position: relative; flex-grow: 1; text-align: left; }
    
    .faculty-icon-overlap {
        position: absolute;
        top: -16px; left: 50%; transform: translateX(-50%);
        width: 32px; height: 32px;
        background: #ffffff;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        color: var(--sk-orange);
        z-index: 2;
    }
    
    .faculty-card h5 { font-size: 1.25rem; margin-bottom: 12px; }
    .faculty-card p { font-size: 0.9rem; line-height: 1.6; margin-bottom: 20px; }
    
    .btn-learn-more {
        background: var(--sk-orange); color: white; border: none; padding: 8px 16px;
        border-radius: 4px; font-size: 0.85rem; font-weight: 600;
        display: inline-flex; align-items: center; text-decoration: none; transition: 0.3s;
    }
    .btn-learn-more svg { margin-left: 8px; width: 14px; height: 14px; }
    .btn-learn-more:hover { background: var(--sk-orange-hover); color: white; }

    /* ================= NGA CODING ACADEMY HIGHLIGHT ================= */
    .faculty-card-link {
        text-decoration: none;
        color: inherit;
        display: block; 
        height: 100%;
    }
    .faculty-card.nga-highlight {
        background-color: white; 
        border: 2px solid var(--sk-orange);
        box-shadow: 0 8px 25px rgba(230, 92, 61, 0.15);
        position: relative;
    }
    .faculty-card.nga-highlight::before {
        content: "Featured";
        position: absolute;
        top: 12px;
        right: 12px;
        background: var(--sk-orange);
        color: white;
        padding: 4px 12px;
        font-size: 0.75rem;
        font-weight: 700;
        border-radius: 20px;
        z-index: 10;
    }
    .faculty-card.nga-highlight:hover {
        background-color: #ffede8;
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 15px 35px rgba(230, 92, 61, 0.25);
    }
    
    /* ================= PARTNERS MAXIMIZED WIDTH ================= */
    .partner-logo-wrapper {
        height: 120px;
        padding: 10px;
        background-color: #ffffff; 
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .partner-img {
        width: 100%;   
        height: 100%;  
        object-fit: contain; 
        display: block;
    }
    .partner-logo-wrapper:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
    }

    /* ================= NEWSLETTER & FOOTER ================= */
    .footer-wrapper {
        background-color: var(--sk-blue);
        position: relative;
        margin-top: 150px; 
        padding-top: 100px;
        padding-bottom: 40px;
        color: rgba(255,255,255,0.7);
    }
    
    .newsletter-box {
        position: absolute;
        top: -80px; 
        left: 0; 
        right: 0; 
        margin: 0 auto;
        width: 90%; 
        max-width: 1100px;
        background: #ffffff;
        padding: 35px 40px;
        border-radius: 8px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        border-top: 4px solid var(--sk-orange); 
        display: flex; 
        align-items: center; 
        justify-content: space-between;
        gap: 20px;
        z-index: 10;
        box-sizing: border-box; 
    }
    
    .newsletter-box p { 
        margin: 0; 
        color: var(--sk-blue); 
        font-weight: 600; 
        font-size: 1.1rem; 
        max-width: 350px; 
    }
    
    .newsletter-form { 
        display: flex; 
        gap: 10px; 
        flex-grow: 1; 
        justify-content: flex-end; 
    }
    
    .newsletter-form input { 
        background: #f8f9fa; 
        border: 1px solid #edf2f7; 
        padding: 12px 15px; 
        width: 100%; 
        max-width: 250px;
        border-radius: 4px; 
        outline: none; 
    }
    
    .newsletter-form button { 
        background: var(--sk-orange); 
        color: white; 
        border: none; 
        padding: 12px 25px; 
        border-radius: 4px; 
        font-weight: 700; 
        white-space: nowrap; 
        transition: 0.3s;
        flex-shrink: 0; 
        display: flex;
        align-items: center;
    }
    
    .newsletter-form button:hover { 
        background: var(--sk-orange-hover); 
    }

    /* ================= MOBILE RESPONSIVE ================= */
    @media (max-width: 991px) {
        .hero h1 { font-size: 3rem; }
        .hero-feature-item { border-right: none; padding: 20px 0; text-align: center; }
        .hero-bottom-banner { position: relative; padding: 40px 20px 60px 20px; }
        .sk-grid-wrapper { grid-template-columns: 1fr; height: auto; }
        .grid-box { height: 300px; }
        
        .newsletter-box { 
            flex-direction: column; 
            text-align: center; 
            top: -120px; 
            padding: 30px 20px; 
        }
        .newsletter-box p { max-width: 100%; margin-bottom: 10px; }
        .newsletter-form { width: 100%; flex-direction: column; }
        .newsletter-form input, .newsletter-form button { width: 100%; }
    }
    @media (max-width: 768px) {
        .partner-logo-wrapper { width: 160px; height: 90px; }
    }

    /* ================= PARTNER MARQUEE ================= */
    .partner-marquee-container {
        width: 100%;
        overflow: hidden;
        position: relative;
        padding: 20px 0;
    }

    .partner-marquee-container::before,
    .partner-marquee-container::after {
        content: "";
        position: absolute;
        top: 0;
        width: 150px;
        height: 100%;
        z-index: 2;
        pointer-events: none;
    }
    .partner-marquee-container::before {
        left: 0;
        background: linear-gradient(to right, white 0%, transparent 100%);
    }
    .partner-marquee-container::after {
        right: 0;
        background: linear-gradient(to left, white 0%, transparent 100%);
    }

    .partner-marquee-track {
        display: flex;
        gap: 3rem;
        width: max-content;
        animation: marquee-scroll 30s linear infinite;
    }

    .partner-marquee-track:hover {
        animation-play-state: paused;
    }

    @keyframes marquee-scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); } 
    }

    .partner-marquee-track .partner-logo-wrapper {
        flex-shrink: 0;
        margin: 0;
    }
	/* Style for the main heading */
.fantastic-heading {
    font-family: 'Inter', sans-serif;
    font-size: 3.2rem;     
    font-weight: 800;      
    line-height: 1.15;     
    color: #ffffff;        /* THIS IS THE CHANGE: Now the text is white! */
    margin-bottom: 20px;
    letter-spacing: -0.03em;
}

/* Style for the highlighted word remains the same */
.sk-text-highlight {
    background: linear-gradient(135deg, var(--sk-orange) 0%, #ff8a3d 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    color: transparent; 
    filter: drop-shadow(0px 4px 10px rgba(234, 88, 12, 0.15));
    display: inline-block;
    padding-bottom: 5px;
}

@media (max-width: 768px) {
    .fantastic-heading {
        font-size: 2.2rem;
    }
}
</style>

<section class="hero">
    <video autoplay muted loop playsinline>
        <source src="videos/NGA Highlight.mp4" type="video/mp4">
    </video>
    <div class="hero-overlay"></div>
    
    <div class="hero-content" data-aos="zoom-in" data-aos-duration="1000">
	
	
     <h3 class="fantastic-heading">
    <span class="sk-text-highlight">Transformative</span><br>
    Education, Endless<br>
    Opportunities.
</h3>
		
		
        <p><?= htmlspecialchars($settings['hero_subtitle'] ?? 'Rwanda’s Private Centre of Excellence in Software Programming, Embedded Systems & Robotics'); ?></p>
    </div>
    
    <div class="hero-bottom-banner d-none d-md-block">
        <div class="container">
            <div class="row">
                <div class="col-md-4 hero-feature-item" data-aos="fade-up" data-aos-delay="100">
                    <h6>Community Impact & Nurturing</h6>
                    <p>Dedicated to serving and impacting our community by educating, nurturing, and caring for every child entrusted to us.</p>
                </div>
                
                <div class="col-md-4 hero-feature-item" data-aos="fade-up" data-aos-delay="200">
                    <h6>Consistently Excellence</h6>
                    <p>Aspiring to consistently offer high-quality digital solutions and transformative education for the future of Rwanda.</p>
                </div>
                
                <div class="col-md-4 hero-feature-item border-0" data-aos="fade-up" data-aos-delay="300">
                    <h6>Innovation & Future-Ready</h6>
                    <p>Preparing skilled, ethical, and joyful leaders through excellence in software programming, embedded systems, and robotics.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="grid-section bg-white" id="events">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                <div class="sk-grid-wrapper">
                    
                    <div class="grid-box grid-box-orange" data-aos="zoom-in" data-aos-delay="100">
                        <h3>News & Events</h3>
                        <p class="small text-white opacity-75 mb-4">Discover recent announcements and achievements that define our learning journey.</p>
                        <a href="nga_events.php" class="grid-box-btn">View All Events</a>
                    </div>
                    
                    <?php 
                    $grid_delay = 200;
                    if (!empty($grid_events)): 
                        foreach ($grid_events as $index => $event): 
                            $btnClass = ($index == 0) ? 'grid-box-btn' : 'grid-box-btn bg-sk-orange border-0';
                            $btnStyle = ($index > 0) ? 'style="background:var(--sk-orange);"' : '';
                    ?>
                        <div class="grid-box grid-box-img" data-aos="zoom-in" data-aos-delay="<?= $grid_delay ?>">
                            <img src="<?= htmlspecialchars($event['image'] ?? 'uploads/default.jpg'); ?>" alt="Event Image" onerror="this.src='uploads/default.jpg'">
                            <div class="grid-box-content">
                                <h3><?= htmlspecialchars(substr($event['title'], 0, 35)) . (strlen($event['title']) > 35 ? '...' : ''); ?></h3>
                                <a href="event_details.php?id=<?= $event['id']; ?>" class="<?= $btnClass; ?>" <?= $btnStyle; ?>>Read More</a>
                            </div>
                        </div>
                    <?php 
                        $grid_delay += 100;
                        endforeach; 
                    else: 
                    ?>
                        <div class="grid-box grid-box-img" data-aos="zoom-in" data-aos-delay="200">
                            <img src="images/IMG_2484-min.jpg" alt="Campus">
                            <div class="grid-box-content"><h3>Campus Life & Community</h3><a href="#" class="grid-box-btn">Discover more</a></div>
                        </div>
                        <div class="grid-box grid-box-img" data-aos="zoom-in" data-aos-delay="300">
                            <img src="images/IMG_2434-min.jpg" alt="Academic">
                            <div class="grid-box-content"><h3>Academic excellence</h3><a href="#" class="grid-box-btn bg-sk-orange border-0" style="background:var(--sk-orange);">Discover more</a></div>
                        </div>
                        <div class="grid-box grid-box-img" data-aos="zoom-in" data-aos-delay="400">
                            <img src="uploads/default.jpg" alt="Faculties">
                            <div class="grid-box-content"><h3>Faculties & Schools</h3><a href="#spes" class="grid-box-btn bg-sk-orange border-0" style="background:var(--sk-orange);">Discover more</a></div>
                        </div>
                    <?php endif; ?>
                    
                    <?php
                    $filled = count($grid_events);
                    for ($i = $filled; $i < 3 && !empty($grid_events); $i++):
                        $btnClass = ($i == 0) ? 'grid-box-btn' : 'grid-box-btn bg-sk-orange border-0';
                        $btnStyle = ($i > 0) ? 'style="background:var(--sk-orange);"' : '';
                    ?>
                        <div class="grid-box grid-box-img" data-aos="zoom-in" data-aos-delay="<?= $grid_delay ?>">
                            <img src="uploads/default.jpg" alt="Placeholder">
                            <div class="grid-box-content">
                                <h3>Stay Tuned</h3>
                                <a href="nga_events.php" class="<?= $btnClass; ?>" <?= $btnStyle; ?>>Discover more</a>
                            </div>
                        </div>
                    <?php 
                        $grid_delay += 100;
                    endfor; 
                    ?>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-1 mt-5 mt-lg-0 px-lg-4" data-aos="fade-left">
                <?php 
                $mission_data = null;
                foreach ($why_partner as $item) {
                    if (trim($item['title']) === 'Mission') {
                        $mission_data = $item;
                        break;
                    }
                }
                ?>
                <span class="sk-subtitle" id="about" style="text-transform: uppercase; font-weight: 700; font-size: 0.85rem; letter-spacing: 1.5px; color: var(--sk-orange); display: block; margin-bottom: 15px;">
                    Our Value
                </span>
                
                <h2 class="sk-title" style="font-size: 3.5rem; letter-spacing: -1.5px; line-height: 1.1; margin-bottom: 30px; font-weight: 800; color: var(--sk-blue);">
                    Our Value
                </h2>
                
                <div class="mb-5 text-muted" style="line-height: 1.8; font-size: 1.1rem; color: #6b7a85;">
                    Providing Christ-centered education, fostering ethical values, and developing a tech-driven mindset (specifically STEM, robotics, and ICT) to shape future leaders
                </div>
                
                <div class="d-flex flex-wrap gap-3">
                    <a href="student_register.php" class="btn-sk-orange py-3 px-4" style="border-radius: 4px; font-weight: 700;">Apply Now</a>
                    <a href="https://nga.ac.rw/report_card/parent_dashboard.php" class="btn-sk-outline py-3 px-4" style="border-radius: 4px; font-weight: 700;">Parent Login</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background: var(--sk-bg-gray);">
    <div class="container py-4">
        <div class="row g-4 justify-content-center">
            <?php 
            $count = 0;
            $value_delay = 100;
            if(!empty($why_partner)): foreach ($why_partner as $w): 
                if($count >= 3) break; 
            ?>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $value_delay ?>">
                <div class="bg-white p-5 text-center h-100 shadow-sm border rounded-1 faculty-card" style="transition: all 0.3s ease;">
                    <img src="<?= htmlspecialchars($w['icon']); ?>" alt="icon" width="45" class="mb-4" style="filter: invert(48%) sepia(79%) saturate(2476%) hue-rotate(346deg) brightness(98%) contrast(93%);">
                    <h5 class="mb-3" style="color: var(--sk-blue); font-weight: 700;">
                        <?= htmlspecialchars($w['title']); ?>
                    </h5>
                    <p class="text-muted m-0 small" style="line-height: 1.6;">
                        <?= htmlspecialchars(substr($w['description'], 0, 110)); ?>...
                    </p>
                </div>
            </div>
            <?php 
            $count++; 
            $value_delay += 150;
            endforeach; endif; 
            ?>
        </div>
    </div>
</section>

<section class="programs-section" id="spes">
    <div class="container text-center">
        
        <div class="mb-5 pb-4" data-aos="fade-up">
            <h2 class="sk-title mb-0">Our Programs</h2>
            <h5 class="mt-1" style="font-style: italic; color: var(--sk-text);">Transformative Education.</h5>
        </div>

        <div class="row g-4 text-start mt-4">
        <?php 
        if(!empty($programs)): 
            $prog_delay = 100;
            foreach($programs as $p): 
                $isSpecial = stripos($p['title'], 'NGA') !== false && stripos($p['title'], 'Coding') !== false;
                $link = $isSpecial ? "https://www.nga.ac.rw/coding-academy/" : "program.php?id=".$p['id'];
                $highlightClass = $isSpecial ? "nga-highlight" : "";
        ?>
            <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?= $prog_delay ?>">
                <a href="<?= $link; ?>" class="faculty-card-link">
                    <div class="faculty-card <?= $highlightClass; ?>">
                        <img src="admin/uploads/program_icons/<?= $p['icon'] ?? 'default.jpg'; ?>" alt="Program" class="faculty-img" onerror="this.src='uploads/default.jpg'">
                        
                        <div class="faculty-content">
                            <div class="faculty-icon-overlap">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
                            </div>
                            
                            <h5><?= htmlspecialchars($p['title']); ?></h5>
                            <p class="text-muted"><?= htmlspecialchars(substr($p['description'], 0, 85)); ?>...</p>
                            
                            <span class="btn-learn-more">
                                Learn more 
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        <?php 
            $prog_delay += 150;
            endforeach; endif; 
        ?>
        </div>
    </div>
</section>

<?php
// Note: We leave this specific DB connection as it was, but gracefully check it
//$history_conn = mysqli_connect("localhost", "root", "", "nga_deployment");
$data = [];
if($history_conn) {
    $result = mysqli_query($history_conn, "SELECT * FROM students_history LIMIT 3");
    if($result) $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
<?php if(count($data) > 0): ?>
<section class="py-5" style="background: var(--sk-bg-gray);" id="student-histories">
    <div class="container py-5">
        <div data-aos="fade-up">
            <span class="sk-subtitle text-center">OUR PRIDE</span>
            <h2 class="sk-title text-center mb-5">Student Stories</h2>
        </div>
        <div class="row g-4 justify-content-center">
            <?php 
            $student_delay = 100;
            foreach ($data as $student): 
            ?>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $student_delay ?>">
                <div class="bg-white p-4 border rounded-1 d-flex align-items-center gap-4 shadow-sm h-100">
                    <img src="uploads/<?= htmlspecialchars($student['photo']); ?>" alt="Student" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;">
                    <div>
                        <h6 class="mb-1 text-dark" style="font-weight: 700; font-size:1.1rem;"><?= htmlspecialchars($student['full_name']); ?></h6>
                        <a href="student-stories.php?id=<?= $student['id']; ?>" class="small text-decoration-none fw-bold" style="color: var(--sk-orange);">Read story &rarr;</a>
                    </div>
                </div>
            </div>
            <?php 
            $student_delay += 150;
            endforeach; 
            ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="py-5 bg-white border-top w-100" id="partners">
    <div class="container-fluid py-5 text-center px-0"> 
        <div data-aos="fade-up">
            <span class="sk-subtitle mb-1">Collaborations</span>
            <h2 class="sk-title mb-5 mt-0">Our Partners</h2>
        </div>
        
        <div class="partner-marquee-container">
            <div class="partner-marquee-track">
                <?php 
                if(!empty($partners)): 
                    // Loop TWICE (0 and 1) to create the seamless infinite scroll effect
                    for ($i = 0; $i < 2; $i++):
                        foreach ($partners as $p): 
                ?>
                    <div class="partner-logo-wrapper">
                        <a href="<?= !empty($p['url']) ? htmlspecialchars($p['url']) : '#'; ?>" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="text-decoration-none w-100 h-100 d-flex align-items-center justify-content-center"
                           title="<?= htmlspecialchars($p['name']) ?>" data-bs-toggle="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="<?= htmlspecialchars($p['name']) ?>">
                            
                            <img src="admin/<?= htmlspecialchars($p['logo_path']); ?>" 
                                 alt="<?= htmlspecialchars($p['name']) ?>" 
                                 title="<?= htmlspecialchars($p['name']) ?>" class="partner-img">
                        </a>
                    </div>
                <?php 
                        endforeach; 
                    endfor;
                endif; 
                ?>
            </div>
        </div>
    </div>
</section>

<div class="footer-wrapper" id="newsletter">
    <div class="newsletter-box" style="flex-wrap: wrap;" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <p>Signup our newsletter to get update information, news, insight or promotions.</p>
        
        <form class="newsletter-form" action="process_newsletter.php" method="POST" id="newsletterForm" style="position: relative;">
            <input type="text" name="subscriber_name" placeholder="Name" required>
            <input type="email" name="subscriber_email" placeholder="Email" required>
            <button type="submit" id="newsletterBtn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                <span id="newsletterBtnText">Sign Up</span>
            </button>
        </form>
        
        <?php if(isset($_GET['nl_status'])): ?>
            <div id="newsletterMessage" style="width: 100%; text-align: right; margin-top: 10px; font-weight: 600; font-size: 0.9rem; color: <?= $_GET['nl_status'] == 'success' ? '#28a745' : '#dc3545' ?>;">
                <?php 
                if($_GET['nl_status'] == 'success') {
                    echo '<i class="fas fa-check-circle me-1"></i> Thank you for subscribing!';
                } elseif($_GET['nl_status'] == 'exists') {
                    echo '<i class="fas fa-exclamation-circle me-1"></i> This email is already subscribed!';
                } else {
                    echo '<i class="fas fa-exclamation-circle me-1"></i> Something went wrong. Please try again.';
                }
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="contact-wrapper mt-5 mb-5" id="contact" style="max-width: 800px; margin: 0 auto; padding: 0 15px;" data-aos="fade-up" >
    <div class="text-center mb-4">
        <h3 style="font-size: 2rem; font-weight: 600;">Contact Us</h3>
        <p style="color: #666;">Have a question? Send us a message and we'll get back to you shortly.</p>
    </div>

    <form action="process_contact.php" method="POST" class="contact-form">
        <div class="row">
            <div class="col-md-6 mb-3">
                <input type="text" class="form-control py-2" name="contact_name" placeholder="Your Name" required>
            </div>
            <div class="col-md-6 mb-3">
                <input type="email" class="form-control py-2" name="contact_email" placeholder="Your Email" required>
            </div>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control py-2" name="contact_subject" placeholder="Subject" required>
        </div>
        <div class="mb-3">
            <textarea class="form-control py-2" name="contact_message" rows="5" placeholder="Your Message" required></textarea>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary px-5 py-2" style="font-weight: 600; border-radius: 5px;">
                <i class="fas fa-paper-plane me-2"></i> Send Message
            </button>
        </div>
    </form>

    <?php if(isset($_GET['contact_status'])): ?>
        <div class="text-center mt-3" style="font-weight: 600; font-size: 0.95rem; color: <?= $_GET['contact_status'] == 'success' ? '#28a745' : '#dc3545' ?>;">
            <?php 
            if($_GET['contact_status'] == 'success') {
                echo '<i class="fas fa-check-circle me-1"></i> Your message has been sent successfully!';
            } else {
                echo '<i class="fas fa-exclamation-circle me-1"></i> Failed to send message. Please try again.';
            }
            ?>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Tooltips Init
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // AOS Animation Init
    AOS.init({
        duration: 800,      // Animation duration
        offset: 100,        // Offset (in px) from the original trigger point
        once: true,         // Only animate once
        easing: 'ease-out-cubic' 
    });
});
</script>

<?php include 'include/footer.php'; ?>
</body>
</html>