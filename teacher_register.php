<?php
// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check for database connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $full_name = $_POST['full_name'];
    $teacher_id_number = $_POST['teacher_id_number'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $blood_group = $_POST['blood_group'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash the password
    $status = 'pending';  // Default status

    // Handle Profile Picture Upload
    // Ensure the 'uploads' directory exists and is writable
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }

    // Handle Profile Picture Upload
    $profile_picture = NULL;
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $upload_dir = 'uploads/';
        $filename = preg_replace('/[^A-Za-z0-9\-]/', '_', $_FILES['profile_picture']['name']); // Sanitize filename
        $profile_picture = $upload_dir . basename($filename);

        // Check if file is successfully moved to the uploads folder
        if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture)) {
            echo "Failed to upload profile picture.";
        }
    }

    // Prepare the SQL query to insert the data
    $sql = "INSERT INTO teacher_registration_request (
        full_name, teacher_id_number, department, email, phone, blood_group,
        profile_picture, password, status
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?
    )";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters to the SQL query
        $stmt->bind_param('sssssssss', $full_name, $teacher_id_number, $department, $email, $phone, $blood_group,
            $profile_picture, $password, $status);

        // Execute the query
        if ($stmt->execute()) {
            echo "Registration request submitted successfully. Awaiting admin approval.";
        } else {
            echo "Error executing query: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing query: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Registration</title>
    <link rel="stylesheet" href="path.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Teacher Registration Form</h2>
        <form action="teacher_register.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="full_name" required>
            </div>
            <div class="mb-3">
                <label for="teacherIdNumber" class="form-label">Teacher ID Number</label>
                <input type="text" class="form-control" id="teacherIdNumber" name="teacher_id_number" required>
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <select class="form-control" id="department" name="department" required>
                    <option value="CSE">CSE</option>
                    <option value="ICT">ICT</option>
                    <option value="EEE">EEE</option>
                    <option value="ME">ME</option>
                    <option value="CIVIL">CIVIL</option>
                    <option value="IPE">IPE</option>
                    <option value="ENG">ENG</option>
                    <option value="BBA">BBA</option>
                    <option value="ASI">ASI</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="bloodGroup" class="form-label">Blood Group</label>
                <select class="form-control" id="bloodGroup" name="blood_group" required>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="profilePicture" class="form-label">Profile Picture (Optional)</label>
                <input type="file" class="form-control" id="profilePicture" name="profile_picture">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>
</html>
