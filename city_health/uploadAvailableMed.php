<?php
session_start();
require_once "../shared/session.city_health.php";
$city_health_title = "Upload Medicine";
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/styleUploadMed.css">
<?php $city_health_styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="card p-4 shadow-lg rounded">
    <form action="../logic/upload_med.php" method="post" enctype="multipart/form-data" id="submitformlegal">
        <input type="hidden" name="city_health_id" value="<?php echo htmlspecialchars($_SESSION["accountId"]); ?>"
            required>
        <div class="form-group mb-3">
            <label class="form-label" for="med_name">Medicine Name</label>
            <input type="text" class="form-control" id="med_name" name="med_name" placeholder="Enter type of Medicine"
                required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label" for="med_description">Description</label>
            <textarea class="form-control" id="med_description" name="med_description"
                placeholder="Enter type of Description" required></textarea>
        </div>

        <div class="form-group mb-3">
            <label class="form-label" for="category">Category</label>
            <input type="text" class="form-control" id="category" name="category" placeholder="Enter category" required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label" for="DosageForm">Dosage Form</label>
            <input type="text" class="form-control" id="DosageForm" name="DosageForm" placeholder="Enter Dosage Form"
                required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label" for="DosageStrength">Dosage Strength</label>
            <input type="text" class="form-control" id="DosageStrength" name="DosageStrength"
                placeholder="Enter Dosage Strength" required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label" for="quantity">Quantity</label>
            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" required>
        </div>


        <div class="form-group mb-3">
            <label class="form-label" for="expiry_date">Expiry Date</label>
            <input type="date" class="form-control" id="expiry_date" name="expiry_date" placeholder="Enter Expiry Date"
                required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label" for="med_image">Upload Image</label>
            <input type="file" accept="image/*" name="med_image" id="med_image" class="form-control" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary w-100">Submit Now</button>
    </form>
</div>
<?php $city_health_content = ob_get_clean() ?>

<?php require_once "_city-health-layout.php" ?>