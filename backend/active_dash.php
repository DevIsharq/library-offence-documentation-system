<?php
    include 'connection.php';

    $id = $_GET['id'];
    $status = $_GET['status'];

    $updateQuery = "UPDATE books SET `status` = $status WHERE `id` = $id";
    
    $req = $conn->query($updateQuery);

    header('Location: ../frontend/dash');


?>