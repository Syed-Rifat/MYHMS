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
    $student_id_number = $_POST['student_id_number'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $blood_group = $_POST['blood_group'];
    $father_name = $_POST['father_name'];
    $father_phone = $_POST['father_phone'];
    $mother_name = $_POST['mother_name'];
    $mother_phone = $_POST['mother_phone'];
    $guardian_name = $_POST['guardian_name'];
    $guardian_phone = $_POST['guardian_phone'];
    $guardian_relation = $_POST['guardian_relation'];
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

// Continue with database insertion


    // Prepare the SQL query to insert the data
    $sql = "INSERT INTO student_registration_request (
        full_name, student_id_number, department, email, phone, blood_group,
        father_name, father_phone, mother_name, mother_phone, guardian_name,
        guardian_phone, guardian_relation, profile_picture, password, status
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    )";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters to the SQL query
        $stmt->bind_param('ssssssssssssssss', $full_name, $student_id_number, $department, $email, $phone, $blood_group,
            $father_name, $father_phone, $mother_name, $mother_phone, $guardian_name, $guardian_phone, $guardian_relation,
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
    <title>Student Registration</title>
    <link rel="stylesheet" href="path.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Student Registration Form</h2>
        <form action="student_register.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="full_name" required>
            </div>
            <div class="mb-3">
                <label for="studentIdNumber" class="form-label">Student ID Number</label>
                <input type="text" class="form-control" id="studentIdNumber" name="student_id_number" required>
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
                <label for="fatherName" class="form-label">Father's Name</label>
                <input type="text" class="form-control" id="fatherName" name="father_name">
            </div>
            <div class="mb-3">
                <label for="fatherPhone" class="form-label">Father's Phone</label>
                <input type="text" class="form-control" id="fatherPhone" name="father_phone">
            </div>
            <div class="mb-3">
                <label for="motherName" class="form-label">Mother's Name</label>
                <input type="text" class="form-control" id="motherName" name="mother_name">
            </div>
            <div class="mb-3">
                <label for="motherPhone" class="form-label">Mother's Phone</label>
                <input type="text" class="form-control" id="motherPhone" name="mother_phone">
            </div>
            <div class="mb-3">
                <label for="guardianName" class="form-label">Guardian's Name (Optional)</label>
                <input type="text" class="form-control" id="guardianName" name="guardian_name">
            </div>
            <div class="mb-3">
                <label for="guardianPhone" class="form-label">Guardian's Phone (Optional)</label>
                <input type="text" class="form-control" id="guardianPhone" name="guardian_phone">
            </div>
            <div class="mb-3">
                <label for="guardianRelation" class="form-label">Guardian's Relation (Optional)</label>
                <input type="text" class="form-control" id="guardianRelation" name="guardian_relation">
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
