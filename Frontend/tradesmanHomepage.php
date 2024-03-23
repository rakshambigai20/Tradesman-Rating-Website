<?php
?>

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
    include "../Backend/bookingTradesmanview.php";

     ?>

    <h3>Your rating code</h3>
    <?php
    $email1 = $_SESSION['email'];
    require ('../Backend/class/dbh.inc.php');
    $q = "SELECT rating_code from users where EMAIL='$email1';";
    $result = $dbc->query($q);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        echo "Rating code: " . $row['rating_code'] . "<br/>";
    }
    ?>

    <?php
    if ($bookings) {
        foreach ($bookings as $booking) {
            echo "<div class='col-md-4 mb-3'>";
            echo "<div class='booking-card' style='width: 100%;height:350px'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>Booking Details</h5>";
            echo "<div class='card-info'><span class='card-label'>ID:</span> " . $booking["ID"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Customer Name:</span> " . $booking["customerName"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Customer Email:</span> " . $booking["customerEmail"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Customer Phone:</span> " . $booking["customerPhone"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Place:</span> " . $booking["place"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Date:</span> " . $booking["date"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Start Time:</span> " . $booking["bookingStart"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>End Time:</span> " . $booking["bookingEnd"] . "</div>";
            echo "<form action='' method='post'>";
            echo "<input type='hidden' name='email' value='" . $email . "'>";
            echo "<input type='hidden' name='bookingID' value='" . $booking['ID'] . "'>";
            echo "<button type='submit' class='btn-card btn btn-primary' name='cancelBooking'>Cancel booking</button>";
            echo "</form>";
            echo "</div>"; // card-body
            echo "</div>"; // card
            echo "</div>"; // col-md-4 mb-3
        }
    } else {
        echo "No bookings available for the provided email ID";
    }
    ?>

</body>
</html>
