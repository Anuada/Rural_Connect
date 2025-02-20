<?php

session_start();

require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";
$db = new DbHelper();
$dh = new DirHandler();

if (isset($_POST['submit'])) {
    uploadMedAvailable($db,$dh);
} 

function uploadMedAvailable($db,$dh) {
    $city_health_id = $_POST['city_health_id'];
    $med_name = $_POST['med_name'];
    $med_description = $_POST['med_description'];
    $quantity = $_POST['quantity'];
    $expiry_date = $_POST['expiry_date'];
    $med_image = $_FILES['med_image'];

    $img_name = $city_health_id . ".png";
    $img_file = $dh->med_image . $img_name;
    move_uploaded_file($_FILES["med_image"]["tmp_name"], $img_file);
	
    $table = "med_availabilty"; 
    $data = array(
        "city_health_id" => $city_health_id,
        "med_name" => $med_name,
        "med_description" => $med_description,
        "quantity" => $quantity,
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