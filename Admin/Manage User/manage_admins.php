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

// Fetch admins data from database
$query = "SELECT * FROM admin";  // Assuming an 'admins' table exists
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));  // Display error if query fails
}

// Pagination settings
$rows_per_page = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $rows_per_page;

// Count total rows
$count_query = "SELECT COUNT(*) AS total FROM admin";
$count_result = mysqli_query($conn, $count_query);
$count_row = mysqli_fetch_assoc($count_result);
$total_rows = $count_row['total'];

$total_pages = ceil($total_rows / $rows_per_page);

// Fetch admin data for the current page
$query = "SELECT * FROM admin LIMIT $offset, $rows_per_page";
$result = mysqli_query($conn, $query);

// Check if there are any admins
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admins</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f8f4; /* Light greenish background */
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
            background-color: #28a745; /* Green header */
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
            background-color: #28a745; /* Green table header */
            color: white;
        }
        .table tbody tr:hover {
            background-color: #dff0d8; /* Light green on hover */
            cursor: pointer;
        }
        .btn-update, .btn-delete {
            border-radius: 50px;
            font-size: 14px;
            padding: 8px 20px;
            transition: all 0.3s ease-in-out;
        }
        .btn-update {
            background-color: #28a745; /* Green update button */
            color: white;
        }
        .btn-update:hover {
            background-color: #218838; /* Darker green for hover */
        }
        .btn-delete {
            background-color: #dc3545; /* Red delete button */
            color: white;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    
    <div class="card">
        <div class="card-header">
            <h3>Manage Admins</h3>
        </div>
        <div class="card-body">
            <!-- Table for admins -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Admin ID</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch admin data for the current page
                    if (mysqli_num_rows($result) > 0) {
                        while ($admin = mysqli_fetch_assoc($result)) {
                            echo "
                            <tr>
                                <td>{$admin['full_name']}</td>
                                <td>{$admin['admin_id']}</td>
                                <td>{$admin['email']}</td>
                                <td>{$admin['phone']}</td>
                                <td class='text-center'>
                                    <button class='btn btn-update btn-sm' data-toggle='modal' data-target='#updateModal' 
                                            data-id='{$admin['admin_id']}' 
                                            data-name='{$admin['full_name']}' 
                                            data-email='{$admin['email']}' 
                                            data-phone='{$admin['phone']}'>
                                        <i class='fas fa-edit'></i> Update
                                    </button>
                                    <button class='btn btn-delete btn-sm' data-toggle='modal' data-target='#deleteModal' 
                                            data-id='{$admin['admin_id']}' >
                                        <i class='fas fa-trash'></i> Delete
                                    </button>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No admins found</td></tr>";
                    }

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

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Admin Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="update_admin.php" method="POST">
                    <!-- Hidden input for admin ID -->
                    <input type="hidden" name="admin_id" id="update_admin_id">

                    <!-- Admin Full Name -->
                    <div class="form-group">
                        <label for="update_full_name">Full Name</label>
                        <input type="text" class="form-control" id="update_full_name" name="full_name" required>
                    </div>

                    <!-- Admin Email -->
                    <div class="form-group">
                        <label for="update_email">Email</label>
                        <input type="email" class="form-control" id="update_email" name="email" required>
                    </div>

                    <!-- Admin Phone -->
                    <div class="form-group">
                        <label for="update_phone">Phone</label>
                        <input type="text" class="form-control" id="update_phone" name="phone" required>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this admin record?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" action="delete_admin.php" method="POST">
                    <input type="hidden" name="admin_id" id="admin_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.10/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Fill update modal with current admin data
    $('#updateModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var adminId = button.data('id');
        var fullName = button.data('name');
        var email = button.data('email');
        var phone = button.data('phone');
        
        // Set values in modal fields
        $('#update_admin_id').val(adminId);
        $('#update_full_name').val(fullName);
        $('#update_email').val(email);
        $('#update_phone').val(phone);
    });

    // Fill delete modal with admin ID
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var adminId = button.data('id');
        $('#admin_id').val(adminId);
    });
</script>

</body>
</html>
