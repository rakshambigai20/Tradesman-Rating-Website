<?php
// Check if the user is logged in
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header('Location: ../Frontend/loginForm.php'); // Redirect to the login page
    exit();
}

// Include necessary classes and functions
require_once 'class/account.php';
require_once 'fileUpload.php'; // Path to the file upload function

// Retrieve and sanitize form data
$email = $_POST['email'] ?? '';
$start = $_POST["start_time"] ?? '';
$end = $_POST["end_time"] ?? '';
$pay = $_POST["pay"] ?? '';
$exp = $_POST["exp"] ?? '';
$skill = $_POST["skills"] ?? '';
$pg_status = $_POST["pg_status"] ?? '';

// Handle file upload for PG
$pgFilePath = handlePGFileUpload('pg', '../uploads/pg/');

// Create an instance of the Tradesman class
$account = new Tradesman($_SESSION['email'], $_SESSION['password']);

// Update professional details
// Pass the path of the uploaded PG file as an additional argument
$account->updateProfessionalDetails($email, $start, $end, $pay, $exp, $skill, $pg_status, $pgFilePath);

// Redirect the user to the appropriate page
header("Location: ../Frontend/professionalPage.php");
exit();
?>
