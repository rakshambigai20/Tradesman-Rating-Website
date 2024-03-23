<?php
if (session_id() == '') {
    session_start();
}
require_once 'class/account.php';  // Include your Account class

// Create an instance of the Account class
$account = new Account($_SESSION['email'],$_SESSION['password']);  // Assuming email and password are not needed for logout

// Call the logout method
$account->logout();
?>
