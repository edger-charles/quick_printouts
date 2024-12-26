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
<hpep
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



    
    <!-----------------------------------------------------------
    SECOND HEADER SECTION GOES HERE
    ----------------------------------------------------------------------->    
    <section id="second-header">
        <aside class="topbar">
            <ul class="categories-list">
                <li><a href="#promotional-products">Promotional Products</a></li>
                <li><a href="#business-stationery-products">Business Stationery</a></li>
                <li><a href="#marketing-materials">Marketing Materials</a></li>
                <li><a href="#packaging-and-labels">Packaging and Labels</a></li>
                <li><a href="#event-wedding-stationery">Event Stationery</a></li>
                <li><a href="#large-format-prints">Large Format Prints</a></li>
                <li><a href="#digital-media-graphics">Digital Media</a></li>
                <li><a href="#calendars-diaries">Calendars and Diaries</a></li>
                <li><a href="#books-magazines">Books and Magazines</a></li>
            </ul>
        </aside>
    </section>



    <section class="promotions" id="promotional-products">
        <div class="promo-details scroll-scale">
            <div class="left-promo">
                <h1 class="promo-title">Promotional Products</h1>
                <p class="promo-description">
                    Enhance your brand visibility with customized promotional products. Choose from a wide range 
                    of T-shirts, mugs, pens, keychains, and tote bags designed to leave a lasting impression. 
                    Perfect for giveaways, corporate events, and brand merchandising.
                </p>
            </div>
            <div class="promo-banners">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="resources/promo images/tshirt.jpeg" alt="Custom T-shirts" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/promo images/mug.jpeg" alt="Custom Mugs" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/promo images/pen.jpeg" alt="Custom Pens" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/promo images/keychain.jpeg" alt="Custom Keychains" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/promo images/totebag.jpeg" alt="Custom Tote Bags" class="promo-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="promo-bottom scroll-scale">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/promo images/Custom T-shirts.jpeg" alt="Custom T-shirt Designs" class="promo-card-img">
                            <h3 class="promo-name">Custom T-shirts</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/promo images/Custom Mugs.jpeg" alt="Custom Mug Designs" class="promo-card-img">
                            <h3 class="promo-name">Custom Mugs</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/promo images/Custom Pens.jpeg" alt="Custom Pen Designs" class="promo-card-img">
                            <h3 class="promo-name">Custom Pens</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/promo images/Custom Keychains.jpeg" alt="Custom Keychain Designs" class="promo-card-img">
                            <h3 class="promo-name">Custom Keychains</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/promo images/Custom Tote Bags.jpeg" alt="Custom Tote Bag Designs" class="promo-card-img">
                            <h3 class="promo-name">Custom Tote Bags</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/promo images/Custom T-shirts 2.jpeg" alt="Custom T-shirt Designs" class="promo-card-img">
                            <h3 class="promo-name">Custom T-shirts</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/promo images/Custom Mugs 2.jpeg" alt="Custom Mug Designs" class="promo-card-img">
                            <h3 class="promo-name">Custom Mugs</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/promo images/Custom Pens 2.jpeg" alt="Custom Pen Designs" class="promo-card-img">
                            <h3 class="promo-name">Custom Pens</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/promo images/Custom Keychains 2.jpeg" alt="Custom Keychain Designs" class="promo-card-img">
                            <h3 class="promo-name">Custom Keychains</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/promo images/Custom Tote Bags 2.jpeg" alt="Custom Tote Bag Designs" class="promo-card-img">
                            <h3 class="promo-name">Custom Tote Bags</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/promo images/Custom Mugs 3.jpeg" alt="Custom Mug Designs" class="promo-card-img">
                            <h3 class="promo-name">Custom Mugs</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/promo images/Custom Pens 3.jpeg" alt="Custom Pen Designs" class="promo-card-img">
                            <h3 class="promo-name">Custom Pens</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/promo images/Custom Keychains 3.jpeg" alt="Custom Keychain Designs" class="promo-card-img">
                            <h3 class="promo-name">Custom Keychains</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/promo images/Custom Tote Bags 3.jpeg" alt="Custom Tote Bag Designs" class="promo-card-img">
                            <h3 class="promo-name">Custom Tote Bags</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="related-products scroll-scale">
            <h2 class="related-products-title">Related Products</h2>
            <div class="related-container">
                <div class="related-prod-card">
                    <img src="resources/promo images/Logo Gift Set.jpeg" alt="Flyers" class="related-prod-img">
                    <h2 class="related-prod-title">Logo Gift Set</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/promo images/Must Have For Employees.jpeg" alt="Business Cards" class="related-prod-img">
                    <h2 class="related-prod-title">Must Have For Employees</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/promo images/Emirates Promotional Merchandise.jpeg" alt="Foamex" class="related-prod-img">
                    <h2 class="related-prod-title">Emirates Promotional Merchandise</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/promo images/Corporate Gifts.jpeg" alt="Folded Flyers" class="related-prod-img">
                    <h2 class="related-prod-title">Corporate Gifts</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="promotions" id="business-stationery-products">
        <div class="promo-details scroll-scale">
            <div class="left-promo">
                <h1 class="promo-title">Business Stationery</h1>
                <p class="promo-description">
                    Elevate your professional image with our premium business stationery. From expertly designed business cards to custom letterheads, envelopes, and notepads, we provide all the essentials to establish a cohesive and polished brand identity.
                </p>
            </div>
            <div class="promo-banners">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="resources/business stationery images/business card.jpeg" alt="Business Cards" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/business stationery images/letterheads.jpeg" alt="Letterheads" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/business stationery images/envelopes.jpeg" alt="Envelopes" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/business stationery images/notepads.jpeg" alt="Notepads" class="promo-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="promo-bottom scroll-scale">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/BCP 1.jpeg" alt="Business Cards" class="promo-card-img">
                            <h3 class="promo-name">Business Cards</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/BCP 2.jpeg" alt="Business Cards" class="promo-card-img">
                            <h3 class="promo-name">Business Cards</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/BCP 3.jpeg" alt="Business Cards" class="promo-card-img">
                            <h3 class="promo-name">Business Cards</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/BCP 4.jpeg" alt="Business Cards" class="promo-card-img">
                            <h3 class="promo-name">Business Cards</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/LP 1.jpeg" alt="Letterheads" class="promo-card-img">
                            <h3 class="promo-name">Letterheads</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/LP 2.jpeg" alt="Letterheads" class="promo-card-img">
                            <h3 class="promo-name">Letterheads</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/LP 3.jpeg" alt="Letterheads" class="promo-card-img">
                            <h3 class="promo-name">Letterheads</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/LP 4.jpeg" alt="Letterheads" class="promo-card-img">
                            <h3 class="promo-name">Letterheads</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/LP 5.jpeg" alt="Letterheads" class="promo-card-img">
                            <h3 class="promo-name">Letterheads</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/LP 6.jpeg" alt="Letterheads" class="promo-card-img">
                            <h3 class="promo-name">Letterheads</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/EP 1.jpeg" alt="Envelopes" class="promo-card-img">
                            <h3 class="promo-name">Envelopes</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/EP 2.jpeg" alt="Envelopes" class="promo-card-img">
                            <h3 class="promo-name">Envelopes</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/EP 3.jpeg" alt="Envelopes" class="promo-card-img">
                            <h3 class="promo-name">Envelopes</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/EP 4.jpeg" alt="Envelopes" class="promo-card-img">
                            <h3 class="promo-name">Envelopes</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/EP 5.jpeg" alt="Envelopes" class="promo-card-img">
                            <h3 class="promo-name">Envelopes</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/EP 6.jpeg" alt="Envelopes" class="promo-card-img">
                            <h3 class="promo-name">Envelopes</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/NP 1.jpeg" alt="Notepads" class="promo-card-img">
                        <h3 class="promo-name">Notepads</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/NP 2.jpeg" alt="Notepads" class="promo-card-img">
                        <h3 class="promo-name">Notepads</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/NP 3.jpeg" alt="Notepads" class="promo-card-img">
                        <h3 class="promo-name">Notepads</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/NP 4.jpeg" alt="Notepads" class="promo-card-img">
                        <h3 class="promo-name">Notepads</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/business stationery images/NP 5.jpeg" alt="Notepads" class="promo-card-img">
                        <h3 class="promo-name">Notepads</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="related-products scroll-scale">
            <h2 class="related-products-title">Related Products</h2>
            <div class="related-container">
                <div class="related-prod-card">
                    <img src="resources/business stationery images/R 1.jpeg" alt="Flyers" class="related-prod-img">
                    <h2 class="related-prod-title">Corporate Identity</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/business stationery images/R 7.jpeg" alt="Folded Flyers" class="related-prod-img">
                    <h2 class="related-prod-title">Fenix Business Card</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/business stationery images/R 8.jpeg" alt="Presentation Folders" class="related-prod-img">
                    <h2 class="related-prod-title">professional Business Card PSD/h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/business stationery images/R 11.jpeg" alt="Calendars" class="related-prod-img">
                    <h2 class="related-prod-title">Stationery Supplies</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="promotions" id="marketing-materials">
        <div class="promo-details scroll-scale">
            <div class="left-promo">
                <h1 class="promo-title">Marketing Materials</h1>
                <p class="promo-description">
                    Elevate your brand presence with our expertly designed marketing materials. From eye-catching 
                    flyers and brochures to impactful posters and pamphlets, we provide the tools you need to 
                    communicate your message effectively. Perfect for events, campaigns, or everyday promotions.
                </p>
            </div>
            <div class="promo-banners">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="resources/marketing materials images/flyer.jpeg" alt="Flyer Design" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/marketing materials images/brochure.jpeg" alt="Brochure Design" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/marketing materials images/poster.jpeg" alt="Poster Design" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/marketing materials images/pamphlet.jpeg" alt="Pamphlet Design" class="promo-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="promo-bottom scroll-scale">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/marketing materials images/flyer 1.jpeg" alt="Flyers" class="promo-card-img">
                            <h3 class="promo-name">Flyers</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/marketing materials images/brochure 1.jpeg" alt="Brochures" class="promo-card-img">
                            <h3 class="promo-name">Brochures</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/marketing materials images/poster 1.jpeg" alt="Posters" class="promo-card-img">
                            <h3 class="promo-name">Posters</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/marketing materials images/pamplet 1.jpeg" alt="Pamphlets" class="promo-card-img">
                            <h3 class="promo-name">Pamphlets</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/marketing materials images/flyer 2.jpeg" alt="Flyers" class="promo-card-img">
                            <h3 class="promo-name">Flyers</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/marketing materials images/brochure 2.jpeg" alt="Brochures" class="promo-card-img">
                            <h3 class="promo-name">Brochures</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/marketing materials images/poster 2.jpeg" alt="Posters" class="promo-card-img">
                            <h3 class="promo-name">Posters</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/marketing materials images/pamphlet 2.jpeg" alt="Pamphlets" class="promo-card-img">
                            <h3 class="promo-name">Pamphlets</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/marketing materials images/flyer 3.jpeg" alt="Flyers" class="promo-card-img">
                            <h3 class="promo-name">Flyers</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/marketing materials images/brochure 3.jpeg" alt="Brochures" class="promo-card-img">
                            <h3 class="promo-name">Brochures</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/marketing materials images/poster 3.jpeg" alt="Posters" class="promo-card-img">
                            <h3 class="promo-name">Posters</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/marketing materials images/pamphlet 3.jpeg" alt="Pamphlets" class="promo-card-img">
                            <h3 class="promo-name">Pamphlets</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="related-products scroll-scale">
            <h2 class="related-products-title">Related Products</h2>
            <div class="related-container">
                <div class="related-prod-card">
                    <img src="resources/marketing materials images/RF.jpeg" alt="Flyer Designs" class="related-prod-img">
                    <h2 class="related-prod-title">Flyers</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/marketing materials images/RB.jpeg" alt="Brochure Designs" class="related-prod-img">
                    <h2 class="related-prod-title">Brochures</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/marketing materials images/RP.jpeg" alt="Poster Designs" class="related-prod-img">
                    <h2 class="related-prod-title">Posters</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/marketing materials images/RPAM.jpeg" alt="Pamphlet Designs" class="related-prod-img">
                    <h2 class="related-prod-title">Pamphlets</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="promotions" id="packaging-and-labels">
        <div class="promo-details scroll-scale">
            <div class="left-promo">
                <h1 class="promo-title">Packaging and Labels</h1>
                <p class="promo-description">
                    Create custom packaging and labels that make your products stand out on the shelves. From 
                    product packaging to bottle labels and custom boxes, we offer solutions tailored to your branding needs.
                </p>
            </div>
            <div class="promo-banners">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="resources/Packaging and Labels images/custom boxes.jpeg" alt="Custom Boxes" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/Packaging and Labels images/bottle labels.jpeg" alt="Bottle Labels" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/Packaging and Labels images/roll labels.jpeg" alt="Roll Labels" class="promo-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="promo-bottom scroll-scale">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/Packaging and Labels images/Custom Mailer Boxes.jpeg" alt="Custom Boxes" class="promo-card-img">
                            <h3 class="promo-name">Custom Mailer Boxes</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/Packaging and Labels images/Jewellery box.jpeg" alt="Bottle Labels" class="promo-card-img">
                            <h3 class="promo-name">Jewellery box</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/Packaging and Labels images/Printed Packaging.jpeg" alt="Roll Labels" class="promo-card-img">
                            <h3 class="promo-name">Printed Packaging</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/Packaging and Labels images/Rectangle Labels.jpeg" alt="Custom Boxes" class="promo-card-img">
                            <h3 class="promo-name">Rectangle Labels</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/Packaging and Labels images/Circle Roll Labels.jpeg" alt="Bottle Labels" class="promo-card-img">
                            <h3 class="promo-name">Circle Roll Labels</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/Packaging and Labels images/alluminium roll labels.jpeg" alt="Roll Labels" class="promo-card-img">
                            <h3 class="promo-name">alluminium roll labels</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/Packaging and Labels images/Olive Oil Label.jpeg" alt="Custom Boxes" class="promo-card-img">
                            <h3 class="promo-name">Oilive Oil Label</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/Packaging and Labels images/primium label.jpeg" alt="Bottle Labels" class="promo-card-img">
                            <h3 class="promo-name">Premium Label</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/Packaging and Labels images/water Label.jpeg" alt="Roll Labels" class="promo-card-img">
                            <h3 class="promo-name">Water Bottle Label</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="related-products scroll-scale">
            <h2 class="related-products-title">Related Products</h2>
            <div class="related-container">
                <div class="related-prod-card">
                    <img src="resources/Packaging and Labels images/Kraft Sleeve.jpeg" alt="Product Sleeves" class="related-prod-img">
                    <h2 class="related-prod-title">Product Sleeves</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/Packaging and Labels images/Hang Tag.jpeg" alt="Hang Tags" class="related-prod-img">
                    <h2 class="related-prod-title">Hang Tags</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/Packaging and Labels images/Pouch.jpeg" alt="Pouches" class="related-prod-img">
                    <h2 class="related-prod-title">Pouches</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/Packaging and Labels images/Products Label Designs.jpeg" alt="Pouches" class="related-prod-img">
                    <h2 class="related-prod-title">Products Labels</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="promotions" id="event-wedding-stationery">
        <div class="promo-details scroll-scale">
            <div class="left-promo">
                <h1 class="promo-title">Event and Wedding Stationery</h1>
                <p class="promo-description">
                    Explore a wide range of personalized event and wedding stationery, including beautifully 
                    designed invitations, detailed programs, elegant menus, and heartfelt thank-you cards. 
                    Make every occasion memorable with our premium stationery options.
                </p>
            </div>
            <div class="promo-banners">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="resources/event and wedding images/Inv.jpeg" alt="Wedding Invitation" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/event and wedding images/EP.jpeg" alt="Event Program" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/event and wedding images/men.jpeg" alt="Menu Design" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/event and wedding images/tha.jpeg" alt="Thank You Card" class="promo-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="promo-bottom scroll-scale">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/event and wedding images/Custom Invitations.jpeg" alt="Invitation" class="promo-card-img">
                            <h3 class="stationery-name">Invitations</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/event and wedding images/Event 1.jpeg" alt="Program" class="promo-card-img">
                            <h3 class="promo-name">Church Anniversary</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/event and wedding images/menu 1.jpeg" alt="Menu" class="promo-card-img">
                            <h3 class="promo-name">Restaurant Menus</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/event and wedding images/thank 1.jpeg" alt="Thank You Card" class="promo-card-img">
                            <h3 class="promo-name">Thank You Cards</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/event and wedding images/Event Flyers.jpeg" alt="Invitation" class="promo-card-img">
                            <h3 class="promo-name">wedding Invitations</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/event and wedding images/prog 1.jpeg" alt="Program" class="promo-card-img">
                            <h3 class="promo-name">Memorial Programs</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/event and wedding images/menu 2.jpeg" alt="Menu" class="promo-card-img">
                            <h3 class="promo-name">Corporate Menus</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/event and wedding images/thank 2.jpeg" alt="Thank You Card" class="promo-card-img">
                            <h3 class="promo-name">Thank You Cards</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="related-products scroll-scale">
            <h2 class="related-products-title">Related Products</h2>
            <div class="related-container">
                <div class="related-prod-card">
                    <img src="resources/event and wedding images/Custom Invitations.jpeg" alt="Custom Invitations" class="related-prod-img">
                    <h2 class="related-prod-title">Custom Invitations</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/event and wedding images/Personalized Cards.jpeg" alt="Personalized Cards" class="related-prod-img">
                    <h2 class="related-prod-title">Personalized Cards</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/event and wedding images/Event Flyers.jpeg" alt="Event Flyers" class="related-prod-img">
                    <h2 class="related-prod-title">Event Flyers</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/event and wedding images/Gift Tags.jpeg" alt="Gift Tags" class="related-prod-img">
                    <h2 class="related-prod-title">Gift Tags</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="promotions" id="large-format-prints">
        <div class="promo-details scroll-scale">
            <div class="left-promo">
                <h1 class="promo-title">Large Format Prints</h1>
                <p class="promo-description">
                    Make a big impact with our large format printing services. Whether you need eye-catching 
                    banners, striking billboards, custom vehicle wraps, or professional trade show displays, 
                    we deliver high-quality prints that amplify your brand's visibility and message.
                </p>
            </div>
            <div class="promo-banners">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="resources/large-format-prints image/banner.jpeg" alt="Banner Printing" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/large-format-prints image/bilboard.jpeg" alt="Billboard Printing" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/large-format-prints image/Vehicle Wrap.jpeg" alt="Vehicle Wrap" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/large-format-prints image/Trade Show Display.jpeg" alt="Trade Show Display" class="promo-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="promo-bottom scroll-scale">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/large-format-prints image/ban 1.jpeg" alt="Banners" class="promo-card-img">
                            <h3 class="promo-name">Banners</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/large-format-prints image/bil 1.jpeg" alt="Billboards" class="promo-card-img">
                            <h3 class="promo-name">Billboards</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/large-format-prints image/ve 1.jpeg" alt="Vehicle Wraps" class="promo-card-img">
                            <h3 class="promo-name">Vehicle Wraps</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/large-format-prints image/tr 1.jpeg" alt="Trade Show Displays" class="promo-card-img">
                            <h3 class="promo-name">Trade Show Displays</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/large-format-prints image/ban 2.jpeg" alt="Banners" class="promo-card-img">
                            <h3 class="promo-name">Banners</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/large-format-prints image/bil 2.jpeg" alt="Billboards" class="promo-card-img">
                            <h3 class="promo-name">Billboards</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/large-format-prints image/ve 2.jpeg" alt="Vehicle Wraps" class="promo-card-img">
                            <h3 class="promo-name">Vehicle Wraps</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/large-format-prints image/tr 2.jpeg" alt="Trade Show Displays" class="promo-card-img">
                            <h3 class="promo-name">Trade Show Displays</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="related-products scroll-scale">
            <h2 class="related-products-title">Related Products</h2>
            <div class="related-container">
                <div class="related-prod-card">
                    <img src="resources/large-format-prints image/POSTER.jpeg" alt="Posters" class="related-prod-img">
                    <h2 class="related-prod-title">Posters</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/large-format-prints image/foam boards.jpeg" alt="Foam Boards" class="related-prod-img">
                    <h2 class="related-prod-title">Foam Boards</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/large-format-prints image/vinyl decals.jpeg" alt="Vinyl Decals" class="related-prod-img">
                    <h2 class="related-prod-title">Vinyl Decals</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/large-format-prints image/signage.jpeg" alt="Signage" class="related-prod-img">
                    <h2 class="related-prod-title">Signage</h2>
                </div>
            </div>
        </div>
    </section>
    

    <section class="promotions" id="digital-media-graphics">
        <div class="promo-details scroll-scale">
            <div class="left-promo">
                <h1 class="promo-title">Digital Media Graphics</h1>
                <p class="promo-description">
                    Elevate your online presence with professionally designed digital media graphics. From 
                    social media templates that captivate your audience to email headers and web ads that
                    drive engagement, our designs are tailored to amplify your brand's online impact.
                </p>
            </div>
            <div class="promo-banners">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="resources/digital-media-graphics images/so 1.jpeg" alt="Social Media Template 1" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/digital-media-graphics images/so 2.jpeg" alt="Social Media Template 2" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/digital-media-graphics images/em 1.jpeg" alt="Email Header 1" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/digital-media-graphics images/em 2.jpeg" alt="Email Header 2" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="resources/digital-media-graphics images/web.jpeg" alt="Web Ad 1" class="promo-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="promo-bottom scroll-scale">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/digital-media-graphics images/1.jpeg" alt="Social Post Design" class="promo-card-img">
                            <h3 class="promo-name">Social Media Posts</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/digital-media-graphics images/2.jpeg" alt="Instagram Story Design" class="promo-card-img">
                            <h3 class="promo-name">Instagram Stories</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/digital-media-graphics images/3.jpeg" alt="Email Banner" class="promo-card-img">
                            <h3 class="promo-name">Email Banners</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/digital-media-graphics images/4.jpeg" alt="Display Ad Design" class="promo-card-img">
                            <h3 class="promo-name">Display Ads</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="resources/digital-media-graphics images/5.jpeg" alt="Animated Banner" class="promo-card-img">
                            <h3 class="promo-name">Animated Banners</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="related-products scroll-scale">
            <h2 class="related-products-title">Related Products</h2>
            <div class="related-container">
                <div class="related-prod-card">
                    <img src="resources/digital-media-graphics images/a.jpeg" alt="Social Media Management" class="related-prod-img">
                    <h2 class="related-prod-title">Social Media Management</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/digital-media-graphics images/b.jpeg" alt="Email Marketing" class="related-prod-img">
                    <h2 class="related-prod-title">Email Marketing</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/digital-media-graphics images/c.jpeg" alt="Website Design" class="related-prod-img">
                    <h2 class="related-prod-title">Website Design</h2>
                </div>
                <div class="related-prod-card">
                    <img src="resources/digital-media-graphics images/d.jpeg" alt="Content Creation" class="related-prod-img">
                    <h2 class="related-prod-title">Content Creation</h2>
                </div>
            </div>
        </div>
    </section>


    <section class="promotions" id="calendars-diaries">
        <div class="promo-details scroll-scale">
            <div class="left-promo">
                <h1 class="promo-title">Calendars and Diaries</h1>
                <p class="promo-description">
                    Custom-designed wall calendars, desk calendars, and planners are the perfect tools to stay 
                    organized and showcase your brand every day of the year. Personalize your calendars and diaries 
                    with unique designs, images, and logos to leave a lasting impression.
                </p>
            </div>
            <div class="promo-banners">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="promo images/calendar1.jpg" alt="Wall Calendar" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="promo images/calendar2.jpg" alt="Desk Calendar" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="promo images/planner1.jpg" alt="Planner" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="promo images/planner2.jpg" alt="Custom Planner" class="promo-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="promo-bottom scroll-scale">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="promo images/wallcalendar.jpg" alt="Wall Calendar" class="promo-card-img">
                            <h3 class="promo-name">Wall Calendar</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="promo images/deskcalendar.jpg" alt="Desk Calendar" class="promo-card-img">
                            <h3 class="promo-name">Desk Calendar</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="promo images/weeklyplanner.jpg" alt="Weekly Planner" class="promo-card-img">
                            <h3 class="promo-name">Weekly Planner</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="promo images/customplanner.jpg" alt="Custom Planner" class="promo-card-img">
                            <h3 class="promo-name">Custom Planner</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="related-products scroll-scale">
            <h2 class="related-products-title">Related Products</h2>
            <div class="related-container">
                <div class="related-prod-card">
                    <img src="related products/relprod1.jpg" alt="Flyers" class="related-prod-img">
                    <h2 class="related-prod-title">Flyers</h2>
                </div>
                <div class="related-prod-card">
                    <img src="related products/relprod2.jpg" alt="Business Cards" class="related-prod-img">
                    <h2 class="related-prod-title">Business Cards</h2>
                </div>
                <div class="related-prod-card">
                    <img src="related products/relprod3.jpg" alt="Foamex" class="related-prod-img">
                    <h2 class="related-prod-title">Foamex</h2>
                </div>
                <div class="related-prod-card">
                    <img src="related products/relprod4.jpg" alt="Folded Flyers" class="related-prod-img">
                    <h2 class="related-prod-title">Folded Flyers</h2>
                </div>
            </div>
        </div>
    </section>


    <section class="promotions" id="books-magazines">
        <div class="promo-details scroll-scale">
            <div class="left-promo">
                <h1 class="promo-title">Books and Magazines</h1>
                <p class="promo-description">
                    Craft compelling cover designs, visually engaging page layouts, and print-ready publications that bring your stories and ideas to life. Whether you're publishing novels, magazines, or educational material, we provide high-quality design and printing solutions tailored to your needs.
                </p>
            </div>
            <div class="promo-banners">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="promo images/book1.jpg" alt="Book Cover Design" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="promo images/magazine1.jpg" alt="Magazine Layout Design" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="promo images/book2.jpg" alt="Educational Books" class="promo-image">
                        </div>
                        <div class="swiper-slide">
                            <img src="promo images/magazine2.jpg" alt="Fashion Magazine" class="promo-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="promo-bottom scroll-scale">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="promo images/booklet1.jpg" alt="Booklet Design" class="promo-card-img">
                            <h3 class="promo-name">Booklets</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="promo images/journal1.jpg" alt="Journals" class="promo-card-img">
                            <h3 class="promo-name">Journals</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="promo images/catalog1.jpg" alt="Catalogs" class="promo-card-img">
                            <h3 class="promo-name">Catalogs</h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="promo-card">
                            <img src="promo images/magazine3.jpg" alt="Magazines" class="promo-card-img">
                            <h3 class="promo-name">Magazines</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="related-products scroll-scale">
            <h2 class="related-products-title">Related Products</h2>
            <div class="related-container">
                <div class="related-prod-card">
                    <img src="related products/bookrelated1.jpg" alt="#" class="related-prod-img">
                    <h2 class="related-prod-title">E-Books</h2>
                </div>
                <div class="related-prod-card">
                    <img src="related products/bookrelated2.jpg" alt="#" class="related-prod-img">
                    <h2 class="related-prod-title">Yearbooks</h2>
                </div>
                <div class="related-prod-card">
                    <img src="related products/bookrelated3.jpg" alt="#" class="related-prod-img">
                    <h2 class="related-prod-title">Photo Albums</h2>
                </div>
                <div class="related-prod-card">
                    <img src="related products/bookrelated4.jpg" alt="#" class="related-prod-img">
                    <h2 class="related-prod-title">Notebooks</h2>
                </div>
            </div>
        </div>
    </section>




    <section id="bottom-section">
        <div class="bottom-section-top scroll-scale">
            <div class="section one">
                <h1 class="brand-name">QuickPrintOuts</h1>
                <div class="social-icons">
                  <a href=""><i class='bx bxl-facebook'></i></a>
                  <a href=""><i class='bx bxl-instagram'></i></a>
                  <a href=""><i class='bx bxl-youtube'></i></a>
                  <a href=""><i class='bx bxl-twitter'></i></a>
                  <a href=""><i class='bx bxl-tiktok'></i></a>
                </div>
                <div class="country">
                  <img src="assets/Kenya Flag.png" alt="Kenya">
                  <h3 class="country-name">Kenya</h3>
                </div>
            </div>
            <div class="section two">
                <h1 class="brand-name">Home</h1>
                <ul class="fast-links">
                    <li class="bottom-link"><a href="home.php#hero">Get Started</a></li>
                    <li class="bottom-link"><a href="home.php#services-section">Our services</a></li>
                    <li class="bottom-link"><a href="home.php#testimonial-section">Discover more about us</a></li>
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
            <a href="#" class="footer-link">Privacy</a>
            <a href="#" class="footer-link">Cookie Policy</a>
            <a href="#" class="footer-link">Legal Information</a>
            <a href="#" class="footer-link">Conditions Of Use</a>
            <a href="#" class="footer-link">Sales Terms & Conditions</a>
            <a href="#" class="footer-link">SiteMap</a>    
        </div>
        <div class="footer-down scroll-scale">
            <p>Copyright &copy; 2024 QuickPrintOuts |Design|Print|Brand|   || All Rights Reserved.</p>
            <a href="#promotional-products"><i class='bx bx-up-arrow-alt'></i></a>
        </div>
    </footer>
      
  
    <!--------------Link To Normal JavaScript----------------->
    <script src="script.js"></script>
    <!--------------Link To Swiper JavaScript----------------->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</body>
</html>
