<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $request_id = $_GET['id'];

    // Update query to reject the student registration request
    $query = "UPDATE student_registration_request SET status='rejected' WHERE request_id='$request_id'";

    if ($conn->query($query) === TRUE) {
        echo "Student registration request rejected successfully.";
    } else {
        echo "Error rejecting registration: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
