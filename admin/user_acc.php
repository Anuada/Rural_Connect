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
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 14px 20px;
            display: inline-block;
        }
        .navbar a:hover {
            background-color: #575757;
            border-radius: 5px;
        }
        .nav-links {
            display: flex;
        }
        .container {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            text-decoration: none;
            color: white;
            background: red;
            padding: 6px 12px;
            border-radius: 5px;
            display: inline-block;
        }
        .btn:hover {
            background: darkred;
        }
    </style>
</head>
<body>
    <div class="navbar">&nbsp;&nbsp;&nbsp;&nbsp;
        <!-- <div>
            <h1>
                <a href="#">Admin DashBoard</a>
            </h1>
        </div> -->
        <div class="nav-links">
            <a href="index.php">Dashboard</a>
            <a href="user_acc.php">Users/Account</a>
            <a href="acc_app.php">Accounts/Approval</a>
            <a href="feedback.php">Feedback</a>
            
        </div>
    </div>
    
    <div class="container">
        <h1>User Client Accounts</h1>
        <table>
            <tr>
                <th>Barangay</th>
                <th>Address</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>Top Top</td>
                <td>Top Top, Cebu City</td>
                <td>toptop@gmail.com</td>
                <td>09061987221</td>
                <td><a href="#" class="btn">Deactivate</a></td>
            </tr>
            <tr>
                <td>Busay</td>
                <td>Barangay Busay, Cebu City</td>
                <td>busay@gmail.com</td>
                <td>09876543211</td>
                <td><a href="#" class="btn">Deactivate</a></td>
            </tr>
            <tr>
                <td>Lahug</td>
                <td>Barangay Lahug, Cebu City</td>
                <td>lahug@gmail.com</td>
                <td>09876543201</td>
                <td><a href="#" class="btn">Deactivate</a></td>
            </tr>
        </table>
    </div>
</body>
</html>
