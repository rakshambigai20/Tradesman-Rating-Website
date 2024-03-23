<!DOCTYPE html>
<html>
<head>
    <title>Personal Details</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tradesman.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">

</head>
<body>
<?php include "../includes/tradesman_nav.html";
include "../Backend/viewPersonal.php" ?>
<div class="settings">
        <form id="detailsForm" method="post" enctype="multipart/form-data" action="../Backend/updatePersonal.php">
            <div class="form-group">
                <span class="form_label">Name</span>
                <input type="text" id="fileInput" name="name" value="<?php echo $userData['name'] ?? ''; ?>" >
            </div>
            <div class="form-group">
                <span class="form_label">Email</span>
                <input type="text" id="fileInput" name="email" value="<?php echo $userData['EMAIL'] ?? ''; ?>" >
            </div>
            <div class="form-group">
                <span class="form_label">Postal Code</span>
                <input type="text" id="fileInput" name="postalCode" value="<?php echo $userData['postal_code'] ?? ''; ?>" >
            </div>
            <div class="form-group">
                <span class="form_label">Phone Number</span>
                <input type="text" id="fileInput" name="number" value="<?php echo $userData['phone'] ?? ''; ?>" >
            </div>
            <div class="form-group">
                <span class="form_label">Location</span>
                <input type="text" id="fileInput" name="location" value="<?php echo $userData['location'] ?? ''; ?>" >
            </div>
            <!-- ... other fields ... -->

            <button type="submit" id="updateButton" name="updateButton" class="btn btn-primary" style="margin-left:450px;width: 150px;">Update</button>
        </form>
    </div>
</body>
</html>