<?php

require_once "../util/DbHelper.php";
require_once "../enums/ItemCategory.php";

session_start();
$db = new DbHelper;

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../");
    exit();
}

$id = $_POST["id"];

$error_count = 0;

foreach ($_POST as $key => $value) {
    if (empty(trim($value))) {
        $error_count++;
    }
}

if ($error_count > 0) {
    $_SESSION["m"] = "Fill out the missing fields!";
    header("Location: ../city_health/edit-medicine.php?id=$id");
    exit();
}

$check_item = $db->getRecord("med_availability", ["id" => $id]);

if (empty($check_item)) {
    $_SESSION["m"] = "Item not found!";
    header("Location: ../city_health/edit-medicine.php?id=$id");
    exit();
}

if ($_POST['category'] != $check_item['category'] && $_POST['category'] == ItemCategory::Medical_Supply->value) {
    $_POST['dosage_strength'] = null;
    $_POST['expiration_date'] = null;
}

$updateMed = $db->updateRecord("med_availability", $_POST);

if ($updateMed) {
    $_SESSION["m"] = "Medicine Updated Successfully";
    header("Location: ../city_health/medicine-inventory.php");
    exit();
} else {
    $_SESSION["m"] = "No Data Was Updated!";
    header("Location: ../city_health/edit-medicine.php?id=$id");
    exit();
}