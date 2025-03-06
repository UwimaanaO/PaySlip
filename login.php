<?php
session_start();
header('Content-Type: application/json'); // Set JSON header

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "payslipproject"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed."]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT id, password, role FROM users WHERE makerereEmail = '$email' OR personalEmail = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['LAST_ACTIVITY'] = time(); // Set activity timestamp

            // Redirect based on role
            $redirect = ($row['role'] == 'admin') ? "adminDashboard.php" : "userDashboard.php";

            echo json_encode(["status" => "success", "redirect" => $redirect]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid password. Try again."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid username or password."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}

$conn->close();
?>