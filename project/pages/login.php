<?php
require_once 'db.php';

$error_message = ''; // Initialize the error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Check if email and password are provided
    if (empty($email) || empty($password)) {
        $error_message .= "Please provide both email and password.<br>";
    } else {
        // Check if email exists in the database
        $check_query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $check_query);
        
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0) {
            // Email exists, check password
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                // Password is correct, redirect to dashboard or wherever needed
                // Start session
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];
                // Redirect to dashboard
                header("Location: index.php");
                exit;
            } else {
                // Password is incorrect
                $error_message .= "Wrong password.<br>";
            }
        } else {
            // Email does not exist in the database
            $error_message .= "User is not registered.<br>";
        }
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="container">
        <div class="heading">Login</div>
        <?php if (!empty($error_message) && strpos($error_message, 'User is not registered') !== false): ?>
                <span class="error-message"><?php echo $error_message; ?></span>
            <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" method="POST" id="loginForm">
            <input required="" class="input" type="email" name="email" id="email" placeholder="E-mail">
            <input required="" class="input" type="password" name="password" id="password" placeholder="Password">
            <?php if (!empty($error_message) && strpos($error_message, 'Wrong password') !== false): ?>
                <span class="error-message"><?php echo $error_message; ?></span>
            <?php endif; ?>
            <span class="forgot-password"><a href="#">Forgot Password ?</a></span>
            <input class="login-button" type="submit" value="Log In">
        </form>

        <?php if (!empty($error_message) && (strpos($error_message, 'User is not registered') === false && strpos($error_message, 'Wrong password') === false)): ?>
            <span class="error-message"><?php echo $error_message; ?></span>
        <?php endif; ?>

        <div class="social-account-container">
    
        </div>
        <div class="register-link">
            <p>Don't have an account? <a href="signup.php">Register</a></p>
        </div>
    </div>
</body>
</html>
