<?php
session_start();

require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$db = new DbHelper();
$ms = new Misc;

if (!isset($_POST["login"])) {
    header("Location: ../mobile/login.php");
    exit();
}

$fields = ['username', 'password'];
$errorMessages = [];

foreach ($fields as $field) {
    if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
        $errorMessages[] = $field;
    }
}

if (!empty($errorMessages)) {
    $field = implode(" and ", $errorMessages);
    $link = count($errorMessages) > 1 ? "are" : "is";
    $_SESSION['m'] = ucwords("$field $link required!");
    $_SESSION['username'] = $_POST['username'];
    header("Location: ../mobile/login.php");
    exit();
}

$account = $db->getRecord("account", ["username" => $_POST['username'], "user_type" => "deliveries"]);

if (empty($account)) {
    $_SESSION['m'] = "Invalid Username!";
    $_SESSION['username'] = $_POST['username'];
    header("Location: ../mobile/login.php");
    exit();
}

if (!password_verify($_POST['password'], $account['password'])) {
    $_SESSION['m'] = "Incorrect Password!";
    $_SESSION['username'] = $_POST['username'];
    header("Location: ../mobile/login.php");
    exit();
}

$_SESSION["accountId"] = $account["accountId"];
$_SESSION["email"] = $account["email"];
$_SESSION["username"] = $account["username"];
$_SESSION["user_type"] = $account["user_type"];

$deliveries = $db->fetchRecords("deliveries", ["accountId" => $account["accountId"]]);
$_SESSION["m"] = "Welcome " . $deliveries[0]["fname"] . " " . $deliveries[0]["lname"];
header("Location: " . $ms->url('deliveries'));
exit();