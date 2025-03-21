<?php

session_start();

require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$dh = new DirHandler();
$ms = new Misc;

if (isset($_POST['submit'])) {
    uploadMedAvailable($db, $dh, $ms);
}

function uploadMedAvailable(DbHelper $db, DirHandler $dh, Misc $ms)
{
    $city_health_id = $_POST['city_health_id'];
    $med_name = $_POST['med_name'];
    $med_description = $_POST['med_description'];
    $category = $_POST['category'];
    $DosageForm = $_POST['DosageForm'];
    $DosageStrength = $_POST['DosageStrength'];
    $quantity = $_POST['quantity'];
    $expiry_date = $_POST['expiry_date'];
    $med_image = $_FILES['med_image'];

    $img_name = str_replace("-", "", $city_health_id) . "_" . strtolower(str_replace(' ', '', $med_name)) . "_" . date('mdYHis');
    $img_file = $ms->uploadImage($med_image, $img_name, $dh->med_image);

    $table = "med_availabilty";
    $data = array(
        "city_health_id" => $city_health_id,
        "med_name" => $med_name,
        "med_description" => $med_description,
        "quantity" => $quantity,
        "category" => $category,
        "DosageForm" => $DosageForm,
        "DosageStrength" => $DosageStrength,
        "expiry_date" => $expiry_date,
        "med_image" => $img_file,
    );

    $success = $db->addRecord($table, $data);

    if ($success) {
        $_SESSION["m"] = "Submitted Medicine successfully";
        header("Location: ../city_health/uploadAvailableMed.php");
        exit();
    } else {
        $_SESSION["m"] = "Error uploading!";
        header("Location: ../city_health/uploadAvailableMed.php");
        exit();
    }
}
?>