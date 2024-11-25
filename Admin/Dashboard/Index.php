<?php
$servername = "localhost";  // Database server
$username = "root";         // Database username (default: root)
$password = "";             // Database password (default: empty)
$dbname = "hms_database";   // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query for total counts of students, teachers, and admins
$total_students_query = "SELECT COUNT(*) AS total FROM student";
$total_teachers_query = "SELECT COUNT(*) AS total FROM teacher";
$total_admins_query = "SELECT COUNT(*) AS total FROM admin";

// Query for pending registration requests
$pending_student_requests_query = "SELECT COUNT(*) AS total FROM student_registration_request WHERE status = 'pending'";
$pending_teacher_requests_query = "SELECT COUNT(*) AS total FROM teacher_registration_request WHERE status = 'pending'";
$pending_admin_requests_query = "SELECT COUNT(*) AS total FROM admin_registration_request WHERE status = 'pending'";

// Execute queries and check for errors
$total_students_result = $conn->query($total_students_query);
$total_teachers_result = $conn->query($total_teachers_query);
$total_admins_result = $conn->query($total_admins_query);
$pending_student_requests_result = $conn->query($pending_student_requests_query);
$pending_teacher_requests_result = $conn->query($pending_teacher_requests_query);
$pending_admin_requests_result = $conn->query($pending_admin_requests_query);

// Fetch the results
$total_students = $total_students_result->fetch_assoc()['total'];
$total_teachers = $total_teachers_result->fetch_assoc()['total'];
$total_admins = $total_admins_result->fetch_assoc()['total'];
$student_requests_count = $pending_student_requests_result->fetch_assoc()['total'];
$teacher_requests_count = $pending_teacher_requests_result->fetch_assoc()['total'];
$admin_requests_count = $pending_admin_requests_result->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users Dashboard</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJv+MzR1EJH0cYwLk+a+VjmH2V3g0RxCjATs4+a9jFv2O49pzp9EmK0XQHRl" crossorigin="anonymous">
    <!-- Font Awesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9f7ef; /* Light greenish background */
            background-image: url('https://www.transparenttextures.com/patterns/circuit-board.png'); /* Subtle background texture */
            background-repeat: repeat;
        }
        .manage-user-page {
            max-width: 1200px;
            margin: 50px auto;
            padding: 40px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .card {
            cursor: pointer;
            transition: transform 0.3s ease;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card-content {
            text-align: center;
            padding: 30px;
        }
        .card h3 {
            color: #1a7f43; /* Greenish color */
        }
        .card p {
            font-size: 1.6rem;
            font-weight: bold;
            color: #1a7f43; /* Greenish color */
        }
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 20px;
        }
        .card i {
            font-size: 3rem;
            color: #1a7f43; /* Greenish icon color */
        }
        .manage-user-page h2 {
            font-family: 'Arial', sans-serif;
            color: #27ae60; /* Darker green for headings */
        }

        
    </style>
</head>
<body>
    <?php include('C:\xampp\htdocs\MYHMS\Admin\nav.php'); ?>
    <main  >
    <div class="manage-user-page">
        <h2 class="text-center">Total Users</h2>
        <div class="card-grid">

             <!-- Card for Students -->
             <div class="card bg-light border-success" onclick="window.location.href='manage_students.php'">
                <div class="card-content">
                    <i class="fas fa-user-graduate"></i> <!-- Student Icon -->
                    <h3>Total Students</h3>
                    <p><?php echo $total_students; ?></p>
                </div>
            </div>

            <!-- Card for Teachers -->
            <div class="card bg-light border-success" onclick="window.location.href='manage_teachers.php'">
                <div class="card-content">
                    <i class="fas fa-chalkboard-teacher"></i> <!-- Teacher Icon -->
                    <h3>Total Teachers</h3>
                    <p><?php echo $total_teachers; ?></p>
                </div>
            </div>

            <!-- Card for Admins -->
            <div class="card bg-light border-success" onclick="window.location.href='manage_admins.php'">
                <div class="card-content">
                    <i class="fas fa-users-cog"></i> <!-- Admin Icon -->
                    <h3>Total Admins</h3>
                    <p><?php echo $total_admins; ?></p>
                </div>
            </div>

            
    </div>
    </main>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb3jzI8j4G1dF1Bv1r2J0ZjA4yjs5u3/5g3rCjmHU3X8SxJXZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-c5h8w57w9f3h5jbGfmGS8gQOpFpKxZT6D0pv5ghWlmBZXt9Jvn6rqa8dFq7VxuJfb" crossorigin="anonymous"></script>

</body>
</html>
