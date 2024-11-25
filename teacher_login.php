<?php
session_start(); // Start the session

// Include the session file
require_once 'C:/xampp/htdocs/MYHMS/teacher_session.php';

// Check if the user is already logged in, if yes, redirect to dashboard
if (isLoggedIn()) {
    redirectToDashboard();
}

// Include the database connection file
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if email and password are set
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Retrieve email and password from the form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare and execute the SQL query to fetch teacher data by email
        $sql = "SELECT * FROM teachers WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and password matches
        if ($user && password_verify($password, $user['password'])) {
            // Authentication successful
            // Set session variables to store user data
            $_SESSION['user_id'] = $user['teacher_id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = 'teacher';  // Role identification for teacher

            // Redirect the user to the teacher dashboard
            header('Location: Teacher/Dashboard/index.php');
            exit;
        } else {
            // Authentication failed
            // Redirect back to the login page with an error message
            header('Location: teacher_login.php?error=1');
            exit;
        }
    }
}
?>
