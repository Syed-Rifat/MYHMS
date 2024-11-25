<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pending Teacher Registration Requests</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #e8f5e9; /* Light green background */
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 30px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #388e3c; /* Dark green header */
            color: white;
            font-size: 1.5rem;
            border-radius: 10px 10px 0 0;
            padding: 15px;
            text-align: center;
        }
        .table {
            border-radius: 10px;
            background-color: #fff;
        }
        .table thead {
            background-color: #388e3c; /* Dark green header */
            color: white;
        }
        .table tbody tr:hover {
            background-color: #c8e6c9; /* Lighter green hover effect */
            cursor: pointer;
        }
        .btn-approve, .btn-reject {
            border-radius: 50px;
            font-size: 14px;
            padding: 8px 20px;
            transition: all 0.3s ease-in-out;
        }
        .btn-approve {
            background-color: #4caf50; /* Green approve button */
            color: white;
        }
        .btn-approve:hover {
            background-color: #388e3c; /* Darker green on hover */
        }
        .btn-reject {
            background-color: #f44336; /* Red reject button */
            color: white;
        }
        .btn-reject:hover {
            background-color: #d32f2f; /* Darker red on hover */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Pending Teacher Registration Requests</h3>
        </div>
        <div class="card-body">
            <!-- Table for teacher registration requests -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection settings
                    $servername = "localhost";  // Change as per your database server
                    $username = "root";         // Your MySQL username
                    $password = "";             // Your MySQL password
                    $dbname = "hms_database";   // Your database name

                    // Create connection
                    $conn = mysqli_connect($servername, $username, $password, $dbname);

                    // Check connection
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Pagination settings
                    $rows_per_page = 10;  // Number of rows per page
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;  // Get the current page, default to 1 if not set
                    $offset = ($page - 1) * $rows_per_page;  // Calculate the offset

                    // Query to count total number of pending requests
                    $count_query = "SELECT COUNT(*) AS total FROM teacher_registration_request WHERE STATUS = 'pending'";
                    $count_result = mysqli_query($conn, $count_query);
                    $count_row = mysqli_fetch_assoc($count_result);
                    $total_rows = $count_row['total'];

                    // Calculate total pages
                    $total_pages = ceil($total_rows / $rows_per_page);

                    // Query to fetch only the required rows for the current page
                    $query = "SELECT * FROM teacher_registration_request WHERE STATUS = 'pending' LIMIT $offset, $rows_per_page";
                    $result = mysqli_query($conn, $query);

                    // Check if there are any requests
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through each registration request
                        while ($request = mysqli_fetch_assoc($result)) {
                            echo "
                            <tr>
                                <td>{$request['full_name']}</td>
                                <td>{$request['email']}</td>
                                <td>{$request['phone']}</td>
                                <td>{$request['department']}</td>
                                <td class='text-center'>
                                    <a href='teacher_approve_request.php?id={$request['request_id']}' class='btn btn-approve btn-sm'>
                                        <i class='fas fa-check-circle'></i> Approve
                                    </a>
                                    <a href='teacher_reject_request.php?id={$request['request_id']}' class='btn btn-reject btn-sm'>
                                        <i class='fas fa-times-circle'></i> Reject
                                    </a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No pending registration requests</td></tr>";
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                    </li>
                    <?php
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<li class='page-item " . ($i == $page ? 'active' : '') . "'>
                                <a class='page-link' href='?page=$i'>$i</a>
                              </li>";
                    }
                    ?>
                    <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Bootstrap JS, jQuery, Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.5/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
