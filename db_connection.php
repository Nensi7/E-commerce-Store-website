<?php
    // Database connection parameters
    $host = 'localhost';      // Database host
    $dbname = 'ecommerce_db'; // Database name
    $username = 'root';       // Database username
    $password = "";           // Database password (for localhost, it could be empty)

    
    // Create the connection
    $conn = mysqli_connect($host, $username, $password, $dbname, 3307);

    // Check if the connection was successful
    if (!$conn) {
        die("Error!! Failed to Connect to the Server: " . mysqli_connect_error());
    }

    // Select the database (optional, as it's already done in the connection above)
    if (!mysqli_select_db($conn, $dbname)) {
        die("Error!! Failed to Select the Database: " . mysqli_connect_error());
    }

    // Function to insert data into the 'users' table
    function insertUser($name, $email, $phonenumber, $address) {
        global $conn; // Access the $conn variable from the connection setup

        // Prepare SQL query with placeholders to prevent SQL injection
        $sql = "INSERT INTO users (name, email, phonenumber, address) VALUES (?, ?, ?, ?)";

        // Prepare statement
        if ($stmt = mysqli_prepare($conn, $sql)) {
            
            // Bind parameters (s = string, i = integer, d = double, b = blob)
            mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $phonenumber, $address);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                return "Record successfully inserted!";
            } else {
                return "Error: " . mysqli_stmt_error($stmt);
            }
        } else {
            return "Error preparing the SQL statement: " . mysqli_error($conn);
        }
    }

    // Check if form is submitted and insert data into the database
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Collect data from form input and sanitize it
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);

        // Call the insert function and store the result
        $result = insertUser($name, $email, $phonenumber, $address);
        echo $result;
    }
?>
