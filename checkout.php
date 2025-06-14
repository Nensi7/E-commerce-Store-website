<?php
session_start();
include('db_connection.php'); // Include database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to proceed to checkout.";
    exit();
}

// Check if cart has items
if (empty($_SESSION['cart'])) {
    echo "Your cart is empty!";
    exit();
}

// Handle form submission for placing order
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $shipping_address = $_POST['shipping_address'];
    $total_amount = $_POST['total_amount'];
    $otp = rand(100000, 999999); // Generate a random OTP for verification

    // Insert order into `orders` table
    $order_query = "INSERT INTO orders (user_id, total_amount, shipping_address, otp) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $order_query);
    mysqli_stmt_bind_param($stmt, 'idss', $user_id, $total_amount, $shipping_address, $otp);
    mysqli_stmt_execute($stmt);
    $order_id = mysqli_insert_id($conn); // Get the last inserted order ID
    mysqli_stmt_close($stmt);

    // Insert order items into `order_items` table
    foreach ($_SESSION['cart'] as $product) {
        $item_query = "INSERT INTO order_items (order_id, product_name, quantity, price) VALUES (?, ?, ?, ?)";
        $item_stmt = mysqli_prepare($conn, $item_query);
        mysqli_stmt_bind_param($item_stmt, 'isid', $order_id, $product['name'], $product['quantity'], $product['price']);
        mysqli_stmt_execute($item_stmt);
        mysqli_stmt_close($item_stmt);
    }

    // Clear cart session after placing order
    unset($_SESSION['cart']);

    // Display confirmation message and OTP
    echo "Your order has been placed successfully! Please verify your order with this OTP: <strong>$otp</strong>";
    exit();
}
?>

<?php
    include('db_connection.php');

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    // Generate order ID and OTP
    $order_id = uniqid();
    $otp = rand(100000, 999999);
    $user_id = $_SESSION['user_id'];

    // Insert the order with OTP into the database
    $order_query = "INSERT INTO orders (order_id, user_id, otp, status) VALUES (?, ?, ?, 'Pending')";
    $stmt = mysqli_prepare($conn, $order_query);
    mysqli_stmt_bind_param($stmt, 'sis', $order_id, $user_id, $otp);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Save order ID in session and send OTP (simulate sending OTP)
    $_SESSION['order_id'] = $order_id;
    echo "Your OTP is: " . $otp; // For testing; replace with actual email/SMS in production

    // Redirect to order confirmation page
    header("Location: order_confirmation.php");
    exit();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include('header.php'); ?>

<div class="container">
    <h1>Checkout</h1>

    <!-- Display cart items -->
    <h2>Your Cart</h2>
    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        <?php
        $total_amount = 0;
        foreach ($_SESSION['cart'] as $product) {
            $product_total = $product['quantity'] * $product['price'];
            $total_amount += $product_total;
            echo "<tr>
                    <td>{$product['name']}</td>
                    <td>{$product['quantity']}</td>
                    <td>₹" . number_format($product['price'], 2) . "</td>
                    <td>₹" . number_format($product_total, 2) . "</td>
                </tr>";
        }
        ?>
        <tr>
            <td colspan="3"><strong>Total Amount:</strong></td>
            <td>₹<?php echo number_format($total_amount, 2); ?></td>
        </tr>
    </table>

    <!-- Checkout form -->
    <h2>Shipping Details</h2>
    <form method="post" action="checkout.php">
        <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
        
        <label for="shipping_address">Shipping Address:</label>
        <textarea id="shipping_address" name="shipping_address" required></textarea>
        
        <button type="submit" class="btn">Place Order</button>
    </form>
</div>

<?php include('footer.php'); ?>

</body>
</html>

