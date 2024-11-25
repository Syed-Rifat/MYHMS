<?php
// Start the session and include necessary files
require_once 'C:/xampp/htdocs/MYHMS/admin_session.php';
require_once 'C:/xampp/htdocs/MYHMS/db_config.php';

// Initialize error and success variables
$error = '';
$success = '';

// Check if the user is logged in
if (!isLoggedIn()) {
    redirectToLogin();
}

// Handle form submission for password change
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_SESSION['user_id'];
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Fetch the current password from the database
    $sql = "SELECT password FROM admin WHERE admin_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $userID]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($currentPassword, $admin['password'])) {
        // Check if the new password and confirm password match
        if ($newPassword === $confirmPassword) {
            // Update the password
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $updateSql = "UPDATE admin SET password = :new_password WHERE admin_id = :user_id";
            $updateStmt = $pdo->prepare($updateSql);
            $updateStmt->execute(['new_password' => $hashedPassword, 'user_id' => $userID]);

            $success = "Password changed successfully.";
        } else {
            $error = "New password and confirm password do not match.";
        }
    } else {
        $error = "Current password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eafaf1;
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        .btn-primary {
            background-color: #28a745;
            border: none;
        }
        .btn-primary:hover {
            background-color: #218838;
        }
        .form-label {
            color: #155724;
        }
    </style>
</head>

<body>
    <div class="container mt-5 d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card p-4" style="width: 100%; max-width: 500px;">
            <h2 class="text-center text-success">Change Password</h2>
            <?php if ($error) : ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php elseif ($success) : ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Change Password</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
