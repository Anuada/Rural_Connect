<?php
session_start();
require_once "../shared/session.barangay_inc.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";
$barangay_inc_title = Misc::displayPageTitle("Request Medicine", "fa-notes-medical");

$db = new DbHelper();
$ms = new Misc;

if (!isset($_GET['id']) || empty(trim($_GET['id']))) {
    $_SESSION['m'] = "ID not found!";
    header("Location: ../barangay_inc/view_med.php");
    exit();
}

$med_avail = $db->getRecord('med_availability', ['id' => $_GET['id']]);

if (empty($med_avail)) {
    $_SESSION['m'] = "Medicine not found!";
    header("Location: ../barangay_inc/view_med.php");
    exit();
}

$limit = (int) ($med_avail['quantity'] * 0.20);
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/barangay.inc.request.med.css">
<?php $barangay_inc_styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="medicine-container">

    <div class="row g-4">
        <!-- Left column: Image + Form -->
        <div class="col-lg-4">
            <!-- Medicine Image -->
            <div class="text-center mb-4">
                <img src="<?php echo $med_avail['med_image'] ?>" alt="<?php echo $med_avail['med_name'] ?>"
                    class="shadow medicine-image" />
            </div>

            <!-- Request Form -->
            <form id="submit-request" action="../logic/request_med.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="submitRequest">
                <input type="hidden" name="med_avail_id" value="<?= htmlspecialchars($_GET['id']) ?>">
                <input type="hidden" name="barangay_inc_id" value="<?= htmlspecialchars($_SESSION['accountId']) ?>">
                <div class="form-fields">
                    <div class="mb-3">
                        <label for="request_quantity">Select Quantity</label>
                        <input type="number" name="request_quantity" id="request_quantity" min="1" max="<?php echo $limit; ?>"
                            value="1" required />
                    </div>

                    <div class="mb-3">
                        <label for="document">Upload Document</label>
                        <input type="file" name="document" class="form-control" id="document" accept="image/*" required />
                        <div class="form-text">Accepted: any images</div>
                    </div>
                    <button type="submit">Submit Request</button>
                </div>
                
            </form>
        </div>

        <!-- Right column: Details -->
        <div class="col-lg-8">
            <h2 class="mb-3 rc-blue-text fw-bold"><i class="fas fa-pills me-2"></i><?php echo $med_avail['med_name'] ?>
            </h2>

            <p class="mb-4 text-secondary">
                <?php echo $med_avail['med_description'] ?>
            </p>

            <table class="table" style="box-shadow: none">
                <colgroup>
                    <col style="width: 30%">
                    </col>
                    <col style="width: 70%%">
                    </col>
                </colgroup>
                <tbody class="align-middle">
                    <tr>
                        <th>Brand Name</th>
                        <td><?php echo $med_avail['brand_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td><?php echo $med_avail['category'] ?></td>
                    </tr>
                    <tr>
                        <th>Unit</th>
                        <td><?php echo $med_avail['unit'] ?></td>
                    </tr>
                    <tr>
                        <th>Dosage Strength</th>
                        <td><?php echo $med_avail['dosage_strength'] ?></td>
                    </tr>
                    <tr>
                        <th>Total Available</th>
                        <td>
                            <?php echo $med_avail['quantity'] . " " . ($med_avail['quantity'] > 1 ? $ms->pluralize(strtolower($med_avail['unit'])) : strtolower($med_avail['unit'])) ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $barangay_inc_content = ob_get_clean() ?>

<?php ob_start() ?>
<script type="module" src="../assets/js/barangay_inc/request.med.js"></script>
<?php $barangay_inc_scripts = ob_get_clean() ?>

<?php require_once "_barangay-inc-layout.php" ?>