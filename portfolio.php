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
    $name = trim($_POST['name']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST['phone']);
    $service = trim($_POST['service']);
    $preferred_date = trim($_POST['date']);
    $description = trim($_POST['description']);

    // Input validation
    $errors = [];



    // Validate name
    if (empty($name)) {
      $errors[] = "Full name is required.";
    }

    // Validate email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Valid email address is required.";
    }

    // Validate phone
    if (empty($phone) || !preg_match('/^[0-9]{10,15}$/', $phone)) {
      $errors[] = "Phone number is required and must be between 10 and 15 digits.";
    }

    // Validate service
    if (empty($service)) {
      $errors[] = "Please select a service.";
    }

    // Validate date
    if (empty($preferred_date)) {
      $errors[] = "Preferred date is required.";
    }

    // Validate description
    if (empty($description) || strlen($description) < 50) {
      $errors[] = "Project description is required and must be at least 10 characters long.";
    }



    // If there are no validation errors, insert data into the database
    if (empty($errors)) {
      try {
          // Use $conn instead of $pdo for the prepared statement
          $stmt = $conn->prepare("INSERT INTO service_bookings (name, email, phone, service, preferred_date, description) 
                                  VALUES (:name, :email, :phone, :service, :preferred_date, :description)");

          // Bind parameters
          $stmt->bindParam(':name', $name);
          $stmt->bindParam(':email', $email);
          $stmt->bindParam(':phone', $phone);
          $stmt->bindParam(':service', $service);
          $stmt->bindParam(':preferred_date', $preferred_date);
          $stmt->bindParam(':description', $description);

          // Execute the query
          $stmt->execute();

          // Success message
          echo "<script>alert('Your consultation has been scheduled successfully!'); window.location.href='your_redirect_page.php';</script>";
      } catch (PDOException $e) {
          echo "<script>alert('Error scheduling consultation. Please try again later.');</script>";
      }
    } else {
      // Display validation errors
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
    <title>Derrick Services Page</title>
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
        <!-- Logout Button -->
        <form method="post" action="home.php">
            <button type="submit" name="logout" class="logout-btn">Logout</button>
        </form>
        <!-- Add this button group to your header before the menu-icon div -->
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


  <section id="quality">
      <div class="printing-quality-section scroll-scale">
        <div class="content-wrapper">
          <div class="text-content">
            <h1>Get Unmatched Printing Quality from us</h1>
            <p>We are proud to be voted among the best Printers in Kenya. Our Quality services and an eye for details, integrity and honesty can't be matched. No business or print is small or tricky to us, we shall always find a way to help. You have a small budget for printing services we are flexible and we shall fit. Order quality branding and printing services from us.</p>
            <a href="#make-order" class="order-btn">Place An Appointment</a>
          </div>
          <div class="image-content">
            <img src="assets/forbanner.jpeg" alt="Printing Machines">
          </div>
        </div>
      </div>
  </section>


  <section id="services-top">
      <h1 class="services-top-title scroll-scale">A One Stop Shop For All Designs, Printing And Branding Services</h1>
      <div class="printing-services scroll-scale">
        <div class="service-card">
          <div class="service-icon">
            <img src="portfolio imagges/buz.jpeg" alt="Business Card Printing">
          </div>
          <div class="service-details">
            <h3>Business Card Printing</h3>
            <p>A good business cards elevates your business and company's image. We design and print quality business cards at affordable prices and quick turn around. Our business cards printing services come with unlimited Finishing which include: Matte and gloss lamination, 2D, Foil, oval corners etc.</p>
          </div>
        </div>
        <div class="service-card">
          <div class="service-icon">
            <img src="portfolio imagges/print station.jpeg" alt="Printed Stationary">
          </div>
          <div class="service-details">
            <h3>Printed Stationary</h3>
            <p>Get Quality custom and branded stationary for your business and organization from Inkaprint Printers. We offer letter heads, complimentary slips, note books, invoice books, printing, receipt books printing, envelops, business cards, job cards, forms, petty cash vouchers, diaries etc.</p>
          </div>
        </div>
        <div class="service-card">
          <div class="service-icon">
            <img src="portfolio imagges/po print.jpeg" alt="Posters Printing Services">
          </div>
          <div class="service-details">
            <h3>Posters Printing Services</h3>
            <p>We offer Poster Printing services in Kenya and E.A Africa Region. Our posters are printed on gloss art paper, matte bond paper, satin and canvas. We print Sizes of posters: A5,A4,A3,A2,A1 and A0. Order your poster printing services from us.</p>
          </div>
        </div>
        <div class="service-card">
          <div class="service-icon">
            <img src="portfolio imagges/t-shirt print.jpeg" alt="T-Shirt Printing">
          </div>
          <div class="service-details">
            <h3>T-Shirt Printing</h3>
            <p>Get quality custom and branded t-shirts for your business, event, groups, and organization from us. We offer both embroidery t-shirt branding, vinyl t-shirt printing, screen printing and heat press. We brand both color and round neck t-shirts at affordable prices and quick turn round.</p>
          </div>
        </div>
        <div class="service-card">
          <div class="service-icon">
            <img src="portfolio imagges/flyer print.jpeg" alt="Flyer Printing">
          </div>
          <div class="service-details">
            <h3>Flyer Printing</h3>
            <p>Promote your events, services, or products with eye-catching flyers. We design and print flyers in various sizes and finishes to ensure maximum impact for your brand.</p>
          </div>
        </div>
        
        <div class="service-card">
          <div class="service-icon">
            <img src="portfolio imagges/banner print.jpeg" alt="Banner Printing">
          </div>
          <div class="service-details">
            <h3>Banner Printing</h3>
            <p>Get high-quality banners for indoor and outdoor advertising. We print roll-up banners, PVC banners, mesh banners, and backlit banners customized to your needs.</p>
          </div>
        </div>
        
        <div class="service-card">
          <div class="service-icon">
            <img src="portfolio imagges/mugs print.jpeg" alt="Mug Printing">
          </div>
          <div class="service-details">
            <h3>Mug Printing</h3>
            <p>Personalized and branded mugs are great for promotions and gifts. We offer full-color sublimation printing on ceramic mugs for unique and creative designs.</p>
          </div>
        </div>
        
        <div class="service-card">
          <div class="service-icon">
            <img src="portfolio imagges/calendar print.jpeg" alt="Calendar Printing">
          </div>
          <div class="service-details">
            <h3>Calendar Printing</h3>
            <p>We print and design customized calendars that keep your brand visible all year long. Choose from wall, desk, or pocket calendars for personal or corporate branding.</p>
          </div>
        </div>
        
        <div class="service-card">
          <div class="service-icon">
            <img src="portfolio imagges/signage print.jpeg" alt="Signage Printing">
          </div>
          <div class="service-details">
            <h3>Signage Printing</h3>
            <p>Enhance your business visibility with custom signage. We design and print shop signs, directional signs, and office signs using durable materials for long-lasting use.</p>
          </div>
        </div>
        
        <div class="service-card">
          <div class="service-icon">
            <img src="portfolio imagges/sticker print.jpeg" alt="Sticker Printing">
          </div>
          <div class="service-details">
            <h3>Sticker Printing</h3>
            <p>Get custom stickers for packaging, branding, and promotional needs. We print vinyl stickers, paper stickers, and labels in all shapes and sizes.</p>
          </div>
        </div>
        
        <div class="service-card">
          <div class="service-icon">
            <img src="portfolio imagges/brochure print.jpeg" alt="Brochure Printing">
          </div>
          <div class="service-details">
            <h3>Brochure Printing</h3>
            <p>Showcase your products and services with professionally printed brochures. We offer bi-fold, tri-fold, and custom-sized brochures printed in full color.</p>
          </div>
        </div>
        
        <div class="service-card">
          <div class="service-icon">
            <img src="portfolio imagges/packaging print.jpeg" alt="Packaging Design and Printing">
          </div>
          <div class="service-details">
            <h3>Packaging Design and Printing</h3>
            <p>We design and print custom packaging solutions that reflect your brand identity. From box packaging to branded bags, we ensure quality and creativity in every print.</p>
          </div>
        </div>   
      </div>
  </section>


  <section class="booking-section scroll-scale" id="make-order">
    <div class="section-header">
        <h2 class="scroll-scale">Schedule Your Design Consultation</h2>
        <p>Tell us about your project and let's bring your vision to life</p>
    </div>

    <div class="booking-container scroll-scale">
        <div class="form-section">

        <!-- Booking Form -->
        <form id="bookingForm" action="portfolio.php" method="POST">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" required>
        </div>

        <div class="form-group">
            <label for="service">Service Type</label>
            <select id="service" name="service" required>
                <option value="">Select a service</option>
                <option value="graphic-design">Graphic Design</option>
                <option value="printing">Printing Services</option>
                <option value="branding">Branding Solutions</option>
            </select>
        </div>

        <div class="form-group">
            <label for="date">Preferred Date</label>
            <input type="date" id="date" name="date" required>
        </div>

        <div class="form-group">
            <label for="description">Project Description</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>

        <button type="submit">Schedule Consultation</button>
    </form>

        </div>
        <div class="illustration-section scroll-scale">
          <svg width="400" height="400" viewBox="0 0 400 400">
              <!-- Wall Background -->
              <rect x="0" y="0" width="400" height="250" fill="var(--white-2)"/>
              
              <!-- Wall Art Designs -->
              <!-- Abstract Art Piece 1 -->
              <rect x="40" y="30" width="60" height="80" rx="5" 
                    fill="var(--primary)" stroke="var(--darkpurple-1)" stroke-width="2"/>
              <path d="M50 50 Q70 90 90 50" stroke="var(--verylightpurple-2)" stroke-width="3" fill="none"/>
              <circle cx="70" cy="70" r="15" fill="var(--vibrant-teal)" opacity="0.6"/>
              
              <!-- Abstract Art Piece 2 -->
              <rect x="300" y="40" width="70" height="50" rx="5" 
                    fill="var(--primary)" stroke="var(--darkpurple-1)" stroke-width="2"/>
              <path d="M310 65 L360 65" stroke="var(--verylightpurple-3)" stroke-width="4"/>
              <circle cx="335" cy="65" r="10" fill="var(--verylightpurple-4)"/>
              
              <!-- Geometric Wall Pattern -->
              <path d="M120 20 L140 40 L120 60" stroke="var(--verylightpurple-1)" stroke-width="2" fill="none"/>
              <path d="M270 30 L290 50 L270 70" stroke="var(--verylightpurple-1)" stroke-width="2" fill="none"/>
              
              <!-- Creative Pattern Elements -->
              <circle cx="180" cy="40" r="8" fill="var(--verylightpurple-5)" opacity="0.7"/>
              <circle cx="200" cy="40" r="8" fill="var(--vibrant-teal)" opacity="0.5"/>
              <circle cx="220" cy="40" r="8" fill="var(--verylightpurple-2)" opacity="0.6"/>
              
              <!-- Hanging Plant Design -->
              <path d="M350 10 Q350 40 330 50" stroke="var(--vibrant-teal-1)" stroke-width="2" fill="none"/>
              <path d="M350 10 Q350 45 370 55" stroke="var(--vibrant-teal-1)" stroke-width="2" fill="none"/>
              <circle cx="350" cy="10" r="3" fill="var(--darkpurple)"/>
              
              <!-- Desk -->
              <rect x="50" y="250" width="300" height="20" fill="var(--darkpurple-1)"/>
              <rect x="60" y="270" width="280" height="80" fill="var(--darkpurple)"/>
              
              <!-- Computer -->
              <rect x="150" y="160" width="120" height="80" fill="var(--white-1)"/>
              <rect x="145" y="155" width="130" height="5" fill="var(--darkpurple)"/>
              <rect x="190" y="240" width="40" height="10" fill="var(--darkpurple)"/>
              <rect x="180" y="250" width="60" height="5" fill="var(--darkpurple-1)"/>
              
              <!-- Screen Content -->
              <rect x="160" y="165" width="100" height="65" fill="var(--verylightpurple-1)"/>
              <path d="M170 180 H250 M170 195 H230 M170 210 H240" stroke="var(--verylightpurple-2)" stroke-width="3"/>
              
              <!-- Designer Character -->
              <circle cx="210" cy="180" r="25" fill="var(--vibrant-teal)"/>
              <path d="M210 205 L210 240 M190 220 L210 240 L230 220" 
                    stroke="var(--vibrant-teal)" stroke-width="4"/>
              <path d="M195 175 L205 175 M215 175 L225 175" 
                    stroke="var(--darkpurple)" stroke-width="2"/>
              <path d="M205 185 Q210 190 215 185" 
                    stroke="var(--darkpurple)" stroke-width="2" fill="none"/>
              
              <!-- Chair -->
              <path d="M180 240 L170 300 M240 240 L250 300" 
                    stroke="var(--darkpurple-2)" stroke-width="4"/>
              <path d="M165 300 L255 300" 
                    stroke="var(--darkpurple-2)" stroke-width="4"/>
              
              <!-- Additional Desk Items -->
              <rect x="100" y="260" width="30" height="20" fill="var(--verylightpurple-1)"/> <!-- Book/notepad -->
              <circle cx="280" cy="270" r="10" fill="var(--verylightpurple-3)"/> <!-- Coffee mug -->
          </svg>

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
          <a href="#quality"><i class='bx bx-up-arrow-alt'></i></a>
      </div>
  </footer>
  
          
<!--------------Link To Normal JavaScript----------------->
<script src="script.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</body>
</html>