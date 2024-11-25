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

// Check if the teacher_id is set in POST request
if (isset($_POST['teacher_id'])) {
    $teacher_id = $_POST['teacher_id'];

    // SQL query to delete teacher
    $delete_query = "DELETE FROM teachers WHERE teacher_id = '$teacher_id'";

    if (mysqli_query($conn, $delete_query)) {
        // Redirect to manage_teachers.php after deletion
        header('Location: manage_teachers.php');
    } else {
        echo "Error deleting teacher: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
