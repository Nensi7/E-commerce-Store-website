<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Website</title>
    <link rel="stylesheet" href="styles.css">
    <script src="js/script.js" defer></script>
</head>
<body>

<header>
    <nav>
        <ul class="nav-menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="product-list.php">Products</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="checkout.php">Checkout</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true): ?>
                <li><a href="admin-dashboard.php">Admin Dashboard</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
