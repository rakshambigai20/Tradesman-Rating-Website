<?php
class Rating {
    private $customerName;
    private $tradesmanName;
    private $code;
    private $comments;
    private $rating;
    private $date;
    private $time;

    public static function viewRatings($email) {
        require('../Backend/class/dbh.inc.php');
        $e = "SELECT * FROM tradesmanratings WHERE tradesman_email = '$email';";
        $result = $dbc->query($e);

        $ratingsData = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $ratingData = array(
                    "bookingId" => $row["Booking_ID"],
                    "customerName" => $row["Customer_name"],
                    "customerEmail" => $row["Customer_email"],
                    "customerRating" => $row["Rating"],
                    "feedback" => $row["Feedback"],
                    "date" => $row["Rating_date"]
                );

                $ratingsData[] = $ratingData;
            }
        }

        return $ratingsData;
    }
    public static function provideRatings($bookingID, $customer_name, $customer_email, $tradesmanName, $tradesman_email, $tradesmanCode, $rating, $feedback){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve POST data
        $bookingID = $_POST["bookingID"];
        $customer_name = $_POST["customer_name"];
        $customer_email = $_POST["customer_email"];
        $tradesmanName = $_POST["tradesmanName"];
        $tradesman_email = $_POST["tradesman_email"];
        $tradesmanCode = $_POST["tradesmanCode"];
        $rating = $_POST["rating"];
        $feedback = $_POST["feedback"];
    
        require ('class/dbh.inc.php');
    
        // Check if rating already exists
        $e = "SELECT * FROM tradesmanratings WHERE Booking_ID='$bookingID';";
        $result = $dbc->query($e);
        if ($result->num_rows > 0) {
            echo "<script>alert('Rating has already been provided by the customer');
            window.location.href = '../Frontend/homePage.php';</script>";
        } else {
            // Check if tradesman code matches
            $codeQuery = "SELECT rating_code FROM users WHERE EMAIL='$tradesman_email';";
            $codeResult = $dbc->query($codeQuery);
            if ($codeResult->num_rows > 0) {
                $codeRow = $codeResult->fetch_assoc();
                if ($tradesmanCode == $codeRow['rating_code']) {
                    // Insert the rating
                    $q = "INSERT INTO tradesmanratings (Tradesman_name,Tradesman_code,Tradesman_email,Customer_name,Customer_email,Booking_ID,Rating,Feedback) VALUES ('$tradesmanName','$tradesmanCode','$tradesman_email','$customer_name','$customer_email','$bookingID','$rating','$feedback');";
                    $r = $dbc->query($q);
    
                    if ($r) {
                        echo "<script>
                                alert('Provided rating successfully');
                                window.location.href = '../Frontend/homePage.php';
                                </script>";
                    } else {
                        echo "<script>alert('Error in providing rating');</script>";
                    }
                } else {
                    echo "<script>
                    alert('Code Incorrect');
                    window.location.href = '../Frontend/homePage.php';
                  </script>";
                }
            } else {
                echo "<script>alert('No tradesman found with the provided email');</script>";
            }
        }
        $dbc->close();
        exit();
    }
}
}
?>
