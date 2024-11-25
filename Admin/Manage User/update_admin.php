<?php
// Database connection settings
$servername = "localhost";  // Change as per your database server
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password
$dbname = "hms_database";   // Your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the form data
$admin_id = $_POST['admin_id'];
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Update query
$query = "UPDATE admin SET full_name = ?, email = ?, phone = ? WHERE admin_id = ?";

// Prepare and bind
$stmt = $conn->prepare($query);
$stmt->bind_param("ssss", $full_name, $email, $phone, $admin_id);

// Execute the query
if ($stmt->execute()) {
    // Redirect to the manage admins page with a success message
    header("Location: manage_admins.php?status=updated");
} else {
    // Redirect to the manage admins page with an error message
    header("Location: manage_admins.php?status=error");
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
