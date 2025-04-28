<?php
session_start();
require_once "../shared/session.barangay_inc.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";
$barangay_inc_title = Misc::displayPageTitle("Track Delivery Status", "fa-truck");

$db = new DbHelper();
$ms = new Misc;
$account_id = $_SESSION["accountId"];

$details = [];

if ((!isset($_GET['med-delivery']) || empty(trim($_GET['med-delivery']))) && (!isset($_GET['custom-med-delivery']) || empty(trim($_GET['custom-med-delivery'])))) {
    $_SESSION['m'] = "med delivery id or custom med delivery id is required!";
    header("Location: " . $ms->url('barangay_inc/my-requests.php'));
    exit();
}

if (isset($_GET['med-delivery'])) {
    $delivery_id = $_GET['med-delivery'];
    $check = $db->display_track_delivery_details_on_barangay($delivery_id, $account_id);
    if (empty($check)) {
        $_SESSION['m'] = "delivery details not found!";
        header("Location: " . $ms->url('barangay_inc/my-requests.php'));
        exit();
    }
    $details = $check;
} else {
    $delivery_id = $_GET['custom-med-delivery'];
    $check = $db->display_track_delivery_details_on_barangay_custom($delivery_id, $account_id);
    if (empty($check)) {
        $_SESSION['m'] = "delivery details not found!";
        header("Location: " . $ms->url('barangay_inc/my-requests.php'));
        exit();
    }
    $details = $check;
}
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/barangay.inc.track.delivery.status.css">
<?php $barangay_inc_styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="card" style="margin-bottom: 20px;">
    <div class="row align-items-center">
        <?php if (isset($details['med_image'])): ?>
            <div class="col-md-3 text-center med-img mb-1">
                <img src="<?php echo $details['med_image'] ?>" alt="<?php echo $details['med_name'] ?>"
                    class="img-fluid rounded shadow-sm" style="width: 180px; height: 180px; object-fit: cover;">
            </div>
        <?php endif ?>
        <div class="col-md-6">
            <p class="mb-1"><strong><?php echo $details['med_name'] ?></strong></p>
            <p class="mb-1 text-secondary"><?php echo $details['category'] ?></p>
            <p class="mb-1 text-secondary"><?php echo $details['unit'] . " - " . $details['dosage_strength'] ?>
            </p>
            <p class="mb-0 text-secondary">Requested Quantity - <?php echo $details['requested_quantity'] ?></p>
        </div>
    </div>
</div>

<div class="kpi-container">
    <div class="kpi-card">
        <h6>Expected Arrival</h6>
        <p><?php echo date("F d, Y", strtotime($details['date_of_supply'])) ?></p>
    </div>
    <div class="kpi-card">
        <h6>Medicine Request ID</h6>
        <p><?php echo $details['request_med_id'] ?></p>
    </div>
</div>
<div class="kpi-container">
    <div class="kpi-card">
        <h6>Courier</h6>
        <p><?php echo $details['delivery'] ?></p>
    </div>
</div>

<div class="card">
    <div class="d-flex justify-content-center align-items-center">
        <div class="position-relative">
            <div class="timeline-line"></div>
            <div id="track-delivery-status"></div>
        </div>
    </div>
</div>

<?php $barangay_inc_content = ob_get_clean() ?>

<?php ob_start() ?>
<script type="module" src="../assets/js/barangay_inc/track.delivery.status.js"></script>
<?php $barangay_inc_scripts = ob_get_clean() ?>

<?php require_once "_barangay-inc-layout.php" ?>