<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
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
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .message {
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create an Account</h1>
        <form id="registrationForm" onsubmit="return handleFormSubmit(event);">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
            </div>
            <button type="submit">Create Account</button>
        </form>
        <div id="message" class="message"></div>
    </div>
    <script>
        function handleFormSubmit(event) {
            event.preventDefault(); // Prevent the default form submission

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const messageDiv = document.getElementById('message');

            // Simple validation
            if (password !== confirmPassword) {
                messageDiv.textContent = "Passwords do not match!";
                messageDiv.style.color = "red";
                return false;
            }

            // Here you would typically send the data to your server for processing
            // For demonstration, we'll just simulate a successful account creation
            // In a real application, you would use AJAX or fetch to send data to your server

            // Simulate successful account creation
            messageDiv.textContent = "Account created successfully! Redirecting...";
            messageDiv.style.color = "green";

            // Redirect to admin login page after a short delay
            setTimeout(() => {
                window.location.href = 'admin_login.php';
            }, 2000); // Redirect after 2 seconds

            return false; // Prevent form submission
        }
    </script>
</body>
</html>