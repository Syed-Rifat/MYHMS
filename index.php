
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Add your custom styles here */
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Hall Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <!-- Add this to the navigation section -->
                    <li class="nav-item">
                        <a class="nav-link" href="register_request.php">Submit Registration Request</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Welcome to the Hall Management System</h2>
                <p class="lead">Please select your login mode:</p>
                <div class="mb-3">
                    <label class="form-label">Login As:</label>
                    <select class="form-select" id="loginMode" onchange="changeLoginForm()">
                        <option value="student">Student</option>
                        <option value="admin">Admin</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div>

                <!-- Student Login Form -->
                <form action="student_login.php" method="POST" id="studentLoginForm">
                    <div class="mb-3">
                        <label for="studentEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="studentEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="studentPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="studentPassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login as Student</button>

                    <p class="mt-3">Don't have an account? <a href="student_register.php">Register here</a></p>
                    <p class="mt-3">Forgot your password? <a href="student_forgot_password.php">Recover it here</a></p>
                </form>

                <!-- Admin Login Form -->
                <form action="admin_login.php" method="POST" class="d-none" id="adminLoginForm">
                    <div class="mb-3">
                        <label for="adminEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="adminEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="adminPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="adminPassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login as Admin</button>
                    <p class="mt-3">Don't have an account? <a href="admin_register.php">Register here</a></p>
                    <p class="mt-3">Forgot your password? <a href="admin_forgot_password.php">Recover it here</a></p>
                    
                </form>

                <!-- Teacher Login Form -->
                <form action="teacher_login.php" method="POST" class="d-none" id="teacherLoginForm">
                    <div class="mb-3">
                        <label for="teacherEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="teacherEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="teacherPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="teacherPassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login as Teacher</button>
                    <p class="mt-3">Don't have an account? <a href="teacher_register.php">Register here</a></p>
                    <p class="mt-3">Forgot your password? <a href="teacher_forgot_password.php">Recover it here</a></p>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function changeLoginForm() {
            var loginMode = document.getElementById("loginMode").value;
            document.getElementById("studentLoginForm").classList.add("d-none");
            document.getElementById("adminLoginForm").classList.add("d-none");
            document.getElementById("teacherLoginForm").classList.add("d-none");

            if (loginMode === "student") {
                document.getElementById("studentLoginForm").classList.remove("d-none");
            } else if (loginMode === "admin") {
                document.getElementById("adminLoginForm").classList.remove("d-none");
            } else if (loginMode === "teacher") {
                document.getElementById("teacherLoginForm").classList.remove("d-none");
            }
        }
    </script>

</body>

</html>
