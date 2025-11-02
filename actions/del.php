<?php
    include '../backend/connection.php';
    // Function to delete a User
    if(isset($_GET['del'])){
        $id = $_GET['del'];

        $sql = "DELETE FROM users WHERE id = $id";

        $res = $conn->query($sql);

        if($res) {
            header("Location: ../frontend/manage_users");
        }
    }


    if(isset($_GET['bookdel'])) {
        $id = $_GET['bookdel'];

        $del = "DELETE FROM books WHERE id = $id";
        $req_del = $conn->query($del);
        if($req_del) {
            header("Location: ../frontend/manage_books");
        }
    }
?>