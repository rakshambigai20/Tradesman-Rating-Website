<!DOCTYPE html>
<html>
<head>
    <title>Professional Details</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tradesman.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    
</head>
<body>
<?php include "../includes/tradesman_nav.html";
include "../Backend/viewProfessional.php"; ?>

<h2>Professional Details</h2>
<div class="settings">
    <!-- Professional Details Form -->
    <form id="professionaldetailsForm" method="post" enctype="multipart/form-data" action="../Backend/updateProfessional.php">
        <div class="form-group">
            <span class="form_label">Email</span>
            <input type="text" id="emailInput" name="email" value="<?php echo $userData['EMAIL'] ?? ''; ?>">
        </div>

        <div class="form-group">
            <span class="form_label">Hourly Pay</span>
            <input type="text" id="payInput" name="pay" value="<?php echo $userData['hourly_pay'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <span class="form_label">Work Experience</span>
            <input type="text" id="expInput" name="exp" value="<?php echo $userData['work_exp'] ?? ''; ?>" >
        </div>
        <div class="form-group">
            <span class="form_label">Skills</span>
            <select id="skillsSelect" name="skills" value="<?php echo $userData['skills'] ?? ''; ?>" >
                <?php
                require ('../Backend/class/dbh.inc.php');
                $q = "SELECT ID, Type from skill;";
                $result = $dbc->query($q);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["Type"] . "'>" . $row["Type"] . "</option>";
                    }
                } else {
                    echo "<option value=''>No items found</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <span class="form_label">Upload References Image</span>
            <input type="file" id="referencesInput" name="references" accept="image/*">
        </div>
        <div class="form-group">
    <span class="form_label">Do you have Professional Recognition?</span>
    <select name="pg_status" id="pgStatusSelect"  readonly>
    <option value="YES" <?php echo (isset($userData['pg_status']) && $userData['pg_status'] == 'YES') ? 'selected' : ''; ?>>Yes</option>
<option value="NO" <?php echo (!isset($userData['pg_status']) || $userData['pg_status'] == 'NO') ? 'selected' : ''; ?>>No</option>
    </select>
</div>
<div class="form-group">
    <span class="form_label">Upload PG (Images or Documents)</span>
    <input type="file" id="pgInput" name="pg" accept="image/*,.pdf,.doc,.docx">
</div>

<button type="submit" id="updateButton" name="updateButton" class="btn btn-primary" style="margin-left:450px;width: 150px;">Update</button>
    </form>
</div>


</body>
</html>
