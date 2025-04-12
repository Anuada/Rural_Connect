<?php
session_start();

require_once "../enums/UserType.php";

$user_types = UserType::all();

$accountId = $_SESSION['accountId'];
$user_type = $_SESSION["user_type"];

if (!isset($_SESSION['accountId'])) {
    header("Location: ../page/login.php");
    exit();
}

if (!in_array($user_type, $user_types)) {
    header("Location: ../page/");
    exit();
}

require_once "../util/DbHelper.php";

$db = new DbHelper();

if (!isset($_POST["submit"])) {
    header("Location: ../page/");
    exit();
}

$ratings = [1, 2, 3, 4, 5];

$fieldInputs = [];

$fieldInputs["accountId"] = $accountId;

// echo in_array($_POST["rating"], $ratings) ? "truth" : "no";

if (!isset($_POST["rating"])) {
    $_SESSION["ratingError"] = "rating is required";
    header("Location: ../page/rate-and-feedback.php");
    exit();
}

if (!in_array($_POST["rating"], $ratings)) {
    $_SESSION["ratingError"] = "rate from 1 to 5 only";
    header("Location: ../page/rate-and-feedback.php");
    exit();
}

$fieldInputs["rating"] = $_POST["rating"];

if (isset($_POST["feedback"]) && !empty(trim($_POST["feedback"]))) {
    $fieldInputs["feedback"] = htmlspecialchars($_POST["feedback"]);
}

$check = $db->getRecord("rate_and_feedback", ["accountId" => $accountId]);

$feedback_message = (isset($_POST['feedback']) && !empty(trim($_POST['feedback']))) ? " and for your feedback" : "";
$message = "Thank you for rating$feedback_message";

if (empty($check)) {
    $db->addRecord("rate_and_feedback", $fieldInputs);

    $_SESSION["m"] = $message;
    header("Location: ../$user_type/");
    exit();
} else {
    $db->updateRecord("rate_and_feedback", $fieldInputs);

    $_SESSION["m"] = $message;
    header("Location: ../$user_type/");
    exit();
}