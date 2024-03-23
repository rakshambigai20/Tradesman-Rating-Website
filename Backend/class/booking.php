<?php
class Booking {
    private $customerName;
    private $emailAddress;
    private $mobileNumber;
    private $location;
    private $date;
    private $time;
    private $tradesmanName;

    // Database connection parameters
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "raterUk";

    // Method to establish database connection
    private function connect() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
    public function cancelBooking($bookingID) {
        require('dbh.inc.php');
        $e = "DELETE FROM booking WHERE ID = '$bookingID';";
        $result = $dbc->query($e);

        if ($result === true) {
            return "";
        } else {
            return "Error cancelling booking";
        }
        $dbc->close();
    }
    public function displayCustomerBookings($email) {
        require ('dbh.inc.php');
        $e = "SELECT * FROM booking WHERE customer_email = '$email';";
        $result = $dbc->query($e);

        $bookingsData = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $bookingData = array(
                    "ID" => $row["ID"],
                    "customerName" => $row["customer_name"],
                    "customerEmail" => $row["customer_email"],
                    "customerPhone" => $row["customer_phone"],
                    "place" => $row["place"],
                    "date" => $row["date"],
                    "bookingStart" => $row["booking_start"],
                    "bookingEnd" => $row["booking_end"],
                    "tradesmanEmail" => $row["tradesman_email"],
                    "tradesmanName" => $row["tradesman_name"],
                    "tradesmanPhone" => $row["tradesman_phone"]
                );

                $bookingsData[] = $bookingData;
            }
        }

        return $bookingsData;
    }

    public function displayBookings($email) {
        require ('dbh.inc.php');
        $e = "SELECT * FROM booking WHERE tradesman_email = '$email';";
        $result = $dbc->query($e);

        $bookingsData = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $bookingData = array(
                    "ID" => $row["ID"],
                    "customerName" => $row["customer_name"],
                    "customerEmail" => $row["customer_email"],
                    "customerPhone" => $row["customer_phone"],
                    "place" => $row["place"],
                    "date" => $row["date"],
                    "bookingStart" => $row["booking_start"],
                    "bookingEnd" => $row["booking_end"]
                );

                $bookingsData[] = $bookingData;
            }
        }

        return $bookingsData;
    }

    // Method to get all unique locations
    public function getAllLocations() {
        $conn = $this->connect();
        $sql = "SELECT DISTINCT location FROM users WHERE location IS NOT NULL";
        $result = $conn->query($sql);

        $locations = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $locations[] = $row['location'];
            }
        }
        $conn->close();
        return $locations;
    }

    // Method to get all unique tradesmen skills
    public function getAllTradesmen() {
        $conn = $this->connect();
        $sql = "SELECT DISTINCT skills FROM users WHERE skills IS NOT NULL";
        $result = $conn->query($sql);

        $tradesmen = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tradesmen[] = $row['skills'];
            }
        }
        $conn->close();
        return $tradesmen;
    }
     // Method to get  tradesmen with respective to location and type
     public function filterTradesmen($location, $type) {
        $conn = $this->connect(); // Assuming you have a connect method
        $location = $conn->real_escape_string($location);
        $type = $conn->real_escape_string($type);
    
        // Query to fetch data from the main 'users' table
        $userQuery = "SELECT ID, EMAIL, name, location, hourly_pay, unavailable, skills, start_time, end_time, rating, pg_status, phone 
                      FROM users 
                      WHERE location='$location' AND skills='$type' 
                      ORDER BY CASE WHEN pg_status='YES' THEN 0 ELSE 1 END, pg_status;";
    
        $userResult = $conn->query($userQuery);
    
        // Query to fetch data from the 'tradesmanratings' table
        $ratingsQuery = "SELECT Tradesman_email, Customer_name, Rating, Feedback 
                         FROM tradesmanratings 
                         WHERE Tradesman_email IN (SELECT EMAIL FROM users WHERE location='$location' AND skills='$type');";
    
        $ratingsResult = $conn->query($ratingsQuery);
    
        // Query to fetch data from the 'booking' table
        $bookingQuery = "SELECT ID, customer_name, customer_email, customer_phone, place, date, booking_start, booking_end, tradesman_name, tradesman_email, tradesman_phone 
                         FROM booking 
                         WHERE tradesman_email IN (SELECT EMAIL FROM users WHERE location='$location' AND skills='$type');";
    
        $bookingResult = $conn->query($bookingQuery);
    
        $conn->close();
    
        // Combine and return the results
        $combinedResults = [
            'users' => $userResult->fetch_all(MYSQLI_ASSOC),
            'tradesmanratings' => $ratingsResult->fetch_all(MYSQLI_ASSOC),
            'booking' => $bookingResult->fetch_all(MYSQLI_ASSOC),
        ];
    
        return $combinedResults;
    }
    

  // Method to book tradesman
// Method to book tradesman
public function bookTradesman() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $customer_name = $_POST["c_name"];
        $customer_email = $_POST["c_email"];
        $customer_phone = $_POST["number"];
        $tradesman_email = $_POST['tradesmanEmail'];
        $tradesman_name = $_POST['tradesmanName'];
        $tradesman_phone = $_POST['tradesmanPhone'];
        $booking_date = $_POST['meeting_date'];
        $booking_time = $_POST['booking_start'];
        $booking_end = $_POST['booking_end'];
        $booking_location = $_POST['tradesmanLocation'];

        require('dbh.inc.php');

        // Check for overlapping time slots in tradesmanratings table
        $overlapQuery = "SELECT * FROM booking 
                         WHERE tradesman_email = '$tradesman_email' AND date = '$booking_date' 
                         AND ((booking_start <= '$booking_time' AND booking_end >= '$booking_time') 
                             OR (booking_start <= '$booking_end' AND booking_end >= '$booking_end'))";

        $overlapResult = $dbc->query($overlapQuery);

        if ($overlapResult && $overlapResult->num_rows > 0) {
            // Overlapping time slots found, show an error message
            echo "<script>
                    alert('Booking slot not available. Time slot overlaps with existing bookings.');
                    window.location.href = '../Frontend/homePage.php';
                  </script>";
            exit();
        }

        // If no overlap, proceed with the booking
        $bookingQuery = "INSERT INTO booking 
                         (customer_name, customer_email, customer_phone, place, date, booking_start, booking_end, tradesman_name, tradesman_email, tradesman_phone)
                         VALUES ('$customer_name', '$customer_email', '$customer_phone', '$booking_location', '$booking_date', '$booking_time', '$booking_end', '$tradesman_name', '$tradesman_email', '$tradesman_phone')";

        $bookingResult = $dbc->query($bookingQuery);

        $change = "UPDATE users 
                   SET unavailable = '$booking_date',
                       start_time = '$booking_time',
                       end_time = '$booking_end' 
                   WHERE EMAIL = '$tradesman_email'";

        $changeResult = $dbc->query($change);

        if ($bookingResult && $changeResult) {
            echo "<script>
                    alert('Booking is successfully completed');
                    window.location.href = '../Frontend/homePage.php';
                  </script>";
            exit();
        }

        $dbc->close();
        exit();
    }
}

// booking tradesman view


    // Other methods and properties of the Booking class...
}
?>
