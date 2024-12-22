<html>

<head>
    <title>
        RuralConnect Landing Page
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
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
            margin-left: 10px;
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
        }

        .navbar ul li {
            display: inline;
        }

        .navbar ul li a {
            text-decoration: none;
            color: #000;
            font-weight: 500;
        }

        .navbar ul li a:hover {
            color: #007bff;
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: 700;
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

        .hero .image {
            max-width: 50%;
        }

        .hero .image img {
            width: 100%;
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
        }
        .logo img {
    width: 70px;
    height: 70px; 
    border-radius: 50%;
    object-fit: cover;
}

    </style>
</head>

<body>
<div class="container">
    <nav class="navbar">
    <div class="logo">
    <img src="../assets/img/misc/delivery_pic.jpeg" alt="Company Logo" />
</div>


        
<a class="get-started" href="../page/index.php">
    <i class="fa fa-arrow-left"></i> Back to Page
</a>


    </nav>
    
</div>
</body>

</html>