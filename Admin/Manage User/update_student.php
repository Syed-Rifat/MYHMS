<?php
// Get the form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];

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

    // Update student record
    $query = "UPDATE student SET full_name = ?, email = ?, phone = ?, department = ? WHERE student_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $full_name, $email, $phone, $department, $student_id);

    // Execute query
    if ($stmt->execute()) {
        // Redirect with a success message
        header("Location: manage_students.php?status=success");
        exit();
    } else {
        // If there is an error
        header("Location: manage_students.php?status=error");
        exit();
    }
    

    // Close the connection
    $stmt->close();
    mysqli_close($conn);
}
?>
