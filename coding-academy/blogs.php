<?php
// Include the header (this contains your DB connection $conn, <head>, and navbar)
include 'include/header.php'; 

// Fetch ONLY published blogs (status = 1), ordered by newest first
$blogs = [];
if (isset($conn)) {
    $blog_query = $conn->query("SELECT * FROM academy_blogs WHERE status = 1 ORDER BY post_date DESC");
    if ($blog_query) {
        while ($row = $blog_query->fetch_assoc()) {
            $blogs[] = $row;
        }
    }
}
?>

<style>
    /* Custom styles specifically for the blogs page, matching your site's theme */
    .page-banner {
        background-color: #0f172a; /* Dark blue matching your theme */
        color: white;
        padding: 80px 0;
        text-align: center;
    }
    .page-banner h1 {
        color: white;
        font-weight: 800;
        font-size: 3rem;
        margin-bottom: 15px;
    }
    .page-banner p {
        color: #e2e8f0;
        font-size: 1.15rem;
        max-width: 600px;
        margin: 0 auto;
    }
    .blog-card { 
        border-radius: 12px; 
        overflow: hidden; 
        border: 1px solid #e2e8f0; 
        background: white;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08);
    }
    .blog-card img { 
        width: 100%; 
        height: 220px; 
        object-fit: cover; 
    }
    .blog-content { 
        padding: 30px; 
    }
    .blog-meta {
        font-size: 0.85rem;
        color: #64748b;
        margin-bottom: 15px;
        display: flex;
        gap: 15px;
    }
    .read-more-link {
        color: #ea580c; /* Orange matching your theme */
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s;
    }
    .read-more-link:hover {
        color: #c2410c;
    }
</style>

<section class="page-banner">
    <!--<div class="container">
        <h1>Academy Blog</h1>
        <p>Stay updated with the latest coding tutorials, student stories, and tech news from New Generation Academy.</p>
    </div>-->
</section>

<section class="py-5" style="background-color: #f8fafc; min-height: 50vh;">
    <div class="container py-4">
        
        <?php if(count($blogs) > 0): ?>
            <div class="row g-4">
                
                <?php foreach($blogs as $blog): ?>
                    <?php 
                        // Strip HTML tags and shorten the content to 120 characters for the preview
                        $excerpt = strip_tags($blog['content']);
                        if (strlen($excerpt) > 120) {
                            $excerpt = substr($excerpt, 0, 120) . '...';
                        }
                        
                        // Fallback image if none is provided in the database
                        $img = !empty($blog['image_path']) ? $blog['image_path'] : 'https://via.placeholder.com/600x400?text=NGA+Blog';
                    ?>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="blog-card h-100 d-flex flex-column">
                            <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($blog['title']) ?>" onerror="this.src='https://via.placeholder.com/600x400?text=No+Image'">
                            
                            <div class="blog-content d-flex flex-column flex-grow-1">
                                <div class="blog-meta">
                                    <span><i class="far fa-calendar-alt me-1"></i> <?= date('M d, Y', strtotime($blog['post_date'])) ?></span>
                                    <span><i class="fas fa-user-edit me-1"></i> <?= htmlspecialchars($blog['author'] ?: 'Admin') ?></span>
                                </div>
                                
                                <h4 class="fw-bold mb-3" style="color: #0f172a; line-height: 1.4;">
                                    <a href="single_blog.php?id=<?= $blog['id'] ?>" class="text-decoration-none" style="color: inherit;">
                                        <?= htmlspecialchars($blog['title']) ?>
                                    </a>
                                </h4>
                                
                                <p class="text-muted small mb-4 flex-grow-1" style="line-height: 1.6;">
                                    <?= htmlspecialchars($excerpt) ?>
                                </p>
                                
                                <div class="mt-auto border-top pt-3">
                                    <a href="single_blog.php?id=<?= $blog['id'] ?>" class="read-more-link">
                                        Read Article <i class="fas fa-arrow-right ms-1 fs-6"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
            </div>
        <?php else: ?>
            <div class="text-center py-5 bg-white rounded-3 border">
                <div class="mb-4" style="font-size: 3.5rem; color: #cbd5e1;">
                    <i class="fas fa-newspaper"></i>
                </div>
                <h3 class="fw-bold text-dark mb-2">No blogs published yet</h3>
                <p class="text-muted">Check back soon for new articles and updates.</p>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php 
// Include the footer (this should close the <body> and <html> tags)
include '../include/footer.php'; 
?>