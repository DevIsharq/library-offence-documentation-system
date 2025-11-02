<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../frontend/css/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
<body>
</body>
</html>

<?php
// Database connection
include 'connection.php';

if (isset($_POST['book_reg'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
    $publication_year = mysqli_real_escape_string($conn, $_POST['publication_year']);
    $total_copies = mysqli_real_escape_string($conn, $_POST['total_copies']);
    $available_copies = mysqli_real_escape_string($conn, $_POST['available_copies']);
     
    // Validate book form fields
    if (empty($title) || empty($author) || empty($isbn) || empty($publication_year) || empty($total_copies) || empty($available_copies)) {
        $_SESSION['error'] = 'All fields are required.';
        header('Location: ../frontend/manage_books');
        exit;
    }

    if (!is_numeric($publication_year) || !is_numeric($total_copies) || !is_numeric($available_copies)) {
        $_SESSION['error'] = "Invalid number format!";
        header("Location: ../frontend/manage_books");
        exit;
    }

    // Check for duplicate book (based on ISBN)
    $duplicate = "SELECT * FROM books WHERE isbn = ?";
    $stmt = $conn->prepare($duplicate);
    $stmt->bind_param('s', $isbn); // ISBN should be a string ('s')
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) { // Correct check for duplicate records
        $_SESSION['error'] = 'Book already exists.';
        header('Location: ../frontend/manage_books');
        exit;
    }

    // Insert book into the database
    $sql_book = "INSERT INTO books (`title`, `author`, `isbn`, `publication_year`, `total_copies`, `available_copies`) 
                 VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql_book);
    $stmt->bind_param('sssiii', $title, $author, $isbn, $publication_year, $total_copies, $available_copies); // 'sssiii' (ISBN is a string)

    if ($stmt->execute()) {
        echo "
        <script>
            Swal.fire('Done', 'Book Added Successfully', 'success')
            .then(function(result) {
                if (result) {
                    window.location = '../frontend/manage_books';
                }
            });
        </script>
        ";
    } else {
        echo "
        <script>
            Swal.fire('Failed', 'Failed to add book', 'error')
            .then(function(result) {
                if (result) {
                    window.location = '../frontend/manage_books';
                }
            });
        </script>
        ";
    }
}


    include "../actions/edit.php";
    // Update the books by admin
    if(isset($_POST['update_book_btn'])) {    
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $author = mysqli_real_escape_string($conn, $_POST['author']);
        $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
        $publication_year = mysqli_real_escape_string($conn, $_POST['publication_year']);
        $total_copies = mysqli_real_escape_string($conn, $_POST['total_copies']);
        $available_copies = mysqli_real_escape_string($conn, $_POST['available_copies']);

        if(empty($id) || empty($title) || empty($author) || empty($isbn) || empty($publication_year) || empty($total_copies) || empty($available_copies)) {
            $_SESSION['error'] = "All fields are required!";
            header("Location: ../frontend/manage_books");
            exit;
        }
    
        if (!is_numeric($publication_year) || !is_numeric($total_copies) || !is_numeric($available_copies)) {
            $_SESSION['error'] = "Invalid number format!";
            header("Location: ../frontend/manage_books");
            exit;
        }
    
        $books_update = "UPDATE `books` SET `title` = ?, `author` = ?, `isbn` = ?, `publication_year` = ?, `total_copies` = ?, `available_copies` = ? WHERE `id` = ?";
        $stmt = $conn->prepare($books_update);
    
        $stmt->bind_param('sssiiii', $title, $author, $isbn, $publication_year, $total_copies, $available_copies, $id);
    
        if($stmt->execute()) {
            echo "
            <script>
                Swal.fire('Updated', 'Book updated successfully', 'success')
                .then(() => {
                    window.location='../frontend/manage_books';
                });
            </script>
            ";
        } else {
            echo "
            <script>
                Swal.fire('Failed', 'Failed to update book', 'error');
            </script>
            ";
        }
        $stmt->close();
        $conn->close();
    }
?>