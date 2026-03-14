<?php
// Make sure your DB connection and data fetching happen here or in header.php
include 'include/header.php'; 

// Fetch partners from DB
if (!isset($partners)) {
    $partners = [];
    if (isset($conn)) {
        $par = $conn->query("SELECT * FROM partners WHERE status=1 ORDER BY display_order ASC");
        if ($par) { while ($p = $par->fetch_assoc()) { $partners[] = $p; } }
    }
}

// Fetch NGA Coding Academy Programs from DB (Software, Embedded, Robotics)
if (!isset($academy_programs)) {
    $academy_programs = [];
    if (isset($conn)) {
        // Using academy_programs as shown in your database screenshot
        $prog_query = $conn->query("SELECT * FROM academy_programs WHERE status=1 ORDER BY id ASC LIMIT 3");
        if ($prog_query) { while ($pr = $prog_query->fetch_assoc()) { $academy_programs[] = $pr; } }
    }
}

// NEW: Fetch Recent Blogs from DB (Latest 3)
if (!isset($recent_blogs)) {
    $recent_blogs = [];
    if (isset($conn)) {
        $blog_query = $conn->query("SELECT * FROM academy_blogs WHERE status=1 ORDER BY post_date DESC, id DESC LIMIT 3");
        if ($blog_query) { while ($bl = $blog_query->fetch_assoc()) { $recent_blogs[] = $bl; } }
    }
}
?>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    :root {
        --sk-blue: #0f172a; /* Darker modern blue */
        --sk-orange: #ea580c; /* Modern orange */
        --sk-orange-hover: #c2410c;
        --sk-bg-gray: #f8fafc;
        --sk-text: #475569;
    }

    body { 
        font-family: 'Inter', sans-serif;
        color: var(--sk-text);
        background-color: #ffffff;
        overflow-x: hidden;
    }

    h1, h2, h3, h4, h5, h6 {
        color: var(--sk-blue);
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .btn-primary-sk {
        background-color: var(--sk-orange);
        color: #ffffff;
        padding: 12px 32px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        border: none;
    }
    .btn-primary-sk:hover { background-color: var(--sk-orange-hover); color: white; }
    
    .btn-outline-sk {
        background-color: transparent;
        color: var(--sk-blue);
        border: 2px solid var(--sk-blue);
        padding: 12px 32px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-block;
    }
    .btn-outline-sk:hover { background: var(--sk-blue); color: white; }

    /* ================= HERO SECTION (VIDEO BACKGROUND) ================= */
    .hero {
        position: relative;
        min-height: 90vh;
        display: flex;
        align-items: center;
        color: white;
        padding-top: 80px;
        overflow: hidden;
    }
    
    .hero-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(to right, rgba(15, 23, 42, 0.95), rgba(15, 23, 42, 0.6));
        z-index: 1;
    }
    
    .hero-video {
        position: absolute;
        top: 50%; left: 50%;
        min-width: 100%; min-height: 100%;
        width: auto; height: auto;
        transform: translate(-50%, -50%);
        z-index: 0;
        object-fit: cover;
    }

    .hero .container {
        position: relative;
        z-index: 2;
    }

    .hero h1 { color: white; font-size: 4.5rem; font-weight: 800; line-height: 1.1; margin-bottom: 24px; }
    .hero p { font-size: 1.25rem; color: #e2e8f0; max-width: 600px; line-height: 1.6; margin-bottom: 40px; }

    /* ================= PROGRAMS SECTION ================= */
    .programs-section { padding: 100px 0; background: var(--sk-bg-gray); }
    .program-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        height: 100%;
        transition: transform 0.3s;
    }
    .program-card:hover { transform: translateY(-5px); }
    .program-card img { width: 100%; height: 250px; object-fit: cover; }
    .program-content { padding: 30px; }
    .program-number { font-size: 3rem; font-weight: 800; color: rgba(234, 88, 12, 0.1); position: absolute; top: 20px; right: 20px; }

    /* ================= 
     US ================= */
    .
    -section { padding: 100px 0; }
    .pillar-list { list-style: none; padding: 0; }
    .pillar-list li { position: relative; padding-left: 30px; margin-bottom: 15px; font-weight: 500; color: var(--sk-blue);}
    .pillar-list li::before {
        content: '✓'; position: absolute; left: 0; color: var(--sk-orange); font-weight: bold;
    }

    /* ================= WHY CHOOSE US ================= */
    .features-section { padding: 100px 0; background: var(--sk-blue); color: white; }
    .features-section h2, .features-section h3 { color: white; }
    .feature-card { background: rgba(255,255,255,0.05); border-radius: 12px; padding: 30px; border: 1px solid rgba(255,255,255,0.1); height: 100%; }
    
    /* ================= BLOGS ================= */
    .blog-section { padding: 100px 0; }
    .blog-card { border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; }
    .blog-card img { width: 100%; height: 220px; object-fit: cover; }
    .blog-content { padding: 25px; }

    /* ================= PARTNERS ================= */
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

/* Fading edges effect (optional but looks very premium) */
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
    gap: 3rem; /* Space between logos */
    width: max-content;
    animation: marquee-scroll 30s linear infinite;
}

/* Pause the scrolling when a user hovers over a logo */
.partner-marquee-track:hover {
    animation-play-state: paused;
}

@keyframes marquee-scroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); } 
    /* Scrolls exactly half the track width, which creates the perfect infinite loop since we duplicated the items */
}

/* Ensure wrappers don't shrink inside the flex track */
.partner-marquee-track .partner-logo-wrapper {
    flex-shrink: 0;
    margin: 0;
}
/* ================= WHY CHOOSE US - MODERNIZED ================= */
    .features-section { 
        padding: 100px 0; 
        background: var(--sk-blue); 
        color: white; 
        position: relative;
        overflow: hidden;
    }
    
    /* Optional subtle background pattern for depth */
    .features-section::before {
        content: '';
        position: absolute;
        top: -50%; left: -50%; width: 200%; height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.03) 1px, transparent 1px);
        background-size: 40px 40px;
        z-index: 0;
        pointer-events: none;
    }

    .features-section .container { position: relative; z-index: 1; }

    .feature-card { 
        background: rgba(255, 255, 255, 0.03); 
        border-radius: 16px; 
        padding: 40px 30px; 
        border: 1px solid rgba(255, 255, 255, 0.08); 
        height: 100%; 
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        backdrop-filter: blur(10px);
        display: flex;
        flex-direction: column;
    }
    
    .feature-icon-box {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        background: rgba(234, 88, 12, 0.1); /* Soft orange background */
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        transition: all 0.4s ease;
    }

    .feature-icon-box svg {
        color: var(--sk-orange);
        transition: all 0.4s ease;
    }

    /* Interactive Hover Effects */
    .feature-card:hover {
        transform: translateY(-10px);
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(234, 88, 12, 0.3); /* Soft orange border on hover */
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2), 0 0 20px rgba(234, 88, 12, 0.1);
    }

    .feature-card:hover .feature-icon-box {
        background: var(--sk-orange);
        transform: scale(1.1) rotate(5deg);
    }

    .feature-card:hover .feature-icon-box svg {
        color: #ffffff;
    }

    .feature-card h4 {
        color: #ffffff;
        font-size: 1.25rem;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .feature-card p {
        color: #94a3b8; /* Slightly brighter than text-white-50 for better readability */
        font-size: 0.95rem;
        line-height: 1.7;
        margin-bottom: 0;
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
        margin: 0 auto; /* Safely centers the box without pushing it off-screen */
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
        box-sizing: border-box; /* Forces padding to stay inside the box */
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
        max-width: 250px; /* Prevents inputs from taking up too much space */
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
        flex-shrink: 0; /* Forces the button to never shrink or disappear */
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
        
        /* Fixed mobile newsletter sizing */
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
</style>

<section class="hero">
    <video class="hero-video" id="heroVideo" autoplay muted playsinline>
        <source src="videos/video1.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="hero-overlay"></div>

    <div class="container">
        <div class="row">
            <div class="col-lg-8" data-aos="fade-up" data-aos-duration="1000">
                <span style="color: var(--sk-orange); font-weight: 700; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 15px; display: block;">Welcome to</span>
                <h1>NGA-Coding Academy</h1>
                <p>Rwanda’s Private Centre of Excellence in Software Programming, Embedded Systems & Robotics</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="student_register.php?id=15" class="btn-primary-sk">Apply Now</a>
                    <a href="#partners" class="btn-outline-sk" style="color: white; border-color: white;">Partner With Us</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const video = document.getElementById("heroVideo");
        const videoSources = ["videos/video1.mp4", "videos/video2.mp4", "videos/video3.mp4"];
        let currentVideoIndex = 0;

        // When the current video finishes, play the next one
        if (video) {
            video.addEventListener('ended', function() {
                currentVideoIndex++;
                if (currentVideoIndex >= videoSources.length) {
                    currentVideoIndex = 0; 
                }
                video.src = videoSources[currentVideoIndex];
                video.play();
            });
        }
    });
</script>

<section class="programs-section" id="programs">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
           <h2 style="font-size: 2.5rem;">Programs We Offer</h2>
<p class="mx-auto mt-3" style="text-align: justify; max-width: 800px; font-size: 1.1rem;">
    Integrated Program Overview: Software Programming, Embedded Systems & Robotics. Our flagship program integrates Software Programming, Embedded Systems, and Robotics into a single, comprehensive, industry-aligned curriculum. Students gain both the software and hardware competencies required to build real-world digital and intelligent systems.
</p>
        </div>

        <div class="row g-4 mt-4">
            <?php 
            if (!empty($academy_programs)): 
                $i = 1; 
                $delay = 100; // Starting delay for staggered animation
                foreach ($academy_programs as $prog): 
                    $num = !empty($prog['program_number']) ? $prog['program_number'] : sprintf("%02d", $i);
                    $img = !empty($prog['image_url']) ? $prog['image_url'] : 'https://via.placeholder.com/600x400?text=Program';
            ?>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                    <div class="program-card position-relative">
                        <div class="program-number"><?= htmlspecialchars($num) ?></div>
                        <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($prog['title']) ?>">
                        <div class="program-content">
                            <span class="badge bg-light text-dark mb-3">Program <?= htmlspecialchars($num) ?></span>
                            <h4 class="mb-3"><?= htmlspecialchars($prog['title']) ?></h4>
                            <p class="text-muted small mb-4"><?= htmlspecialchars(substr($prog['description'], 0, 150)) ?>...</p>
                            <a href="<?= htmlspecialchars($prog['link_url'] !== '#' ? $prog['link_url'] : 'program_details.php?id='.$prog['id']) ?>" style="color: var(--sk-orange); font-weight: 600; text-decoration: none;">Read More &rarr;</a>
                        </div>
                    </div>
                </div>
            <?php 
                $i++; 
                $delay += 150; // Increase delay by 150ms for the next card
                endforeach; 
            else: 
            ?>
                <div class="col-12 text-center"><p>Loading programs...</p></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="about-section" id="about">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span style="color: var(--sk-orange); font-weight: 700; text-transform: uppercase;">Ready to begin your journey?</span>
                <h2 class="mt-2 mb-4" style="font-size: 2.5rem;">Who We Are</h2>
                <p class="text-muted mb-4">NGA-Coding Academy is a private high school and emerging Centre of Excellence dedicated to developing exceptional talent in Software Programming, Embedded Systems, and Robotics. Our mission is to provide high-quality, competency-based training that prepares students to thrive in Rwanda’s growing digital economy.</p>
                
                <h4 class="mb-3 mt-5">Vision</h4>
                <p class="text-muted">To shape future-ready careers by delivering excellence in software engineering, embedded systems, and robotics.</p>
                
                <h4 class="mb-3 mt-4">Mission</h4>
                <p class="text-muted">To provide high-quality, competency-based training in Software Programming, Embedded Systems, and Robotics; to nurture innovation through industry-aligned curricula; and to develop entrepreneurial, job-ready graduates who uphold Christian values while contributing to Rwanda’s digital transformation and the global tech ecosystem.</p>
            </div>
            
            <div class="col-lg-6 bg-light p-5 rounded-4 border" data-aos="fade-left">
                <h3 class="mb-4">Centre of Excellence Pillars</h3>
                <ul class="pillar-list">
                    <li>Specialized Curriculum and Training</li>
                    <li>Modern Technology & Infrastructure</li>
                    <li>Industry & Academic Partnerships</li>
                    <li>Community & National Alignment</li>
                    <li>Evidence-Based Graduate Outcomes</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span style="color: var(--sk-orange); font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px;">Why Choose Us</span>
            <h2 class="mt-2" style="font-size: 2.5rem; color: #ffffff;"><font color="#042a41">Reasons to Join Our Academy</font></h2>
            <p class="mt-3" style="color: #94a3b8; max-width: 600px; margin: 0 auto;">Discover what makes us the perfect choice for your educational journey into the world of tech.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"></path>
                            <polyline points="10 8 8 10 10 12"></polyline>
                            <polyline points="14 8 16 10 14 12"></polyline>
                        </svg>
                    </div>
                    <h4><font color="#042a41">Industry-Relevant Curriculum</font></h4>
                    <p>Cutting-edge courses designed with industry experts to ensure you learn what matters most in today's tech landscape.</p>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                            <line x1="8" y1="21" x2="16" y2="21"></line>
                            <line x1="12" y1="17" x2="12" y2="21"></line>
                        </svg>
                    </div>
                    <h4><font color="#042a41">State-of-the-Art Facilities</font></h4>
                    <p>Modern learning spaces equipped with the latest technology to provide the best educational experience.</p>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                        </svg>
                    </div>
                    <h4><font color="#042a41">Practical Approach</font></h4>
                    <p>Hands-on learning with real-world projects that prepare you for immediate success in your career.</p>
                </div>
            </div>
            
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h4><font color="#042a41">Industry Partnerships</font></h4>
                    <p>Strong connections with leading companies providing internships, mentorship, and career opportunities.</p>
                </div>
            </div>
            
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                            <polyline points="17 6 23 6 23 12"></polyline>
                        </svg>
                    </div>
                    <h4><font color="#042a41">Career Pathways</font></h4>
                    <p>Comprehensive support and guidance to help you navigate your journey from student to professional.</p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5 pt-4" data-aos="zoom-in" data-aos-delay="600">
            <a href="student_register.php" class="btn-primary-sk px-5" style="box-shadow: 0 4px 14px rgba(234, 88, 12, 0.4);">Register Now</a>
            <p class="mt-3 small" style="color: #cbd5e1;">Join thousands of successful graduates</p>
        </div>
    </div>
</section>

<section class="blog-section bg-light">
    <div class="container">
        <h2 class="text-center mb-5" style="font-size: 2.5rem;" data-aos="fade-up">Recent Blogs</h2>
        
        <div class="row g-4">
            <?php if (!empty($recent_blogs)): 
                $blog_delay = 100;
                foreach ($recent_blogs as $blog): 
                    $img = !empty($blog['image_path']) ? $blog['image_path'] : 'https://via.placeholder.com/600x400?text=NGA+Blog';
                    $excerpt = strip_tags($blog['content']);
                    if (strlen($excerpt) > 120) {
                        $excerpt = substr($excerpt, 0, 120) . '...';
                    }
            ?>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $blog_delay ?>">
                    <div class="blog-card bg-white h-100 d-flex flex-column">
                        <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($blog['title']) ?>">
                        <div class="blog-content d-flex flex-column flex-grow-1">
                            <h5 class="mb-3"><?= htmlspecialchars($blog['title']) ?></h5>
                            <p class="text-muted small mb-4 flex-grow-1"><?= htmlspecialchars($excerpt) ?></p>
                            <a href="single_blog.php?id=<?= $blog['id'] ?>" style="color: var(--sk-blue); font-weight: 600; text-decoration: none; margin-top: auto;">More Details &rarr;</a>
                        </div>
                    </div>
                </div>
            <?php 
                $blog_delay += 150; 
                endforeach; 
            else: 
            ?>
                <div class="col-12 text-center py-5">
                    <div class="text-muted fs-4 mb-3"><i class="fas fa-newspaper"></i></div>
                    <p class="text-muted">No recent blogs available at the moment. Check back soon!</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="blogs.php" class="btn-outline-sk">View All Blogs</a>
        </div>
    </div>
</section>
<section class="py-5 bg-white border-top w-100" id="partners">
    <div class="container-fluid py-5 text-center px-0"> <div data-aos="fade-up">
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
                           class="text-decoration-none  h-100 d-flex align-items-center justify-content-center"
                           title="<?= htmlspecialchars($p['name']) ?>" data-bs-toggle="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="<?= htmlspecialchars($p['name']) ?>">
                            
                            <img src="../admin/<?= htmlspecialchars($p['logo_path']); ?>" 
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


<div class="footer-wrapper" id="newsletter" id="contact">
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

<!--
<div style="background: var(--sk-blue); color: white; padding: 60px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <h4 class="text-white mb-4">Have a Questions?</h4>
                <p class="text-white-50 mb-2">KG 643 St, Kimihurura, Rugando</p>
                <p class="text-white-50 mb-2">+250 791 823 651</p>
                <p class="text-white-50">ngacodingacademy@nga.ac.rw</p>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <h4 class="text-white mb-4">Quick Links</h4>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white-50 text-decoration-none">Home</a></li>
                    <li><a href="#programs" class="text-white-50 text-decoration-none">Programs</a></li>
                    <li><a href="#" class="text-white-50 text-decoration-none">Student Projects</a></li>
                    <li><a href="https://nga.ac.rw/events" class="text-white-50 text-decoration-none">Our Events</a></li>
                    <li><a href="student_register.php" class="text-white-50 text-decoration-none">Online Registration</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <h4 class="text-white mb-4">Important Links</h4>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white-50 text-decoration-none">Staff / Student Login</a></li>
                    <li><a href="#" class="text-white-50 text-decoration-none">Staff Mail Portal</a></li>
                </ul>
            </div>
        </div>
        <div class="border-top border-secondary pt-4 mt-4 text-center" data-aos="fade-in" data-aos-delay="400">
            <p class="text-white-50 mb-0">© 2026 NGA-Coding Academy. All rights reserved.</p>
        </div>
    </div>
</div>-->

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Initialize AOS animations
        AOS.init({
            duration: 800,      // How long the animation takes (in ms)
            offset: 100,        // Distance from bottom of screen before triggering
            once: true,         // Whether animation should happen only once - while scrolling down
            easing: 'ease-out-cubic' // Smooth easing function
        });
    });
</script>

<?php include 'include/footer.php'; ?>