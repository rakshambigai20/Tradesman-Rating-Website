<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "raterUk";
$dbc = new mysqli($servername, $username, $password, $dbname);

if (!$dbc) {
    die("Connection failed: " . mysqli_connect_error());
}


?>

