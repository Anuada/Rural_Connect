<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "rural_connect";

# Create connection
$conn = new mysqli($servername, $username, $password);

# Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

# Create the database if it doesn't exist
$createDatabaseSQL = "CREATE DATABASE IF NOT EXISTS $database";
executeQuery($conn, $createDatabaseSQL);

# Close the connection
$conn->close();

# Reconnect with the database
$conn = new mysqli($servername, $username, $password, $database);

# Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

# Function to execute SQL queries
function executeQuery($conn, $sql)
{
    try {
        $conn->query($sql);
        echo "Migrating Database\n";
    } catch (Exception $e) {
        echo "Error Migrating\n";
    }
}

# SQL dump content
$sqlDump = file_get_contents('util/' . $database . '.sql');

# Split SQL dump into individual queries
$queries = explode(";", $sqlDump);

# Execute each query
foreach ($queries as $query) {
    $query = trim($query);
    if (!empty($query)) {
        executeQuery($conn, $query);
    }
}

# Close connection
$conn->close();