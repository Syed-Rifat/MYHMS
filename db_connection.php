<?php
// Define database connection parameters
$host = 'localhost';      // Database host (usually 'localhost')
$db_name = 'hms_database'; // Database name
$username = 'root';       // MySQL username (usually 'root' for local development)
$password = '';           // MySQL password (leave empty for local development if no password)

try {
    // Create a new PDO instance to connect to the database
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    
    // Set the PDO error mode to exception for error handling
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optional: Display a message if connection is successful
    // echo "Connected successfully"; 
}
catch(PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
    die(); // Stop further execution if connection fails
}
?>
