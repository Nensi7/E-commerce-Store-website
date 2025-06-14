<?php
session_start();

// Include database connection
include('db_connection.php');

// Define variables for error messages
$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input from the form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the passwords match
    if ($password !== $confirm_password) {
        $error = 'Passwords do not match!';
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL query to insert new user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        
        // Execute the query
        if (mysqli_query($conn, $sql)) {
            // If user is successfully registered, show success message
            $success = 'Registration successful! You can now log in.';
        } else {
            $error = 'Error: ' . mysqli_error($conn);
        }
    }
}
?>

<?php include('header.php'); ?>

<div class="container">
    <h1>User Registration</h1>

    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="POST" action="register.php">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        
        <button type="submit" class="btn">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>

<?php include('footer.php'); ?>
