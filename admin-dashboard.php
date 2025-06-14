<?php 
include('header.php');

// Check if the user is logged in as admin (implement authentication check)
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Include database connection
include('db_connection.php');

// Fetch data for products, orders, and users
// Fetch products
$product_result = mysqli_query($conn, "SELECT * FROM products");
$products = mysqli_fetch_all($product_result, MYSQLI_ASSOC);

// Fetch users
$user_result = mysqli_query($conn, "SELECT * FROM users");
$users = mysqli_fetch_all($user_result, MYSQLI_ASSOC);

// Fetch orders
$order_result = mysqli_query($conn, "SELECT * FROM orders");
$orders = mysqli_fetch_all($order_result, MYSQLI_ASSOC);
?>

<div class="container">
    <h1>Admin Dashboard</h1>

    <div class="dashboard-summary">
        <div class="dashboard-section">
            <h2>Total Products</h2>
            <p><?php echo count($products); ?></p>
        </div>
        <div class="dashboard-section">
            <h2>Total Users</h2>
            <p><?php echo count($users); ?></p>
        </div>
        <div class="dashboard-section">
            <h2>Total Orders</h2>
            <p><?php echo count($orders); ?></p>
        </div>
    </div>

    <div class="dashboard-actions">
        <h2>Manage Data</h2>
        <ul>
            <li><a href="manage-products.php">Manage Products</a></li>
            <li><a href="manage-users.php">Manage Users</a></li>
            <li><a href="manage-orders.php">Manage Orders</a></li>
        </ul>
    </div>

    <div class="dashboard-reports">
        <h2>Reports</h2>
        <p>Generate reports for sales, orders, and more.</p>
        <!-- You can add report generation logic here -->
    </div>
</div>

<?php include('footer.php'); ?>
