<?php
session_start();
require_once "../shared/session.admin.php";
require_once "./is.admin.authenticated.php";
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/admin.feedback.css">
<?php $admin_styles = ob_get_clean() ?>

<?php ob_start() ?>

<div class="container">
    <h3>Ratings and Feedback</h3>

    <canvas id="ratingsChart"></canvas>
</div>

<!-- Modal -->
<div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ratingModalLabel">Feedbacks</h5>
            </div>
            <div class="modal-body">
                <p id="modalContent" class="scrollable"></p>
            </div>
        </div>
    </div>
</div>

<?php $admin_content = ob_get_clean() ?>

<?php ob_start() ?>
<script type="module" src="../assets/js/admin/feedback.js"></script>
<?php $admin_scripts = ob_get_clean() ?>

<?php require_once "_admin-layout.php" ?>