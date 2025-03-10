<?php
// Enable error reporting (for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = "localhost"; 
$username = "root"; // Change if needed
$password = ""; // Change if needed
$database = "payslipproject"; // Change to your actual database

$conn = new mysqli($host, $username, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = null;
$message = "";

// Check if IPPS Number is entered to fetch user details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["fetchUser"])) {
    $ippsNumber = trim($_POST["ippsNumber"]);

    if (!empty($ippsNumber) && ctype_digit($ippsNumber)) {
        $stmt = $conn->prepare("SELECT first_name, last_name, email, role FROM users WHERE ipps_number = ?");
        $stmt->bind_param("i", $ippsNumber);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        } else {
            $message = "No user found with this IPPS Number.";
        }

        $stmt->close();
    } else {
        $message = "Please enter a valid IPPS Number.";
    }
}

// Handle role update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateRole"])) {
    if (!empty($_POST["ippsNumber"]) && !empty($_POST["role"])) {
        $ippsNumber = trim($_POST["ippsNumber"]);
        $newRole = trim($_POST["role"]);

        if (!ctype_digit($ippsNumber)) {
            $message = "Error: IPPS Number must be numeric.";
        } else {
            $stmt = $conn->prepare("UPDATE users SET role = ? WHERE ipps_number = ?");
            $stmt->bind_param("si", $newRole, $ippsNumber);

            if ($stmt->execute()) {
                $message = "Success: Role updated successfully!";
            } else {
                $message = "Error: Could not update role.";
            }

            $stmt->close();
        }
    } else {
        $message = "Error: IPPS Number and Role are required.";
    }
}

// Close database connection
$conn->close();
?>