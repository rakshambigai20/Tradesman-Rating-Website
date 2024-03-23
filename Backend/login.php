<?php
if (session_id() == '') {
    session_start();
}
require_once 'class/account.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST["email"] ?? '';
    $password = $_POST["pass"] ?? '';

    // Create an instance of the Account class
    $account = new Account($email, $password);
$_SESSION['account']=$account;
    // Now call the login method on the Account object
    $account->login();
}
?>
