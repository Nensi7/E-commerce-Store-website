<?php
session_start(); // Start session to check if user is logged in

include('db_connection.php'); // Include the database connection file

// Check if user is logged in, assuming user ID is stored in session
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to view your profile.";
    exit();
}

// Fetch user data from the database
$user_id = $_SESSION['user_id']; // Retrieve the user ID from the session
$query = "SELECT name, email, phonenumber, address FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $name, $email, $phonenumber, $address);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// Update profile data if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_name = $_POST['name'];
    $new_email = $_POST['email'];
    $new_phonenumber = $_POST['phonenumber'];
    $new_address = $_POST['address'];

    $update_query = "UPDATE users SET name = ?, email = ?, phonenumber = ?, address = ? WHERE id = ?";
    $update_stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($update_stmt, 'ssssi', $new_name, $new_email, $new_phonenumber, $new_address, $user_id);

    if (mysqli_stmt_execute($update_stmt)) {
        echo "Profile updated successfully!";
        // Refresh page to reflect updates
        header("Refresh:0");
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
    mysqli_stmt_close($update_stmt);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to CSS file for styling -->
</head>
<body>

<?php include('header.php'); ?>

<div class="container">
    <h1>Your Profile</h1>
    <form method="post" action="profile.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

        <label for="phonenumber">Phone Number:</label>
        <input type="text" id="phonenumber" name="phonenumber" value="<?php echo htmlspecialchars($phonenumber); ?>" required>

        <label for="address">Address:</label>
        <textarea id="address" name="address" required><?php echo htmlspecialchars($address); ?></textarea>

        <button type="submit" class="btn">Update Profile</button>
    </form>
</div>

<?php include('footer.php'); ?>

</body>
</html>
