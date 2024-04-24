<?php
require_once 'db.php';

session_start(); // Start session for user authentication

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            // Password is correct, redirect to index2.php
            header("Location: index2.php");
            exit;
        } else {
            // Incorrect password
            $_SESSION['login_error'] = "Incorrect email or password.";
            header("Location: login2.php");
            exit;
        }
    } else {
        // User not found
        $_SESSION['login_error'] = "User not found.";
        header("Location: login2.php");
        exit;
    }
}

mysqli_close($conn);
?>

