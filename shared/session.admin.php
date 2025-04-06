<?php

if (isset($_SESSION['accountId'])) {
    switch ($_SESSION["user_type"]) {

        case 'barangay_inc':
            header("Location: ../barangay_inc/");
            break;

        case 'deliveries':
            header("Location: ../deliveries/");
            break;
            
        case 'city_health':
            header("Location: ../city_health/");
            break;

        default:
            break;
    }
    require_once "../shared/is.user.verified.php";
} else {
    header("Location: ../page/login.php");
    exit();
}
