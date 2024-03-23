<!DOCTYPE html>
<html>
<head>
    <title>Rater.co.uk</title>
    <link rel="stylesheet" href="../css/booking.css">
</head>
<body>
    <?php include "../includes/adminNav.html"; ?>

    <?php
    session_start();
    if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
        $email = $_SESSION['email'];


        require('../Backend/class/dbh.inc.php');
        $e = "SELECT * FROM tradesmanratings ;";
        $result = $dbc->query($e);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4 mb-3'>";
                echo "<div class='booking-card' style='width: 100%; height:400px;'>";
                echo "<div class='card-body'>";

                echo "<h5 class='card-title'>Ratings</h5>";
                echo "<div class='card-info'><span class='card-label'>Booking ID:</span> " . $row["Booking_ID"] . "</div>";
                echo "<div class='card-info'><span class='card-label'>Customer Name:</span> " . $row["Customer_name"] . "</div>";
                echo "<div class='card-info'><span class='card-label'>Customer Email:</span> " . $row["Customer_email"] . "</div>";
                echo "<div class='card-info'><span class='card-label'>Customer ratings:</span> " . $row["Rating"] . "</div>";
                echo "<div class='card-info'><span class='card-label'>Feedback:</span> " . $row["Feedback"] . "</div>";
                echo "<div class='card-info'><span class='card-label'>Date:</span> " . $row["Rating_date"] . "</div>";
                echo "<div class='card-info'><span class='card-label'>Tradesman Name:</span> " . $row["Tradesman_name"] . "</div>";
                echo "<div class='card-info'><span class='card-label'>Tradesman email:</span> " . $row["Tradesman_email"] . "</div>";
                echo "</div>"; // card-body
                echo "</div>"; // card
                echo "</div>"; // col-md-4 mb-3
            }
        } else {
            echo "Rating is not available";
        }
        $dbc->close();
    }
    ?>


</html>

