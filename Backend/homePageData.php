<?php
require_once('class/Booking.php');
// Create an instance of the Booking class
$booking = new Booking();

// Fetch all locations and tradesmen data
$allLocations = $booking->getAllLocations();
$allTradesmen = $booking->getAllTradesmen();
?>