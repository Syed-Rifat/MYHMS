<?php
// Start the session if needed (for login/logout functionality)
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Management System</title>

    <!-- Embedded CSS for Sidebar Navbar -->
    <style>
        /* Basic Styling */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            margin: 0;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #3A3A3A;
            color: white;
            height: 100vh;
            position: fixed;
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            font-size: 24px;
            background-color: #2C2C2C;
        }

        .nav-links {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .nav-links li {
            padding: 10px 20px;
        }

        .nav-links li a {
            color: white;
            text-decoration: none;
            display: block;
            font-size: 18px;
        }

        .nav-links li a:hover {
            background-color: #575757;
        }

        .nav-links li.active a {
            background-color: #4CAF50; /* Highlight active link */
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
            background-color: #f4f4f4;
        }

        .header {
            display: flex;
            justify-content: flex-end;
            padding: 20px;
        }

        .profile {
            display: flex;
            align-items: center;
        }

        .notification-bell {
            font-size: 20px;
            margin-right: 20px;
            cursor: pointer;
        }

        .profile-icon {
            background-color: #555;
            color: white;
            border-radius: 50%;
            padding: 10px;
            width: 40px;
            height: 40px;
            text-align: center;
            line-height: 40px;
            font-weight: bold;
            cursor: pointer;
        }

        table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: center;
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        /* Profile and Notification Icon */
        .profile-icon:hover, .notification-bell:hover {
            background-color: #777;
        }

        .notification-bell {
            font-size: 20px;
            margin-right: 20px;
            cursor: pointer;
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            My Hall
        </div>
        <ul class="nav-links">
            <li class="active"><a href="#">Dashboard</a></li> <!-- Active Link -->
            <li><a href="#">Profile</a></li>
            <li><a href="#">Manage User</a></li>
            <li><a href="#">Meal Management</a></li>
            <li><a href="#">Payment</a></li>
            <li><a href="#">Notice Board</a></li>
            <li><a href="#">Notifications</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="content">
        <!-- Header Section -->
        <div class="header">
            <div class="profile">
                <!-- Notification Bell Icon -->
                <div class="notification-bell">🔔</div>
                <!-- Profile Icon -->
                <div class="profile-icon">P</div>
            </div>
        </div>

        <!-- Main Content -->
        <h3>Welcome to the Hall Management System</h3>
        <p>This is the content of the Hall Management System dashboard.</p>

        <!-- Example Table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Room</th>
                    <th>Check-in</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>001</td>
                    <td>John Doe</td>
                    <td>101A</td>
                    <td>2024-11-01</td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>Jane Smith</td>
                    <td>102B</td>
                    <td>2024-11-02</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
