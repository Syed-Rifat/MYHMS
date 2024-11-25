<?php
// db_config.php

$host = 'localhost';  // Database host
$db_name = 'hms_database';  // Database name
$username = 'root';  // MySQL username (usually 'root' for local development)
$password = '';  // MySQL password (usually empty for local development)

try {
    // Establishing a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    
    // Set the PDO error mode to exception for error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If the connection fails, display the error message
    die("Connection failed: " . $e->getMessage());
}
?>
