<?php
// Database connection parameters
$host = 'localhost'; // Host name (XAMPP default is localhost)
$dbname = 'derrickprint_db'; // Database name
$username = 'root'; // Database username (default for XAMPP)
$password = ''; // Database password (default for XAMPP is empty)

// Create a connection
try {
    // Initialize the PDO object with DSN (Data Source Name) and credentials
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Set error mode to exception for better error handling
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Success message (can be commented out in production)
    // echo "Database connection established successfully.";
} catch (PDOException $e) {
    // Handle connection errors
    die("Database connection failed: " . $e->getMessage());
}

// Function to prevent SQL injection through prepared statements
function safeQuery($sql, $params = []) {
    global $conn;
    try {
        $stmt = $conn->prepare($sql);
        // Bind parameters and execute
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        return $stmt;
    } catch (PDOException $e) {
        die("Error executing query: " . $e->getMessage());
    }
}

// Example of how to use the safeQuery function
// $sql = "SELECT * FROM users WHERE username = :username";
// $params = [':username' => $username];
// $result = safeQuery($sql, $params);
// $user = $result->fetch(PDO::FETCH_ASSOC);

?>
