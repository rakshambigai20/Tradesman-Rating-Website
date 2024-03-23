<?php
if (session_id() == '') {
    session_start();
}

// Include the necessary class definition (use Tradesman instead of Account)
require_once 'class/account.php';

// Check if the user is logged in (you can modify this logic as needed)
if (!isset($_SESSION['email'])) {
    header('Location: ../Frontend/loginForm.php'); // Redirect to the login page
    exit();
}

// Create an instance of the Tradesman class (instead of Account)
$tradesman = new Tradesman($_SESSION['email'], $_SESSION['password']);

// Call the viewPersonal method to retrieve the user's personal details
$userData = $tradesman->viewPersonal();

// Now, you can use $userData to display the user's details in your HTML
?>