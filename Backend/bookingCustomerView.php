<?php
require_once '../Backend/class/booking.php'; // Make sure the path to your class file is correct
$booking = new Booking();
$email = isset($_POST['email']) ? $_POST['email'] : "";

// Check if a booking was canceled
if (isset($_POST['cancelBooking']) && !empty($_POST['bookingID'])) {
    $bookingID = $_POST['bookingID'];
    $cancelResult = $booking->cancelBooking($bookingID);
    echo $cancelResult; // Display cancellation result
}

$bookings = $booking->displayCustomerBookings($email);
?>