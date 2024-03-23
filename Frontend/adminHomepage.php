
<!DOCTYPE html>
<html>
<head>
    <title>Rater.co.uk</title>
    <link rel="stylesheet" href="../css/customer.css">
    <link rel="stylesheet" href="../css/booking.css">
</head>
<body>
<?php
include "../includes/adminNav.html";
?>
<?php
session_start();
$email1 = $_SESSION['email'];
 require ('../Backend/class/dbh.inc.php');
    
    if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
        $email = $_SESSION['email'];

        $e = "SELECT * FROM booking;";
        $result = $dbc->query($e);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4 mb-3'>";
                echo "<div class='booking-card' style='width: 100%; height:350px'>";
                echo "<div class='card-body'>";

                echo "<h5 class='card-title'>Booking Details</h5>";
                echo "<div class='card-info'><span class='card-label'>ID:</span> " . $row["ID"] . "</div>";
                echo "<div class='card-info'><span class='card-label'>Customer Name:</span> " . $row["customer_name"] . "</div>";
                echo "<div class='card-info'><span class='card-label'>Customer Email:</span> " . $row["customer_email"] . "</div>";
                echo "<div class='card-info'><span class='card-label'>Customer Phone:</span> " . $row["customer_phone"] . "</div>";
                echo "<div class='card-info'><span class='card-label'>Place:</span> " . $row["place"] . "</div>";
                echo "<div class='card-info'><span class='card-label'>Date:</span> " . $row["date"] . "</div>";
                echo "<div class='card-info'><span class='card-label'>Start Time:</span> " . $row["booking_start"] . "</div>";
                echo "<div class='card-info'><span class='card-label'>End Time:</span> " . $row["booking_end"] . "</div>";


                echo "</div>"; // card-body
                echo "</div>"; // card
                echo "</div>"; // col-md-4 mb-3
            }
        } else {
            echo "Tradesman booking is not available with the provided email ID";
        }
        $dbc->close();
    }
    ?>

    <!-- Modal for Rating Tradesman -->
   <!-- Modal -->
<div class="modal fade" id="ratings" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rate Tradesman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="tradesman_rating.php" method="post">
                    Booking ID:<input type="text" id="bookingID" name="bookingID">
                    Customer name: <input type="text" id="customer_name" name="customer_name">
                    Customer Email: <input type="text" id="customer_email" name="customer_email">
                    Tradesman Name: <input type="text" id="tradesmanName" name="tradesmanName">
                    Tradesman Email:<input type="text" id="tradesman_email" name="tradesman_email">
                    Tradesman code:<input type="text" id="tradesmanCode" name="tradesmanCode">
                    Rating 1-5: <input type="number" id="rating" name="rating" min="1" max="5" required>
                    Feedback: <textarea id="feedback" name="feedback" rows="4" cols="50"></textarea>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit1" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


</body>
<script>
function setModalContent(button) {
    var bookingId = button.getAttribute('data-bookingid');
    var customerName = button.getAttribute('data-customername');
    var tradesmanName = button.getAttribute('data-tradesmanname');
    var customerEmail = button.getAttribute('data-customeremail');
    var tradesmanEmail = button.getAttribute('data-tradesmanemail');

    document.getElementById('bookingID').value = bookingId;
    document.getElementById('customer_name').value = customerName;
    document.getElementById('customer_email').value = customerEmail;
    document.getElementById('tradesmanName').value = tradesmanName;
    document.getElementById('tradesman_email').value = tradesmanEmail;
}
</script>
</html>


</body>
<script>
function setModalContent(button) {
    var bookingId = button.getAttribute('data-bookingid');
    var customerName = button.getAttribute('data-customername');
    var tradesmanName = button.getAttribute('data-tradesmanname');
    var customerEmail = button.getAttribute('data-customeremail');
    var tradesmanEmail = button.getAttribute('data-tradesmanemail');

    document.getElementById('bookingID').value = bookingId;
    document.getElementById('customer_name').value = customerName;
    document.getElementById('customer_email').value = customerEmail;
    document.getElementById('tradesmanName').value = tradesmanName;
    document.getElementById('tradesman_email').value = tradesmanEmail;
}
</script>
</html>
