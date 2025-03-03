<?php
session_start(); // Start the session

// Destroy all session data
session_unset();
session_destroy();

// Redirect to login page (update with your actual login page URL)
header("Location: login.php");
exit();
?>