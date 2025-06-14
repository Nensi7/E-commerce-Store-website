<?php 
include('header.php'); 

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate input (basic example)
    if (empty($name) || empty($email) || empty($message)) {
        $error = "All fields are required!";
    } else {
        // If all fields are filled, you can proceed with saving data to the database or sending an email
        // Example: Insert into database (ensure you have a 'contacts' table in your database)
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ecommerce_db";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert data into the contacts table (make sure the table exists in your DB)
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            $success = "Your message has been sent successfully!";
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<div class="container">
    <h1>Contact Us</h1>
    <p>If you have any questions or need assistance, feel free to reach out to us through the contact form below.</p>

    <!-- Display success or error message -->
    <?php if (isset($success)): ?>
        <div class="alert alert-success">
            <?= $success ?>
        </div>
    <?php elseif (isset($error)): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <!-- Contact Form -->
    <form action="contact.php" method="post" class="contact-form">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit" class="btn">Send Message</button>
    </form>

    <!-- Map Section -->
    <h2>Our Location</h2>
    <div class="map-container">
        <!-- Static Google Maps Link -->
        <a href="https://www.google.com/maps/place/1600+Amphitheatre+Parkway,+Mountain+View,+CA" target="_blank">
            <img src="images/map-placeholder.jpg" alt="Our Location" style="width: 100%; max-width: 600px;">
        </a>
        <p>Click on the map to view our location on Google Maps.</p>
    </div>
</div>

<?php include('footer.php'); ?>
