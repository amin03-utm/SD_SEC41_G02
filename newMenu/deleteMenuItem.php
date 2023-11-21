<?php
session_start();

// Check if the user is authenticated (replace with your authentication logic)
if (isset($_SESSION["user_email"])) {
    // Replace with your database connection code
    $servername = "localhost";
    $username = "sd41";
    $password = "sd41project";
    $dbname = "db_sd_41_02";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the item_id from the POST data
        $item_id = $_POST["item_id"];

        // Prevent SQL injection by using prepared statements
        $stmt = $conn->prepare("DELETE FROM cart_items WHERE item_id = ?");
        $stmt->bind_param("i", $item_id);

        // Execute the delete query
        if ($stmt->execute()) {
            // Item was successfully deleted
            header("Location: menuViewAdmin.php?user_email=" . $_SESSION["user_email"]);
            exit();
        } else {
            echo "Error deleting item: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle unauthenticated access (e.g., redirect to a login page)
    echo "Please log in to delete items.";
}
?>
