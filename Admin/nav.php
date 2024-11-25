
<?php
// Get the current script filename
$currentFile = $_SERVER["PHP_SELF"];

// Get the directory structure
$directories = explode("/", $currentFile);

// Get the last directory, which will be the active page
$activePage = end($directories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
       /* Global styles */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f9f5; /* Light greenish background for the body */
}

/* Header styles */
header {
    background-color: #2d6a4f; /* Dark green header */
    color: white;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

header h1 {
    margin: 0;
    margin-left: 220px;
    font-size: 1.8rem;
    font-weight: bold;
}

header p {
    margin: 0;
    padding: 0;
    margin-left: 220px;
    font-size: 1rem;
}

/* Footer styles */
footer {
    background-color: #2d6a4f; /* Same green as the header */
    color: white;
    padding: 1.5rem;
    box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
}

footer p {
    margin: 0;
    padding: 0;
    margin-left: 220px;
}

/* Sidebar (Navigation) styles */
nav {
    background-color: #1b4332; /* Darker green for the sidebar */
    color: white;
    position: fixed;
    top: 0;
    left: 0;
    width: 220px;
    height: 100%;
    overflow-y: auto;
    box-shadow: 2px 0 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease; /* Smooth transition for hover and active states */
}

nav #nav-wrapper {
    height: 100%;
}

nav #nav-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
}

nav li {
    margin-top: 1.5rem;
}

nav a {
    color: white;
    text-decoration: none;
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 1.1rem;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

nav a:hover {
    background-color: #38b000; /* Lighter green on hover */
    color: white;
}

nav a.active {
    background-color: #2d6a4f; /* Active menu item has darker green */
    color: yellow; /* Active text color */
}

/* Main content area */
main {
    padding: 2rem;
    margin-left: 220px; /* Adjusted to fit the sidebar */
    background-color: #ffffff;
    min-height: 100vh;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    transition: margin-left 0.3s ease; /* Smooth transition for the content layout */
}

main h1 {
    color: #2d6a4f; /* Green color for main headings */
    font-size: 2rem;
    font-weight: bold;
}

main h2 {
    color: #1b4332; /* Dark green color for secondary headings */
    font-size: 1.5rem;
}

main p {
    color: #555;
    font-size: 1rem;
}

/* Additional styling for smooth user experience */
a {
    text-decoration: none;
}

button {
    background-color: #38b000;
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #2d6a4f; /* Darker green when hovered */
}

/* Responsive Design */
@media (max-width: 768px) {
    nav {
        width: 100%;
        height: auto;
        position: relative;
    }
    main {
        margin-left: 0;
    }
    header h1, header p, footer p {
        margin-left: 10px;
    }
}

    </style>
</head>
<body>

<!-- Sidebar Navigation -->
<nav class="bg-dark text-white">
    <div id="nav-wrapper" class="d-flex flex-column">
        <ul class="list-unstyled m-0 p-0">
            <li><a href="http://localhost/MYHMS/Admin/Dashboard/" class="nav-link <?php if($activePage == 'Dashboard') echo 'active'; ?>"><span class="material-icons">home</span>Dashboard</a></li>
            <li><a href="http://localhost/MYHMS/Admin/Manage User/" class="nav-link <?php if($activePage == 'ManageUser') echo 'active'; ?>"><span class="material-icons">group</span>Manage User</a></li>
            <li><a href="http://localhost/MYHMS/Admin/Meal Management/" class="nav-link <?php if($activePage == 'MealManagement') echo 'active'; ?>"><span class="material-icons">restaurant</span>Meal Management</a></li>
            <li><a href="http://localhost/MYHMS/Admin/Notice Board/" class="nav-link <?php if($activePage == 'NoticeBoard') echo 'active'; ?>"><span class="material-icons">announcement</span>Notice Board</a></li>
            <li><a href="http://localhost/MYHMS/Admin/Notifications/" class="nav-link <?php if($activePage == 'Notifications') echo 'active'; ?>"><span class="material-icons">notifications</span>Notifications</a></li>
            <li><a href="http://localhost/MYHMS/Admin/Payments/" class="nav-link <?php if($activePage == 'Payments') echo 'active'; ?>"><span class="material-icons">payment</span>Payments</a></li>
            <li><a href="http://localhost/MYHMS/Admin/Profile/" class="nav-link <?php if($activePage == 'Profile') echo 'active'; ?>"><span class="material-icons">person</span>Profile</a></li>
            <li><a href="http://localhost/MYHMS/Admin/Settings/" class="nav-link <?php if($activePage == 'Settings') echo 'active'; ?>"><span class="material-icons">settings</span>Settings</a></li>
            <li><a href="http://localhost/MYHMS/Admin/Logout/" class="nav-link <?php if($activePage == 'Logout') echo 'active'; ?>"><span class="material-icons">logout</span>Logout</a></li>

        </ul>
    </div>
</nav>

<!---

<header>
    <div class="container">
        <h1>Welcome to the Hall Management System</h1>
        <p>Select an option from the sidebar to begin managing your hall.</p>
        
        <?php if ($activePage == 'Dashboard') { ?>
            <h2>Dashboard Overview</h2>
            <p>This is the dashboard section where key stats will be shown.</p>
        <?php } elseif ($activePage == 'Manage User') { ?>
            <h2>Manage Users</h2>
            <p>This is where you can manage user registrations and their data.</p>
        <?php } elseif ($activePage == 'Meal Management') { ?>
            <h2>Meal Management</h2>
            <p>Here you can manage meal plans and preferences.</p>
        <?php } elseif ($activePage == 'Notice Board') { ?>
            <h2>Notice Board</h2>
            <p>View and manage important notices for the hall.</p>
        <?php } elseif ($activePage == 'Notifications') { ?>
            <h2>Notifications</h2>
            <p>Manage and send notifications to users.</p>
        <?php } elseif ($activePage == 'Payments') { ?>
            <h2>Payments</h2>
            <p>Track and manage payments.</p>
        <?php } elseif ($activePage == 'Profile') { ?>
            <h2>Your Profile</h2>
            <p>Edit your profile details here.</p>
        <?php } elseif ($activePage == 'Settings') { ?>
            <h2>Settings</h2>
            <p>Modify hall management system settings.</p>
        <?php } ?>
    </div>
</header>
        -->

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
