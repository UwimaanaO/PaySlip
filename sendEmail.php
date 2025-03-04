<?php
// Include PHPMailer library if you're using it for better email sending
// Use the following command to install PHPMailer: composer require phpmailer/phpmailer
// Or you can download it manually from https://github.com/PHPMailer/PHPMailer

// Here we'll use the PHP mail function for simplicity

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user email and the message
    $to = $_POST['email']; // The user's email received from the frontend
    $subject = "Your Pay Slip Request";
    $message = "Hello, \n\nYour requested pay slip for the month is now available. Please find it attached.\n\nBest Regards,\nYour Company";
    
    // Set the headers for the email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8" . "\r\n";
    $headers .= "From: uwimaanaolivia2000@gmail.com" . "\r\n"; // Your admin email
    
    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(["status" => "success", "message" => "Email sent successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to send email."]);
    }
}
?>