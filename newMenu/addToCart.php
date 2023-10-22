<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

// Ensure user is authenticated (adjust as needed based on your authentication system)
if (isset($_SESSION["user_email"])) {
    $user_id = $_SESSION["user_email"];
    
    if (isset($_POST["add_to_cart"])) {
        $item_id = $_POST["item_id"];
        $item_name = $_POST["item_name"];
        $item_price = $_POST["item_price"];

        // Database connection details
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

        // Check if the item is already in the cart
        $item_exists = false;

        // Adjust the SQL query based on your table structure
        $checkCartItemQuery = "SELECT * FROM cart_items WHERE user_email = '$user_id' AND item_id = $item_id";
        $result = $conn->query($checkCartItemQuery);

        if ($result->num_rows > 0) {
            // Item already exists in the cart; you can update the quantity or perform other actions here if needed
            $item_exists = true;
        }

        if (!$item_exists) {
            // Add the item to the cart in the database
            $insertCartItemQuery = "INSERT INTO cart_items (user_email, item_id, item_name, item_price) VALUES ('$user_id', $item_id, '$item_name', $item_price)";
            $conn->query($insertCartItemQuery);

            // Add the item to the cart session
            $cart_item = array(
                "id" => $item_id,
                "name" => $item_name,
                "price" => $item_price
            );
            $_SESSION["cart"][] = $cart_item;
        }

        // Close the database connection
        $conn->close();

        // Redirect back to the menu page or your desired page
        header("Location: menuCustomer.php");
        exit();
    }
} else {
    // Handle unauthenticated access (e.g., redirect to a login page)
}
?>
