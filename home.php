<?php
// Start the session
session_start();

// Include database connection (db_connect.php)
include('db_connect.php');

// Check if the logout button is clicked
if (isset($_POST['logout'])) {
    // Destroy the session to log out the user
    session_unset();
    session_destroy();
    
    // Redirect to index.php
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickPrintOuts Home Page</title>
    <!--Link Stylesheet CSS Here......-------------->
    <link rel="stylesheet" href="styles.css">
    <!--Theme Switcher Styling Page CSS Link Here......-------------->
    <link rel="stylesheet" href="color_palletes.css">
    <!--Swiper Link Stylesheet CSS Here......-------------->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!--BoxIcons Link Goes Here.........------------------------->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <!--Link Google Fonts API Here....---------------------------->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <!--Font Awesomes CSS Link API Here....---------------------------->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <a href="home.php">
            <img src="assets/Qlogo-removebg-preview.png" alt="Pentagon Logo" class="logo">
        </a>     
        <ul class="navlist">
            <li><a href="home.php" style="--i:1">Home</a></li>
            <li><a href="about.php" style="--i:2">About</a></li>
            <li><a href="portfolio.php" style="--i:3">Portfolio</a></li>
            <li><a href="services.php" style="--i:4">Services</a></li>
            <li><a href="contact.php" style="--i:5">Contact</a></li> 
        </ul>
        <!-- Logout Button -->
        <form method="post" action="home.php">
            <button type="submit" name="logout" class="logout-btn">Logout</button>
        </form>
        <div class="theme-switcher">
            <button class="theme-btn" data-theme="light" title="Light Mode">☀️</button>
            <button class="theme-btn" data-theme="colored" title="Colored Mode">🎨</button>
            <button class="theme-btn" data-theme="dark" title="Dark Mode">🌙</button>
        </div>
        <div id="menu-icon" class="bx bx-menu"></div>      
    </header>


    <!-- Chatbox Section -->
    <section id="chatbox">
        <div class="chat-icon" onclick="toggleChatbox()">
            <i class="fa-solid fa-comments"></i>
        </div>
        <div class="chatbox-container" id="chatbox-container">
            <div class="chatbox-header">
                <h3>Chat with Us</h3>
                <span class="close-btn" onclick="toggleChatbox()">&times;</span>
            </div>
            <div class="chatbox-messages" id="chatbox-messages">
                <!-- Chat messages will be dynamically added here -->
            </div>
            <form class="chatbox-input" onsubmit="sendMessage(event)">
                <input type="text" id="chat-input" placeholder="Type your message..." required />
                <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
            </form>
        </div>
    </section>


    <section id="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Transform Your Ideas Into Reality</h1>
                <p>Your one-stop destination for premium design, printing, and branding solutions. We bring creativity to life with cutting-edge technology and exceptional craftsmanship.</p>
                <div class="cta-buttons">
                    <a href="#article-section" class="cta-primary">Read Monthly Article</a>
                    <a href="#services-section" class="cta-secondary">Brows Our Services</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="assets/StockCake-Large Format Printer_1734809038.jpg" alt="Printing and Design Services Illustration">
            </div>
        </div>
    </section>


    <section class="services-section" id="services-section">
        <h2 class="section-title">Our Services</h2>
        <div class="services-grid">
            <div class="service-card">
                <div class="card-content">
                    <div class="card-icon">🎁</div>
                    <h3 class="card-title">Promotional Products</h3>
                    <p class="card-description">Custom merchandise and branded items to promote your business effectively.</p>
                    <a href="services.php#promotional-products" class="card-link">Learn More</a>
                </div>
            </div>
    
            <div class="service-card">
                <div class="card-content">
                    <div class="card-icon">📄</div>
                    <h3 class="card-title">Business Stationery</h3>
                    <p class="card-description">Professional business cards, letterheads, and corporate stationery solutions.</p>
                    <a href="services.php#business-stationery-products" class="card-link">Learn More</a>
                </div>
            </div>
    
            <div class="service-card">
                <div class="card-content">
                    <div class="card-icon">📱</div>
                    <h3 class="card-title">Marketing Materials</h3>
                    <p class="card-description">Brochures, flyers, and marketing collateral to boost your brand presence.</p>
                    <a href="services.php#marketing-materials" class="card-link">Learn More</a>
                </div>
            </div>
    
            <div class="service-card">
                <div class="card-content">
                    <div class="card-icon">📦</div>
                    <h3 class="card-title">Packaging and Labels</h3>
                    <p class="card-description">Custom packaging solutions and professional label designs for your products.</p>
                    <a href="services.php#packaging-and-labels" class="card-link">Learn More</a>
                </div>
            </div>
    
            <div class="service-card">
                <div class="card-content">
                    <div class="card-icon">💌</div>
                    <h3 class="card-title">Event Stationery</h3>
                    <p class="card-description">Beautiful invitations and stationery for weddings and special events.</p>
                    <a href="services.php#event-wedding-stationery" class="card-link">Learn More</a>
                </div>
            </div>
    
            <div class="service-card">
                <div class="card-content">
                    <div class="card-icon">🖼️</div>
                    <h3 class="card-title">Large Format Prints</h3>
                    <p class="card-description">High-quality banners, posters, and large-scale printing solutions.</p>
                    <a href="services.php#large-format-prints" class="card-link">Learn More</a>
                </div>
            </div>
    
            <div class="service-card">
                <div class="card-content">
                    <div class="card-icon">💻</div>
                    <h3 class="card-title">Digital Media</h3>
                    <p class="card-description">Professional digital graphics and designs for your online presence.</p>
                    <a href="services.php#digital-media-graphics" class="card-link">Learn More</a>
                </div>
            </div>
    
            <div class="service-card">
                <div class="card-content">
                    <div class="card-icon">📅</div>
                    <h3 class="card-title">Calendars and Diaries</h3>
                    <p class="card-description">Custom calendars and personalized diaries for business and personal use.</p>
                    <a href="services.php#calendars-diaries" class="card-link">Learn More</a>
                </div>
            </div>
    
            <div class="service-card">
                <div class="card-content">
                    <div class="card-icon">📚</div>
                    <h3 class="card-title">Books and Magazines</h3>
                    <p class="card-description">Professional book printing and magazine publishing services with premium finishing.</p>
                    <a href="services.php#books-magazines" class="card-link">Learn More</a>
                </div>
            </div>
        </div>
    </section>


    <section id="article-section">
        <article class="article scroll-scale">
            <h2 class="article-subject">Discover the incredible QuickPrintOuts discounts! A wide range of products at special prices just for you!</h2>
            <p class="article-description">
                Choosing <b>QuickPrintOuts</b> as your printing partner is now even more convenient! We have created an online section dedicated 
                to <b>our best offers</b> to make it easy for you to find the most suitable discounted products. Don't compromise on <b>quality</b> to 
                access lower prices! We offer you a wide range of affordable customizable products through which you can bring your ideas 
                to life, all printed in high definition. We provide weekly offers for different products in <b>our catalog</b>. Our promotions 
                cover items from each of our sections: stay updated and never miss an opportunity to save on your orders!
            </p>
            <h2 class="article-subtitle">Quality and affordability guaranteed by Pixartprinting</h2>
            <p class="article-description">
                Since 1994, we have been providing customers with quality products. <b>96% of our customers</b> report being <b>satisfied with our service</b>. 
                Read the reviews from our many customers: Reevoo, the independent review system, can provide you with guarantees about the quality 
                of our service. Our production <b>operates 7 days a week, 24 hours a day</b>. We work to provide you with everything you need in a short time. 
                Our <b>multilingual customer service is available</b> for you from Monday to Friday, from 8 am to 10 pm (14 hours a day and 70 hours a week), 
                to respond to all your requests. Our experts can offer you qualified support, from choosing the most suitable support for your needs to 
                the post-purchase phase.
                <br>
                <br>
                We combine the daily commitment of over nine hundred people with the use of <b>the best printing technologies</b> on the market to always ensure 
                maximum quality results at advantageous prices. We study <b>different materials</b> daily to leverage their properties and offer you a unique product. 
                We understand the characteristics of each surface and use safe inks to achieve vibrant colors and precise print details on any medium:
            </p>
            <ul class="article-list">
                <li class="print-medium" style="--i: 1">Paper</li>
                <li class="print-medium" style="--i: 2">Cardboard</li>
                <li class="print-medium" style="--i: 3">Plexiglass</li>
                <li class="print-medium" style="--i: 4">Forex</li>
                <li class="print-medium" style="--i: 5">Alluminium</li>
                <li class="print-medium" style="--i: 6">Corrugated Plastic</li>
                <li class="print-medium" style="--i: 7">Sandwitch Pannels</li>
            </ul>
            <p class="article-description">
                Many materials for different usage contexts, all characterized by high-quality printing. Choose Pixartprinting and unleash your desire to communicate!
            </p>
            <h2 class="article-subtitle">Stay updated on offers and discounts from Pixartprinting: subscribe to our newsletter!</h2>
            <p class="article-description">
                If your busy schedule doesn't allow you to regularly check our "Promotions" section, don't worry. 
                You have the option to subscribe to our useful newsletter to receive real-time notifications about 
                the latest promotions from Pixartprinting. Don't risk missing out on the best printing opportunities 
                for products that suit your needs! With a quick glance at our emails, you'll recognize the ideal discounts 
                for you. Scroll to the bottom of the page and enter your email address to enjoy all the benefits of our newsletter!
            </p>
        </article>
    </section>


    <section id="bottom-section">
        <div class="bottom-section-top scroll-scale">
            <div class="section one">
                <h1 class="brand-name">QuickPrintOuts</h1>
                <div class="social-icons">
                  <a href="#"><i class='bx bxl-facebook'></i></a>
                  <a href="#"><i class='bx bxl-instagram'></i></a>
                  <a href="#"><i class='bx bxl-youtube'></i></a>
                  <a href="#"><i class='bx bxl-twitter'></i></a>
                  <a href="#"><i class='bx bxl-tiktok'></i></a>
                </div>
                <div class="country">
                  <img src="assets/Kenya Flag.png" alt="Kenya">
                  <h3 class="country-name">Kenya</h3>
                </div>
            </div>
            <div class="section two">
                <h1 class="brand-name">About Us</h1>
                <ul class="fast-links">
                    <li class="bottom-link"><a href="about.php#about-intro">About us</a></li>
                    <li class="bottom-link"><a href="about.php#about-second">What we do fo you</a></li>
                    <li class="bottom-link"><a href="about.php#testimonial-section">What our clients say</a></li>
                    <li class="bottom-link"><a href="about.php#testimonial-section">Leave us a comment</a></li>
                </ul>
            </div>
            <div class="section three">
                <h1 class="brand-name">Portfolio</h1>
                <ul class="fast-links">
                    <li class="bottom-link"><a href="about.php#quality">Our print quality</a></li>
                    <li class="bottom-link"><a href="about.php#services-top">Work Samples</a></li>
                    <li class="bottom-link"><a href="about.php#booking-section">Make enquiry with us</a></li>
                </ul>
            </div>
            <div class="section four">
                <h1 class="brand-name">Help & Contacts</h1>
                <ul class="fast-links">
                    <li class="bottom-link"><a href="portfolio.php#make-order">Place an order now</a></li>
                    <li class="bottom-link"><a href="about.php#contact-section">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <div class="bottom-section-bottom scroll-scale">
            <div class="section one">
                <h1 class="sector-title">Customer Friendly</h1>
                <a href="contact.html"><i class='bx bxs-user-account friendly'></i></a>
            </div>
            <div class="section two">
                <h1 class="sector-title">Timely Delivery</h1>
                <a href="home.html#article-section"><i class='bx bx-timer on-time'></i></a>
            </div>
            <div class="section three">
                <h1 class="sector-title">Accepted Payment Metthods</h1>
                <div class="payment-modes">
                    <i class='bx bxl-paypal paypal'></i>
                    <i class='bx bxs-bank bank'></i>
                    <i class='bx bxs-wallet-alt money'></i>
                    <i class='bx bx-mobile mpesa'></i>
                </div>
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
      
  
    <!--------------Link To Normal JavaScript----------------->
    <script src="script.js"></script>
    <!--------------Link To Swiper JavaScript----------------->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</body>
</html>
