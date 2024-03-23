<!DOCTYPE html>
<html>
<head>
    <title>Rater.co.uk</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<?php
session_start();
include "../includes/adminNav.html";
require "../Backend/class/dbh.inc.php";
if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
        $email = $_SESSION['email'];


        require('../Backend/class/dbh.inc.php');
        $e = "SELECT * FROM users ;";
        $result = $dbc->query($e);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='col-md-4 mb-3'>";
        echo "<div class='booking-card' style='width: 100%;'>";
        echo "<div class='card-body'>";

        echo "<h5 class='card-title'>Tradesman details</h5>";
        echo "<div class='card-info'><span class='card-label'>Tradesman name:</span> " . $row["name"] . "</div>";
        echo "<div class='card-info'><span class='card-label'>Tradesman email:</span> " . $row["EMAIL"] . "</div>";
        echo "<div class='card-info'><span class='card-label'>Location:</span> " . $row["location"] . "</div>";
        echo "<div class='card-info'><span class='card-label'>Skills:</span> " . $row["skills"] . "</div>";
        echo "<form action='../Backend/deleteProfile.php' method='post'>";
        echo "<input type='hidden' name='email' value='" . $row["EMAIL"] . "'>";
        echo "<button type='submit' class='btn-card btn btn-primary' name='DeleteProfile'>Delete Profile</button>";
        echo "</form>";

        echo "</div>"; // card-body
        echo "</div>"; // card
        echo "</div>"; // col-md-4 mb-3
    }
} else {
    echo "No users available";
}}
$dbc->close();
?>
