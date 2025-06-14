<?php include('header.php'); ?>

<!-- Background Image Wrapper -->
<div class="background"></div>

<!-- Page Content -->
<div class="container">
    <h1>Welcome to Our E-commerce Store!</h1>
    <div class="banner">
        <p>Discover our amazing collection of products!</p>
    </div>

    <h2>Featured Products</h2>
    <div class="product-grid">
        <?php
        // Sample product array with 20 products
        $products = [
            ["name" => "Wireless Earbuds", "price" => 2499],
            ["name" => "Smartphone", "price" => 15999],
            ["name" => "Laptop", "price" => 49999],
            ["name" => "Tablet", "price" => 8999],
            ["name" => "Smartwatch", "price" => 2999],
            ["name" => "Bluetooth Speaker", "price" => 1499],
            ["name" => "Fitness Tracker", "price" => 1799],
            ["name" => "Gaming Mouse", "price" => 699],
            ["name" => "Mechanical Keyboard", "price" => 2499],
            ["name" => "4K Monitor", "price" => 17999],
            ["name" => "Portable Charger", "price" => 999],
            ["name" => "Digital Camera", "price" => 32999],
            ["name" => "VR Headset", "price" => 12999],
            ["name" => "External SSD", "price" => 3999],
            ["name" => "Router", "price" => 1599],
            ["name" => "Drone", "price" => 24999],
            ["name" => "Electric Toothbrush", "price" => 1299],
            ["name" => "Smart Light Bulb", "price" => 499],
            ["name" => "Noise-Canceling Headphones", "price" => 8999],
            ["name" => "Air Purifier", "price" => 10999]
        ];

        // Loop to display each product in a grid format
        foreach ($products as $product) {
            echo '
            <div class="product">
                <img src="images/sample-product.jpg" alt="' . $product['name'] . '">
                <h3>' . $product['name'] . '</h3>
                <p>Price: ₹' . number_format($product['price'], 2) . '</p>
                <button class="btn add-to-cart" data-product="' . $product['name'] . '" data-price="' . $product['price'] . '">Add to Cart</button>
            </div>';
        }
        ?>
    </div>
</div>

<?php include('footer.php'); ?>
