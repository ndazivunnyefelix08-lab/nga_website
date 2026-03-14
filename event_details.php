<?php
include "config/db.php"; 
include "include/header.php";

// Function to convert plain YouTube URLs into responsive Embed Iframes
function formatEventContent($string) {
    // 1. Convert standard YouTube links to Embeds
    $string = preg_replace(
        "/[a-zA-Z|0-9|\?|\&|\=|\-|\/|\:]+youtube\.com\/watch\?v=([a-zA-Z0-9\-_]+)\S*/",
        "<div class='ratio ratio-16x9 my-4 sk-shadow rounded overflow-hidden'><iframe src='https://www.youtube.com/embed/$1' frameborder='0' allowfullscreen></iframe></div>",
        $string
    );

    // 2. Ensure existing iframes (pasted embed codes) are also responsive
    if (strpos($string, '<iframe') !== false && strpos($string, 'ratio') === false) {
        $string = str_replace('<iframe', '<div class="ratio ratio-16x9 my-4 sk-shadow rounded overflow-hidden"><iframe', $string);
        $string = str_replace('</iframe>', '</iframe></div>', $string);
    }

    return $string;
}

// Get the event ID from the URL
$event_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$event = null;

if ($event_id > 0) {
    $stmt = mysqli_prepare($conn, "SELECT title, body, image, created_at FROM events WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $event_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $event = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

// Redirect if event not found
if (!$event) {
    echo "<div class='container py-5 mt-5 text-center' style='min-height: 50vh; display: flex; flex-direction: column; justify-content: center; align-items: center;'>
            <h3 style='color: #042a41; font-weight: 800; font-family: \"Manrope\", sans-serif;'>Event not found.</h3>
            <a href='index.php' class='btn' style='background-color: #e65c3d; color: white; padding: 12px 32px; border-radius: 4px; font-weight: 700; margin-top: 20px; text-decoration: none;'>Back to Home</a>
          </div>";
    include "include/footer.php";
    exit;
}
?>

<style>
    /* ================= SKOOLA EXACT COLORS & VARIABLES ================= */
    :root {
        --sk-blue: #042a41;
        --sk-orange: #e65c3d;
        --sk-orange-hover: #cf4f33;
        --sk-bg-gray: #f8f9fa;
        --sk-text: #6b7a85;
        --font-main: 'Manrope', sans-serif;
    }

    body {
        font-family: var(--font-main);
        background: var(--sk-bg-gray);
        color: var(--sk-text);
    }

    h1, h2, h3, h4, h5, h6 {
        color: var(--sk-blue);
        font-weight: 800;
        font-family: var(--font-main);
    }

    /* Hero Section matching the Skoola theme */
    .event-hero {
        position: relative;
        height: 60vh;
        min-height: 450px;
        background-color: var(--sk-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        overflow: hidden;
    }
    .event-hero-bg {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: url('<?php echo !empty($event['image']) ? $event['image'] : 'images/default-event.jpg'; ?>') center/cover no-repeat;
        z-index: 0;
    }
    .event-hero-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(4, 42, 65, 0.85); /* Deep blue overlay */
        background-image: radial-gradient(rgba(0,0,0,0.2) 1px, transparent 1px); /* Dot matrix effect */
        background-size: 4px 4px;
        z-index: 1;
    }
    .event-hero-content {
        position: relative;
        z-index: 2;
        padding: 0 20px;
        max-width: 900px;
    }
    .event-hero-content h1 {
        color: #ffffff;
        font-size: 3.5rem;
        letter-spacing: -1px;
        line-height: 1.2;
    }

    /* Badges / Tags */
    .sk-badge-orange {
        background: rgba(230, 92, 61, 0.15);
        color: var(--sk-orange);
        border: 1px solid rgba(230, 92, 61, 0.3);
        padding: 8px 18px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .sk-badge-light {
        background: rgba(255,255,255,0.1);
        color: #ffffff;
        border: 1px solid rgba(255,255,255,0.2);
        padding: 8px 18px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    /* Content Wrapper */
    .event-content-wrapper {
        margin-top: -80px; /* Overlap effect */
        background: #ffffff;
        border-radius: 4px; /* Skoola uses sharp/small border radius */
        border: 1px solid #edf2f7;
        padding: 60px;
        box-shadow: 0 20px 50px rgba(4, 42, 65, 0.08);
        position: relative;
        z-index: 10;
    }
    
    /* Breadcrumbs */
    .sk-breadcrumb {
        background: var(--sk-bg-gray);
        padding: 12px 25px;
        border-radius: 4px;
        font-size: 0.9rem;
        font-weight: 600;
    }
    .sk-breadcrumb a {
        text-decoration: none;
        color: var(--sk-orange);
        transition: 0.3s;
    }
    .sk-breadcrumb a:hover { color: var(--sk-orange-hover); }
    .sk-breadcrumb .breadcrumb-item.active { color: var(--sk-text); }
    .sk-breadcrumb .breadcrumb-item + .breadcrumb-item::before { color: #cbd5e1; }

    /* Body Text Styling */
    .content-body {
        line-height: 1.8;
        font-size: 1.1rem;
        color: var(--sk-text);
        margin-top: 40px;
    }
    .content-body h1, .content-body h2, .content-body h3, .content-body h4 {
        margin-top: 30px;
        margin-bottom: 15px;
    }
    .content-body img {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
        margin: 30px 0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
    .sk-shadow {
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        border-radius: 4px !important;
    }

    /* Buttons */
    .btn-sk-outline {
        background-color: transparent;
        color: var(--sk-orange);
        border: 1px solid var(--sk-orange);
        padding: 10px 24px;
        border-radius: 4px;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }
    .btn-sk-outline:hover { background: var(--sk-orange); color: white; }

    /* Share Icons */
    .share-links .share-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px; height: 40px;
        border-radius: 50%;
        background: var(--sk-bg-gray);
        color: var(--sk-blue);
        transition: all 0.3s ease;
        text-decoration: none;
    }
    .share-links .share-btn:hover {
        background: var(--sk-orange);
        color: white;
        transform: translateY(-3px);
    }

    @media (max-width: 768px) {
        .event-hero-content h1 { font-size: 2.5rem; }
        .event-content-wrapper { padding: 30px 20px; margin-top: -50px; }
        .content-body { font-size: 1rem; }
    }
</style>

<header class="event-hero">
    <div class="event-hero-bg"></div>
    <div class="event-hero-overlay"></div>
    <div class="event-hero-content container">
        <h1 class="mb-4"><?php echo htmlspecialchars($event['title']); ?></h1>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <span class="sk-badge-orange">
                <i class="far fa-calendar-alt me-2"></i> <?php echo date("F d, Y", strtotime($event['created_at'])); ?>
            </span>
            <span class="sk-badge-light">
                <i class="fas fa-bullhorn me-2"></i> Announcement
            </span>
        </div>
    </div>
</header>

<main class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <article class="event-content-wrapper">
                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb sk-breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="nga_events.php">Events</a></li>
                        <li class="breadcrumb-item active text-truncate" style="max-width: 200px;" aria-current="page">
                            <?php echo htmlspecialchars($event['title']); ?>
                        </li>
                    </ol>
                </nav>

                <div class="content-body">
                    <?php 
                        // Apply YouTube conversion and display content
                        echo formatEventContent($event['body']); 
                    ?>
                </div>

                <hr class="my-5" style="border-color: #edf2f7; opacity: 1;">
                
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-4">
                    <a href="nga_events.php" class="btn-sk-outline">
                        &larr; Explore All Events
                    </a>
                    
                    <div class="share-links d-flex align-items-center gap-2">
                        <span class="me-2 fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px; color: var(--sk-text);">Share:</span>
                        <a href="#" class="share-btn"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="share-btn"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="share-btn"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" class="share-btn"><i class="fas fa-link"></i></a>
                    </div>
                </div>
            </article>
        </div>
    </div>
</main>
</body>
<?php include "include/footer.php"; ?>

</html>