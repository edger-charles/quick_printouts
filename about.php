<?php
// Include database connection file
require 'db_connect.php';

// Start session if not already started
session_start();

// Check if the logout button is clicked
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

// Initialize variables for form data and error handling
$name = $role = $image_path = $testimonial_content = $rating = "";
$error_message = "";
$success_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
    // Validate form inputs
    if (empty($_POST["name"]) || empty($_POST["role"]) || empty($_POST["testimonial-content"]) || 
        empty($_POST["rating"]) || empty($_FILES['image']['name'])) {
        $error_message = "All fields are required.";
    } else {
        try {
            // Sanitize and prepare data
            $name = filter_var(trim($_POST["name"]), FILTER_SANITIZE_STRING);
            $role = filter_var(trim($_POST["role"]), FILTER_SANITIZE_STRING);
            $testimonial_content = filter_var(trim($_POST["testimonial-content"]), FILTER_SANITIZE_STRING);
            $rating = filter_var($_POST["rating"], FILTER_VALIDATE_INT, 
                               ["options" => ["min_range" => 1, "max_range" => 5]]);

            // Handle file upload
            $upload_dir = 'uploads/testimonials/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            // Generate unique filename
            $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $unique_filename = uniqid() . '.' . $file_extension;
            $image_path = $upload_dir . $unique_filename;

            // Validate file type
            $allowed_types = ['jpg', 'jpeg', 'png', 'svg'];
            if (!in_array($file_extension, $allowed_types)) {
                throw new Exception("Invalid file type. Allowed types: JPG, JPEG, PNG, SVG");
            }

            // Move uploaded file
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                throw new Exception("Failed to upload image");
            }

            // Insert into database using prepared statement
            $sql = "INSERT INTO testimonials (name, role, image_path, testimonial_content, rating) 
                    VALUES (:name, :role, :image_path, :testimonial_content, :rating)";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':role' => $role,
                ':image_path' => $image_path,
                ':testimonial_content' => $testimonial_content,
                ':rating' => $rating
            ]);

            $success_message = "Testimonial submitted successfully!";
            
            // Redirect after successful submission
            header("Location: about.php?success=1");
            exit();

        } catch (Exception $e) {
            $error_message = "Error: " . $e->getMessage();
            // Delete uploaded file if database insertion fails
            if (isset($image_path) && file_exists($image_path)) {
                unlink($image_path);
            }
        }
    }
}

// Fetch testimonials with error handling
try {
    $query = "SELECT * FROM testimonials ORDER BY RAND() LIMIT 3";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $random_testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = "Error fetching testimonials: " . $e->getMessage();
    $random_testimonials = [];
}

// Display success message if redirected after successful submission
if (isset($_GET['success']) && $_GET['success'] == '1') {
    $success_message = "Thank you! Your testimonial has been submitted successfully.";
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickPrintOuts About Page</title>
    <!--Link Stylesheet CSS Here......-------------->
    <link rel="stylesheet" href="styles.css">
    <!--Theme Switcher Styling Page CSS Link Here......-------------->
    <link rel="stylesheet" href="color_palletes.css">
    <!--Theme Switcher Styling Page CSS Link Here......-------------->
    <link rel="stylesheet" href="color_palletes.css">
    <!--BoxIcons Link Goes Here.........------------------------->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <!--Swiper Link Stylesheet CSS Here......-------------->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
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
        <form method="POST">
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


    <section id="about-intro">
    <div class="about-intro-top scroll-scale">
        <div class="top-left scroll-scale">
            <h1 class="intro-title">Award-Winning Graphic Designs, Printing & Branding Company In Kenya!</h1>
            <p class="intro-paragraph">
                We are a leading creative agency recognized for delivering top-tier graphic design, printing, and branding solutions 
                to businesses across Kenya. Our expertise lies in crafting visually stunning designs, innovative print materials, and 
                impactful branding strategies that set your business apart in a competitive market.  
            </p>
            <p class="intro-paragraph">
                With years of experience and a passion for creativity, we take pride in transforming ideas into reality. Whether 
                you need eye-catching logos, professional marketing materials, or large-scale print projects, our team is dedicated to 
                exceeding your expectations and ensuring your brand shines. Let us help you tell your story through powerful visual communication.
            </p>
            <div class="loader">
                <div class="circle">
                  <div class="dot"></div>
                  <div class="outline"></div>
                </div>
                <div class="circle">
                  <div class="dot"></div>
                  <div class="outline"></div>
                </div>
                <div class="circle">
                  <div class="dot"></div>
                  <div class="outline"></div>
                </div>
                <div class="circle">
                  <div class="dot"></div>
                  <div class="outline"></div>
                </div>
                <div class="circle">
                    <div class="dot"></div>
                    <div class="outline"></div>
                </div>
                <div class="circle">
                    <div class="dot"></div>
                    <div class="outline"></div>
                </div>
                <div class="circle">
                    <div class="dot"></div>
                    <div class="outline"></div>
                </div>
                <div class="circle">
                    <div class="dot"></div>
                    <div class="outline"></div>
                </div>
                <div class="circle">
                    <div class="dot"></div>
                    <div class="outline"></div>
                </div>
            </div>
            <a href="#testimonial-section" class="call-to-action">
                <button class="cta">
                    <span>What our customers say about us</span>
                    <svg width="15px" height="10px" viewBox="0 0 13 10">
                      <path d="M1,5 L11,5"></path>
                      <polyline points="8 1 12 5 8 9"></polyline>
                    </svg>
                </button>
            </a>
        </div>

        <div class="port-box product scroll-scale">
            <div class="port-image">
                <img src="assets/1734853083.jpg" alt="">
            </div>
            <div class="port-content">
                <h3>About QuickPrintOuts</h3>
                <h4>Leaders in Graphic Design, Printing, and Branding</h4>
                <p>
                    QuickPrintOuts is your go-to destination for professional graphic design, printing, and branding solutions in Kenya.  
                    Located at Kilome House, opposite Koja Street, Nairobi, we specialize in turning ideas into visually compelling designs  
                    and high-quality print materials that leave a lasting impression.  
                </p>
                <p>
                    Our services cater to businesses of all sizes, offering everything from creative brand development to large-scale printing projects.  
                    With a focus on precision, innovation, and customer satisfaction, QuickPrintOuts ensures your brand stands out in the market.  
                    Whether you require corporate branding, promotional materials, or personalized design work, we deliver results that reflect  
                    professionalism and creativity.  
                </p>                    
                <a href="contact.php" title="Contact QuickPrintOuts!"><i class='bx bx-link-external'></i></a>
            </div>
        </div>
    </div>
    </section>


    <section id="about-second">
    <h1 class="what-we-do">What We Do For You</h1>
    <div class="types scroll-scale">
        <div class="design-types">
            <div class="design-box">
                <h2 class="design-title">We Design</h2>
                <h3 class="design-paragraph">
                    From innovative logos to comprehensive brand identities, our design services 
                    bring your vision to life. We focus on creating sleek, professional, and modern 
                    designs that leave a lasting impression on your audience. Whether you need digital 
                    assets, website layouts, or promotional materials, we ensure every project is unique and 
                    tailored to your brand's personality.
                </h3>
                <img src="assets/Designing digital graphics_1734821718.jpg" alt="Design Process" class="design-img">
            </div>
            <div class="design-box">
                <h2 class="design-title">We Print</h2>
                <h3 class="design-paragraph">
                    High-quality prints that speak volumes. Our printing services cover everything 
                    from business cards to large-scale banners. We use the latest technology to produce 
                    sharp, vibrant, and durable prints that elevate your marketing materials. 
                    Trust us to deliver precision and excellence in every piece.
                </h3>
                <img src="assets/Precision Meets Color_1734809020.jpg" alt="Printing Services" class="design-img">
            </div>
        </div>
        <div class="design-box-out">
            <h2 class="design-title">We Brand</h2>
            <h3 class="design-paragraph">
                Crafting compelling brand stories and visual identities is our specialty. Our branding 
                services encompass everything from conceptualization to execution. We create logos, 
                stationery, and promotional materials that reflect your brand’s core values. Our team 
                ensures consistency across all platforms to build strong brand recognition and trust.  
                Let us help you stand out in a crowded market with bold, strategic, and impactful branding.
            </h3>
            <div class="designbox-out-imgs">
                <img src="assets/Luxurious Red Interior_1734822246.jpg" alt="Brand Development" class="design-img">
                <img src="assets/car interior_1734822668.jpg" alt="Brand Development" class="design-img2">
            </div>
        </div>
    </div>
    </section>


    <section id="testimonial-section">
        <div class="container">
            <div class="section-header scroll-scale">
                <h2>What Our Clients Say</h2>
                <p>Discover why people love working with us</p>
            </div>
    
            <!-- Swiper container with added navigation -->
            <div class="testimonial-container scroll-scale">
                <?php foreach ($random_testimonials as $testimonial): ?>
                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <div class="client-image">
                                <img src="<?php echo $testimonial['image_path']; ?>" alt="Client Image">
                            </div>
                            <div class="client-info">
                                <h4><?php echo $testimonial['name']; ?></h4>
                                <p><?php echo $testimonial['role']; ?></p>
                            </div>
                        </div>
                        <div class="testimonial-content">
                            <span class="quote-icon">❝</span>
                            <p><?php echo $testimonial['testimonial_content']; ?></p>
                            <div class="rating"><?php echo str_repeat('★', $testimonial['rating']); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>    

            <!-- Testimonial Form -->
            <div class="testimonial-form-container scroll-scale">
                <h3>Leave Your Testimony</h3>
                <form id="testimonial-form" action="about.php" method="POST" enctype="multipart/form-data">
                    <?php if (!empty($success_message)): ?>
                        <div class="success-message"><?php echo $success_message; ?></div>
                    <?php endif; ?>
                    <?php if (!empty($error_message)): ?>
                        <div class="error-message"><?php echo $error_message; ?></div>
                    <?php endif; ?>

                    <div class="left-group">
                        <div class="input-group">
                            <label for="name">Your Name:</label>
                            <input type="text" id="name" name="name" placeholder="Your Name" required>
                        </div>

                        <div class="input-group">
                            <label for="role">Your Role:</label>
                            <input type="text" id="role" name="role" placeholder="Your Role" required>
                        </div>

                        <div class="input-group">
                            <!-- Image Upload -->
                            <label for="image">Your Photo:</label>
                            <input type="file" id="image" name="image" accept=".png, .jpg, .jpeg, .svg" required>
                        </div>
                    </div>

                    <div class="right-group">
                        <div class="input-down">
                            <label for="testimonial-content">Your Testimony:</label>
                            <textarea id="testimonial-content" name="testimonial-content" rows="4" placeholder="Your Testimony" required></textarea>
                        </div>

                        <div class="input-down">
                            <label for="rating">Rating:</label>
                            <select id="rating" name="rating" required>
                                <option value="1">★</option>
                                <option value="2">★★</option>
                                <option value="3">★★★</option>
                                <option value="4">★★★★</option>
                                <option value="5">★★★★★</option>
                            </select>
                        </div>

                        <button type="submit" class="submit-btn">Submit Testimony</button>
                    </div>
                </form>
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
        <a href="#about-intro"><i class='bx bx-up-arrow-alt'></i></a>
    </div>
    </footer>
   
  
    <!--------------Link To Normal JavaScript----------------->
    <script src="script.js"></script>
    <!--------------Link To Swiper JavaScript----------------->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

</body>
</html>