<?php
    include '../backend/connection.php';

    $update_books = false;

  if(isset($_GET['edit_books'])) {
    $book_id = $_GET['edit_books'];

    $update_books = true;
    
    $book_query = "SELECT * FROM books WHERE id = $book_id";
    $book_req = $conn->query($book_query);
    $book_res = mysqli_fetch_assoc($book_req);
}

?>