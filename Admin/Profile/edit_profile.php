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

// Handle form submission for profile editing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_SESSION['user_id'];
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Handle the profile picture upload
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
        $fileTmpPath = $_FILES['profile_pic']['tmp_name'];
        $fileName = $_FILES['profile_pic']['name'];
        $fileSize = $_FILES['profile_pic']['size'];
        $fileType = $_FILES['profile_pic']['type'];
        $fileNameCmps = explode('.', $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Set allowed file extensions
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileExtension, $allowedExtensions)) {
            // Define a new name for the file
            $newFileName = 'profile_' . $userID . '.' . $fileExtension;

            // Directory where images will be stored
            $uploadDir = 'uploads/profile_pics/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Full path to save the image
            $uploadFilePath = $uploadDir . $newFileName;

            // Move the uploaded file to the server's folder
            if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
                // Save the image path in the database
                $sql = "UPDATE admin SET full_name = :full_name, email = :email, phone = :phone, profile_pic = :profile_pic WHERE admin_id = :user_id";
                $stmt = $pdo->prepare($sql);
                $update = $stmt->execute([
                    'full_name' => $fullName,
                    'email' => $email,
                    'phone' => $phone,
                    'profile_pic' => $uploadFilePath,
                    'user_id' => $userID
                ]);

                if ($update) {
                    $success = "Profile updated successfully.";
                } else {
                    $error = "Failed to update profile. Please try again.";
                }
            } else {
                $error = "There was an error uploading the file.";
            }
        } else {
            $error = "Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        // If no profile picture is uploaded, update only other details
        $sql = "UPDATE admin SET full_name = :full_name, email = :email, phone = :phone WHERE admin_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $update = $stmt->execute([
            'full_name' => $fullName,
            'email' => $email,
            'phone' => $phone,
            'user_id' => $userID
        ]);

        if ($update) {
            $success = "Profile updated successfully.";
        } else {
            $error = "Failed to update profile. Please try again.";
        }
    }
}

// Retrieve the user's information from the database
$userID = $_SESSION['user_id'];
$sql = "SELECT * FROM admin WHERE admin_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $userID]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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

        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 20px 0;
        }
    </style>
</head>

<body>

<main>
    <div class="container mt-5 d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card p-4" style="width: 100%; max-width: 500px;">
            <h2 class="text-center text-success">Edit Profile</h2>
            <?php if ($error) : ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php elseif ($success) : ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            <form method="POST" enctype="multipart/form-data">
                <div class="text-center">
                    <!-- Display current profile picture or default if none exists -->
                    <?php if (!empty($admin['profile_pic'])) : ?>
                        <img src="<?php echo $admin['profile_pic']; ?>" class="profile-img" alt="Profile Picture">
                    <?php else : ?>
                        <img src="https://via.placeholder.com/150" class="profile-img" alt="Profile Picture">
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $admin['full_name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $admin['email']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $admin['phone']; ?>" required>
                </div>

                <!-- File input for profile picture -->
                <div class="mb-3">
                    <label for="profile_pic" class="form-label">Profile Picture</label>
                    <input type="file" class="form-control" id="profile_pic" name="profile_pic" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary w-100">Update Profile</button>
            </form>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
