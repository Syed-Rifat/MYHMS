<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms_database";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the admin_id is set in POST request
if (isset($_POST['admin_id'])) {
    $admin_id = $_POST['admin_id'];

    // SQL query to delete admin
    $delete_query = "DELETE FROM admins WHERE admin_id = '$admin_id'";

    if (mysqli_query($conn, $delete_query)) {
        // Redirect to manage_admins.php after deletion
        header('Location: manage_admins.php');
    } else {
        echo "Error deleting admin: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
