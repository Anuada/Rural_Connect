<?php 
session_start();

require_once "../util/dbhelper.php";
require_once "../util/DirHandler.php";

$db = new DbHelper();
$dh = new DirHandler();

$errors = []; // Array to store errors

if (isset($_POST['submit'])) {

    // Retrieve the form inputs
    $students_Id = isset($_POST['students_Id']) ? htmlspecialchars(trim($_POST['students_Id'])) : '';
    $nameFiles = isset($_POST['file_name']) ? htmlspecialchars(trim($_POST['file_name'])) : '';
    $dateUpload = isset($_POST['upload_date']) ? htmlspecialchars(trim($_POST['upload_date'])) : '';
    $uploadFiles = isset($_FILES['uploadFiles']) ? $_FILES['uploadFiles'] : null;

    // Validate the required fields
    if (empty($students_Id)) {
        $errors[] = "Student ID is missing.";
    }
    if (empty($nameFiles)) {
        $errors[] = "File Name is required.";
    }
    if (empty($dateUpload)) {
        $errors[] = "Upload Date is required.";
    }

    if (empty($errors)) {
        // Validate and process the file upload
        if ($uploadFiles && $uploadFiles['error'] === UPLOAD_ERR_OK) {
            $targetFile = $dh->uploadFiles . basename($uploadFiles['name']);

            // Ensure the directory exists
            if (!is_dir($dh->uploadFiles)) {
                mkdir($dh->uploadFiles, 0777, true);
            }

            // Move the uploaded file
            if (move_uploaded_file($uploadFiles['tmp_name'], $targetFile)) {
                echo "File uploaded successfully to: " . $targetFile;

                // Prepare SQL to insert file details into the database
                $sql = "INSERT INTO uploads (students_Id, name, date_uploaded, file_path) VALUES (?, ?, ?, ?)";
                $params = [$students_Id, $nameFiles, $dateUpload, $targetFile];

                // Execute the query
                if ($db->executeQuery($sql, $params)) {
                    echo "File details inserted into the database successfully.";
                } else {
                    echo "Failed to insert file details into the database.";
                }
            } else {
                echo "Failed to upload the file.";
            }
        } else {
            echo "No file uploaded or there was an error.";
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>
