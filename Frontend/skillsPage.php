<!DOCTYPE html>
<html>
<head>
    <title>Rater.co.uk</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<?php
include "../includes/adminNav.html";
?>
<form action="../Backend/addSkills.php" method='post'>
        <input type='text' class="skills-text"  name='type' placeholder="Enter type" required>
        <button type='submit' class='btn btn-primary skill-button' name='addSkill'>Add Skill</button>
</form>
        <?php
        require('../Backend/class/dbh.inc.php');
        $e = "SELECT * FROM skill;";
        $result = $dbc->query($e);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4 mb-3'>";
                echo "<div class='booking-card' style='width: 100%;'>";
                echo "<div class='card-body'>";

                echo "<h5 class='card-title'>Tradesman details</h5>";
                echo "<div class='card-info'><span class='card-label'>ID:</span> " . $row["ID"] . "</div>";
                echo "<div class='card-info'><span class='card-label'>Type:</span> " . $row["Type"] . "</div>";
                echo "<form action='../Backend/deleteSkills.php' method='post'>";
                echo "<input type='hidden' name='ID' value='" . $row["ID"] . "'>";
                echo "<button type='submit' class='btn-card btn btn-primary' name='DeleteSkill'>Delete Skill</button>";
                echo "</form>";

                echo "</div>"; // card-body
                echo "</div>"; // card
                echo "</div>"; // col-md-4 mb-3
            }
        } 
        else {
            echo "No skills available";
        }
        $dbc->close();
        ?>