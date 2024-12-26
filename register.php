<?php
// Include the database connection file
require_once 'db_connect.php';

// Initialize error message variable
$error_message = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['Email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['Cpassword'];

    // Input validation
    if (empty($name) || empty($username) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
        $error_message = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Invalid email format.';
    } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {  // Basic validation for phone number (10 digits)
        $error_message = 'Invalid phone number. It must be 10 digits.';
    } elseif (strlen($password) < 6) {
        $error_message = 'Password must be at least 6 characters long.';
    } elseif ($password !== $confirm_password) {
        $error_message = 'Passwords do not match.';
    } else {
        // Password hashing for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the username or email already exists
        $sql = "SELECT * FROM users WHERE username = :username OR email = :email";
        $stmt = safeQuery($sql, [':username' => $username, ':email' => $email]);
        if ($stmt->rowCount() > 0) {
            $error_message = 'Username or email already exists.';
        } else {
            // Insert user into the database
            $sql = "INSERT INTO users (name, username, email, phone, password, confirm_password) 
                    VALUES (:name, :username, :email, :phone, :password, :confirm_password)";
            $params = [
                ':name' => $name,
                ':username' => $username,
                ':email' => $email,
                ':phone' => $phone,
                ':password' => $hashed_password,
                ':confirm_password' => $hashed_password
            ];
            $stmt = safeQuery($sql, $params);

            // Redirect to login page on successful registration
            header('Location: login.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up Page</title>
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
    REGISTRATION PAGE HEADER GOES HERE
    --------------------------------------------------------------------------------->
    <header>
        <img src="assets/Qlogo-removebg-preview.png" alt="Pentagon Logo" class="logo">
        <a href="login.php">
            <button class="reg-btn">Login</button>
        </a>
        <div class="theme-switcher">
            <button class="theme-btn" data-theme="light" title="Light Mode">☀️</button>
            <button class="theme-btn" data-theme="colored" title="Colored Mode">🎨</button>
            <button class="theme-btn" data-theme="dark" title="Dark Mode">🌙</button>
        </div>
    </header>

    <!----------------------------------------------------------
    REGISTRATION FORM SECTION
    ---------------------------------------------------------->
    <section id="user-register">
        <form action="" method="POST" class="register-form scroll-scale">
            <h1 class="form-title">Sign Up</h1>

            <!-- Display error messages if any -->
            <?php if (isset($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <div class="input-box">
                <i class='bx bxs-lock-alt'></i>
                <input type="text" name="name" placeholder="Full Name" required>
            </div>
            <div class="input-box">
                <i class='bx bxs-user'></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-box">
                <i class='bx bxs-envelope'></i>
                <input type="email" name="Email" placeholder="Your Email" required>
            </div>
            <div class="input-box">
                <i class='bx bxs-user'></i>
                <input type="tel" name="phone" placeholder="Phone Number" required>
            </div>
            <div class="input-box">
                <i class='bx bxs-lock-alt'></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="input-box">
                <i class='bx bxs-lock-alt'></i>
                <input type="password" name="Cpassword" placeholder="Confirm Password" required>
            </div>

            <div class="remember-forgot-box">
                <label for="remember">
                    <input type="checkbox" id="remember">
                    Remember me.
                </label>
            </div>

            <button class="register-btn" type="submit">Sign Up</button>

            <p class="alternative">Already have an account?<a href="login.php">Sign In</a></p>
        </form>
    </section>

    <!--Link Javascript File------------------------>
    <script src="script.js"></script>
</body>
</html>
