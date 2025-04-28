<?php
session_start();
require_once "../shared/session.delivery.php";
require_once "../util/Misc.php";
$deliveries_title = Misc::displayPageTitle("Customized Requests Queue","fa-clipboard-list");
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/deliveries.requests.css">
<?php $deliveries_styles = ob_get_clean() ?>

<?php ob_start() ?>
<div id="med-request-table-data" class="card-list d-flex flex-column gap-3"></div>
<div id="med-request-pagination" class="pagination mt-3 d-flex justify-content-end"></div>
<?php $deliveries_content = ob_get_clean() ?>

<?php ob_start() ?>
<script type="module" src="../assets/js/deliveries/custom.medicine.requests.js"></script>
<?php $deliveries_scripts = ob_get_clean() ?>

<?php require_once "_deliveries-layout.php" ?>