<?php

// Database credentials (replace with your details)
$servername = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'med_deliveries';

// Define the desired save location (including filename)
$save_location = __DIR__ . '\\' . $database . '.sql';


// Build the mysqldump command with the save location
$command = "mysqldump -u $username -p -h $servername $database > $save_location";

$output = [];
$retval = -1;

exec($command, $output, $retval);

echo $retval == 0 ? "Database backup created successfully: $save_location \n" :
    "Error creating database backup \n";
