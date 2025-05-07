<?php

session_start();

require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$dh = new DirHandler();
$ms = new Misc;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    uploadMedAvailable($db, $dh, $ms);
}

function uploadMedAvailable(DbHelper $db, DirHandler $dh, Misc $ms)
{
    $city_health_id = $_POST['city_health_id'];
    $generic_name = $_POST['generic_name'];

    $errorCount = 0;
    foreach ($_POST as $key => $value) {
        if (empty(trim($value))) {
            $errorCount++;
        }
    }

    if ($errorCount > 0) {
        $_SESSION["m"] = "Fill out the missing fields!";
        $_SESSION["field_inputs"] = $_POST;
        header("Location: ../city_health/add-new-medicine.php");
        exit();
    }

    if (!isset($_FILES['item_image']) || $_FILES['item_image']['size'] <= 0) {
        $_SESSION["m"] = "Image is required!";
        $_SESSION["field_inputs"] = $_POST;
        header("Location: ../city_health/add-new-medicine.php");
        exit();
    }

    $generic_name_with_underscores = preg_replace('/[^a-zA-Z0-9_]/', '_', $generic_name); // Replace all non-alphanumeric characters with "_"

    $img_name = str_replace("-", "", $city_health_id) . "_" . strtolower(str_replace(' ', '', $generic_name_with_underscores)) . "_" . date('mdYHis');
    $_POST['item_image'] = $ms->uploadImage($_FILES['item_image'], $img_name, $dh->item_image);

    $success = $db->addRecord("med_availability", $_POST);

    if ($success) {
        $_SESSION["m"] = "Submitted Medicine successfully";
        header("Location: ../city_health/add-new-medicine.php");
        exit();
    } else {
        $_SESSION["m"] = "Error uploading!";
        header("Location: ../city_health/add-new-medicine.php");
        exit();
    }
}