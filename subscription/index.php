<?php
session_start();
require_once "../shared/session.subscription.php";
require_once "../enums/SubscriptionPlan.php";
?>
<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/subscription.all.css">
<?php $styles = ob_get_clean() ?>
<?php ob_start() ?>
<?php require_once "../shared/navbar.subscription.php" ?>
<?php $navbar = ob_get_clean() ?>


<?php ob_start() ?>


<?php $content = ob_get_clean() ?>
<div class="container" style="padding-top:130px">
    <h2 class="text-center mb-4">Choose Your Plan</h2>
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
                    <a href="../subscription/details.php?plan=<?php echo SubscriptionPlan::Monthly->value ?>"
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
                    <a href="../subscription/details.php?plan=<?php echo SubscriptionPlan::Annual->value ?>"
                        class="btn btn-success btn-subscribe">Subscribe
                        Annually</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once "../shared/layout.php" ?>