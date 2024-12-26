<?php
// Start the session at the beginning of the page if it's not already started
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <!--Link Stylesheet CSS Here......-------------->
    <link rel="stylesheet" href="index.css">
    <!--Theme Switcher Styling Page CSS Link Here......-------------->
    <link rel="stylesheet" href="color_palletes.css">
    <!--BoxIcons Link Goes Here.........------------------------->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <!--Link Google Fonts API Here....---------------------------->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <!----------------------------------------------------
    INDEX PAGE PAGE HEADER GOES HERE
    --------------------------------------------------------------------------------->
    <header>
        <img src="assets/Qlogo-removebg-preview.png" alt="Pentagon Logo" class="logo">   
        <ul class="navlist">
            <li><a href="#hero" style="--i:1">Hero</a></li>
            <li><a href="#features" style="--i:2">Features</a></li>
            <li><a href="#our-services" style="--i:3">Services</a></li>
            <li><a href="#testimonials" style="--i:4">Testimonials</a></li> 
        </ul>
        <a href="login.php">
            <button class="reg-btn">Logout</button>
        </a>
        <div class="theme-switcher">
            <button class="theme-btn" data-theme="light" title="Light Mode">☀️</button>
            <button class="theme-btn" data-theme="colored" title="Colored Mode">🎨</button>
            <button class="theme-btn" data-theme="dark" title="Dark Mode">🌙</button>
        </div>
        <div id="menu-icon" class="bx bx-menu"></div>      
    </header>



    <section class="hero" id="hero">
    <div class="hero-content scroll-scale">
            <h1 class="scroll-scale">Fast. Reliable. <span>Prints</span> in Minutes!</h1>
            <p>Your one-stop solution for high-quality, same-day printouts at unbeatable prices.</p>
            <div class="cta-buttons scroll-scale">
                <!-- Conditional redirect based on login status -->
                <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
                    <a href="home.php" class="cta">Sign Up Now</a>
                    <a href="home.php" class="secondary-cta">Learn More</a>
                <?php else: ?>
                    <a href="register.php" class="cta">Sign Up Now</a>
                    <a href="login.php" class="secondary-cta">Learn More</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="hero-illustration scroll-scale">
            <!-- Printing Illustration -->
            <div class="printer">
                <div class="printer-body"></div>
                <div class="printer-paper"></div>
                <div class="printer-light"></div>
                <div class="printing-animation"></div>
            </div>
            
            <!-- Design Illustration -->
            <div class="design-elements">
                <div class="color-palette">
                    <div class="color c1"></div>
                    <div class="color c2"></div>
                    <div class="color c3"></div>
                    <div class="color c4"></div>
                </div>
                <div class="pen-tool">
                    <div class="pen-body"></div>
                    <div class="pen-tip"></div>
                </div>
                <div class="canvas">
                    <div class="canvas-content"></div>
                    <div class="cursor"></div>
                </div>
            </div>
    
            <!-- Branding Illustration -->
            <div class="branding-elements">
                <div class="business-card">
                    <div class="card-logo"></div>
                    <div class="card-lines">
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                </div>
                <div class="brand-shapes">
                    <div class="shape circle"></div>
                    <div class="shape square"></div>
                    <div class="shape triangle"></div>
                </div>
                <div class="typography">
                    <div class="text-line"></div>
                    <div class="text-line"></div>
                    <div class="text-line"></div>
                </div>
            </div>
    
            <!-- Floating Elements -->
            <div class="floating-elements">
                <div class="element document"></div>
                <div class="element palette"></div>
                <div class="element pencil"></div>
            </div>
        </div>
    </section>



    <section class="features" id="features">
        <div class="features-container">
            <div class="section-header scroll-scale">
                <h2>Why Choose QuickPrint?</h2>
                <div class="header-underline"></div>
            </div>
            
            <div class="feature-cards">
                <div class="card scroll-scale">
                    <div class="card-icon">
                        <i class='bx bx-time'></i>
                        <div class="icon-bg"></div>
                    </div>
                    <div class="card-content">
                        <h3>Super Fast Delivery</h3>
                        <p>Print and pick up your documents within 30 minutes. Experience lightning-fast turnaround times.</p>
                        <div class="card-stats">
                            <span class="stat">
                                <strong>30</strong>
                                <small>mins</small>
                            </span>
                            <span class="stat">
                                <strong>24/7</strong>
                                <small>service</small>
                            </span>
                        </div>
                    </div>
                    <div class="card-indicator"></div>
                </div>
    
                <div class="card scroll-scale">
                    <div class="card-icon">
                        <i class='bx bx-printer'></i>
                        <div class="icon-bg"></div>
                    </div>
                    <div class="card-content">
                        <h3>Top-Notch Quality</h3>
                        <p>Get crisp, vibrant, and professional printouts every time. Industry-leading print quality.</p>
                        <div class="card-stats">
                            <span class="stat">
                                <strong>4K</strong>
                                <small>DPI</small>
                            </span>
                            <span class="stat">
                                <strong>100%</strong>
                                <small>clarity</small>
                            </span>
                        </div>
                    </div>
                    <div class="card-indicator"></div>
                </div>
    
                <div class="card scroll-scale">
                    <div class="card-icon">
                        <i class='bx bx-wallet'></i>
                        <div class="icon-bg"></div>
                    </div>
                    <div class="card-content">
                        <h3>Affordable Rates</h3>
                        <p>High quality at prices you can't resist. Best value guaranteed with our price match promise.</p>
                        <div class="card-stats">
                            <span class="stat">
                                <strong>-20%</strong>
                                <small>savings</small>
                            </span>
                            <span class="stat">
                                <strong>$0.05</strong>
                                <small>per page</small>
                            </span>
                        </div>
                    </div>
                    <div class="card-indicator"></div>
                </div>
            </div>
        </div>
    </section>



    <section class="index-services" id="our-services">
        <h2 class="section-title scroll-scale">Our Services</h2>
        <p class="section-description">Comprehensive solutions for all your creative needs</p>
        <div class="services-grid scroll-scale">
            <div class="service-card scroll-scale">
                <i class='bx bx-palette service-icon'></i>
                <h3>Graphic Design</h3>
                <p>Professional designs that capture your brand's essence</p>
            </div>
            <div class="service-card scroll-scale">
                <i class='bx bx-printer service-icon'></i>
                <h3>Premium Printing</h3>
                <p>High-quality prints for all your business needs</p>
            </div>
            <div class="service-card scroll-scale">
                <i class='bx bx-briefcase service-icon'></i>
                <h3>Branding Solutions</h3>
                <p>Complete branding packages to make you stand out</p>
            </div>
        </div>
    </section>




    <section class="testimonials" id="testimonials">
        <h2 class="scroll-scale">What Our Customers Say</h2>
        <div class="testimonial-container scroll-scale">
            <div class="testimonial">
                <p>"QuickPrint is the fastest and easiest service I've used! I had my documents ready in no time."</p>
                <span>- James W.</span>
            </div>
            <div class="testimonial">
                <p>"Affordable, quick, and great quality prints. I highly recommend QuickPrint!"</p>
                <span>- Sarah M.</span>
            </div>
            <div class="testimonial">
                <p>"The service exceeded my expectations. Will definitely be using QuickPrint for all my future needs!"</p>
                <span>- John D.</span>
            </div>
        </div>
    </section>




    <footer>
        <div class="footer-link-box scroll-scale">
            <a href="documents.html #privacy" class="footer-link">Privacy</a>
            <a href="documents.html #ads-policy" class="footer-link">Cookie Policy</a>
            <a href="documents.html #legalization" class="footer-link">Legal Information</a>
            <a href="documents.html #conditions-of-use" class="footer-link">Conditions Of Use</a>
            <a href="documents.html #sitemap" class="footer-link">SiteMap</a>    
        </div>
        <div class="footer-down scroll-scale">
            <p>Copyright &copy; 2024 QuickPrintOuts |Design|Print|Brand|   || All Rights Reserved.</p>
            <a href="#hero"><i class='bx bx-up-arrow-alt'></i></a>
        </div>
    </footer>

    <!--Link Javascript File------------------------>
    <script src="script.js"></script>

</body>
</html>