<?php
session_start();

require_once "../enums/UserType.php";

$user_types = UserType::all();

$accountId = $_SESSION['accountId'];
$user_type = $_SESSION["user_type"];

if (!isset($_SESSION['accountId'])) {
    header("Location: ../page/login.php");
    exit();
}

require_once "../shared/is.user.verified.php";

if (!in_array($user_type, $user_types)) {
    header("Location: ../page/");
    exit();
}
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/rate.and.feedback.css">
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <span class="navbar-brand">
            <span class="blue-color" id="title">Rural Connect</span>
            <span class="reg-w">Rate and Feedback</span>
        </span>
    </div>
</nav>
<?php $navbar = ob_get_clean() ?>

<?php ob_start() ?>
<div class="container rate-feedback-container">
    <form action="../logic/rate-and-feedback.php" method="post">
        <p style="font-size:20px">Rate Our Service!</p>
        <div class="star-rating">
            <input type="radio" id="star5" name="rating" value="5" />
            <label for="star5" class="star">&#9733;</label>

            <input type="radio" id="star4" name="rating" value="4" />
            <label for="star4" class="star">&#9733;</label>

            <input type="radio" id="star3" name="rating" value="3" />
            <label for="star3" class="star">&#9733;</label>

            <input type="radio" id="star2" name="rating" value="2" />
            <label for="star2" class="star">&#9733;</label>

            <input type="radio" id="star1" name="rating" value="1" />
            <label for="star1" class="star">&#9733;</label>
        </div>
        <div class="text-danger" style="height:30px" id="ratingError"></div>

        <p>
            <label for="feedback" style="font-size:20px">Feedback</label>
            <textarea class="form-control" id="feedback" name="feedback" rows="6"
                placeholder="(Optional) We appreciate your input on how we can do better."></textarea>
        </p>

        <p>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </p>
    </form>
</div>
<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script>
    const title = document.getElementById("title");
    title.addEventListener("click", () => {
        location.href = "../<?php echo $user_type ?>/";
    });
</script>

<?php if (isset($_SESSION["ratingError"])): ?>
    <script>
        document.getElementById("ratingError").innerHTML = "<?php echo $_SESSION["ratingError"] ?>";
    </script>
    <?php unset($_SESSION["ratingError"]) ?>
<?php endif ?>
<?php $scripts = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>
