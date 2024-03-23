<?php
require_once 'Account.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $currentPassword = $_POST['pass'] ?? '';
    $newPassword1 = $_POST['pass1'] ?? '';
    $newPassword2 = $_POST['pass2'] ?? '';

    // Create an instance of the Account class
    $account = new Account($email, $currentPassword); 

    // Call the resetPassword method
    Account::resetPassword($email, $currentPassword, $newPassword1, $newPassword2);
}
?>
