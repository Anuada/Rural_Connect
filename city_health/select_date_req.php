<?php
session_start();
require_once "../shared/session.city_health.php";
require_once "../util/DbHelper.php";

$db = new DbHelper();

$requestId = isset($_GET['requestId']) ? $_GET['requestId'] : null;
$users = $db->fetchDeliveries();

$city_health_title = "Select Delivery Date";
?>

<?php ob_start() ?>
<!-- css/styles here -->
<?php $city_health_styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="d-flex justify-content-center mt-4">
    <div class="card shadow-lg p-4 w-50">
        <form action="../logic/Selectdate_req.php" method="POST">
            <input type="hidden" name="requestId" value="<?php echo htmlspecialchars($requestId); ?>">

            <div class="mb-3">
                <label for="assignedUser">Select Courier</label>
                <select class="form-control" name="deliveries_accountId" required>
                    <option hidden selected>SELECT COURIER</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo htmlspecialchars($user['accountId']); ?>">
                            <?php echo htmlspecialchars($user['fname'] . ' ' . $user['lname']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="date_of_supply">Select Supply Date</label>
                <input type="date" name="date_of_supply" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Assign</button>
        </form>
    </div>
</div>
<?php $city_health_content = ob_get_clean() ?>


<?php require_once "_city-health-layout.php" ?>