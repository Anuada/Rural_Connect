<?php

if (isset($_SESSION['accountId'])) {
    switch ($_SESSION["user_type"]) {


        case 'city_health':
            header("Location: ../barangay_inc/");
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
} else {
    header("Location: ../page/login.php");
    exit();
}
