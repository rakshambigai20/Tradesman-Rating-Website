<!DOCTYPE html>
<html>
<head>
    <title>Rater.co.uk</title>
    <link rel="stylesheet" href="../css/customer.css">
    <link rel="stylesheet" href="../css/booking.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include "../includes/nav.html";
    include "../Backend/bookingCustomerView.php";
    ?>

    <?php
    if ($bookings) {
        foreach ($bookings as $row) {
            echo "<div class='col-md-4 mb-3'>";
            echo "<div class='booking-card' style='width: 100%;'>";
            echo "<div class='card-body'>";

            echo "<h5 class='card-title'>Booking Details</h5>";
            echo "<div class='card-info'><span class='card-label'>ID:</span> " . $row["ID"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Customer Name:</span> " . $row["customerName"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Customer Email:</span> " . $row["customerEmail"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Customer Phone:</span> " . $row["customerPhone"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Place:</span> " . $row["place"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Date:</span> " . $row["date"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Start Time:</span> " . $row["bookingStart"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>End Time:</span> " . $row["bookingEnd"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Tradesman Email:</span> " . $row["tradesmanEmail"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Tradesman Name:</span> " . $row["tradesmanName"] . "</div>";
            echo "<div class='card-info'><span class='card-label'>Tradesman Phone:</span> " . $row["tradesmanPhone"] . "</div>";
            echo "<button type='button' class='btn-card btn btn-primary' data-toggle='modal' data-target='#ratings' 
  data-bookingid='" . $row['ID'] . "' 
  data-customername='" . htmlspecialchars($row['customerName'], ENT_QUOTES) . "' 
  data-tradesmanname='" . htmlspecialchars($row['tradesmanName'], ENT_QUOTES) . "' 
  data-customeremail='" . htmlspecialchars($row['customerEmail'], ENT_QUOTES) . "' 
  data-tradesmanemail='" . htmlspecialchars($row['tradesmanEmail'], ENT_QUOTES) . "' 
  onclick='setModalContent(this)'>Rate Tradesman</button>";

            echo "<form action='' method='post'>";
            echo "<input type='hidden' name='email' value='" . $email . "'>";
            echo "<input type='hidden' name='bookingID' value='" . $row['ID'] . "'>";
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
            <div class="modal-body" >
                <form action="../Backend/updateRatings.php" method="post" >
                    <input  type="hidden" id="bookingID" name="bookingID">
                    <input type="hidden" id="customer_name" name="customer_name">
                    <input type="hidden" id="customer_email" name="customer_email">
                    <input type="hidden" id="tradesmanName" name="tradesmanName">
                    <input type="hidden" id="tradesman_email" name="tradesman_email">
                    Tradesman code:<input style="margin:10px;" type="text" id="tradesmanCode" name="tradesmanCode"><br>
                    Rating 1-5: <input style="margin:10px;" type="number" id="rating" name="rating" min="1" max="5" required><br>
                    Feedback:<br> <textarea style="margin:10px;" id="feedback" name="feedback" rows="4" cols="50"></textarea>
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
