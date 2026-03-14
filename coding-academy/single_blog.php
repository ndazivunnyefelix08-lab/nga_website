<?php
// Include your header which likely contains the $conn database connection
include 'include/header.php'; 

// Fallback DB connection just in case it's not in header.php
if (!isset($conn)) {
    $host = "localhost";
    $dbname = "ngarw_spes";
    $user = "ngarw_spes";
    $pass = "ngarw_spes";
    $conn = new mysqli($host, $user, $pass, $dbname);
}

// 1. Get the Blog ID from the URL
$blog_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$blog = null;

// 2. Fetch the specific blog post
if ($blog_id > 0) {
    $stmt = $conn->prepare("SELECT * FROM academy_blogs WHERE id = ? AND status = 1");
    $stmt->bind_param("i", $blog_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $blog = $result->fetch_assoc();
    }
}

// 3. Fetch 3 other recent blogs for the "More News" section at the bottom
$recent_blogs = [];
if ($blog) {
    $recent_stmt = $conn->prepare("SELECT * FROM academy_blogs WHERE status = 1 AND id != ? ORDER BY post_date DESC LIMIT 3");
    $recent_stmt->bind_param("i", $blog_id);
    $recent_stmt->execute();
    $recent_result = $recent_stmt->get_result();
    while ($row = $recent_result->fetch_assoc()) {
        $recent_blogs[] = $row;
    }
}
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    :root {
        --sk-blue: #0f172a; 
        --sk-orange: #ea580c; 
        --sk-bg-gray: #f8fafc;
        --sk-text: #334155;
    }

    body { 
        font-family: 'Inter', sans-serif;
        color: var(--sk-text);
        background-color: var(--sk-bg-gray);
    }

    .article-header {
        background-color: var(--sk-blue);
        color: white;
        padding: 80px 0 60px;
        text-align: center;
    }

    .article-meta {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        color: #94a3b8;
        font-size: 0.95rem;
        margin-top: 20px;
    }

    .article-meta i {
        color: var(--sk-orange);
    }

    .article-image-container {
        max-width: 900px;
        margin: -40px auto 40px;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        background: white;
    }

    .article-image-container img {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
    }

    .article-content {
        max-width: 800px;
        margin: 0 auto;
        font-size: 1.15rem;
        line-height: 1.8;
        color: #475569;
        padding: 0 20px 60px;
    }

    .article-content p {
        margin-bottom: 24px;
    }

    /* Styling for the related blogs card to match the landing page */
    .blog-card {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        background: white;
        height: 100%;
        transition: transform 0.3s;
    }
    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }
    .blog-card img { width: 100%; height: 200px; object-fit: cover; }
    .blog-content { padding: 25px; }
</style>

<?php if ($blog): ?>
    <section class="article-header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-start mb-4">
                        <a href="blogs.php" class="text-white text-decoration-none" style="opacity: 0.8;">
                            <i class="fas fa-arrow-left me-2"></i> Back to all blogs
                        </a>
                    </div>
                    
                    <h1 class="fw-bold" style="font-size: 3rem; letter-spacing: -0.02em;"><?= htmlspecialchars($blog['title']) ?></h1>
                    
                    <div class="article-meta">
                        <span><i class="fas fa-user-edit"></i> <?= htmlspecialchars($blog['author'] ?: 'NGA Admin') ?></span>
                        <span><i class="far fa-calendar-alt"></i> <?= date('F j, Y', strtotime($blog['post_date'])) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container relative-container">
        <div class="article-image-container">
            <?php 
                $img = !empty($blog['image_path']) ? $blog['image_path'] : 'https://via.placeholder.com/900x500?text=No+Featured+Image';
            ?>
            <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($blog['title']) ?>">
        </div>
    </div>

    <article class="article-content">
        <?php 
            // nl2br() turns line breaks from the database into HTML <br> tags so paragraphs show up properly.
            echo nl2br(htmlspecialchars($blog['content'])); 
        ?>
    </article>

    <?php if (count($recent_blogs) > 0): ?>
    <section class="py-5 bg-white border-top">
        <div class="container py-4">
            <h3 class="mb-4 text-center fw-bold" style="color: var(--sk-blue);">More Recent News</h3>
            <div class="row g-4 justify-content-center">
                <?php foreach ($recent_blogs as $rb): ?>
                    <?php 
                        $rb_img = !empty($rb['image_path']) ? $rb['image_path'] : 'https://via.placeholder.com/400x250?text=NGA+Blog';
                        $excerpt = strip_tags($rb['content']);
                        if (strlen($excerpt) > 100) $excerpt = substr($excerpt, 0, 100) . '...';
                    ?>
                    <div class="col-md-4">
                        <div class="blog-card d-flex flex-column">
                            <img src="<?= htmlspecialchars($rb_img) ?>" alt="<?= htmlspecialchars($rb['title']) ?>">
                            <div class="blog-content d-flex flex-column flex-grow-1">
                                <span class="text-muted small mb-2"><i class="far fa-calendar-alt me-1"></i> <?= date('M d, Y', strtotime($rb['post_date'])) ?></span>
                                <h5 class="fw-bold mb-3" style="color: var(--sk-blue);"><?= htmlspecialchars($rb['title']) ?></h5>
                                <p class="text-muted small mb-4 flex-grow-1"><?= htmlspecialchars($excerpt) ?></p>
                                <a href="single_blog.php?id=<?= $rb['id'] ?>" style="color: var(--sk-orange); font-weight: 600; text-decoration: none; margin-top: auto;">
                                    Read Article &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

<?php else: ?>
    <section class="py-5 text-center" style="min-height: 60vh; display: flex; align-items: center; justify-content: center;">
        <div class="container">
            <div class="text-muted mb-4" style="font-size: 4rem;">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <h1 class="fw-bold mb-3" style="color: var(--sk-blue);">Article Not Found</h1>
            <p class="text-muted mb-4 fs-5">The blog post you are looking for does not exist or has been unpublished.</p>
            <a href="index.php" class="btn text-white px-4 py-2 rounded-3 fw-bold" style="background-color: var(--sk-orange);">Return to Home</a>
        </div>
    </section>
<?php endif; ?>

<?php include 'include/footer.php'; ?>