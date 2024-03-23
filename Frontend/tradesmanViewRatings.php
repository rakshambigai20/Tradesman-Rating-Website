<!DOCTYPE html>
<html>
<head>
    <title>Rater.co.uk</title>
    <link rel="stylesheet" href="../css/customer.css">
    <link rel="stylesheet" href="../css/booking.css">
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include "../includes/tradesman_nav.html";
    include "../Backend/ratingsTradesmanview.php"; ?>

    <?php
    if (isset($ratings) && !empty($ratings)) {
        foreach ($ratings as $rating) {
            echo "<div class='col-md-4 mb-3'>";
            echo "<div class='booking-card' style='width: 100%;height:350px'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>Ratings</h5>";
            echo "<div class='card-info'><span class='card-label'>Booking ID:</span> " . $rating["bookingId"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Customer Name:</span> " . $rating["customerName"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Customer Email:</span> " . $rating["customerEmail"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Customer ratings:</span> " . $rating["customerRating"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Feedback:</span> " . $rating["feedback"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Date:</span> " . $rating["date"] . "</div>";
            echo "</div>"; // card-body
            echo "</div>"; // card
            echo "</div>"; // col-md-4 mb-3
        }
    } else {
        echo "No ratings available for the provided email ID";
    }
    ?>

</body>
</html>
