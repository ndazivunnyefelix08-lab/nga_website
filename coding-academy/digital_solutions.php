<?php
// Include your site header (contains navigation and database connection)
include 'include/header.php'; 

// Fetch the specific ID from the URL (e.g., digital_solutions.php?id=1)
$solution_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$solution = null;
$error = false;

if ($solution_id > 0 && isset($conn)) {
    // Securely fetch the specific digital solution
    $stmt = $conn->prepare("SELECT * FROM innovation_sliders WHERE id = ? AND status = 1");
    if ($stmt) {
        $stmt->bind_param("i", $solution_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $solution = $result->fetch_assoc();
        } else {
            $error = true;
        }
        $stmt->close();
    } else {
        $error = true;
    }
} else {
    $error = true;
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

    h1, h2, h3, h4, h5, h6 {
        color: var(--sk-blue);
        font-weight: 800;
    }

    .sk-subtitle {
        color: var(--sk-orange);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 700;
        display: block;
        margin-bottom: 10px;
    }

    /* ================= PAGE HEADER BANNER ================= */
    .page-header-banner {
        background-color: var(--sk-blue);
        padding: 120px 20px 80px;
        text-align: center;
        color: #ffffff;
        position: relative;
        overflow: hidden;
    }
    
    .page-header-banner::after {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background-image: radial-gradient(rgba(255,255,255,0.08) 1.5px, transparent 1.5px);
        background-size: 30px 30px;
        z-index: 1;
    }

    .page-header-content {
        position: relative;
        z-index: 2;
    }

    .page-header-banner h1 {
        color: #ffffff;
        font-size: clamp(2.5rem, 5vw, 4rem);
        margin-bottom: 15px;
        line-height: 1.2;
        letter-spacing: -1px;
    }
    
    .breadcrumb {
        justify-content: center;
        background: transparent;
        padding: 0;
        margin: 0;
        font-size: 0.95rem;
    }
    .breadcrumb-item a { color: var(--sk-orange); text-decoration: none; font-weight: 700; transition: 0.3s; }
    .breadcrumb-item a:hover { color: #ffffff; }
    .breadcrumb-item.active { color: rgba(255,255,255,0.6); }
    .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.4); }

    /* ================= DETAILS SECTION ================= */
    .details-section {
        padding: 100px 0;
    }

    .feature-image-wrapper {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(4, 42, 65, 0.1);
        position: relative;
    }

    .feature-image-wrapper img {
        width: 100%;
        height: auto;
        max-height: 600px;
        object-fit: cover;
        display: block;
    }

    .details-content h2 {
        font-size: 2.8rem;
        line-height: 1.2;
        margin-bottom: 25px;
    }

    .details-content p.lead {
        font-size: 1.15rem;
        line-height: 1.8;
        color: var(--sk-text);
        margin-bottom: 30px;
    }

    .thumbs-list {
        list-style: none;
        padding: 0;
        margin: 0 0 40px 0;
        background: var(--sk-bg-gray);
        padding: 30px;
        border-radius: 12px;
        border: 1px solid var(--sk-border);
    }

    .thumbs-list li {
        display: flex;
        align-items: flex-start;
        margin-bottom: 15px;
        font-size: 1.05rem;
        line-height: 1.7;
        color: var(--sk-blue);
        font-weight: 500;
    }

    .thumbs-list li:last-child {
        margin-bottom: 0;
    }

    .thumbs-list li svg {
        color: var(--sk-orange);
        flex-shrink: 0;
        margin-right: 15px;
        margin-top: 4px;
    }

    /* Buttons */
    .btn-sk-orange {
        background-color: var(--sk-orange);
        color: #ffffff;
        border: none;
        padding: 14px 35px;
        border-radius: 30px;
        font-weight: 700;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-sk-orange:hover {
        background-color: var(--sk-orange-hover);
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(230, 92, 61, 0.2);
    }

    .btn-sk-outline {
        background-color: transparent;
        color: var(--sk-blue);
        border: 2px solid var(--sk-border);
        padding: 12px 30px;
        border-radius: 30px;
        font-weight: 700;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-sk-outline:hover { 
        background: var(--sk-blue); 
        color: white; 
        border-color: var(--sk-blue);
    }
</style>

<?php if ($solution && !$error): ?>
    <header class="page-header-banner">
        <div class="container page-header-content">
            <span class="sk-subtitle text-white-50" data-aos="fade-down" style="color: rgba(255,255,255,0.7) !important;">Digital Solutions</span>
            <h1 data-aos="zoom-in" data-aos-duration="1000">Solution Details</h1>
            
            <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="innovation.php">Innovation</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </nav>
        </div>
    </header>

    <section class="details-section">
        <div class="container">
            <div class="row g-5 align-items-center">
                
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="feature-image-wrapper">
                        <img src="admin/<?= htmlspecialchars($solution['image_url']) ?>" 
                             alt="<?= htmlspecialchars($solution['title']) ?>" 
                             onerror="this.src='https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1000&q=80'">
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="details-content">
                        <span class="sk-subtitle">NGA Innovation</span>
                        <h2><?= htmlspecialchars($solution['title']) ?></h2>
                        
                        <p class="lead">
                            <?= nl2br(htmlspecialchars($solution['description'])) ?>
                        </p>

                        <?php if (!empty($solution['list_item_1']) || !empty($solution['list_item_2'])): ?>
                            <ul class="thumbs-list shadow-sm">
                                <?php if (!empty($solution['list_item_1'])): ?>
                                <li>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                                    <span><?= htmlspecialchars($solution['list_item_1']) ?></span>
                                </li>
                                <?php endif; ?>
                                
                                <?php if (!empty($solution['list_item_2'])): ?>
                                <li>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                                    <span><?= htmlspecialchars($solution['list_item_2']) ?></span>
                                </li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>

                        <div class="d-flex gap-3 flex-wrap mt-4">
                            <a href="contact.php" class="btn-sk-orange">
                                Get in Touch
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                            </a>
                            <a href="innovation.php" class="btn-sk-outline">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                                Back to Innovation
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

<?php else: ?>
    <header class="page-header-banner" style="padding: 80px 20px;">
        <div class="container page-header-content">
            <h1>Solution Not Found</h1>
        </div>
    </header>

    <section class="py-5 text-center" style="padding-top: 100px !important; padding-bottom: 150px !important; background-color: var(--sk-bg-gray);">
        <div class="container" data-aos="fade-up">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--sk-orange)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 20px;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            
            <h2 class="mb-3" style="font-size: 2.5rem; color: var(--sk-blue);">Whoops!</h2>
            <p class="text-muted mb-5" style="font-size: 1.1rem; max-width: 500px; margin: 0 auto;">
                The digital solution you are looking for does not exist, has been removed, or the link is broken.
            </p>
            
            <a href="innovation.php" class="btn-sk-orange" style="padding: 12px 30px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Return to Innovation Page
            </a>
        </div>
    </section>
<?php endif; ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        AOS.init({
            duration: 800,
            offset: 100,
            once: true,
            easing: 'ease-out-cubic'
        });
    });
</script>

<?php 
// Include your site footer
include 'include/footer.php'; 
?>