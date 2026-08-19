<?php
// session_check.php

// Start session
session_start();

// Function to validate user authentication
function validateUser() {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page if not logged in
        header('Location: /login.php');
        exit();
    }
}

// Call the validation function
validateUser();
?>