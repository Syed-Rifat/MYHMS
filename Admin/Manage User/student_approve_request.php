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
        // First, get the student registration request details
        $query = "SELECT * FROM student_registration_request WHERE request_id = '$request_id' AND status = 'pending'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Insert into the student table
            $insert_query = "INSERT INTO student (full_name, student_id_number, department, email, phone, blood_group, father_name, father_phone, mother_name, mother_phone, guardian_name, guardian_phone, guardian_relation, profile_picture, password)
                             VALUES ('" . $row['full_name'] . "', '" . $row['student_id_number'] . "', '" . $row['department'] . "', '" . $row['email'] . "', '" . $row['phone'] . "', '" . $row['blood_group'] . "', '" . $row['father_name'] . "', '" . $row['father_phone'] . "', '" . $row['mother_name'] . "', '" . $row['mother_phone'] . "', '" . $row['guardian_name'] . "', '" . $row['guardian_phone'] . "', '" . $row['guardian_relation'] . "', '" . $row['profile_picture'] . "', '" . $row['PASSWORD'] . "')";
            
            if ($conn->query($insert_query) === TRUE) {
                // Update the status to 'approved'
                $update_query = "UPDATE student_registration_request SET status='approved' WHERE request_id='$request_id'";

                if ($conn->query($update_query) === TRUE) {
                    $conn->commit(); // Commit the transaction
                    echo "Student registration approved and data saved.";
                } else {
                    $conn->rollback(); // Rollback the transaction in case of failure
                    echo "Error updating status: " . $conn->error;
                }
            } else {
                $conn->rollback(); // Rollback the transaction in case of failure
                echo "Error inserting student data: " . $conn->error;
            }
        } else {
            echo "No pending request found with that ID.";
        }
    } catch (Exception $e) {
        $conn->rollback(); // Rollback the transaction in case of any error
        echo "Error: " . $e->getMessage();
    }
}

// Close the connection
$conn->close();
?>
