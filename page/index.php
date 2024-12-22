<?php
session_start();
ob_start();
?>
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
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
            padding: 20px 0;
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
            color: #000;
            font-weight: 500;
        }

        .navbar ul li a:hover {
            color: #007bff;
        }

        .navbar .logo img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
        }

        .navbar .get-started {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 20px;
            text-decoration: none;
        }

        .navbar .get-started:hover {
            background-color: #0056b3;
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 50px 0;
        }

        .hero .text {
            max-width: 50%;
        }

        .hero .text h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero .text p {
            font-size: 18px;
            margin-bottom: 20px;
            color: #666;
        }

        .hero .text .more-info {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 20px;
            text-decoration: none;
        }

        .hero .text .more-info:hover {
            background-color: #0056b3;
        }

        .hero .image img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        @media (max-width: 768px) {
            .hero {
                flex-direction: column;
                text-align: center;
            }

            .hero .text,
            .hero .image {
                max-width: 100%;
            }

            .hero .image img {
                margin-top: 20px;
            }
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
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Value</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <a class="get-started" href="../page/login.php" aria-label="Login">Login</a>
        </nav>

        <!-- Hero Section -->
        <div class="hero">
            <div class="text">
                <h1>Rural Connect</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <a class="more-info" href="../page/signup.php" aria-label="Sign up for Rural Connect">Sign up</a>
            </div>
            <div class="image">
                <img src="../assets/img/misc/med2.JPG" alt="Illustration of team collaboration">
            </div>
        </div>
    </div>

    <?php
$content = ob_get_clean();
require_once "../shared/layout.php";
