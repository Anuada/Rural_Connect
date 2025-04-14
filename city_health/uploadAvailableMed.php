<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/Misc.php";
$city_health_title = Misc::displayPageTitle("Upload Medicine","fa-upload me-2");
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
            <div class="mb-3">
                <label for="med_name">Medicine Name</label>
                <input type="text" id="med_name" name="med_name" required>
            </div>

            <div class="mb-3">
                <label for="med_description">Description</label>
                <textarea id="med_description" name="med_description"
                    required></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="category">Category</label>
                    <input type="text" id="category" name="category" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="DosageForm">Dosage Form</label>
                    <input type="text" id="DosageForm" name="DosageForm" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="DosageStrength">Dosage Strength</label>
                    <input type="text" id="DosageStrength" name="DosageStrength"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="expiry_date">Expiry Date</label>
                    <input type="date" id="expiry_date" name="expiry_date" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="med_image">Upload Image</label>
                    <input type="file" accept="image/*" name="med_image" id="med_image" required>
                </div>
            </div>
            
            <button type="submit" name="submit">Submit Now</button>
        </div>
    </form>
</div>
<?php $city_health_content = ob_get_clean() ?>

<?php require_once "_city-health-layout.php" ?>