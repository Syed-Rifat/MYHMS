<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function showFields() {
            var userType = document.getElementById("userType").value;
            document.getElementById("studentFields").style.display = (userType === 'student') ? 'block' : 'none';
            document.getElementById("teacherFields").style.display = (userType === 'teacher') ? 'block' : 'none';
            document.getElementById("adminFields").style.display = (userType === 'admin') ? 'block' : 'none';
        }
    </script>
</head>
<body>

<div class="container mt-5">
    <h2>Registration Form</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <!-- User Type Selector -->
        <div class="mb-3">
            <label for="userType" class="form-label">Register As</label>
            <select class="form-control" id="userType" name="user_type" required onchange="showFields()">
                <option value="">-- Select User Type --</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <!-- Common Fields -->
        <div id="commonFields">
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="full_name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
        </div>

        <!-- Student Fields -->
        <div id="studentFields" style="display: none;">
            <div class="mb-3">
                <label for="studentId" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="studentId" name="student_id">
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <select class="form-control" id="department" name="department">
                    <option value="">-- Select Department --</option>
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
                <label for="bloodGroup" class="form-label">Blood Group</label>
                <select class="form-control" id="bloodGroup" name="blood_group">
                    <option value="">-- Select Blood Group --</option>
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
        </div>

        <!-- Teacher Fields -->
        <div id="teacherFields" style="display: none;">
            <div class="mb-3">
                <label for="teacherId" class="form-label">Teacher ID</label>
                <input type="text" class="form-control" id="teacherId" name="teacher_id">
            </div>
            <div class="mb-3">
                <label for="bloodGroup" class="form-label">Blood Group</label>
                <select class="form-control" id="bloodGroup" name="blood_group">
                    <option value="">-- Select Blood Group --</option>
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
        </div>

        <!-- Admin Fields -->
        <div id="adminFields" style="display: none;">
            <!-- Admin fields will only have Full Name, Email, and Phone -->
            <!-- No need to repeat common fields here, as they are already included -->
        </div>

        <!-- Submit Button -->
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


<?php
// Connect to MySQL Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $user_type = $_POST['user_type'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($user_type == 'student') {
        $student_id = $_POST['student_id'];
        $department = $_POST['department'];
        $blood_group = $_POST['bloodGroup'];
        $father_name = $_POST['fatherName'];
        $father_phone = $_POST['fatherPhone'];
        $mother_name = $_POST['motherName'];
        $mother_phone = $_POST['motherPhone'];
        $guardian_name = $_POST['guardianName'];
        $guardian_phone = $_POST['guardian_Phone'];
        $guardian_relation = $_POST['guardianRelation'];

        // Insert into students table
        $sql = "INSERT INTO students (full_name, student_id, email, phone, department, blood_group, father_name, father_phone, mother_name, mother_phone, guardian_name, guardian_phone, guardian_relation, password) 
                VALUES ('$full_name', '$student_id', '$email', '$phone', '$department', '$blood_group', '$father_name', '$father_phone', '$mother_name', '$mother_phone', '$guardian_name', '$guardian_phone', '$guardian_relation', '$password')";
    } elseif ($user_type == 'teacher') {
        $teacher_id = $_POST['teacher_id'];
        $blood_group = $_POST['blood_group'];

        // Insert into teachers table
        $sql = "INSERT INTO teachers (full_name, teacher_id, email, phone, blood_group, password) 
                VALUES ('$full_name', '$teacher_id', '$email', '$phone', '$blood_group', '$password')";
    } elseif ($user_type == 'admin') {
        // Insert into admins table
        $sql = "INSERT INTO admins (full_name, email, phone, password) 
                VALUES ('$full_name', '$email', '$phone', '$password')";
    }

    // Execute query and check if it was successful
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
