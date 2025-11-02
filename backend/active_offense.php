<?php
    include 'connection.php';

    if (isset($_GET['id']) && isset($_GET['status'])) {
        $id = intval($_GET['id']); // Convert ID to an integer to prevent SQL injection
        $status = mysqli_real_escape_string($conn, $_GET['status']); // Escape status string

        // Ensure status is quoted if it's a string
        $update_status = "UPDATE offenses SET `status` = '$status' WHERE `id` = $id";

        if (mysqli_query($conn, $update_status)) {
            header('Location: ../frontend/manage_offenses'); // Corrected URL
            exit(); // Ensure script stops after redirect
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid request. Missing parameters.";
    }

    $conn->close(); // Close the connection
?>