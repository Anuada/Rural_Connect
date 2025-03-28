<?php

include "../util/dbhelper.php";
session_start();
$db = new DbHelper;

if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $med_name = $_POST["med_name"];
    $med_description = $_POST["med_description"];
    $quantity = $_POST["quantity"];
    $DosageForm = $_POST["DosageForm"];
    $DosageStrength = $_POST["DosageStrength"];
    $category = $_POST["category"];
    $expiry_date = $_POST["expiry_date"];

    if (!empty(trim($med_name)) && !empty(trim($med_description)) && !empty(trim($quantity)) && !empty(trim($expiry_date)) && !empty(trim($DosageForm)) && !empty(trim($DosageStrength)) && !empty(trim($category))) {
        $updateMed = $db->updateRecord("med_availabilty", ["id" => $id, "med_name" => $med_name, "med_description" => $med_description, "quantity" => $quantity, "expiry_date" => $expiry_date, "DosageForm" => $DosageForm, "DosageStrength" => $DosageStrength, "category" => $category]);
       
        if ($updateMed) {
            $_SESSION["m"] = "Updated Medicine successfully";
            header("Location: ../city_health/uploadAvailableMed.php");
            exit();
        } else {
            $_SESSION["m"] = "Error uploading!";
            header("Location: ../city_health/uploadMedEdit.php");
            exit();
        }
    }
} else {
    header("Location: ../");
    exit();
}
