<?php
include '../backend/connection.php';

header('Content-Type: application/json'); // Ensure correct JSON response format

if (!isset($_GET['book_id'])) {
    echo json_encode(["error" => "Missing book_id parameter"]);
    exit;
}

$book_id = mysqli_real_escape_string($conn, $_GET['book_id']);

if ($book_id == 0) {
    echo json_encode(["error" => "Invalid book ID"]);
    exit;
}

$sql = "SELECT author, isbn, publication_year FROM books WHERE title = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["error" => "SQL prepare failed: " . $conn->error]);
    exit;
}

$stmt->bind_param("s", $book_id);
$stmt->execute();
$result = $stmt->get_result();

error_log("Fetching details for Book ID: " . $book_id); // Debugging log

if ($result->num_rows > 0) {
    $bookDetails = $result->fetch_assoc();
    echo json_encode($bookDetails);
} else {
    echo json_encode(["error" => "No book found for ID: " . $book_id]);
}

$stmt->close();
$conn->close();
?>