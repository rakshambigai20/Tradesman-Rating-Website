<?php
if (session_id() == '') {
    session_start();
}
include "class/account.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     // This would be determined based on your application logic
    $skill = $_POST['id'] ?? '';

    // Instantiate the Account class
    $user = new admin($_SESSION['email'], $_SESSION['password']);

    // Call the register method
    $user->deleteSkills();
    
}
?>