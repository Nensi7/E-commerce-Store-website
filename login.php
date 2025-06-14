<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: home.php"); // Redirect to home page if already logged in
    exit;
}

// Define variables for error messages
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sample credentials (in a real scenario, these would be stored in a database)
    $stored_username = 'testuser';
    $stored_password = 'testpassword'; // You would typically hash passwords in a real application

    // Get input from form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username and password match the stored credentials
    if ($username === $stored_username && $password === $stored_password) {
        // Set session variables upon successful login
        $_SESSION['user_id'] = $username;
        $_SESSION['logged_in'] = true;
        
        // Redirect to home page
        header("Location: home.php");
        exit;
    } else {
        $error = 'Invalid username or password!';
    }
}
?>

<?php include('header.php'); ?>

<div class="container">
    <h1>User Login</h1>
    
    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <button type="submit" class="btn">Login</button>
    </form>
    
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>

<?php include('footer.php'); ?>
