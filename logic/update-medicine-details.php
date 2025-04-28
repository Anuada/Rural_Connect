<?php

require_once "../util/DbHelper.php";
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