<?php include('header.php'); ?>

<div class="container">
    <?php
    // Sample product array with 20 products
    $products = [
        1 => ["name" => "Wireless Earbuds", "price" => 2499, "description" => "High-quality wireless earbuds with noise cancellation.", "image" => "images/earbuds.jpg"],
        2 => ["name" => "Smartphone", "price" => 15999, "description" => "Latest smartphone with excellent camera and performance.", "image" => "images/smartphone.jpg"],
        3 => ["name" => "Laptop", "price" => 49999, "description" => "Powerful laptop for work and gaming.", "image" => "images/laptop.jpg"],
        4 => ["name" => "Tablet", "price" => 8999, "description" => "Lightweight tablet with a stunning display.", "image" => "images/tablet.jpg"],
        5 => ["name" => "Smartwatch", "price" => 2999, "description" => "Fitness tracking and heart rate monitoring on your wrist.", "image" => "images/smartwatch.jpg"],
        6 => ["name" => "Bluetooth Speaker", "price" => 1499, "description" => "Portable speaker with excellent sound quality.", "image" => "images/speaker.jpg"],
        7 => ["name" => "Fitness Tracker", "price" => 1799, "description" => "Track your fitness progress with this sleek device.", "image" => "images/fitness-tracker.jpg"],
        8 => ["name" => "Gaming Mouse", "price" => 699, "description" => "Ergonomic gaming mouse with customizable buttons.", "image" => "images/mouse.jpg"],
        9 => ["name" => "Mechanical Keyboard", "price" => 2499, "description" => "Responsive mechanical keyboard for gamers and typists.", "image" => "images/keyboard.jpg"],
        10 => ["name" => "4K Monitor", "price" => 17999, "description" => "Ultra-clear 4K resolution for crisp and vibrant visuals.", "image" => "images/monitor.jpg"],
        11 => ["name" => "Portable Charger", "price" => 999, "description" => "Charge your devices on the go with this power bank.", "image" => "images/charger.jpg"],
        12 => ["name" => "Digital Camera", "price" => 32999, "description" => "Capture stunning photos with this high-quality digital camera.", "image" => "images/camera.jpg"],
        13 => ["name" => "VR Headset", "price" => 12999, "description" => "Experience virtual reality with this immersive VR headset.", "image" => "images/vr-headset.jpg"],
        14 => ["name" => "External SSD", "price" => 3999, "description" => "Fast and reliable external storage for your data.", "image" => "images/external-ssd.jpg"],
        15 => ["name" => "Router", "price" => 1599, "description" => "High-speed router with excellent Wi-Fi coverage.", "image" => "images/router.jpg"],
        16 => ["name" => "Drone", "price" => 24999, "description" => "Fly high with this advanced drone with HD camera.", "image" => "images/drone.jpg"],
        17 => ["name" => "Electric Toothbrush", "price" => 1299, "description" => "Deep clean your teeth with this electric toothbrush.", "image" => "images/toothbrush.jpg"],
        18 => ["name" => "Smart Light Bulb", "price" => 499, "description" => "Control your lighting with your smartphone using this smart bulb.", "image" => "images/light-bulb.jpg"],
        19 => ["name" => "Noise-Canceling Headphones", "price" => 8999, "description" => "Block out the noise with these noise-canceling headphones.", "image" => "images/headphones.jpg"],
        20 => ["name" => "Air Purifier", "price" => 10999, "description" => "Breathe fresh air with this powerful air purifier.", "image" => "images/air-purifier.jpg"]
    ];

    // Get the product ID from the URL
    $product_id = $_GET['product_id'] ?? 1; // Default to product ID 1 if not set
    $product = $products[$product_id] ?? null;

    if ($product) {
        echo '
        <div class="product-detail">
            <img src="' . $product['image'] . '" alt="' . $product['name'] . '" class="product-image">
            <div class="product-info">
                <h1>' . $product['name'] . '</h1>
                <p class="price">Price: ₹' . number_format($product['price'], 2) . '</p>
                <p class="description">' . $product['description'] . '</p>
                <button class="btn add-to-cart" data-product="' . $product['name'] . '" data-price="' . $product['price'] . '">Add to Cart</button>
            </div>
        </div>';
    } else {
        echo '<p>Product not found.</p>';
    }
    ?>
</div>

<?php include('footer.php'); ?>
