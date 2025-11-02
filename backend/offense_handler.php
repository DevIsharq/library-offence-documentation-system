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
include 'connection.php';

if (isset($_POST['add_offense_btn'])) {
    $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $student_reg_no = mysqli_real_escape_string($conn, $_POST['student_reg_no']);
    $offense_type = mysqli_real_escape_string($conn, $_POST['offense_type']);
    $book_title = mysqli_real_escape_string($conn, $_POST['book_title']);
    $fines = mysqli_real_escape_string($conn, $_POST['fines']);

    $query_offense = "INSERT INTO offenses (`student_name`, `student_reg_no`, `book_title`, `offense_type`, `fines`) VALUES ('$student_name', '$student_reg_no', '$book_title', '$offense_type', '$fines')";

    if (mysqli_query($conn, $query_offense)) {
        echo "
            <script>
                swal.fire('Recorded', 'Offense Recorded Successfully', 'success')
                .then(function(result){
                if(result){
                    window.location='../frontend/manage_offenses';
            }});
            </script>
            ";
        }else{
            echo "
            <script>
                swal.fire('Failed', 'Failed to Recorded Offense', 'error');
            </script>
        ";
    }

}
?>