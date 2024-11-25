<?php
// Start the session
require_once 'C:/xampp/htdocs/MYHMS/admin_session.php';

// Include the database connection file
require_once 'C:/xampp/htdocs/MYHMS/db_config.php';

// Check if the user is logged in
if (!isLoggedIn()) {
    // Redirect to the login page if not logged in
    redirectToLogin();
}

// Retrieve the user's information from the database
$userID = $_SESSION['user_id'];
$sql = "SELECT * FROM admin WHERE admin_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $userID]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if admin record exists
if (!$admin) {
    echo "Error: Admin record not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <!-- Include navigation bar -->
    <?php include('C:\xampp\htdocs\MYHMS\Admin\nav.php'); ?>

    <main>
        <div class="container mt-4">
            <h1>Admin Profile</h1>
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="profile-photo text-center">
                        <?php if (!empty($admin['photo'])) : ?>
                            <img src="<?php echo htmlspecialchars($admin['photo']); ?>" alt="Profile Photo" class="img-fluid rounded-circle">
                        <?php else : ?>
                            <i class="bi bi-person-circle" style="font-size: 10rem; color: #6c757d;"></i> <!-- Default icon -->
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="profile-info">
                        <p><strong>Full Name:</strong> <?php echo htmlspecialchars($admin['full_name']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($admin['email']); ?></p>
                        <p><strong>Phone:</strong> <?php echo htmlspecialchars($admin['phone']); ?></p>
                        <p><strong>Account Created At:</strong> <?php echo htmlspecialchars($admin['created_at']); ?></p>
                        <!-- Add more profile fields as needed -->
                    </div>
                </div>
            </div>
            <div class="profile-actions mt-4 text-center">
                <a href="change_password.php" id="changePasswordBtn" class="btn btn-primary">Change Password</a>
                <a href="edit_profile.php" id="editProfileBtn" class="btn btn-secondary">Edit Profile</a>
                
            </div>
        </div>
    </main>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
