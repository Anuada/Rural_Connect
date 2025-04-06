<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: white;
        }

        canvas {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        &nbsp;&nbsp;&nbsp;
        <div class="nav-links">
            <a href="index.php">Dashboard</a>
            <a href="user_acc.php">Users/Account</a>
            <a href="acc_app.php">Accounts/Approval</a>
            <a href="#">Feedback</a>

        </div>
    </div>

    <div class="container">
        <h1>Feedback and Ratings</h1>
        <table>
            <tr>
                <th>Barangay</th>
                <th>Feedback</th>
                <th>Rating</th>
            </tr>
            <tr>
                <td>John Doe</td>
                <td>Great service!</td>
                <td>5</td>
            </tr>
            <tr>
                <td>Jane Smith</td>
                <td>Could be better.</td>
                <td>3</td>
            </tr>
            <tr>
                <td>Mike Johnson</td>
                <td>Excellent experience.</td>
                <td>4</td>
            </tr>
        </table>

        <canvas id="ratingsChart"></canvas>
    </div>

    <script>
        var ctx = document.getElementById('ratingsChart').getContext('2d');
        var ratingsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],
                datasets: [{
                    label: 'Number of Ratings',
                    data: [2, 2, 3, 6, 8],
                    backgroundColor: ['red', 'orange', 'yellow', 'green', 'blue']
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</body>

</html>