<?php
session_start();
include "../util/dbhelper.php";
$db = new DbHelper;

if (isset($_POST["submit"])) {
    $accountId = $_POST["accountId"];
    $fname = trim($_POST["fname"]);
    $lname = trim($_POST["lname"]);
    $address = trim($_POST["address"]);
    $contactNo = trim($_POST["contactNo"]);

    // Handle profile picture upload
    if (!empty($_FILES["id_verification"]["name"])) {
        $target_dir = "../assets/img/profile/barangay_incharge/";
        $file_name = $accountId . ".png";
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["id_verification"]["tmp_name"], $target_file)) {
            // Update record with new image
            $updateProfile = $db->updateRecord("barangay_inc", [
                "accountId" => $accountId,
                "fname" => $fname,
                "lname" => $lname,
                "address" => $address,
                "contactNo" => $contactNo,
                "id_verification" => $target_file
            ], "accountId = '$accountId'");
        } else {
            $_SESSION["m"] = "Error uploading profile picture!";
            header("Location: ../barangay_inc/updateProfile.php");
            exit();
        }
    } else {
        // Update without changing profile picture
        $updateProfile = $db->updateRecord("barangay_inc", [
            "accountId" => $accountId,
            "fname" => $fname,
            "lname" => $lname,
            "address" => $address,
            "contactNo" => $contactNo
        ], "accountId = '$accountId'");
    }

    if ($updateProfile) {
        $_SESSION["m"] = "Profile updated successfully!";
        header("Location: ../barangay_inc/updateProfile.php");
        exit();
    } else {
        $_SESSION["m"] = "Error updating profile!";
        header("Location: ../barangay_inc/updateProfile.php");
        exit();
    }
} else {
    header("Location: ../");
    exit();
}
