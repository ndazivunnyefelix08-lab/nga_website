<?php
// footer.php

// Define your base URL here. 
// If your site is live, '/' is perfect. 
// If you are testing locally in a folder like "localhost/nga", change this to '/nga/'
$base_url = '/'; 
?>

<style>
/* =========================
   SKOOLA EXACT FOOTER STYLES
========================= */
:root {
    --sk-blue: #042a41;
    --sk-orange: #e65c3d;
    --sk-text-muted: #94a3b8;
    --sk-icon-blue: #3b82f6; /* The light blue arrow/icon color in the image */
}

.sk-footer {
    background-color: var(--sk-blue);
    color: var(--sk-text-muted);
    font-family: 'Manrope', sans-serif;
    padding-top: 60px; /* Reduced from 100px assuming the newsletter box overlaps */
    padding-bottom: 20px;
    font-size: 0.95rem;
}

.sk-footer h5 {
    color: #ffffff;
    font-weight: 700;
    font-size: 1.15rem;
    margin-bottom: 25px;
}

/* Footer Paragraphs & Text */
.sk-footer p {
    line-height: 1.8;
    margin-bottom: 20px;
    color: var(--sk-text-muted);
}

/* Social Icons */
.sk-socials {
    display: flex;
    gap: 12px;
    margin-top: 25px;
}
.sk-socials a {
    background-color: rgba(255,255,255,0.1);
    width: 38px; height: 38px;
    display: flex; align-items: center; justify-content: center;
    border-radius: 50%;
    color: #ffffff;
    transition: all 0.3s ease;
    text-decoration: none;
}
.sk-socials a:hover {
    background-color: var(--sk-orange);
    transform: translateY(-3px);
}
.sk-socials svg {
    width: 16px; height: 16px; fill: currentColor;
}

/* Footer Link Lists */
.sk-footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}
.sk-footer-links li {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
}
.sk-footer-links a {
    color: var(--sk-text-muted);
    text-decoration: none;
    transition: color 0.3s;
    font-weight: 500;
}
.sk-footer-links a:hover {
    color: #ffffff;
}
.sk-arrow-icon {
    color: var(--sk-icon-blue);
    margin-right: 10px;
}

/* Contact List */
.sk-contact-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.sk-contact-list li {
    margin-bottom: 15px;
    display: flex;
    align-items: flex-start;
    line-height: 1.6;
}
.sk-contact-list svg {
    color: var(--sk-icon-blue);
    margin-right: 12px;
    margin-top: 4px;
    flex-shrink: 0;
}
.sk-contact-list a {
    color: var(--sk-text-muted);
    text-decoration: none;
    transition: color 0.3s;
}
.sk-contact-list a:hover {
    color: #ffffff;
}

/* Bottom Copyright Bar */
.sk-footer-bottom {
    margin-top: 50px;
    padding-top: 25px;
    border-top: 1px solid rgba(255,255,255,0.08);
    font-size: 0.85rem;
}
.sk-footer-bottom a {
    color: var(--sk-text-muted);
    text-decoration: none;
    transition: 0.3s;
    margin-left: 15px;
}
.sk-footer-bottom a:hover {
    color: #ffffff;
}

@media (max-width: 991px) {
    .sk-footer-col { margin-bottom: 40px; }
    .sk-footer-bottom { text-align: center; }
    .sk-footer-bottom .text-md-end { margin-top: 15px; text-align: center !important; }
}
</style>

<footer class="sk-footer" id="contact">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-4 col-md-6 sk-footer-col pe-lg-5">
                <a href="<?= $base_url ?>index.php" style="text-decoration: none;">
                    <h2 style="color: #ffffff; font-weight: 800; font-size: 2.2rem; letter-spacing: -1px; margin-bottom: 20px;">NGA</h2>
                </a>
                <p>Equipping students with transformative education, programming, embedded systems, and robotics to shape a bright future in Rwanda.</p>
                
                <div class="sk-socials">
                    <a href="https://web.facebook.com/new.generationacademy.14" target="_blank"><svg viewBox="0 0 320 512"><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/></svg></a>
                    <a href="https://www.instagram.com/new.generation_academy/" target="_blank"><svg viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg></a>
                    <a href="https://x.com/NewGenerationrw" target="_blank"><svg viewBox="0 0 512 512"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L273 181.2 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg></a>
                    <a href="https://www.youtube.com/channel/UC-xACP9LlR_N9GxJ6A7aebQ" target="_blank"><svg viewBox="0 0 576 512"><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 sk-footer-col">
                <h5>Quick Links</h5>
                <ul class="sk-footer-links">
                    <li><svg class="sk-arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg> <a href="<?= $base_url ?>index.php">Home</a></li>
                    <li><svg class="sk-arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg> <a href="<?= $base_url ?>index.php#about">About us</a></li>
                    <li><svg class="sk-arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg> <a href="<?= $base_url ?>index.php#spes">Programs</a></li>
                    <li><svg class="sk-arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg> <a href="<?= $base_url ?>admin/login.php">Admin Login</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 sk-footer-col">
                <h5>Important Links</h5>
                <ul class="sk-footer-links">
                    <li><svg class="sk-arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg> <a href="https://webmail.hackflix.net/" target="_blank">Staff Mail Portal</a></li>
                    <li><svg class="sk-arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg> <a href="https://nga.ac.rw/report_card/" target="_blank">NGA Report Card</a></li>
                    <li><svg class="sk-arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg> <a href="https://nga.ac.rw/mis/login" target="_blank">MIS Portal</a></li>
                    <li><svg class="sk-arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg> <a href="<?= $base_url ?>donation.php" target="_blank">Support Us</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 sk-footer-col">
                <h5>Get in touch</h5>
                <ul class="sk-contact-list">
                    <li>
                        <?= htmlspecialchars($settings['school_address'] ?? 'KG 28 AV, Kigali, Rwanda'); ?>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <a href="mailto:info@nga.ac.rw">info@nga.ac.rw</a>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        <a href="tel:<?= preg_replace('/[^0-9+]/', '', $settings['school_phone'] ?? '+250789552671'); ?>"><?= htmlspecialchars($settings['school_phone'] ?? '+250 789 552 671'); ?></a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="sk-footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    Copyright &copy; <?= date("Y"); ?> New Generation Academy. All rights reserved.
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#">Term of services</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>