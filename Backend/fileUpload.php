<?php

function handlePGFileUpload($fileInputName, $targetDirectory) {
    // Check if file input exists and a file is uploaded
    if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] == UPLOAD_ERR_NO_FILE) {
        echo "No file uploaded for $fileInputName.";
        return false;
    }

    // Check for upload errors
    if ($_FILES[$fileInputName]['error'] != UPLOAD_ERR_OK) {
        echo "Error in file upload: " . $_FILES[$fileInputName]['error'];
        return false;
    }

    // Create target directory if it doesn't exist
    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    // Sanitize the file name
    $fileName = basename($_FILES[$fileInputName]['name']);
    $sanitizedFileName = preg_replace("/[^a-zA-Z0-9\.\-\_]/", "", $fileName);
    $targetFile = $targetDirectory . $sanitizedFileName;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check file size (e.g., 5MB maximum)
    if ($_FILES[$fileInputName]['size'] > 5000000) {
        echo "Sorry, your file is too large.";
        return false;
    }

    // Allow certain file formats
    $allowedTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'doc', 'docx');
    if (!in_array($fileType, $allowedTypes)) {
        echo "Sorry, only JPG, JPEG, PNG, GIF, PDF, DOC, and DOCX files are allowed.";
        return false;
    }

    // Check if file already exists (optional)
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        return false;
    }

    // Attempt to upload the file
    if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $targetFile)) {
        echo "The file " . htmlspecialchars($sanitizedFileName) . " has been uploaded.";
        return $targetFile; // Returns the path of the uploaded file
    } else {
        echo "Sorry, there was an error uploading your file.";
        return false;
    }
}

?>
