<?php
session_start();
require_once "../shared/session.admin.php";
require_once "../admin/is.admin.authenticated.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    http_response_code(405);
    echo json_encode(['message' => 'Method Not Allowed']);
    exit();
}

$json = file_get_contents('php://input');
$data = json_decode($json, true);


$infos = ["DOB", "fname", "lname", "address", "contactNo"];
$fieldInputs = [];
$errorMessages = [];

$fieldInputs["accountId"] = $_SESSION["accountId"];

foreach ($infos as $i) {
    if (!isset($data[$i]) || empty(trim($data[$i]))) {
        $errorMessages[$i] = "$i is required";
    } else {
        $fieldInputs[$i] = $data[$i];
    }
}

if (!empty($errorMessages)) {
    echo $ms->json_response($errorMessages, "Fill out the missing fields", 422);
    exit();
}

$updateProfile = $db->updateRecord("admin", $fieldInputs);

if ($updateProfile > 0) {
    echo $ms->json_response(null, "User Updated Successfully");
    exit();
}