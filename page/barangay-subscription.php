<?php
session_start();
$load = false;
require_once "../enums/SubscriptionPlan.php";
?>
<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/landing.page.subscription.css">
<?php $landing_page_styles = ob_get_clean() ?>

<?php ob_start() ?>
<div class="container">
    <h2 class="text-center mb-3">Choose Your Plan</h2>
    <div class="row justify-content-center g-4">

        <!-- Monthly Plan -->
        <div class="col-md-5">
            <div class="card p-4 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="plan-type">Monthly Plan</h5>
                    <p class="price text-primary mt-3">₱299<span class="text-muted fs-6">/month</span></p>
                    <ul class="list-unstyled my-4">
                        <li>✔ Request Medicine</li>
                        <li>✔ Free Delivery</li>
                    </ul>
                    <a href="<?php echo isset($_SESSION['accountId']) ? "../subscription/details.php?plan=" . SubscriptionPlan::Monthly->name : "#" ?>"
                        class="btn btn-primary btn-subscribe">Subscribe
                        Monthly</a>
                </div>
            </div>
        </div>

        <!-- Annual Plan -->
        <div class="col-md-5">
            <div class="card p-4 shadow-sm highlight bg-light">
                <div class="card-body text-center">
                    <h5 class="plan-type">Annual Plan</h5>
                    <p class="price text-success mt-3">₱2,999<span class="text-muted fs-6">/year</span></p>
                    <ul class="list-unstyled my-4">
                        <li>✔ Request Medicine</li>
                        <li>✔ Free Delivery</li>
                        <li>✔ Save 16%</li>
                    </ul>
                    <a href="<?php echo isset($_SESSION['accountId']) ? "../subscription/details.php?plan=" . SubscriptionPlan::Annual->name : "#" ?>"
                        class="btn btn-success btn-subscribe">Subscribe
                        Annually</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $land_page_content = ob_get_clean() ?>

<?php ob_start() ?>

<?php if (!isset($_SESSION['accountId'])): ?>
    <script type="module" src="../assets/js/landing_page/barangay.subscription.js"></script>
<?php endif ?>

<?php $landing_page_scripts = ob_get_clean() ?>

<?php require_once "../shared/landing_page_layout.php" ?>