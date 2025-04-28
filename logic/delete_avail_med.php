<?php
session_start();
include "../util/DbHelper.php";

$db = new DbHelper;

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id = $_GET["id"];
    $med_avail = $db->getRecord("med_availability", ["id" => $id]);
    unlink($med_avail['med_image']);
    $deleteMed = $db->deleteRecord("med_availability", ["id" => $id]);
    if ($deleteMed) {
        $_SESSION["m"] = "Deleted successfully";
        header("Location: ../city_health/medicine-inventory.php");
        exit();
    } else {
        $_SESSION["m"] = "Error uploading!";
        header("Location: ../city_health/medicine-inventory.php");
        exit();
    }
}