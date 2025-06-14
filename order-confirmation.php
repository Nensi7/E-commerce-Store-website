<?php
session_start();
include('db_connection.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to confirm your order.";
    exit();
}

// Check if an order ID is passed or stored in session (order ID from checkout.php)
if (!isset($_SESSION['order_id'])) {
    echo "No order found for confirmation.";
    exit();
}

$order_id = $_SESSION['order_id'];
$message = "";

// Process OTP verification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_otp = $_POST['otp'];

    // Query to fetch the OTP for the specific order
    $otp_query = "SELECT otp FROM orders WHERE order_id = ? AND user_id = ?";
    $stmt = mysqli_prepare($conn, $otp_query);
    mysqli_stmt_bind_param($stmt, 'ii', $order_id, $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $stored_otp);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Verify the entered OTP
    if ($stored_otp == $user_otp) {
        // Update order status to confirmed
        $update_query = "UPDATE orders SET status = 'Confirmed' WHERE order_id = ?";
        $update_stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($update_stmt, 'i', $order_id);
        mysqli_stmt_execute($update_stmt);
        mysqli_stmt_close($update_stmt);

        $message = "Your order has been successfully confirmed!";
        unset($_SESSION['order_id']); // Clear order ID after confirmation
    } else {
        $message = "Invalid OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include('header.php'); ?>

<div class="container">
    <h1>Order Confirmation</h1>
    <p>Please enter the OTP sent to you during the checkout process to confirm your order.</p>

    <?php if ($message): ?>
        <p><strong><?php echo $message; ?></strong></p>
    <?php endif; ?>

    
    <!-- OTP Form -->
    <form method="post" action="order_confirmation.php">
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" required>
        <button type="submit" class="btn">Confirm Order</button>
    </form>
</div>

<?php include('footer.php'); ?>

</body>
</html>

<?php
include('db_connection.php');

// Check if order ID is in session
if (!isset($_SESSION['order_id'])) {
    echo "No order found. Please complete checkout first.";
    exit();
}

$order_id = $_SESSION['order_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entered_otp = $_POST['otp'];

    // Check OTP in database
    $otp_query = "SELECT otp FROM orders WHERE order_id = ? AND status = 'Pending'";
    $stmt = mysqli_prepare($conn, $otp_query);
    mysqli_stmt_bind_param($stmt, 's', $order_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $otp);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($otp == $entered_otp) {
        // Update order status to 'Confirmed'
        $update_query = "UPDATE orders SET status = 'Confirmed' WHERE order_id = ?";
        $stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt, 's', $order_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo "Order confirmed successfully!";
        unset($_SESSION['order_id']); // Clear order ID from session
    } else {
        echo "Invalid OTP. Please try again.";
    }
}
?>

