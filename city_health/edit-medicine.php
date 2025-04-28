<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/DbHelper.php";
require_once "../util/Misc.php";
require_once "../enums/Unit.php";
$city_health_title = Misc::displayPageTitle("Update Medicine", "fa-pills me-2");

$db = new DbHelper();
$ms = new Misc;

$units = Unit::all();

$location = $ms->url("city_health/medicine-inventory.php");
if (!isset($_GET['id']) || empty(trim($_GET['id']))) {
    $_SESSION['m'] = "Id Not Set!";
    header("Location: $location");
    exit();
}

$id = $_GET['id'];

$medicine = $db->getRecord("med_availability", ["id" => $id]);

if (!$medicine) {
    $_SESSION['m'] = "Medicine Details Not Found!";
    header("Location: $location");
    exit();
}

?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/styleUploadMed.css">
<?php $city_health_styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="card p-4 shadow-lg rounded">
    <form action="../logic/update-medicine-details.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($medicine["id"]); ?>">
        <div class="form-fields">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="med_name">
                        Generic Name
                        <i class="fa fa-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="right"
                            data-bs-custom-class="wider-tooltip"
                            title="If the medicine is a combination of two or more medicines, separate each with a forward slash '/' without space, for example: Paracetamol/Ibuprofen, so that a description will appear in the description field if the description for that particular medicine exists."></i>
                    </label>
                    <input class="form-control" type="text" id="med_name" name="med_name"
                        value="<?php echo htmlspecialchars($medicine["med_name"]) ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="brand_name">Brand Name</label>
                    <input class="form-control" type="text" id="brand_name" name="brand_name"
                        value="<?php echo htmlspecialchars($medicine["brand_name"]) ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="med_description">Description</label>
                <textarea class="form-control" id="med_description" name="med_description" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="category">Category</label>
                <input class="form-control" type="text" id="category" name="category"
                    value="<?php echo htmlspecialchars($medicine["category"]); ?>" required>
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
                    <input class="form-control" type="text" id="dosage_strength" name="dosage_strength"
                        value="<?php echo htmlspecialchars($medicine["dosage_strength"]); ?>" required>
                </div>
            </div>

            <button type="submit">Update Medicine</button>
        </div>
    </form>
</div>
<?php $city_health_content = ob_get_clean() ?>


<?php ob_start() ?>
<script>
    document.getElementById('med_description').value = "<?php echo htmlspecialchars($medicine["med_description"]) ?>";
    document.getElementById('unit').value = "<?php echo htmlspecialchars($medicine["unit"]) ?>";
</script>

<script type="module" src="../assets/js/city_health/add.new.medicine.js"></script>
<?php $city_health_scripts = ob_get_clean() ?>

<?php require_once "_city-health-layout.php" ?>