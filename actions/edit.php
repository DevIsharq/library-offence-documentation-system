<?php
    include '../backend/connection.php';

    $update = false;

    if(isset($_GET['edit'])){
        $id = $_GET['edit'];

        $update = true;

        $sql = "SELECT * FROM users WHERE id = $id";
        $req = $conn->query($sql);
        $res = mysqli_fetch_assoc($req);

    }



    if(isset($_GET['edit_books'])) {
        $book_id = $_GET['edit_books'];

        $update = true;

        $book_query = "SELECT * FROM books WHERE id = $book_id";
        $book_req = $conn->query($book_query);
        $book_res = mysqli_fetch_assoc($book_req);
    }
?>