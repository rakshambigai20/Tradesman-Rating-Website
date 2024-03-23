<?php
require_once 'class/account.php';

$tradesman = new Tradesman($_SESSION['email'], $_SESSION['password']);

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['updateButton'])) {
        // Retrieve form data
        $name = $_POST["name"];
        $email = $_POST["email"];
        $postalCode = $_POST["postalCode"];
        $phone_number = $_POST["number"];
        $selectedLocation = $_POST["location"];
    
        // Update personal information
        $tradesman->updatePersonal($email, $name, $selectedLocation, $postalCode, $phone_number);

        // Redirect to view updated information
        header('Location: ../Frontend/personalDetailsPage.php'); // Adjust the redirection path as needed
        exit();
    }
}

// Fetch current user data for display

// ... Rest of your code for displaying the form ...
?>
