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
        <form id="detailsForm" method="post" enctype="multipart/form-data" action="">
            <div class="form-group">
                <span class="form_label">Name</span>
                <input type="text" id="fileInput" name="name" value="<?php echo htmlspecialchars($userData['name'] ?? ''); ?>" readonly>
            </div>
            <div class="form-group">
                <span class="form_label">Email</span>
                <input type="text" id="fileInput" name="email" value="<?php echo htmlspecialchars($userData['EMAIL'] ?? ''); ?>" readonly>
            </div>
            <div class="form-group">
                <span class="form_label">Postal Code</span>
                <input type="text" id="fileInput" name="postalCode" value="<?php echo htmlspecialchars($userData['postal_code'] ?? ''); ?>" readonly>
            </div>
            <div class="form-group">
                <span class="form_label">Phone Number</span>
                <input type="text" id="fileInput" name="number" value="<?php echo htmlspecialchars($userData['phone'] ?? ''); ?>" readonly>
            </div>
            <div class="form-group">
                <span class="form_label">Location</span>
                <input type="text" id="fileInput" name="location" value="<?php echo htmlspecialchars($userData['location'] ?? ''); ?>" readonly>
            </div>
        
            <a href="updatePersonalDetailsPage.php" class="btn btn-primary" style="margin-left:450px; width: 150px;">Edit</a>

            
        </form>
    </div>


</body>
</html>