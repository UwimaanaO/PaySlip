<?php
// Database connection
$servername = "localhost";
$username = "root"; // XAMPP default MySQL username
$password = ""; // XAMPP default MySQL password
$database = "payslipproject"; // Name of your database

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

    // Prepare SQL query to check for matching email
    $sql = "SELECT * FROM users WHERE makerereEmail = '$email'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, verify password
        $row = $result->fetch_assoc();
        
        // Check if password matches
        if (password_verify($password, $row['password'])) {
            // Password matches, allow login
            session_start();
            $_SESSION['user_id'] = $row['id']; // Store user ID in session
            $_SESSION['user_email'] = $row['makerereEmail']; // Store email in session
            
            // Redirect to the Dashboard
            header("Location: Dashboard.html");
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found with this email.";
    }
}

// Close the connection
$conn->close();
?>