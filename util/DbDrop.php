<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "rural_connect";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the database exists
$result = $conn->query("SHOW DATABASES LIKE '$database'");

if ($result->num_rows > 0) {
    // Database exists, drop it
    $sql = "DROP DATABASE $database";

    if ($conn->query($sql) === TRUE) {
        echo "Database '$database' dropped successfully \n";
    } else {
        echo "Error dropping database: " . $conn->error . " \n";
    }
} else {
    echo "Database '$database' does not exist \n";
}

// Close connection
$conn->close();
