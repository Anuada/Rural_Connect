<?php
session_start();
require_once "../shared/session.barangay_inc.php";
require_once "../util/Misc.php";
$barangay_inc_title = Misc::displayPageTitle("Custom Medicine Request", "fa-file-medical");
?>

<?php ob_start() ?>
<div class="card p-4 shadow-lg rounded">
    <form id="submit-custom-request" action="../logic/request_med.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="customRequest" id="customRequest">
        <div class="form-fields">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="requested_medicine">Medicine Name</label>
                    <input type="text" class="form-control" id="requested_medicine" name="requested_medicine" required>
                    <div style="height: 15px" class="form-text" id="requested_medicineError"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="category">Category</label>
                    <input type="text" class="form-control" id="category" name="category" required>
                    <div style="height: 15px" class="form-text" id="categoryError"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="dosage_form">Dosage Form</label>
                    <input type="text" class="form-control" id="dosage_form" name="dosage_form" required>
                    <div style="height: 15px" class="form-text" id="dosage_formError"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="dosage_strength">Dosage Strength</label>
                    <input type="text" class="form-control" id="dosage_strength" name="dosage_strength" required>
                    <div style="height: 15px" class="form-text" id="dosage_strengthError"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="requested_quantity">Quantity</label>
                    <input type="number" class="form-control" id="requested_quantity" name="requested_quantity" min="1"
                        required>
                    <div style="height: 15px" class="form-text" id="requested_quantityError"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="document">Upload Document</label>
                    <input type="file" accept="image/*" class="form-control" name="document" id="document" required>
                    <div style="height: 15px" class="form-text" id="documentError">Accepted: any images</div>
                </div>
            </div>

            <button type="submit">Submit Request</button>
        </div>
    </form>
</div>
<?php $barangay_inc_content = ob_get_clean() ?>

<?php ob_start() ?>

<?php if (isset($_SESSION['errorMessages'])): ?>
    <script>
        <?php foreach ($_SESSION['errorMessages'] as $key => $value): ?>
            let <?php echo $key ?>ErrorEl = document.getElementById("<?php echo $key ?>Error");
            <?php echo $key ?>ErrorEl.classList.add("text-danger");
            <?php echo $key ?>ErrorEl.innerText = "<?php echo $value ?>";
        <?php endforeach ?>
    </script>
    <?php unset($_SESSION['errorMessages']) ?>
<?php endif ?>

<?php if (isset($_SESSION['formFields'])): ?>
    <script>
        <?php foreach ($_SESSION['formFields'] as $key => $value): ?>
            document.getElementById('<?php echo $key ?>').value = "<?php echo $value ?>";
        <?php endforeach ?>
    </script>
    <?php unset($_SESSION['formFields']) ?>
<?php endif ?>

<script type="module" src="../assets/js/barangay_inc/custom.med.request.js"></script>
<?php $barangay_inc_scripts = ob_get_clean() ?>

<?php require_once "_barangay-inc-layout.php" ?>