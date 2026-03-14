<?php
include 'include/header.php'; 

$courses = [];
if (isset($conn)) {
    // Fetch from the new table
    $query = $conn->query("SELECT * FROM academic_curriculum WHERE status = 1 ORDER BY academic_year ASC, id ASC");
    if ($query) { 
        while ($row = $query->fetch_assoc()) { 
            // Format the database row so it matches what our HTML expects
            $courses[] = [
                'code'        => $row['course_code'],
                'tags'        => explode(',', $row['tags']), // Splits "TAG1, TAG2" into an array
                'title'       => $row['title'],
                'description' => $row['description'],
                'duration'    => $row['duration'],
                'level'       => $row['course_level'],
                'year'        => $row['academic_year']
            ];
        } 
    }
}
?>

<style>
    /* ================= THEME VARIABLES ================= */
    :root {
        --sk-blue: #0f172a; 
        --sk-orange: #ea580c; 
        --sk-bg-gray: #f8fafc;
        --sk-text: #475569;
        --sk-border: #e2e8f0;
    }

    body {
        background-color: var(--sk-bg-gray);
        color: var(--sk-text);
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        overflow-x: hidden;
    }

    /* Buttons */
    .btn-sk-orange {
        background-color: var(--sk-orange);
        color: #ffffff;
        border: none;
        padding: 8px 24px;
        border-radius: 4px;
        font-weight: 700;
        transition: all 0.3s ease;
    }
    .btn-sk-outline {
        background-color: transparent;
        color: var(--sk-orange);
        border: 2px solid var(--sk-orange);
        padding: 8px 24px;
        border-radius: 4px;
        font-weight: 700;
        transition: all 0.3s;
    }

    /* ================= CURRICULUM LAYOUT ================= */
    .curriculum-section {
        padding: 80px 0;
    }

    /* LEFT SIDEBAR TIMELINE */
    .sidebar-wrapper {
        position: sticky;
        top: 120px;
    }
    
    .curriculum-timeline {
        padding-left: 10px;
    }
    
    .timeline-item {
        position: relative;
        padding-left: 30px;
        margin-bottom: 40px;
        cursor: pointer;
        transition: all 0.3s ease;
        opacity: 0.6; /* Inactive state */
    }
    
    .timeline-item:hover {
        opacity: 1;
    }

    .timeline-item.active {
        opacity: 1;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        left: 6px;
        top: 24px;
        bottom: -40px;
        width: 2px;
        background: var(--sk-border);
    }
    
    .timeline-item:last-child::before {
        display: none;
    }

    .timeline-marker {
        position: absolute;
        left: 0;
        top: 5px;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: white;
        border: 3px solid var(--sk-border);
        z-index: 2;
        transition: all 0.3s ease;
    }

    .timeline-item.active .timeline-marker {
        border-color: var(--sk-orange);
        background: var(--sk-orange);
        box-shadow: 0 0 0 4px rgba(234, 88, 12, 0.2);
    }

    .timeline-content h3 {
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--sk-blue);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
        transition: color 0.3s;
    }
    
    .timeline-item.active .timeline-content h3 {
        color: var(--sk-orange);
    }

    .timeline-content p {
        font-size: 0.9rem;
        color: var(--sk-text);
        margin: 0;
    }

    /* ================= COURSE CARDS ================= */
    .course-card-wrapper {
        display: none; /* Hidden by default, JavaScript handles showing */
        animation: fadeInCourse 0.5s ease forwards;
    }

    @keyframes fadeInCourse {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .course-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 35px 40px;
        margin-bottom: 25px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        border: 1px solid var(--sk-border);
        transition: all 0.3s ease;
    }

    .course-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        border-color: #cbd5e1;
    }

    .course-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 20px;
    }

    /* Badges */
    .badge-code {
        background: #e0f2fe;
        color: #0369a1;
        font-weight: 700;
        padding: 6px 16px;
        border-radius: 30px;
        font-size: 0.85rem;
        border: 1px solid #bae6fd;
    }

    .badge-tags-container {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .badge-tag {
        background: #f1f5f9;
        color: #475569;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Title & Description */
    .course-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--sk-blue);
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }

    .course-desc {
        color: var(--sk-text);
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 30px;
        max-width: 90%;
    }

    /* Footer Meta Data (Trimester & Level) */
    .course-meta {
        display: flex;
        gap: 25px;
        align-items: center;
        border-top: 1px solid var(--sk-border);
        padding-top: 20px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        color: #64748b;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .meta-item svg {
        color: var(--sk-orange);
        margin-right: 8px;
    }

    /* ================= BOTTOM ENROLL BANNER ================= */
    .enroll-banner {
        background: linear-gradient(90deg, #ea580c 0%, #c2410c 100%);
        padding: 30px 0;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .enroll-banner h3 {
        color: white;
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
    }

    /* Mobile adjustments */
    @media (max-width: 991px) {
        .sidebar-wrapper { display: none; } /* Hide timeline on mobile */
        .course-card { padding: 25px; }
        .course-title { font-size: 1.4rem; }
        .course-desc { max-width: 100%; font-size: 1rem; }
    }
</style>

<div style="background: white; padding: 60px 0 40px 0; border-bottom: 1px solid var(--sk-border);">
    <div class="container text-center">
        <h1 style="font-size: 3rem; color: var(--sk-blue);">Academic Curriculum</h1>
        <p style="font-size: 1.1rem; color: var(--sk-text); max-width: 600px; margin: 15px auto 0;">Explore the comprehensive modules and courses designed to build your expertise from foundation to advanced specialization.</p>
    </div>
</div>

<section class="curriculum-section">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-3 pe-lg-5">
                <div class="sidebar-wrapper">
                    <div class="curriculum-timeline">
                        <div class="timeline-item active" data-year-filter="1" onclick="filterCourses(1)">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h3>Year 1</h3>
                                <p>Foundation & Core Principles</p>
                            </div>
                        </div>
                        
                        <div class="timeline-item" data-year-filter="2" onclick="filterCourses(2)">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h3>Year 2</h3>
                                <p>Intermediate & Application</p>
                            </div>
                        </div>
                        
                        <div class="timeline-item" data-year-filter="3" onclick="filterCourses(3)">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h3>Year 3</h3>
                                <p>Advanced & Specialization</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                
                <div class="d-block d-lg-none mb-4 text-center">
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <button class="btn mobile-filter-btn btn-sk-orange" data-year-filter="1" onclick="filterCourses(1)">Year 1</button>
                        <button class="btn mobile-filter-btn btn-sk-outline" data-year-filter="2" onclick="filterCourses(2)">Year 2</button>
                        <button class="btn mobile-filter-btn btn-sk-outline" data-year-filter="3" onclick="filterCourses(3)">Year 3</button>
                    </div>
                </div>

                <div id="courseListContainer">
                    <?php foreach ($courses as $course): ?>
                        <div class="course-card-wrapper" data-course-year="<?= htmlspecialchars($course['year']); ?>">
                            <div class="course-card">
                                
                                <div class="course-header">
                                    <span class="badge-code"><?= htmlspecialchars($course['code']); ?></span>
                                    
                                    <div class="badge-tags-container">
                                        <?php foreach ($course['tags'] as $tag): ?>
                                            <span class="badge-tag"><?= htmlspecialchars($tag); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <h2 class="course-title"><?= htmlspecialchars($course['title']); ?></h2>
                                
                                <p class="course-desc">
                                    <?= htmlspecialchars($course['description']); ?>
                                </p>

                                <div class="course-meta">
                                    <div class="meta-item">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg>
                                        <?= htmlspecialchars($course['duration']); ?>
                                    </div>
                                    
                                    <div class="meta-item">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="18" y1="20" x2="18" y2="10"></line>
                                            <line x1="12" y1="20" x2="12" y2="4"></line>
                                            <line x1="6" y1="20" x2="6" y2="14"></line>
                                        </svg>
                                        <?= htmlspecialchars($course['level']); ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div id="noCoursesMessage" style="display: none; text-align: center; padding: 40px; background: white; border-radius: 12px; border: 1px dashed var(--sk-border);">
                    <h4 style="color: var(--sk-blue);">No courses available yet.</h4>
                    <p style="color: var(--sk-text);">Please check back later for updates to this academic year.</p>
                </div>

            </div>

        </div>
    </div>
</section>
<!--
<div class="enroll-banner">
    <div class="container">
        <h3>Enroll your child today to learn good manners and etiquette.</h3>
    </div>
</div>-->

<script>
    function filterCourses(selectedYear) {
        // 1. Update Desktop Sidebar Styles
        const timelineItems = document.querySelectorAll('.timeline-item');
        timelineItems.forEach(item => {
            if (item.getAttribute('data-year-filter') == selectedYear) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });

        // 2. Update Mobile Button Styles
        const mobileBtns = document.querySelectorAll('.mobile-filter-btn');
        mobileBtns.forEach(btn => {
            if (btn.getAttribute('data-year-filter') == selectedYear) {
                btn.classList.remove('btn-sk-outline');
                btn.classList.add('btn-sk-orange');
            } else {
                btn.classList.remove('btn-sk-orange');
                btn.classList.add('btn-sk-outline');
            }
        });

        // 3. Filter the Courses
        const courses = document.querySelectorAll('.course-card-wrapper');
        let visibleCount = 0;

        courses.forEach(course => {
            if (course.getAttribute('data-course-year') == selectedYear) {
                course.style.display = 'block';
                // Reset animation so it replays smoothly when switching tabs
                course.style.animation = 'none';
                course.offsetHeight; /* trigger reflow */
                course.style.animation = null; 
                visibleCount++;
            } else {
                course.style.display = 'none';
            }
        });

        // 4. Handle Empty State
        const noCoursesMessage = document.getElementById('noCoursesMessage');
        if (visibleCount === 0) {
            noCoursesMessage.style.display = 'block';
        } else {
            noCoursesMessage.style.display = 'none';
        }
    }

    // Run filter automatically on page load to show Year 1 by default
    document.addEventListener("DOMContentLoaded", () => {
        filterCourses(1);
    });
</script>

<?php 
// Include your site footer 
include 'include/footer.php'; 
?>