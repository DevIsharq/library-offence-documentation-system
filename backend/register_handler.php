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
// Include the database connection file
include 'connection.php';


// Check if the form was submitted
if (isset($_POST['reg_btn']))  {
    // Retrieve form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Validate form fields
    if (empty($name) || empty($phone) || empty($email) || empty($password) || empty($confirmPassword)) {
        $_SESSION['error'] = 'All fields are required.';
        header('Location: register');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email format.';
        header('Location: register');
        exit;
    }

    if ($password !== $confirmPassword) {
        $_SESSION['error'] = 'Passwords do not match.';
        header('Location: register');
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Check if the email already exists
    $checkQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $_SESSION['error'] = 'Email already exists.';
        header('Location: register');
        exit;
    }

    // Insert the user into the database
    $query = "INSERT INTO users (`name`, `phone`, `email`, `password`, `role`) VALUES ('$name', '$phone', '$email', '$hashedPassword', '$role')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = 'Registration successful. You can now log in.';
        header('Location: ../frontend/login');
        exit;
    } else {
        $_SESSION['error'] = 'Registration failed. Please try again.';
        header('Location: register');
        exit;
    }
}

if (isset($_POST['reg_btn_add']))  {
    // Retrieve form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Validate form fields
    if (empty($name) || empty($phone) || empty($email) || empty($password) || empty($confirmPassword)) {
        $_SESSION['error'] = 'All fields are required.';
        header('Location: ../frontend/manage_users');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email format.';
        header('Location: ../frontend/manage_users');
        exit;
    }

    if ($password !== $confirmPassword) {
        $_SESSION['error'] = 'Passwords do not match.';
        header('Location: ../frontend/manage_users');
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Check if the email already exists
    $checkQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $_SESSION['error'] = 'Email already exists.';
        header('Location: ../frontend/manage_users');
        exit;
    }

    // Insert the user into the database
    $query = "INSERT INTO users (`name`, `phone`, `email`, `password`, `role`) VALUES ('$name', '$phone', '$email', '$hashedPassword', '$role')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = 'Registration successful. You can now log in.';
        header('Location: ../frontend/manage_users');
        exit;
    } else {
        $_SESSION['error'] = 'Registration failed. Please try again.';
        header('Location: ../frontend/manage_users');
        exit;
    }
}



include '../actions/edit.php';
// Update the users by admin 
if(isset($_POST['update_user_btn'])) {
    $id = mysqli_real_escape_string($conn, $_POST['hidden']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

 
    $sql_update = "UPDATE users SET `name` = ?, `phone` = ?, `email` = ?, `password` = ?, `role` = ? WHERE id = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param('sssssi', $name, $phone, $email, $password, $role, $id);
    
    if($stmt->execute()){
        echo "
            <script>
                swal.fire('Updated', 'User updated Successfully', 'success')
                .then(function(result){
                if(result){
                    window.location='../frontend/manage_users';
            }});
            </script>
        ";
    }else{
        echo "
        <script>
            swal.fire('Failed', 'Failed to updated User', 'error');
        </script>
    ";
    }
    $stmt->close();
    $conn->close();
}