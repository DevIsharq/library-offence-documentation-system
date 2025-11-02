<?php
    include 'connection.php';
    
    $id = $_GET['id'];
    $status = $_GET['status'];
    
    $update_status = "UPDATE add_borrow SET `status` = $status WHERE `id` = $id";
    
    $req = $conn->query($update_status);
    
    header('Location: ../frontend/view_borrow_books');


?>