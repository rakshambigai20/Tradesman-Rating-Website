<?php

require_once 'class/account.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     // This would be determined based on your application logic
    $email = $_POST['email'] ?? '';
    $password = $_POST['create_password'] ?? '';

    // Instantiate the Account class
    $user = new Tradesman($email,$password);
    

    // Call the register method
    $user->register();
}

?>