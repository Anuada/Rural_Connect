
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 14px 20px;
            display: inline-block;
        }
        .navbar a:hover {
            background-color: #575757;
        }
        .nav-links {
            display: flex;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div>
            <h1>
                <a href="#"> Welcome Admin</a>
            </h1>
        </div>
        <div class="nav-links">
        <a href="index.php">Dashboard</a>
            <a href="user_acc.php">Users/Account</a>
            <a href="acc_app.php">Accounts/Approval</a>
            <a href="feedback.php">Feedback</a>
            <a href="admin_login.php">Logout</a>
        </div>
    </div>
   
</body>
</html>
