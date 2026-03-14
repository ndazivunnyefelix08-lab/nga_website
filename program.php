<?php
include 'include/header.php';

if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$program_id = (int)$_GET['id'];

/* Fetch single program */
$stmt = $conn->prepare("SELECT * FROM programs WHERE id = ?");
$stmt->bind_param("i", $program_id);
$stmt->execute();
$program = $stmt->get_result()->fetch_assoc();

if(!$program){
    header("Location: index.php");
    exit;
}

/* Helper function to convert YouTube URLs to Embeds */
function getYoutubeEmbedUrl($url) {
    $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
    $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v=)|(?:\/))([a-zA-Z0-9_-]+)/i';

    if (preg_match($longUrlRegex, $url, $matches)) {
        return "https://www.youtube.com/embed/" . $matches[3];
    } elseif (preg_match($shortUrlRegex, $url, $matches)) {
        return "https://www.youtube.com/embed/" . $matches[1];
    }
    return $url;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($program['title']); ?> | NGA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }
        body { font-family: 'Inter', sans-serif; }
        
        /* Hero Section Styling */
        .hero-section {
            height: 450px;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('admin/uploads/banners/<?= $program['banner'] ?? 'default-bg.jpg'; ?>');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            color: white;
            border-radius: 0 0 40px 40px;
        }

        /* Content Card Overlap */
        .content-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            padding: 2.5rem;
            margin-top: -80px;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .sticky-sidebar { position: sticky; top: 30px; }

        /* Smooth Hover for Related Items */
        .related-item {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        .related-item:hover {
            background: #fff;
            border-color: #ffc107;
            transform: translateX(8px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        /* Video Container */
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 15px;
            margin: 2.5rem 0;
            background: #000;
        }
        .video-container iframe {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
        }

        .program-icon-lg {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 15px;
        }
    </style>
</head>
<body class="bg-light">

<header class="hero-section">
    <div class="container text-center">
       
        <h1 class="display-3 fw-bold"><?= $program['title']; ?></h1>
        <nav aria-label="breadcrumb">
         <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fw-bold text-uppercase">Enrollment Open</span>
           <!-- <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php" class="text-white text-decoration-none opacity-75">Home</a></li>
                <li class="breadcrumb-item active text-white fw-bold" aria-current="page">Details</li>
            </ol>-->
        </nav>
    </div>
</header>

<main class="container py-5">
    <div class="row g-5">
        
        <div class="col-lg-8">
            <div class="content-card">
                <?php if(!empty($program['icon'])): ?>
                    <img src="admin/uploads/program_icons/<?= $program['icon']; ?>" class="program-icon-lg mb-4 shadow-sm" alt="Program Banner">
                <?php endif; ?>

                <h2 class="fw-bold mb-4 border-start border-warning border-4 ps-3">Program Overview</h2>
                <div class="fs-5 text-muted lh-lg mb-5">
                    <?= nl2br($program['description']); ?>
                </div>

                <?php if(!empty($program['youtube_link'])): ?>
                    <h4 class="fw-bold mb-3"><i class="bi bi-play-circle-fill text-danger"></i> Video Introduction</h4>
                    <div class="video-container shadow-lg">
                        <iframe src="<?= getYoutubeEmbedUrl($program['youtube_link']); ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="sticky-sidebar">
                
                <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                    <div class="card-header bg-warning py-3 border-0">
                        <h5 class="mb-0 fw-bold text-center">Take Action</h5>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted mb-4">Click below to submit your application for the next cohort starting soon.</p>
                        <a href="student_register.php?id=<?= $program_id; ?>" class="btn btn-dark btn-lg w-100 rounded-pill fw-bold py-3">
                            Apply for Admission
                        </a>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Recommended For You</h5>
                        
                        <?php
                        $related = $conn->query("SELECT id, title, icon FROM programs WHERE id != $program_id LIMIT 4");
                        while($rel = $related->fetch_assoc()):
                            
                            // DETERMINING THE LINK BASED ON PROGRAM NAME
                            $progTitle = strtolower(trim($rel['title']));
                            if($progTitle == 'nga-coding academy' || $progTitle == 'nga coding academy') {
                                $targetPage = "https://nga-web-demo.vercel.app/";
                            } else {
                                $targetPage = "program.php";
                            }
                        ?>
                        <div class="related-item d-flex align-items-center mb-3 p-2 rounded-3">
                            <img src="admin/uploads/program_icons/<?= $rel['icon']; ?>" 
                                 class="rounded-3 shadow-sm me-3" 
                                 style="width:65px; height:65px; object-fit:cover;">
                            <div class="position-relative">
                                <h6 class="mb-1">
                                    <a href="<?= $targetPage; ?>?id=<?= $rel['id']; ?>" 
                                       target="_blank"
                                       class="text-dark text-decoration-none fw-bold stretched-link">
                                       <?= $rel['title']; ?>
                                    </a>
                                </h6>
                                <small class="text-warning fw-semibold text-uppercase" style="font-size: 0.7rem;">Read More &rarr;</small>
                            </div>
                        </div>
                        <?php endwhile; ?>

                    </div>
                </div>

                <div class="text-center mt-4">
                    <p class="small text-muted">Need help? <a href="index.php#contact" class="text-decoration-none fw-bold">Contact Support</a></p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'include/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>