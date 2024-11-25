<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $request_id = $_GET['id'];

    // Start transaction
    $conn->begin_transaction();

    try {
        // First, get the teacher registration request details
        $query = "SELECT * FROM teacher_registration_request WHERE request_id = '$request_id' AND status = 'pending'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Insert into the teacher table
            $insert_query = "INSERT INTO teacher (full_name, teacher_id, department, email, phone, blood_group, profile_picture, password)
                             VALUES ('" . $row['full_name'] . "', '" . $row['teacher_id'] . "', '" . $row['department'] . "', '" . $row['email'] . "', '" . $row['phone'] . "', '" . $row['blood_group'] . "', '" . $row['profile_picture'] . "', '" . $row['password'] . "')";

            if ($conn->query($insert_query) === TRUE) {
                // Update the status to 'approved'
                $update_query = "UPDATE teacher_registration_request SET status='approved' WHERE request_id='$request_id'";

                if ($conn->query($update_query) === TRUE) {
                    $conn->commit(); // Commit the transaction
                    echo "Teacher registration approved and data saved.";
                } else {
                    $conn->rollback(); // Rollback the transaction in case of failure
                    echo "Error updating status: " . $conn->error;
                }
            } else {
                $conn->rollback(); // Rollback the transaction in case of failure
                echo "Error inserting teacher data: " . $conn->error;
            }
        } else {
            echo "No pending teacher request found with that ID.";
        }
    } catch (Exception $e) {
        $conn->rollback(); // Rollback the transaction in case of any error
        echo "Error: " . $e->getMessage();
    }
}

// Close the connection
$conn->close();
?>
