<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Value - Rural Connect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100vh;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
            background-color: #eef2f3;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            padding: 20px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: linear-gradient(135deg, #007bff, #00d4ff);
            border-radius: 10px;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 20px;
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

        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            height: calc(100vh - 100px);
            padding: 20px;
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

        .hero .image {
            max-width: 45%;
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
        </nav>
        
        <div class="hero">
            <div class="text">
                <h1>Value</h1>
                <p><strong>Rural Connect</strong> is dedicated to ensuring that essential medicines and healthcare supplies reach barangays efficiently and reliably. With a strong commitment to <strong>accessibility, efficiency, and innovation</strong>, we utilize technology-driven solutions to optimize medical logistics and minimize delays.</p>
                <p>Rooted in <strong>community service and reliability</strong>, our initiative prioritizes the well-being of barangay residents by maintaining a seamless and dependable medical supply chain.</p>
            </div>
            <div class="image">
                <img src="../assets/img/misc/med2.JPG" alt="Illustration of team collaboration">
            </div>
        </div>
    </div>
</body>
</html>
