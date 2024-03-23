<?php
session_start();
require_once 'class/rating.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include necessary classes and files
    require_once 'class/booking.php';

    // Retrieve POST data
    $bookingID = $_POST["bookingID"];
    
    $customer_name = $_POST["customer_name"];
    $customer_email = $_POST["customer_email"];
    $tradesmanName = $_POST["tradesmanName"];
    $tradesman_email = $_POST["tradesman_email"];
    $tradesmanCode = $_POST["tradesmanCode"];
    $rating = $_POST["rating"];
    $feedback = $_POST["feedback"];

    // Create an object of the Rating class
    $Rating = new Rating();

    // Call the updateRatings method on the Rating object
    $result = $Rating->provideRatings($bookingID, $customer_name, $customer_email, $tradesmanName, $tradesman_email, $tradesmanCode, $rating, $feedback);

    // Redirect to a page based on the result
    switch ($result) {
        case "success":
            header("Location: ../Frontend/bookingCustomerView.php");
            exit();
        case "rating_exists":
            echo "<script>
    alert('Rating has already been provided by the customer');
    window.location.href = '../Frontend/homePage.php';
</script>";
            break;
        case "code_incorrect":
            echo "<script>alert('Code Incorrect');</script>";
            break;
        case "no_tradesman":
            echo "<script>alert('No tradesman found with the provided email');</script>";
            break;
        case "error":
            echo "<script>alert('Error in providing rating');</script>";
            break;
    }
}
?>
