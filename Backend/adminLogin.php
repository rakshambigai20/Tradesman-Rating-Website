<?php
require_once 'account.php'; // Include the Account class definition

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST["email"] ?? '';
    $password = $_POST["pass"] ?? '';


    // Create an instance of the Account class
    $account = new Account($email, $password);

    // Now call the login method on the Account object
    $loginResult = $account->login();
}
?>