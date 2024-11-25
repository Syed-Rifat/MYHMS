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

// Check if the student_id is set in POST request
if (isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    // SQL query to delete student
    $delete_query = "DELETE FROM student WHERE student_id = '$student_id'";

    if (mysqli_query($conn, $delete_query)) {
        // Redirect to manage_students.php after deletion
        header('Location: manage_students.php');
    } else {
        echo "Error deleting student: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
