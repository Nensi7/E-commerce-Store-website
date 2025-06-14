<?php include('header.php'); ?>

<div class="container">
    <h1>Product Listing</h1>
    
    <!-- Filter and Sort Options -->
    <div class="filter-sort">
        <form method="GET" action="product-list.php">
            <label for="category">Category:</label>
            <select name="category" id="category">
                <option value="all">All</option>
                <option value="electronics">Electronics</option>
                <option value="books">Books</option>
                <option value="clothing">Clothing</option>
            </select>
            
            <label for="sort">Sort By:</label>
            <select name="sort" id="sort">
                <option value="default">Default</option>
                <option value="price-asc">Price: Low to High</option>
                <option value="price-desc">Price: High to Low</option>
            </select>
            
            <button type="submit">Apply</button>
        </form>
    </div>

    <!-- Product Grid -->
    <div class="product-grid">
        <?php
        // Sample product array with categories
        $products = [
            ["name" => "Wireless Earbuds", "price" => 2499, "category" => "electronics"],
            ["name" => "Smartphone", "price" => 15999, "category" => "electronics"],
            ["name" => "Laptop", "price" => 49999, "category" => "electronics"],
            ["name" => "Tablet", "price" => 8999, "category" => "electronics"],
            ["name" => "Novel Book", "price" => 399, "category" => "books"],
            ["name" => "Biography", "price" => 599, "category" => "books"],
            ["name" => "Smartwatch", "price" => 2999, "category" => "electronics"],
            ["name" => "Bluetooth Speaker", "price" => 1499, "category" => "electronics"],
            ["name" => "Fitness Tracker", "price" => 1799, "category" => "electronics"],
            ["name" => "Men's T-Shirt", "price" => 499, "category" => "clothing"],
            ["name" => "Women's Jacket", "price" => 1499, "category" => "clothing"]
            // Add more products as needed
        ];

        // Apply category filter
        $selectedCategory = $_GET['category'] ?? 'all';
        if ($selectedCategory !== 'all') {
            $products = array_filter($products, function($product) use ($selectedCategory) {
                return $product['category'] === $selectedCategory;
            });
        }

        // Apply sorting
        $sortOption = $_GET['sort'] ?? 'default';
        if ($sortOption === 'price-asc') {
            usort($products, fn($a, $b) => $a['price'] <=> $b['price']);
        } elseif ($sortOption === 'price-desc') {
            usort($products, fn($a, $b) => $b['price'] <=> $a['price']);
        }

        // Display filtered and sorted products
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
