<?php
// Include the database connection code
require ('dbh.inc.php');

// Assuming $submittedEmail2 contains the tradesman's email
$email = mysqli_real_escape_string($dbc, $submittedEmail2);

// Construct the SQL query to select ratings and feedback
$query = "SELECT Customer_name, Rating, Feedback FROM tradesmanratings WHERE Tradesman_email = '$email'";

// Execute the query
$result = $dbc->query($query);

// Check if there are any rows in the result
if ($result && $result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Customer Name</th><th>Ratings</th><th>Feedback</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['Customer_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Rating']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Feedback']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<br>No Ratings Updated";
}

// Close the database connection
$dbc->close();
?>
