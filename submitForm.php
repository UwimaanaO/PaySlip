<?php
// Step 1: Connect to the Database
$servername = "localhost";
$username = "root"; // Default XAMPP MySQL username
$password = ""; // Default XAMPP MySQL password
$database = "payslipproject"; // Database you created

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Get Data from Form
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$ippsNumber = $_POST['ippsNumber'];
$unit = $_POST['unit'];
$makerereEmail = $_POST['makerereEmail'];
$personalEmail = $_POST['personalEmail'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password

// Step 3: Insert Data into Database
$sql = "INSERT INTO users (firstName, lastName, ippsNumber, unit, makerereEmail, personalEmail, password) 
        VALUES ('$firstName', '$lastName', '$ippsNumber', '$unit', '$makerereEmail', '$personalEmail', '$password')";

if ($conn->query($sql) === TRUE) {
    // Step 4: Redirect to the index page after successful registration
    header("Location: index.php");
    exit(); // Make sure the script stops executing after redirect
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Step 4: Close Connection
$conn->close();
?>