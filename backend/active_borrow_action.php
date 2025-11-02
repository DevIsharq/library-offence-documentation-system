<?php
    include 'connection.php';

    $id = $_GET['id'];
    $status = $_GET['action'];

    $update_action = "UPDATE add_borrow SET `action` = $status WHERE `id` = $id";
    
    $req = $conn->query($update_action);

    header('Location: ../frontend/view_borrow_books');

    ?>