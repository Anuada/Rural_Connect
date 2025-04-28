<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/Misc.php";
require_once "../enums/Unit.php";
$city_health_title = Misc::displayPageTitle("Add New Medicine", "fa-plus-circle");

$units = Unit::all();
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/styleUploadMed.css">
<?php $city_health_styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="card p-4 shadow-lg rounded">
    <form action="../logic/upload_med.php" method="post" enctype="multipart/form-data" id="submitformlegal">
        <div class="form-fields">
            <input type="hidden" name="city_health_id" value="<?php echo htmlspecialchars($_SESSION["accountId"]); ?>"
                required>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="med_name">
                        Generic Name
                        <i class="fa fa-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="right"
                            data-bs-custom-class="wider-tooltip"
                            title="If the medicine is a combination of two or more medicines, separate each with a forward slash '/' without space, for example: Paracetamol/Ibuprofen, so that a description will appear in the description field if the description for that particular medicine exists."></i>
                    </label>
                    <input class="form-control" type="text" id="med_name" name="med_name" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="brand_name">Brand Name</label>
                    <input class="form-control" type="text" id="brand_name" name="brand_name" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="med_description">Description</label>
                <textarea class="form-control" id="med_description" name="med_description" required></textarea>
            </div>

            <div class="mb-3">
                <label for="category">Category</label>
                <input class="form-control" type="text" id="category" name="category" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="unit">Unit</label>
                    <select class="form-control" id="unit" name="unit" required>
                        <option hidden selected>SELECT UNIT</option>
                        <?php foreach ($units as $unit): ?>
                            <option value="<?php echo $unit ?>"><?php echo $unit ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="dosage_strength">Dosage Strength</label>
                    <input class="form-control" type="text" id="dosage_strength" name="dosage_strength" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="quantity">Quantity</label>
                    <input class="form-control" type="number" id="quantity" name="quantity" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="med_image">Upload Image</label>
                    <input type="file" accept="image/*" class="form-control" name="med_image" id="med_image" required>
                </div>
            </div>

            <button type="submit">Submit Now</button>
        </div>
    </form>
</div>
<?php $city_health_content = ob_get_clean() ?>

<?php ob_start() ?>

<?php if (isset($_SESSION["field_inputs"])): ?>
    <script>
        <?php foreach ($_SESSION["field_inputs"] as $key => $value): ?>
            document.querySelector('[name="<?php echo $key ?>"]').value = "<?php echo $value ?>"
        <?php endforeach ?>
    </script>
    <?php unset($_SESSION["field_inputs"]); ?>
<?php endif ?>

<script type="module" src="../assets/js/city_health/add.new.medicine.js"></script>
<?php $city_health_scripts = ob_get_clean() ?>

<?php require_once "_city-health-layout.php" ?>