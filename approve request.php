<?php
require 'db_connection.php';

// Fetch pending registration requests
$sql = "SELECT * FROM registration_requests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<thead><tr><th>Role</th><th>Full Name</th><th>User ID</th><th>Email</th><th>Phone</th><th>Actions</th></tr></thead><tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['role']}</td>
                <td>{$row['full_name']}</td>
                <td>{$row['user_id']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>
                    <form method='POST' action='approve_request.php'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button type='submit' class='btn btn-success' name='approve_request'>Approve</button>
                    </form>
                </td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "No pending requests.";
}

$conn->close();
?>
