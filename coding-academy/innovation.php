<?php
// Include your site header (contains navigation and database connection)
include 'include/header.php'; 

/* =========================================================
   DYNAMIC DATABASE FETCHING
========================================================= */

// 1. Fetch Innovation Sliders (For the top Carousel)
$sliders = [];
if (isset($conn)) {
    $slider_query = $conn->query("SELECT * FROM innovation_sliders WHERE status=1 ORDER BY display_order ASC");
    if ($slider_query) {
        while ($row = $slider_query->fetch_assoc()) {
            $sliders[] = $row;
        }
    }
}

// 2. Fetch Portfolio Works (For Digital Experience Section)
$portfolios = [];
if (isset($conn)) {
    // Fetch latest 4 completed works
    $port_query = $conn->query("SELECT * FROM portfolio_works WHERE status=1 ORDER BY created_at DESC LIMIT 4");
    if ($port_query) {
        while ($row = $port_query->fetch_assoc()) {
            $portfolios[] = $row;
        }
    }
}

// 3. Fetch Innovation Pillars
$pillars = [];
if (isset($conn)) {
    $pillar_query = $conn->query("SELECT * FROM innovation_pillars WHERE status=1 ORDER BY display_order ASC");
    if ($pillar_query) {
        while ($row = $pillar_query->fetch_assoc()) {
            $pillars[] = $row;
        }
    }
}
?>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* ================= THEME VARIABLES ================= */
    :root {
        --sk-blue: #042a41;
        --sk-orange: #e65c3d;
        --sk-orange-hover: #cf4f33;
        --sk-text: #6b7a85;
        --sk-bg-gray: #f8f9fa;
        --sk-border: #e2e8f0;
    }

    body {
        background-color: #ffffff;
        color: var(--sk-text);
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        overflow-x: hidden;
    }

    h1, h2, h3, h4 { color: var(--sk-blue); font-weight: 800; }

    .sk-subtitle {
        color: #ff6b6b; font-size: 0.85rem; text-transform: uppercase;
        letter-spacing: 1.5px; font-weight: 700; display: block; margin-bottom: 10px;
    }

    /* Buttons */
    .btn-sk-outline {
        background-color: transparent; color: var(--sk-orange);
        border: 1px solid rgba(230, 92, 61, 0.4); padding: 10px 30px;
        border-radius: 30px; font-weight: 600; transition: all 0.3s;
        text-decoration: none; display: inline-block;
    }
    .btn-sk-outline:hover { background: var(--sk-orange); color: white; border-color: var(--sk-orange); }

    .btn-sk-orange {
        background-color: var(--sk-orange); color: #ffffff; border: none;
        padding: 12px 32px; border-radius: 30px; font-weight: 600;
        transition: all 0.3s ease; text-decoration: none; display: inline-flex;
        align-items: center; gap: 8px;
    }
    .btn-sk-orange:hover {
        background-color: var(--sk-orange-hover); color: #ffffff;
        transform: translateY(-3px); box-shadow: 0 10px 20px rgba(230, 92, 61, 0.2);
    }

    /* ================= PAGE HEADER ================= */
    .page-header-banner {
        background-color: var(--sk-blue); padding: 120px 20px 80px;
        text-align: center; color: #ffffff; position: relative; overflow: hidden;
    }
    .page-header-banner::after {
        content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background-image: radial-gradient(rgba(255,255,255,0.08) 1.5px, transparent 1.5px);
        background-size: 30px 30px; z-index: 1;
    }
    .page-header-content { position: relative; z-index: 2; }
    .page-header-banner h1 { font-size: clamp(2.5rem, 5vw, 4rem); margin-bottom: 15px; color: #fff;}
    .page-header-banner p { font-size: 1.15rem; max-width: 600px; margin: 0 auto 30px; color: rgba(255,255,255,0.7); }
    
    .breadcrumb { justify-content: center; background: transparent; padding: 0; margin: 0; }
    .breadcrumb-item a { color: var(--sk-orange); text-decoration: none; font-weight: 700; transition: 0.3s; }
    .breadcrumb-item a:hover { color: #ffffff; }
    .breadcrumb-item.active { color: rgba(255,255,255,0.6); }

    /* ================= FULL SLIDER SECTION ================= */
    .showcase-section { padding: 100px 0; background-color: #ffffff; }
    .showcase-text-content h2 { font-size: 2.5rem; line-height: 1.2; margin-bottom: 20px; }
    .showcase-text-content p.lead-text { font-size: 1.1rem; line-height: 1.8; margin-bottom: 30px; }
    
    .thumbs-list { list-style: none; padding: 0; margin: 0; }
    .thumbs-list li { display: flex; align-items: flex-start; margin-bottom: 20px; font-size: 1.05rem; }
    .thumbs-list li svg { color: var(--sk-orange); flex-shrink: 0; margin-right: 15px; margin-top: 4px; }

    .custom-full-slider { padding-bottom: 60px; }
    .custom-full-slider img { border-radius: 12px; box-shadow: 0 20px 40px rgba(4,42,65,0.1); height: 450px; object-fit: cover; }
    .custom-full-slider .carousel-indicators { bottom: 0; margin-bottom: 0; }
    .custom-full-slider .carousel-indicators [data-bs-target] { width: 12px; height: 12px; border-radius: 50%; background-color: #cbd5e1; margin: 0 6px; border: none; transition: 0.3s; }
    .custom-full-slider .carousel-indicators .active { background-color: var(--sk-orange); transform: scale(1.2); }

    /* ================= DIGITAL EXPERIENCE ================= */
    .digital-experience-section { padding: 80px 0 100px 0; background-color: var(--sk-bg-gray); }
    .portfolio-card { background: #ffffff; border-radius: 0 0 8px 8px; overflow: hidden; transition: 0.3s; height: 100%; display: flex; flex-direction: column; }
    .portfolio-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(4,42,65,0.08); }
    .portfolio-img-wrapper { background: #f1f5f9; padding: 30px; display: flex; justify-content: center; align-items: center; height: 320px; }
    .portfolio-img-wrapper img { max-width: 100%; max-height: 100%; object-fit: contain; transition: 0.5s; }
    .portfolio-card:hover .portfolio-img-wrapper img { transform: scale(1.05); }
    .portfolio-content { padding: 25px 30px; flex-grow: 1; }
    .portfolio-content h4 { font-size: 1.4rem; font-weight: 700; margin-bottom: 8px; }
    .portfolio-content .read-more { color: #ff6b6b; font-weight: 600; text-decoration: none; font-size: 0.95rem; transition: 0.3s; }
    .portfolio-content .read-more:hover { color: var(--sk-blue); }

    /* ================= PILLARS OF INNOVATION ================= */
    .pillars-section { padding: 100px 0; background-color: #ffffff; }
    .innovation-card { background: #ffffff; border-radius: 12px; padding: 40px 30px; height: 100%; border: 1px solid var(--sk-border); transition: 0.4s; display: flex; flex-direction: column; align-items: center; text-align: center; }
    .icon-box { width: 70px; height: 70px; border-radius: 50%; background: rgba(230,92,61,0.1); color: var(--sk-orange); display: flex; align-items: center; justify-content: center; margin-bottom: 25px; transition: 0.4s; }
    .innovation-card:hover { transform: translateY(-10px); box-shadow: 0 15px 35px rgba(4,42,65,0.1); border-color: rgba(230,92,61,0.3); }
    .innovation-card:hover .icon-box { background: var(--sk-orange); color: #ffffff; transform: scale(1.1) rotate(5deg); }
</style>

<header class="page-header-banner">
    <div class="container page-header-content">
        <span class="sk-subtitle text-white-50" data-aos="fade-down" style="color: rgba(255,255,255,0.7) !important;">NGA-Coding Academy</span>
        <h1 data-aos="zoom-in" data-aos-duration="1000">Hello Innovation</h1>
        <p data-aos="fade-up" data-aos-delay="200">Driving Rwandan progress through cutting-edge technology, creative problem solving, and a future-ready entrepreneurial mindset.</p>
        
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="400">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Innovation</li>
            </ol>
        </nav>
    </div>
</header>

<section class="showcase-section">
    <div class="container" data-aos="fade-up">
        
        <?php if(!empty($sliders)): ?>
        <div id="innovationFullSlider" class="carousel slide custom-full-slider" data-bs-ride="carousel">
            
            <div class="carousel-indicators">
                <?php foreach($sliders as $index => $slide): ?>
                    <button type="button" data-bs-target="#innovationFullSlider" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" <?= $index === 0 ? 'aria-current="true"' : '' ?>></button>
                <?php endforeach; ?>
            </div>

            <div class="carousel-inner">
                <?php foreach($sliders as $index => $slide): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="row align-items-center g-5">
                            <div class="col-lg-6 pe-lg-5">
                                <div class="showcase-text-content">
                                    <h2><?= htmlspecialchars($slide['title']) ?></h2>
                                    <p class="lead-text"><?= htmlspecialchars($slide['description']) ?></p>
                                    
                                    <ul class="thumbs-list">
                                        <?php if(!empty($slide['list_item_1'])): ?>
                                        <li>
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                                            <span><?= htmlspecialchars($slide['list_item_1']) ?></span>
                                        </li>
                                        <?php endif; ?>
                                        <?php if(!empty($slide['list_item_2'])): ?>
                                        <li>
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                                            <span><?= htmlspecialchars($slide['list_item_2']) ?></span>
                                        </li>
                                        <?php endif; ?>
                                    </ul>

                                    <a href="digital_solutions.php?id=<?= $slide['id'] ?>" class="btn-sk-orange mt-3">
                                        Read More
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <img src="admin/<?= htmlspecialchars($slide['image_url']) ?>" class="d-block w-100" alt="<?= htmlspecialchars($slide['title']) ?>" onerror="this.src='https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1000&q=80'">
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php else: ?>
            <p class="text-center text-muted">No slider presentations available.</p>
        <?php endif; ?>

    </div>
</section>

<section class="digital-experience-section">
    <div class="container">
        
        <div class="d-flex justify-content-between align-items-end flex-wrap mb-5" data-aos="fade-up">
            <div class="mb-3 mb-md-0">
                <span class="sk-subtitle">Digital Experience</span>
                <h2 style="font-size: clamp(2rem, 4vw, 2.8rem); max-width: 600px; line-height: 1.2;">The Hundred Of Completed Works Still Counting</h2>
            </div>
            <div>
                <a href="portfolio.php" class="btn-sk-outline">View All</a>
            </div>
        </div>

        <div class="row g-4">
            <?php 
            if(!empty($portfolios)): 
                $delay = 100;
                foreach($portfolios as $port): 
            ?>
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                    <div class="portfolio-card">
                        <div class="portfolio-img-wrapper">
                            <img src="admin/<?= htmlspecialchars($port['image_url']) ?>" alt="<?= htmlspecialchars($port['title']) ?>" style="border-radius: 8px; box-shadow: 0 10px 20px rgba(0,0,0,0.1);" onerror="this.src='https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=800&q=80'">
                        </div>
                        <div class="portfolio-content">
                            <h4><?= htmlspecialchars($port['title']) ?></h4>
                            <a href="portfolio_details.php?id=<?= $port['id'] ?>" class="read-more">Read More</a>
                        </div>
                    </div>
                </div>
            <?php 
                $delay += 100;
                endforeach; 
            else: 
            ?>
                <div class="col-12 text-center text-muted"><p>No completed works found.</p></div>
            <?php endif; ?>
        </div>

    </div>
</section>

<section class="pillars-section">
    <div class="container">
        
        <div class="text-center mb-5 pb-3" data-aos="fade-up">
            <span class="sk-subtitle" style="color: var(--sk-orange);">Our Focus</span>
            <h2 style="font-size: 2.5rem;">The Pillars of NGA Innovation</h2>
        </div>

        <div class="row g-4">
            <?php 
            if(!empty($pillars)): 
                $p_delay = 100;
                foreach($pillars as $pillar): 
            ?>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= $p_delay ?>">
                    <div class="innovation-card">
                        <div class="icon-box">
                            <?= !empty($pillar['icon_svg']) ? $pillar['icon_svg'] : '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12a10 10 0 1 0 20 0 10 10 0 1 0-20 0Z"></path><path d="M12 2v20"></path><path d="M2 12h20"></path></svg>'; ?>
                        </div>
                        <h4><?= htmlspecialchars($pillar['title']) ?></h4>
                        <p class="text-muted m-0"><?= htmlspecialchars($pillar['description']) ?></p>
                    </div>
                </div>
            <?php 
                $p_delay += 100;
                endforeach; 
            else: 
            ?>
                 <div class="col-12 text-center text-muted"><p>No pillars found.</p></div>
            <?php endif; ?>
        </div>

    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        AOS.init({
            duration: 800,      // Animation duration (ms)
            offset: 100,        // Offset from trigger point (px)
            once: true,         // Only animate once
            easing: 'ease-out-cubic' 
        });
    });
</script>

<?php 
// Include your site footer
include 'include/footer.php'; 
?>