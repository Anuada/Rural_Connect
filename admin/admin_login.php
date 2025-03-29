<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "med_deliveries";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email'];

    // Prevent SQL Injection
    $user = mysqli_real_escape_string($conn, $user);
    $pass = mysqli_real_escape_string($conn, $pass);
    $email = mysqli_real_escape_string($conn, $email);

    // Check user credentials
    $sql = "SELECT * FROM users WHERE username='$user' AND email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (password_verify($pass, $row['password'])) {
            $_SESSION['username'] = $user;
            header("Location: index.php"); // Redirect to a dashboard page
            exit();
        } else {
            echo "<script>alert('Invalid credentials!');window.location='index.html';</script>";
        }
    } else {
        echo "<script>alert('User not found!');window.location='index.html';</script>";
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.login-container {
    width: 30%;
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input {
    width: 95%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #5cb85c;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #4cae4c;
}

.message {
    margin-top: 15px;
    text-align: center;
}
    </style>
</head>
<body>
    <div class="login-container">
        <form id="loginForm" action="index.php" method="POST">
            <h2> Admin </h2>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Login</button>
            <p class="message">Not registered? <a href="admin_create_acc.php">Create an account</a></p>
        </form>
    </div>

<script>
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const messageDiv = document.getElementById('message');

    // Basic validation
    if (username === '' || password === '' || confirmPassword === '') {
        messageDiv.textContent = 'All fields are required.';
        messageDiv.style.color = 'red';
        return;
    }

    if (password !== confirmPassword) {
        messageDiv.textContent = 'Passwords do not match.';
        messageDiv.style.color = 'red';
        return;
    }

    // Simulate account creation success
    messageDiv.textContent = 'Account created successfully!';
    messageDiv.style.color = 'green';

    // Clear the form
    document.getElementById('registrationForm').reset();
});
</script>

</body>
</html>