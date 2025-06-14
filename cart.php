<?php include('header.php'); ?>

<div class="container">
    <h1>Your Shopping Cart</h1>

    <?php
    // Check if there are any items in the cart
    $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

    if (empty($cart)) {
        echo '<p>Your cart is empty!</p>';
    } else {
        echo '<div class="cart-items">';

        // Loop through cart items and display them
        foreach ($cart as $index => $item) {
            echo '
            <div class="cart-item">
                <img src="images/sample-product.jpg" alt="' . $item['name'] . '" class="cart-item-image">
                <div class="cart-item-details">
                    <h3>' . $item['name'] . '</h3>
                    <p>Price: ₹' . number_format($item['price'], 2) . '</p>
                    <button class="btn remove-from-cart" data-index="' . $index . '">Remove from Cart</button>
                </div>
            </div>';
        }

        echo '</div>';
    }
    ?>

    <!-- Cart Summary and Checkout Button -->
    <div class="cart-summary">
        <h2>Cart Summary</h2>
        <p>Total Items: <span id="total-items">0</span></p>
        <p>Total Price: ₹<span id="total-price">0.00</span></p>
        <button class="btn checkout-btn">Proceed to Checkout</button>
    </div>
</div>

<script src="js/cart.js"></script>

<?php include('footer.php'); ?>
