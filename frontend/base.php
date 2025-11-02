<?php
include '../backend/init.php';

// Include session handling and database connection
include '../backend/session.php';
include '../backend/connection.php';

// Fetch user details based on session user ID
$userId = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$userId'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Redirect to login if user not found
if (!$user) {
    header("Location: login");
    exit;
}

// Retrieve the role of the logged-in user
$role = $_SESSION['role'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Library Offense System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap/css/bootstrap.min.css" rel="">
      <!-- Font Awesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <script src="../frontend/css/sweetalert2/dist/sweetalert2.all.min.js"></script>

  <!-- local css -->
   <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Library Offense System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Welcome, <?php echo $user['name']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="font-weight: bolder; font-size: 20px;" href="#" onclick="signoutModal()"><i class="fa fa-power-off text-danger"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>