<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms_database";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Pagination settings
$rows_per_page = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $rows_per_page;

// Count total rows
$count_query = "SELECT COUNT(*) AS total FROM teacher";
$count_result = mysqli_query($conn, $count_query);
$count_row = mysqli_fetch_assoc($count_result);
$total_rows = $count_row['total'];

$total_pages = ceil($total_rows / $rows_per_page);

// Fetch teacher data for the current page
$query = "SELECT * FROM teacher LIMIT $offset, $rows_per_page";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Teachers</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
</head>
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
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h3>Manage Teachers</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Teacher ID</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($teacher = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= $teacher['full_name'] ?></td>
                                <td><?= $teacher['teacher_id'] ?></td>
                                <td><?= $teacher['email'] ?></td>
                                <td><?= $teacher['phone'] ?></td>
                                <td><?= $teacher['department'] ?></td>
                                <td>
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#updateModal" 
                                        data-id="<?= $teacher['teacher_id'] ?>" 
                                        data-name="<?= $teacher['full_name'] ?>" 
                                        data-email="<?= $teacher['email'] ?>" 
                                        data-phone="<?= $teacher['phone'] ?>" 
                                        data-department="<?= $teacher['department'] ?>">
                                        <i class="fas fa-edit"></i> Update
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" 
                                        data-id="<?= $teacher['teacher_id'] ?>">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center">No teachers found</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
                    </li>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
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
            <form action="update_teacher.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update teacher Information</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="teacher_id" id="update_teacher_id">
                    <div class="form-group">
                        <label for="update_full_name">Full Name</label>
                        <input type="text" class="form-control" id="update_full_name" name="full_name" required>
                    </div>
                    <div class="form-group">
                        <label for="update_email">Email</label>
                        <input type="email" class="form-control" id="update_email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="update_phone">Phone</label>
                        <input type="text" class="form-control" id="update_phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="update_department">Department</label>
                        <input type="text" class="form-control" id="update_department" name="department" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="delete_teacher.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this teacher record?
                    <input type="hidden" name="teacher_id" id="delete_teacher_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Pass data to modals
    $('#updateModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        $('#update_teacher_id').val(button.data('id'));
        $('#update_full_name').val(button.data('name'));
        $('#update_email').val(button.data('email'));
        $('#update_phone').val(button.data('phone'));
        $('#update_department').val(button.data('department'));
    });

    $('#deleteModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        $('#delete_teacher_id').val(button.data('id'));
    });
</script>
</body>
</html>
