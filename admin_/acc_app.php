<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Approval</title>
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
        .container {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #333;
            color: white;
        }
        .btn {
            padding: 8px 12px;
            margin: 2px;
            border: none;
            cursor: pointer;
        }
        .approve {
            background-color: green;
            color: white;
        }
        .reject {
            background-color: red;
            color: white;
        }
        h1{
            font-family: Arial,sans-serif;
            font-size: 32px;
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
            <a href="#">Accounts/Approval</a>
            <a href="feedback.php">Feedback</a>
            
        </div>
    </div>
    
    <div class="container">
        <h1>Account Approval</h1>
        <br>
        <table>
            <tr>
                <th>Barangay</th>
                <th>Brgy-Email</th>
                <th>Brgy-Contact Number</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>John Doe</td>
                <td>johndoe@example.com</td>
                <td>09051918542</td>
                <td>
                    <button class="btn approve">Approve</button>
                    <button class="btn reject">Reject</button>
                </td>
            </tr>
            <tr>
                <td>Jane Smith</td>
                <td>janesmith@example.com</td>
                <td>09051918542</td>
                <td>
                    <button class="btn approve">Approve</button>
                    <button class="btn reject">Reject</button>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
