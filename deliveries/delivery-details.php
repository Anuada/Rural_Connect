<?php
session_start();
require_once "../shared/session.delivery.php";
require_once "../enums/DeliveryStatus.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";

$deliveries_title = Misc::displayPageTitle("Delivery Details", "fa-truck");

$delivery_status = DeliveryStatus::all();
$db = new DbHelper();
$ms = new Misc;
$account_id = $_SESSION["accountId"];

if ((!isset($_GET['med-delivery']) || empty(trim($_GET['med-delivery']))) && (!isset($_GET['custom-med-delivery']) || empty(trim($_GET['custom-med-delivery'])))) {
    $_SESSION['m'] = "med delivery id or custom med delivery id is required!";
    header("Location: " . $ms->url('deliveries/medicine-requests.php'));
    exit();
}

$requestType = '';

$detail = [];

if (isset($_GET['med-delivery'])) {
    $id = $_GET['med-delivery'];
    $requestType = 'med-delivery';
    $check = $db->display_medicine_requests_to_deliver($account_id, null, null, $id);
    if (empty($check)) {
        $_SESSION['m'] = "delivery info not found!";
        header("Location: " . $ms->url('deliveries/medicine-requests.php'));
        exit();
    }
    $detail = $check;
} else {
    $id = $_GET['custom-med-delivery'];
    $requestType = 'custom-med-delivery';
    $check = $db->display_customized_medicine_requests_to_deliver($account_id, null, null, $id);
    if (empty($check)) {
        $_SESSION['m'] = "delivery info not found!";
        header("Location: " . $ms->url('deliveries/custom-medicine-requests.php'));
        exit();
    }
    $detail = $check;
}

?>

<?php ob_start() ?>
<div class="card">
    <div class="row align-items-center mb-4">
        <?php if (isset($detail['med_image'])): ?>
            <div class="col-md-3 text-center med-img mb-1">
                <img src="<?php echo $detail['med_image'] ?>" alt="<?php echo $detail['med_name'] ?>"
                    class="img-fluid rounded shadow-sm">
            </div>
        <?php endif ?>
        <div class="col-md-9">
            <p class="mb-1"><strong><?php echo $detail['med_name'] ?></strong></p>
            <p class="mb-1 text-secondary"><?php echo $detail['category'] ?></p>
            <p class="mb-1 text-secondary"><?php echo $detail['dosage_form'] . " - " . $detail['dosage_strength'] ?></p>
            <p class="mb-0 text-secondary">Requested Quantity - <?php echo $detail['requested_quantity'] ?></p>
        </div>
    </div>

    <div class="mb-4">
        <table>
            <thead>
                <tr>
                    <th colspan="2">Barangay Recipient</th>
                </tr>
            </thead>
            <colgroup>
                <col style="width: 40%">
                </col>
                <col style="width: 60%">
                </col>
            </colgroup>
            <tbody>
                <tr>
                    <td>Barangay</td>
                    <td><?php echo $detail['barangay'] ?></td>
                </tr>
                <tr>
                    <td>Incharge</td>
                    <td><?php echo $detail['barangay_incharge'] ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo $detail['address'] ?></td>
                </tr>
                <tr>
                    <td>Contact Number</td>
                    <td><?php echo $detail['contactNo'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mb-4">
        <table>
            <thead>
                <tr>
                    <th colspan="2">Request Info</th>
                </tr>
            </thead>
            <colgroup>
                <col style="width: 40%">
                </col>
                <col style="width: 60%">
                </col>
            </colgroup>
            <tbody>
                <tr>
                    <td>Medicine Request ID</td>
                    <td><?php echo $detail['request_med_id'] ?></td>
                </tr>
                <tr>
                    <td>Expected Arrival</td>
                    <td><?php echo date('F d, Y', strtotime($detail['date_of_supply'])) ?></td>
                </tr>
                <tr>
                    <td>Delivery Status</td>
                    <td>
                        <form action="<?php echo $ms->url('logic/delivery-change-status.php') ?>" method="post">
                            <div class="form-fields">
                                <input type="hidden" name="id" id="id" value="<?php echo $detail['id'] ?>">
                                <input type="hidden" name="request-type" id="request-type"
                                    value="<?php echo $requestType ?>">
                                <select name="delivery_status" id="delivery_status" title="Select delivery status">
                                    <?php foreach ($delivery_status as $status): ?>
                                        <option value="<?php echo $status ?>" <?php echo $detail['delivery_status'] == $status ? "selected" : "" ?>><?php echo $status ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php $deliveries_content = ob_get_clean() ?>


<?php ob_start() ?>
<script type="module" src="../assets/js/deliveries/delivery.details.js"></script>
<?php $deliveries_scripts = ob_get_clean() ?>

<?php require_once "_deliveries-layout.php" ?>