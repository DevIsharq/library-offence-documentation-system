<?php
include 'connection.php';

if (isset($_POST['log_btn'])) {
    $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
    $password = $_POST['password'];

    // Prepare the query to fetch user data based on email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Regenerate session ID to prevent session fixation attacks
            session_regenerate_id(true);
            $_SESSION['success'] = "Login Successful!";

            // Redirect to the single dashboard
            header("Location: ../frontend/dash");
            exit;
        } else {
            // Invalid password
            session_start();
            $_SESSION['error'] = "Invalid credentials. Please try again.";
            header("Location: ../frontend/login");
            exit;
        }
    } else {
        // User not found
        session_start();
        $_SESSION['error'] = "User not found. Please register first.";
        header("Location: ../frontend/login");
        exit;
    }
}
?>