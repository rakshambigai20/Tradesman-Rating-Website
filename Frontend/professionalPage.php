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
include "../Backend/viewProfessional.php";?>

<h2>Professional Details</h2>
<div class="settings">
    <!-- Professional Details Form -->
    <form id="professionaldetailsForm" method="post" enctype="multipart/form-data" action="update_professional.php">
        <div class="form-group">
            <span class="form_label">Email</span>
            <input type="text" id="emailInput" name="email" value="<?php echo $userData['EMAIL'] ?? ''; ?>" readonly>
        </div>

        <div class="form-group">
            <span class="form_label">Hourly Pay</span>
            <input type="text" id="payInput" name="pay" value="<?php echo $userData['hourly_pay'] ?? ''; ?>" readonly>
        </div>
        <div class="form-group">
            <span class="form_label">Work Experience</span>
            <input type="text" id="expInput" name="exp" value="<?php echo $userData['work_exp'] ?? ''; ?>" readonly>
        </div>
        <div class="form-group">
            <span class="form_label">Skills</span>
            <input type="text" id="skillsInput" name="skills" value="<?php echo $userData['skills'] ?? ''; ?>" readonly>
        </div>
        <div class="form-group">
            <span class="form_label">Do you have Professional Recognition?</span>
            <input type="text" id="pgStatusInput" name="pg_status" value="<?php echo $userData['pg_status'] ?? ''; ?>" readonly>
        </div>
        <div class="form-group">
            <span class="form_label">Current References File</span>
            <input type="text" id="referencesInput" name="references" value="<?php echo $userData['pg_name'] ?? 'None'; ?>" readonly>
        </div>
        <!-- You can add more read-only fields as needed -->

        <a href="updateProfessionalPage.php" class="btn btn-primary" style="margin-left:450px; width: 150px;">Edit</a>
    </form>
</div>
</body>
</html>
