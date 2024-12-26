<?php
session_start(); // Start session to manage user login state

// Include database connection using PDO
require_once 'db_connect.php';

// Initialize error message
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    $username_or_email = trim($_POST['username_or_email']);
    $password = trim($_POST['password']);

    // Input validation (basic)
    if (empty($username_or_email) || empty($password)) {
        $error_message = "All fields are required!";
    } else {
        try {
            // Use $conn instead of $pdo for the database connection
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username_or_email OR email = :username_or_email");
            $stmt->bindParam(':username_or_email', $username_or_email);
            $stmt->execute();

            // Check if user exists
            if ($stmt->rowCount() > 0) {
                // Fetch user data
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Verify password (ensure passwords are hashed during registration)
                if (password_verify($password, $user['password'])) {
                    // Password is correct, set session variables
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];

                    // Redirect to home page
                    header("Location: home.php");
                    exit();
                } else {
                    $error_message = "Invalid username/email or password.";
                }
            } else {
                $error_message = "Sign in failed, no account found. Register first!";
            }
        } catch (PDOException $e) {
            $error_message = "Error: " . $e->getMessage();
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!--Link Stylesheet CSS Here......-------------->
    <link rel="stylesheet" href="styles.css">
    <!--Theme Switcher Styling Page CSS Link Here......-------------->
    <link rel="stylesheet" href="color_palletes.css">
    <!--BoxIcons Link Goes Here.........------------------------->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <!--Link Google Fonts API Here....---------------------------->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <!----------------------------------------------------
    LOGIN PAGE HEADER GOES HERE
    --------------------------------------------------------------------------------->
    <header>
        <img src="assets/Qlogo-removebg-preview.png" alt="Pentagon Logo" class="logo">
        <a href="register.php">
            <button class="reg-btn">Register</button>
        </a>
        <div class="theme-switcher">
            <button class="theme-btn" data-theme="light" title="Light Mode">☀️</button>
            <button class="theme-btn" data-theme="colored" title="Colored Mode">🎨</button>
            <button class="theme-btn" data-theme="dark" title="Dark Mode">🌙</button>
        </div>   
    </header>

    <!----------------------------------------------------------
    LOGIN FORM SECTION GOES HERE
    --------------------------------------------------------------------------->
    <section id="user-login">
    <form action="login.php" method="POST" class="login-form scroll-scale">
        <h1 class="form-title">Login</h1>

        <!-- Display error messages if any -->
        <?php if (!empty($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <div class="input-box">
            <i class='bx bxs-user'></i>
            <input type="text" name="username_or_email" placeholder="Username or Email" required>
        </div>
        <div class="input-box">
            <i class='bx bxs-lock-alt'></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <div class="remember-forgot-box">
            <label for="remember">
                <input type="checkbox" id="remember">
                Remember me.
            </label>
            <a href="#">Forgot Password?</a>
        </div>

        <button class="login-btn" type="submit">Login</button>

        <p class="alternative">Don't have an account? <a href="register.php">Register</a></p>
    </form>
    </section>

    

    <!--Link Javascript File------------------------>
    <script src="script.js"></script>

</body>
</html>
