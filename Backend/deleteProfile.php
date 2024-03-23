<?php
if (session_id() == '') {
    session_start();
}
require_once 'account.php'; // Include the Account class definition

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST["email"] ?? '';
    
    // Create an instance of the Account class
    $adminUser = new admin($_SESSION['email'], $_SESSION['password']);

    // Now call the login method on the Account object
    $adminUser->deleteProfile();
}
?>
