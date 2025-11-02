<?php
include '../backend/connection.php';

// Fix: Use the correct date column from the 'offenses' table
$sql = "
    SELECT 
        'Offense' AS record_type, 
        student_name, 
        student_reg_no, 
        book_title, 
        offense_type, 
        fines, 
        status, 
        offense_date AS record_date,  -- Change 'date' to 'offense_date' (or the correct column name)
        NULL AS book_id, NULL AS author, NULL AS isbn, NULL AS publication_year, NULL AS borrow_date, NULL AS return_date, NULL AS action
    FROM offenses 
    WHERE status = 'unpaid'
    
    UNION ALL
    
    SELECT 
        'Borrow' AS record_type, 
        NULL AS student_name, 
        student_reg_no, 
        NULL AS book_title, 
        NULL AS offense_type, 
        NULL AS fines, 
        status, 
        borrow_date AS record_date,
        book_id, author, isbn, publication_year, borrow_date, return_date, action
    FROM add_borrow 
    WHERE status = 'unpaid'
    
    ORDER BY record_date DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unpaid Records</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Unpaid Offenses & Borrowed Books</h2>
    <table>
        <thead>
            <tr>
                <th>Type</th>
                <th>Student Name</th>
                <th>Registration No.</th>
                <th>Book Title</th>
                <th>Offense Type</th>
                <th>Fines</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Publication Year</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Action</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0) : ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= htmlspecialchars($row['record_type']); ?></td>
                        <td><?= htmlspecialchars($row['student_name'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($row['student_reg_no']); ?></td>
                        <td><?= htmlspecialchars($row['book_title'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($row['offense_type'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($row['fines'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($row['author'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($row['isbn'] ?? '-'); ?></td>
                        <td><?= $row['publication_year'] ?? '-'; ?></td>
                        <td><?= htmlspecialchars($row['borrow_date'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($row['return_date'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($row['action'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($row['status']); ?></td>
                        <td><?= htmlspecialchars($row['record_date']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else : ?>
                <tr><td colspan="14">No unpaid records found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>