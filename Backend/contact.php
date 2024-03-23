<?php
include "class/querry.php"; // Include the Account class definition

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"] ?? '';
    $comments =$_POST["comments"];
    
    
    
}
    // Create an instance of the Account class
    $querry = new Querry($name,$email,$comments);

    // Now call the login method on the Account object
    $querry->replyQuerry();
?>