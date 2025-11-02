<?php
    include '../backend/init.php';
    include "../backend/register_handler.php";

    $name = "";
    $phone = "";
    $email = "";
    $password = "";
    // $confirmPassword = "";
    $role = "";

    include '../actions/edit.php';

    if($update == true) {
        $name = mysqli_real_escape_string($conn, $res['name']);
        $phone = mysqli_real_escape_string($conn, $res['phone']);
        $email = mysqli_real_escape_string($conn, $res['email']);
        $password = mysqli_real_escape_string($conn, $res['password']);
        $role = mysqli_real_escape_string($conn, $res['role']);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Library Offense System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body style="background-image:url(slider_background.jpg)">
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card shadow p-4" style="width: 400px;">
            <h2 class="text-center mb-4">Update</h2>

            <!-- Display success or error messages -->
            <?php
            // session_start();
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }
            ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <!-- <label for="name" class="form-label">Full Name:</label> -->
                    <input type="hidden" class="form-control" id="id" name="hidden" value="<?= $id ?>" placeholder="Enter Your Full Name" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>" placeholder="Enter Your Full Name" required>
                </div>
                <div class="mb-3">
                    <label for="number" class="form-label">Registration Number:</label>
                    <input type="text" class="form-control" id="number" name="phone" value="<?= $phone ?>" placeholder="Enter Your Phone Number" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" placeholder="Example@gmail.com" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?= $password ?>" placeholder="Enter Your Password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?= $confirmPassword ?>" placeholder="Re-enter Your Password" required>
                </div>
                <div class="mb-3">
                    <!-- <label for="role" class="form-label">Role</label> -->
                    <input type="hidden" class="form-control" value="<?= $role ?>" id="name" name="role" required>
                </div>
                <button type="submit" name="update_user_btn" class="btn btn-primary w-100">Update User</button>
                <p class="mt-3 text-center">
                    <!-- Already have an account? <a href="login.php">Login</a> -->
                </p>
            </form>
        </div>
    </div>
</body>
</html>