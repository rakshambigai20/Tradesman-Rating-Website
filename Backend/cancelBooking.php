<?php
if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
    require_once 'class/booking.php';
    $email = $_SESSION['email'];

    if (isset($_POST['cancelBooking']) && !empty($_POST['bookingID'])) {
        $bookingID = $_POST['bookingID'];
        $cancelResult = $booking->cancelBooking($bookingID);

        if ($cancelResult) {
            // Booking was canceled successfully, show an alert
            echo "<script>alert('Booking canceled successfully');</script>";
        } else {
            // Failed to cancel the booking, show an alert
            echo "<script>alert('Error canceling booking');</script>";
        }
    }
}
?>
