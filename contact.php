<?php
require 'db_connect.php'; // Database connection

// Check if the logout button is clicked
if (isset($_POST['logout'])) {
    // Destroy the session to log out the user
    session_unset();
    session_destroy();

    // Redirect to index.php
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $message = trim($_POST['message']);

    // Input validation
    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
        $errors[] = 'Invalid phone number. Use digits only (10-15 characters).';
    }

    if (empty($message) || strlen($message) < 10) {
        $errors[] = 'Message must be at least 10 characters long.';
    }

    // If no errors, proceed to insert data
    if (empty($errors)) {
        try {
            // Use $conn instead of $pdo for the prepared statement
            $stmt = $conn->prepare("INSERT INTO contact_messages (email, phone, message) VALUES (:email, :phone, :message)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':message', $message);
            $stmt->execute();

            echo "<script>alert('Message sent successfully!'); window.location.href='contact.php';</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Error submitting message. Please try again later.');</script>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Derrick Contact Page</title>
    <!--Link Stylesheet CSS Here......-------------->
    <link rel="stylesheet" href="styles.css">
    <!--Theme Switcher Styling Page CSS Link Here......-------------->
    <link rel="stylesheet" href="color_palletes.css">
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

    <div class="contact-section" id="contact-section">
        <div class="contact scroll-scale">
            <span class="big-circle"></span>
            <img src="images/patterns.jpeg" class="square" alt="Busan">
            <div class="bytwo">
                <div class="contact-info">
                    <h3 class="title">Let's stay in touch</h3>
                    <p class="text">Find our contacts below to stay in touch with us.
                        Find us in all social media platforms below as <span class="bold-text">QuickPrintOus</span>.
                        Follow us on our accounts to stay updated on our progress and programs.
                    </p>
                    <div class="info">
                        <div class="information">
                            <img src="https://img.icons8.com/3d-fluency/94/location.png" class="icon" alt="Location">
                            <p>Type your Address</p>
                        </div>
                        <div class="information">
                            <img src="https://img.icons8.com/parakeet/48/new-post.png" class="icon" alt="Email">
                            <p>youremail@123.mail.com</p>
                        </div>
                        <div class="information">
                            <img src="https://img.icons8.com/3d-fluency/94/phone.png" class="icon" alt="Phone">
                            <p>+1 234 5678 900</p>
                        </div>
                    </div>
                    <div class="social-media">
                        <p>Connect with us:</p>
                        <div class="social-icons">
                            <a href="https://www.facebook.com" target="_blank">
                                <i class='bx bxl-facebook-square'></i>
                            </a>
                            <a href="https://www.twitter.com" target="_blank">
                                <i class='bx bxl-twitter'></i>
                            </a>
                            <a href="https://www.tiktok.com" target="_blank">
                                <i class='bx bxl-tiktok'></i>
                            </a>
                            <a href="https://www.instagram.com" target="_blank">
                                <i class='bx bxl-instagram-alt'></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="contact-form">
                    <span class="circle one"></span>
                    <span class="circle two"></span>

                    <form action="contact.php" method="post">
                        <h3 class="title">Contact Us</h3>
                        <div class="input-container">
                            <input type="email" name="email" placeholder="Enter Your Email" required class="input" autocomplete="email">
                        </div>
                        <div class="input-container">
                            <input type="tel" name="phone" placeholder="Enter Your Phone Number" required class="input" autocomplete="tel">
                        </div>
                        <div class="input-container textarea">
                            <textarea name="message" placeholder="Enter Your Message here" required class="input"></textarea>
                        </div>
                        
                        <input type="submit" value="Send" class="btn">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!----Contact Lower Section -->
    <main>
    <section class="contact-section scroll-scale">
        <h1>Visit Us</h1>
        <div class="contact-container">
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d112850.476947836!2d36.813225256697656!3d-1.2792313480500817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1squickprintouts%2C%20Kilome%20Road%20House!5e1!3m2!1sen!2ske!4v1734825830680!5m2!1sen!2ske" 
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </section>
    </main>


    <section id="bottom-section">
    <div class="bottom-section-top scroll-scale">
        <div class="section one">
            <h1 class="brand-name"><span>Q</span>uick<span>P</span>rint<span>O</span>uts</h1>
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
        <a href="#contact-section"><i class='bx bx-up-arrow-alt'></i></a>
    </div>
    </footer>

<script src="script.js"></script>
</body>
</html>