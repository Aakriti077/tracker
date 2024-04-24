<?php
require_once 'db.php';

$registration_message = ''; // Initialize the registration message variable
$error_message = ''; // Initialize the error message variable
$password_error = ''; // Initialize the password error message variable
$repassword_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $re_password = mysqli_real_escape_string($conn, $_POST['re-password']);

    // Check if any field is empty
    if (empty($name) || empty($email) || empty($password) || empty($re_password)) {
        $error_message = "Please fill out all fields.";
    } elseif ($password !== $re_password) {
        $repassword_error = "Passwords do not match.";
    } else {
        // Password validation
        if (strlen($password) < 8) {
            $password_error = "Password should be at least 8 characters long.";
        } elseif (!preg_match('/[#$@]/', $password)) {
            $password_error = "Password must have at least one special character (@, #, $).";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Check if email already exists
            $check_query = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $check_query);
            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }

            if (mysqli_num_rows($result) > 0) {
                $error_message = "User already exists.";
            } else {
                // Insert user into database
                $insert_query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
                if (mysqli_query($conn, $insert_query)) {
                    $registration_message = "User successfully registered!";
                } else {
                    $error_message = "Error: " . $insert_query . "<br>" . mysqli_error($conn);
                }
            }
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
    <title>Signup</title>
    <link rel="stylesheet" href="../css/signup.css">
</head>
<body>
    <div class="container">
        <div class="heading">Signup</div>
        <div class="registration-message" style="color: green;"><?php echo $registration_message; ?></div>
        <?php if (!empty($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" method="POST">
            <input required="" class="input" type="text" name="name" id="name" placeholder="Full Name">
            <input required="" class="input" type="email" name="email" id="email" placeholder="E-mail">
            <input required="" class="input" type="password" name="password" id="password" placeholder="Password">
            <input required="" class="input" type="password" name="re-password" id="re-password" placeholder="Re-enter Password">
            <?php if (!empty($password_error)): ?>
                <div class="error-message"><?php echo $password_error; ?></div>
            <?php endif; ?>
            <?php if (!empty($repassword_error)): ?>
                <div class="error-message"><?php echo $repassword_error; ?></div>
            <?php endif; ?>
            <input class="signup-button" type="submit" value="Sign Up">
        </form>
        <!-- <div class="registration-message" style="color: green;"><?php echo $registration_message; ?></div> -->
        <div class="register-link">
            <p>Already have an account? <a href="login.php">Log In</a></p>
        </div>
    </div>
</body>
</html>
