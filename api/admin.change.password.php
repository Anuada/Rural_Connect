<?php
session_start();
require_once "../shared/session.admin.php";
require_once "../admin/is.admin.authenticated.php";
require_once "../util/dbhelper.php";
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

$user = $db->fetchRecords("account", ["accountId" => $_SESSION["accountId"]])[0];

$infos = ["current_password", "new_password", "repeat_password"];
$errorMessages = [];

foreach ($infos as $i) {
    if (!isset($data[$i]) || empty(trim($data[$i]))) {
        $var = str_replace("_", " ", $i);
        $errorMessages[$i] = "$var is required";
    }
}

if (!empty($errorMessages)) {
    echo $ms->json_response($errorMessages, "Error Found", 422);
    exit();
}

if (!password_verify($data["current_password"], $user["password"])) {
    $errorMessages["current_password"] = "Incorrect Password";
}

if (!empty($errorMessages)) {
    echo $ms->json_response($errorMessages, "Error Found", 422);
    exit();
}

if ($data["new_password"] !== $data["repeat_password"]) {
    $errorMessages["new_password"] = "New password and confirmation do not match.";
}

if (!empty($errorMessages)) {
    echo $ms->json_response($errorMessages, "Error Found", 422);
    exit();
}

$newPassword = password_hash($data["new_password"], PASSWORD_DEFAULT);
$changePassword = $db->updateRecord("account", ["accountId" => $user["accountId"], "password" => $newPassword]);

if ($changePassword <= 0) {
    echo $ms->json_response(null,"Password Not Changed",422);
    exit();
}

echo $ms->json_response(null,"Password changed successfully");