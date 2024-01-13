<?php error_reporting(E_ALL);
ini_set('display_errors', 1);
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was selected
    if (isset($_FILES["excelFile"]) && $_FILES["excelFile"]["error"] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["excelFile"]["name"]);

        // Check if the file already exists
        if (file_exists($targetFile)) {
            echo "File already exists. Please choose a different file.";
        } else {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["excelFile"]["tmp_name"], $targetFile)) {
                echo "File uploaded successfully.";
            } else {
                echo "Error uploading file.";
            }
        }
    } else {
        echo "Please select a file to upload.";
    }
}
?>
