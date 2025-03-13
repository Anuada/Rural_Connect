<?php
session_start();
include "../util/dbhelper.php";

$db = new DbHelper;

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id = $_GET["id"];
    $deleteMed = $db->deleteRecord("med_availabilty", ["id" => $id]);
    if ($deleteMed) {
        $_SESSION["m"] = "Deleted successfully";
        header("Location: ../city_health/view_med.php");
        exit();
    } else {
        $_SESSION["m"] = "Error uploading!";
        header("Location: ../city_health/view_med.php");
        exit();
    }
}