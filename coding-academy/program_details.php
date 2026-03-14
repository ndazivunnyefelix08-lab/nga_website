<?php
// 1. Include your site header (which usually contains the DB connection $conn, nav bar, and <head> tags)
include 'include/header.php'; 

// 2. Get the Program ID from the URL (e.g., program_details.php?id=1)
$program_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$program = null;
$error_message = null;

// 3. Fetch Program Details from the 'academy_programs' table
if ($program_id > 0 && isset($conn)) {
    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM academy_programs WHERE id = ? AND status = 1");
    if ($stmt) {
        $stmt->bind_param("i", $program_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $program = $result->fetch_assoc();
        } else {
            $error_message = "Sorry, the program you are looking for could not be found or is no longer active.";
        }
        $stmt->close();
    } else {
        $error_message = "Database error. Please try again later.";
    }
} else {
    $error_message = "No valid program selected.";
}
?>

<style>
    /* ================= THEME COLORS & VARIABLES ================= */
    :root {
        --sk-blue: #042a41;
        --sk-orange: #e65c3d;
        --sk-orange-hover: #cf4f33;
        --sk-text: #6b7a85;
        --sk-bg-gray: #f8f9fa;
    }

    /* Target specific elements to avoid overriding your global header styles */
    .program-detail-page h1, 
    .program-detail-page h2, 
    .program-detail-page h3, 
    .program-detail-page h4 {
        color: var(--sk-blue);
        font-weight: 800;
    }

    /* ================= PAGE BANNER ================= */
    .program-header-banner {
        background-color: var(--sk-blue);
        padding: 100px 20px 80px;
        text-align: center;
        color: #ffffff;
        position: relative;
    }
    .program-header-banner h1 {
        color: #ffffff;
        font-size: clamp(2.5rem, 5vw, 3.5rem);
        margin-bottom: 15px;
        line-height: 1.2;
    }
    .program-meta {
        font-size: 1.1rem;
        opacity: 0.9;
        font-weight: 600;
        color: var(--sk-orange);
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    /* ================= MAIN CONTENT ================= */
    .program-content-section {
        padding: 80px 0;
        background-color: #ffffff;
    }
    .program-image {
        width: 100%;
        height: auto;
        max-height: 500px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 15px 35px rgba(4, 42, 65, 0.1);
        margin-bottom: 40px;
    }
    .program-description {
        font-size: 1.15rem;
        line-height: 1.8;
        color: var(--sk-text);
    }
    .program-description h3 {
        margin-top: 30px;
        margin-bottom: 20px;
        font-size: 2rem;
    }
    .program-description p {
        margin-bottom: 25px;
    }

    /* ================= BUTTONS ================= */
    .btn-apply-now {
        background-color: var(--sk-orange);
        color: #ffffff;
        border: none;
        padding: 16px 45px;
        border-radius: 4px;
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
    }
    .btn-apply-now:hover {
        background-color: var(--sk-orange-hover);
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(230, 92, 61, 0.25);
    }
</style>

<div class="program-detail-page">
    <?php if ($program): ?>
        
        <header class="program-header-banner">
            <div class="container">
                <h1><?php echo htmlspecialchars($program['title']); ?></h1>
                <div class="program-meta">
                    <?php if (!empty($program['program_number'])): ?>
                        Program Number: <?php echo htmlspecialchars($program['program_number']); ?>
                    <?php else: ?>
                        NGA Coding Academy
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <section class="program-content-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        
                        <?php if (!empty($program['image_url'])): ?>
                            <img src="<?php echo htmlspecialchars($program['image_url']); ?>" 
                                 alt="<?php echo htmlspecialchars($program['title']); ?>" 
                                 class="program-image"
                                 onerror="this.style.display='none'"> <?php endif; ?>

                        <div class="program-description">
                            <h3>About the Program</h3>
                            
                            <?php echo nl2br(htmlspecialchars($program['description'])); ?>
                        </div>
                        
                        <div class="text-start mt-5 pt-3 border-top">
                            <h4 class="mb-4">Ready to shape your future?</h4>
                            <a href="student_register.php?program_id=<?php echo $program['id']; ?>" class="btn-apply-now">
                                Apply for this Program
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 10px;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    <?php else: ?>
        
        <section class="py-5 text-center" style="padding-top: 150px !important; padding-bottom: 150px !important; background-color: var(--sk-bg-gray);">
            <div class="container">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--sk-orange)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 20px;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                
                <h2 class="mb-3" style="font-size: 2.5rem;">Program Not Found</h2>
                <p class="text-muted mb-5" style="font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
                    <?php echo isset($error_message) ? $error_message : "The program you are looking for does not exist."; ?>
                </p>
                
                <a href="index.php" class="btn-apply-now" style="padding: 12px 30px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px;"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    Return to Homepage
                </a>
            </div>
        </section>
        
    <?php endif; ?>
</div>

<?php 
// Include your site footer 
include 'include/footer.php'; 
?>