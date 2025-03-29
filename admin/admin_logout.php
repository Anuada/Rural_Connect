<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php"); // Redirect to the login page
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <a href="admin_login.php"></a>
</body>
</html>