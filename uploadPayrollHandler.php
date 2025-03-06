<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["payrollFile"]) && $_FILES["payrollFile"]["error"] == 0) {
        $file = $_FILES["payrollFile"];
        
        // Validate file type (PDF only)
        $allowedTypes = ['application/pdf'];
        if (!in_array($file["type"], $allowedTypes)) {
            die("Error: Only PDF files are allowed.");
        }

        // Validate file size (Max: 3MB)
        $maxSize = 3 * 1024 * 1024; // 3MB
        if ($file["size"] > $maxSize) {
            die("Error: File size exceeds 3MB limit.");
        }

        // Define upload directory
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Generate a unique filename to prevent overwriting
        $newFileName = uniqid("payroll_", true) . ".pdf";
        $uploadPath = $uploadDir . $newFileName;

        // Move file to the uploads directory
        if (move_uploaded_file($file["tmp_name"], $uploadPath)) {
            echo "Payroll uploaded successfully: <a href='$uploadPath' target='_blank'>View File</a>";
        } else {
            echo "Error: Failed to upload file.";
        }
    } else {
        echo "Error: No file uploaded or an error occurred.";
    }
} else {
    echo "Error: Invalid request.";
}
?>
