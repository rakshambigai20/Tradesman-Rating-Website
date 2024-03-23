<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rater.co.uk</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include "homePage.php"; ?>

    <div>
        <?php
            $location = $_POST["location"] ?? '';
            $type = $_POST["type"] ?? '';
            require ('../Backend/class/dbh.inc.php');
            $q = "SELECT ID, EMAIL, name, location, hourly_pay, unavailable, skills, start_time, end_time, rating, pg_status, phone FROM users 
                   WHERE location='$location' AND skills='$type' ORDER BY 
                   CASE WHEN pg_status='YES' THEN 0 ELSE 1 END, pg_status;";

            $result = $dbc->query($q);
        ?>
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-3'>";
                    echo "<div class='card' style='width: 100%;height:550px;'>";
                    echo "<div class='card-body'>";

                    // Professional status badge
                    $badgeClass = $row["pg_status"] == 'YES' ? 'badge-success' : 'badge-secondary';
                    $badgeText = $row["pg_status"] == 'YES' ? 'Professional' : '';
                    echo "<h5 class='card-title'><span style='background:green;' class='badge " . $badgeClass . "'>" . $badgeText . "</span> " . $row["name"] . "</h5>";

                    // Tradesman information
                    echo "<div class='card-info'><span class='card-label'>Email:</span> " . $row["EMAIL"] . "</div>";
                    echo "<div class='card-info'><span class='card-label'>Location:</span> " . $row["location"] . "</div>";
                    echo "<div class='card-info'><span class='card-label'>Hourly Pay:</span> " . $row["hourly_pay"] . "</div>";
                    echo "<div class='card-info'><span class='card-label'>Skills:</span> " . $row["skills"] . "</div>";
                    echo "<div class='card-info'><span class='card-label'>Phone:</span> " . $row["phone"] . "</div>";
                    echo "<div class='card-info'><span class='card-label'>Rating:</span> </div>";
                     // Fetch and Display Ratings
                     $tradesmanEmail = $row["EMAIL"];
                     $ratingsQuery = "SELECT Customer_name,Rating,Feedback FROM tradesmanratings WHERE Tradesman_email = '$tradesmanEmail'";
                     $ratingsResult = $dbc->query($ratingsQuery);
 
 
                     echo "<div style='height: 95px; width: 350px; overflow-y: auto; border: 1px solid black;margin-left:13px'>";
                     if ($ratingsResult && $ratingsResult->num_rows > 0) {
                         while ($ratingRow = $ratingsResult->fetch_assoc()) {
                             echo "<p><b>Name:<b> " . $ratingRow["Customer_name"] . "</p>";
                             echo "<p><b>Rating:<b> " . $ratingRow["Rating"] . "</p>";
                             echo "<p><b>Feedcack:<b> " . $ratingRow["Feedback"] . "</p>";
                             echo "<hr>";
                         }
                     } else {
                         echo "<p>No ratings available.</p>";
                     }
                    
                     echo "</div>";
                     echo "<div class='card-info'><span class='card-label'>Calender:</span> </div>";


                    // Check Availability form
                      // Fetch and Display Bookings
                      $bookingsQuery = "SELECT * FROM booking WHERE tradesman_email = '$tradesmanEmail'";
                      $bookingsResult = $dbc->query($bookingsQuery);
                      
                      echo "<div style='height: 95px; width: 350px; overflow-y: auto; border: 1px solid black; margin-left:13px'>";
                      
                      if ($bookingsResult && $bookingsResult->num_rows > 0) {
                          while ($bookingRow = $bookingsResult->fetch_assoc()) {
                              // Use DATE() function to extract the date part
                              $formattedDate = date('Y-m-d', strtotime($bookingRow["date"]));
                      
                              echo "<p><b>Slot:</b> " . $formattedDate . " from " . $bookingRow["booking_start"] . " to " . $bookingRow["booking_end"] . "</p>";
                          }
                      } else {
                          echo "<p>No bookings available.</p>";
                      }
                      
                      echo "</div>";           


                   
                   

                    // Booking action
                    echo "<button style='margin:10px;width:350px' type='button' class='btn btn-primary mb-2' data-toggle='modal' data-target='#availabilityModal' data-name='" . $row["name"] . "' data-email='" . $row["EMAIL"] . "' data-phone='" . $row["phone"] . "' data-location='" . $row["location"] . "' onclick='setModalContent(this)'>Book Tradesman</button>";

                    echo "</div>"; // card-body
                    echo "</div>"; // card
                    echo "</div>"; // col-md-4 mb-3
                }
            } else {
                echo "<p>No tradesmen available. Please search again with selected location and skills.</p>";
            }
            $dbc->close();
        ?>
    </div>

    <!-- Modal for Booking -->
    <div class="modal fade" id="availabilityModal" tabindex="-1" role="dialog" aria-labelledby="availabilityModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="availabilityModalLabel">Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <form method='post' action='../Backend/bookTrade.php'>
                            <!-- Hidden fields to store tradesman details -->
                            <input type="hidden" id="tradesmanName" name="tradesmanName">
                            <input type="hidden" id="tradesmanEmail" name="tradesmanEmail">
                            <input type="hidden" id="tradesmanPhone" name="tradesmanPhone">
                            <input type="hidden" id="tradesmanLocation" name="tradesmanLocation">

                            <!-- Visible form fields -->
                            <div class="form-group">
                                <label for="c_name">Name</label>
                                <input type="text" class="form-control" id="c_name" name="c_name" required>
                            </div>
                            <div class="form-group">
                                <label for="c_email">Email Address</label>
                                <input type="text" class="form-control" id="c_email" name="c_email" required>
                            </div>
                            <div class="form-group">
                                <label for="number">Phone number</label>
                                <input type="text" class="form-control" id="number" name="number" required>
                            </div>
                            <div class="form-group">
                                <label for="meeting_date">Meeting Date:</label>
                                <input type="date" class="form-control" id="meeting_date" name="meeting_date" required>
                            </div>
                            <div class="form-group">
                                <label for="booking_start">Start time:</label>
                                <input type="time" class="form-control" id="booking_start" name="booking_start" required>
                            </div>
                            <div class="form-group">
                                <label for="booking_end">End time:</label>
                                <input type="time" class="form-control" id="booking_end" name="booking_end" required>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Book</button>
        </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            <?php if ($isFormSubmitted) : ?>
                $('#checkModal').modal('show');
            <?php endif; ?>
        });
    </script>

    <script>
        $(document).ready(function(){
            <?php if ($isratingFormSubmitted) : ?>
                $('#ratingsModal').modal('show');
            <?php endif; ?>
        });
    </script>

    <script>
        function setModalContent(button) {
            var name = button.getAttribute('data-name');
            var email = button.getAttribute('data-email');
            var phone = button.getAttribute('data-phone');
            var location = button.getAttribute('data-location');

            document.getElementById('tradesmanName').value = name;
            document.getElementById('tradesmanEmail').value = email;
            document.getElementById('tradesmanPhone').value = phone;
            document.getElementById('tradesmanLocation').value = location;
        }
    </script>

    <script>
        function setModalContent1(button) {
            var email = button.getAttribute('data-email');
            document.getElementById('tradesmanEmail').value = email;
        }
    </script>
     <script>
        $(document).ready(function () {
            $('#selectedDate').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            $('#selectedDate').on('changeDate', function () {
                var selectedDate = $(this).val();
                filterBookings(selectedDate);
            });
        });

        function filterBookings(selectedDate) {
            // You may need to adjust this part based on your actual PHP logic to fetch bookings
            $.ajax({
                url: 'your_php_script_to_fetch_bookings.php',
                type: 'POST',
                data: { selectedDate: selectedDate },
                success: function (response) {
                    $('#bookingsContainer').html(response);
                },
                error: function () {
                    console.log('Error fetching bookings.');
                }
            });
        }
    </script>
</body>
</html>
