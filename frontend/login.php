<?php
include '../backend/init.php';
include '../backend/login_handler.php';

// session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dash");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Library Offense System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body style="background-image:url(slider_background.jpg)">
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card shadow p-4" style="width: 400px;">
            <a href="../index" class="text-dark">&larr; Go Back</a>
            <h2 class="text-center mb-4">Login</h2>

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
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Example@gmail.com" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password" required>
                </div>
                <button type="submit" name="log_btn" class="btn btn-primary w-100">Login</button>
                <p class="mt-3 text-center">
                    Don't have an account? <a href="register">Register</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>