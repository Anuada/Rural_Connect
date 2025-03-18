<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rural Connect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #eef2f3;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0px;
            background: linear-gradient(135deg, #007bff, #00d4ff);
            border-radius: 10px;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 20px;
            padding: 0;
            margin: 0;
        }

        .navbar ul li a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            transition: color 0.3s;
        }

        .navbar ul li a:hover {
            color: #ffdd57;
        }

        .navbar .logo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
        }

        .navbar .get-started {
            background-color: #ffdd57;
            color: #333;
            padding: 12px 24px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s;
        }

        .navbar .get-started:hover {
            background-color: #ffcc00;
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 50px 0;
        }

        .hero .text {
            max-width: 50%;
            animation: fadeInLeft 1.2s ease;
        }

        .hero .text h1 {
            font-size: 50px;
            font-weight: 700;
            color: #007bff;
        }

        .hero .text p {
            font-size: 18px;
            margin-bottom: 20px;
            color: #444;
        }

        .hero .text .more-info {
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s;
        }

        .hero .text .more-info:hover {
            background-color: #0056b3;
        }

        .hero .image img {
            width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
            animation: fadeInRight 1.2s ease;
        }

        @media (max-width: 768px) {
            .hero {
                flex-direction: column;
                text-align: center;
            }

            .hero .text, .hero .image {
                max-width: 100%;
            }
        }

        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Navigation Bar -->
        <nav class="navbar">
            <div class="logo">
                <img src="../assets/img/misc/delivery_pic.jpeg" alt="Company Logo">
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="value.php">Value</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <a class="get-started" href="../page/login.php" aria-label="Login">Login</a>
        </nav>

        
        <div class="hero">
            <div class="text">
                <h1>Rural Connect</h1>
                <p>Ultimately, RURAL CONNECT aims to bridge the healthcare gap between urban and rural areas, ensuring that all residents, irrespective of location, have access to the medical care they require. By addressing logistical, communication, and supply chain issues, this platform will play a pivotal role in enhancing healthcare access for mountain barangays.</p>
                <a class="more-info" href="../page/signup.php" aria-label="Sign up for Rural Connect">Sign up</a>
            </div>
            <div class="image">
                <img src="../assets/img/misc/med2.JPG" alt="Illustration of team collaboration">
            </div>
        </div>
    </div>
</body>
</html>
