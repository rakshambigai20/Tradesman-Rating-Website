<html>
<head>
	<title>Rater.co.uk</title>
	<link rel="stylesheet" href="../css/customer.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
</head>
<body>
<?php
include "../includes/nav.html";
include "../Backend/homePageData.php"; // Include the data handler script
?>
	
    <form action="tradesmenBooking.php" method="POST">
    <!-- Location Dropdown -->
    <div class="form-group">
        <select class="custom-dropdown" name="location" id="locationInput" required>
            <option value="">Select Location</option>
            <?php foreach ($allLocations as $location): ?>
                <option value="<?php echo htmlspecialchars($location); ?>">
                    <?php echo htmlspecialchars($location); ?>
                </option>
            <?php endforeach; ?>
        </select>

    <!-- Trade Dropdown -->
        <select class="custom-dropdown" name="type" id="typeInput" required>
            <option value="">Select Trade</option>
            <?php foreach ($allTradesmen as $trade): ?>
                <option value="<?php echo htmlspecialchars($trade); ?>">
                    <?php echo htmlspecialchars($trade); ?>
                </option>
            <?php endforeach; ?>
        </select>
   

    <!-- Buttons -->
    <button class="search-button btn btn-primary" type="submit">Search</button>
    <button type="button" class="booking-button" class='btn btn-primary' data-toggle='modal' data-target='#bookingModal1'>Booking</button>
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="bookingModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Booking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="view" action="bookingCustomerView.php" method="POST">
            <label for="email">Enter Booked email:</label>
            <input id="email" type="text" name="email" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit1" class="btn btn-primary">View Booking</button>
        
          </form>
      </div>
    </div>
  </div>
</div>







</body>
</html>
