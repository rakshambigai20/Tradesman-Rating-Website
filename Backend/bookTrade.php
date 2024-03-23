<?php
require_once('class/Booking.php'); // Include the Booking class
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $customerName = $_POST["c_name"];
    $emailAddress = $_POST["c_email"];
    $mobileNumber = $_POST["number"];
    $location = $_POST["tradesmanLocation"];
    $date = $_POST["meeting_date"];
    $time = $_POST["booking_start"];
    $tradesmanName = $_POST["tradesmanName"];

    // Create an instance of the Booking class
    $booking = new Booking();

    // Call the bookTradesman method to store the booking information in the database
    $result = $booking->bookTradesman($customerName, $emailAddress, $mobileNumber, $location, $date, $time,$tradesmanName);

    if ($result) {
        // Booking was successful, you can redirect or display a success message
        echo "<script>alert('Booking is successfully completed');</script>";
        // Redirect to a success page or load another page
        // header("Location: success.php");
        // exit();
    } else {
        // There was an error in booking, handle it accordingly
        echo "<script>alert('Booking failed. Please try again later.');</script>";
        // Redirect or display an error message
        // header("Location: error.php");
        // exit();
    }
} else {
    // Handle invalid requests, e.g., direct access to this script
    echo "Invalid request!";
}
?>

?>
