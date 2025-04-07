<?php

if (isset($_SESSION['accountId'])) {
    switch ($_SESSION["user_type"]) {

        case 'city_health':
            header("Location: ../city_health/");
            break;

        case 'deliveries':
            header("Location: ../deliveries/");
            break;

        case 'admin':
            header("Location: ../admin/");
            break;

        default:
            break;
    }
    require_once "../shared/is.user.verified.php";
    require_once "../shared/is.subscribed.php";
} else {
    header("Location: ../page/login.php");
    exit();
}
