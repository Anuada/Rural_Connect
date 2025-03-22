<?php
session_start();

require_once "../util/DbHelper.php";
require_once "../util/Misc.php";
require_once "../util/DirHandler.php";

$db = new DbHelper();
$ms = new Misc;
$dh = new DirHandler;

if (!isset($_POST["submit"])) {
    header("Location: ../");
    exit();
}

$infos = ["accountId", "fname", "lname", "address", "contactNo"];
$fieldInputs = [];
$errorMessages = [];
$isProfileChanges = false;

foreach ($infos as $i) {
    if (!isset($_POST[$i]) || empty(trim($_POST[$i]))) {
        $errorMessages[$i] = "$i is required";
    } else {
        $fieldInputs[$i] = $_POST[$i];
    }
}

if (!empty($errorMessages)) {
    $_SESSION["errorMessages"] = $errorMessages;
    header("Location: ../deliveries/updateProfile.php");
    exit();
}

if (isset($_FILES["id_verification"]) && $_FILES['id_verification']['size'] > 0) {

    if (file_exists($dh->deleviries . $fieldInputs["accountId"])) {
        unlink($dh->deleviries . $fieldInputs["accountId"]);
    }
    $fieldInputs["id_verification"] = $ms->uploadImage($_FILES["id_verification"], $fieldInputs["accountId"], $dh->deleviries);
    $isProfileChanges = true;
}

$updateProfile = $db->updateRecord("deliveries", $fieldInputs);

if ($updateProfile > 0 || $isProfileChanges) {
    $_SESSION["m"] = "Profile updated successfully";
    header("Location: ../deliveries/updateProfile.php");
    exit();
} else {
    $_SESSION["m"] = "No Data Was Updated!";
    header("Location: ../deliveries/updateProfile.php");
    exit();
}