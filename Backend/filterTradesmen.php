<?php
require_once 'class/booking.php';

$booking = new Booking();
$location = $_POST["location"] ?? '';
$type = $_POST["type"] ?? '';
$result = $booking->filterTradesmen($location, $type);
?>