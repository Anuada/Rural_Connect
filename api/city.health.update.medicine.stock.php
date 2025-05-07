<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    echo $ms->json_response(null, 'Method Not Allowed', 405);
    exit();
}

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$error_fields = [];

foreach ($data as $key => $value) {
    if (empty(trim($value))) {
        switch ($key) {
            case 'stock':
                $error_fields[] = "added stock";
                break;

            case 'quantity':
                $error_fields[] = "total stock";
                break;

            default:
                $error_fields[] = $key;
                break;
        }
    }
}

if (!empty($error_fields)) {
    $message = $ms->formatListWithOxfordComma($error_fields) . (count($error_fields) > 1 ? " are" : " is") . " required";
    echo $ms->json_response(null, $message, 422);
    exit();
}

if (intval($data['stock']) <= 0) {
    echo $ms->json_response(null, "Please enter a stock quantity greater than zero!", 422);
    exit();
}

$new_stocks = $data['stock'];

unset($data['stock']);

$check = $db->getRecord("med_availability", ["id" => $data["id"]]);

if (empty($check)) {
    echo $ms->json_response(null, "Medicine not found!", 404);
    exit();
}
$medicine = $check['generic_name'];

$update_stock = $db->updateRecord("med_availability", $data);

if ($update_stock > 0) {
    $_SESSION['m'] = "$medicine stock increased by $new_stocks. Great job keeping inventory updated";
    echo $ms->json_response(null, "");
    exit();
}
echo $ms->json_response(null, "Error adding new stocks", 422);
exit();