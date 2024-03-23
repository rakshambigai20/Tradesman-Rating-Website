<?php session_start();
if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
    require_once 'class/rating.php';
    $email = $_SESSION['email'];
    $ratings = Rating::viewRatings($email);
}
?>