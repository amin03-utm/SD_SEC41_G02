<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$servername = "localhost";
$username = "sd41";
$password = "sd41project";
$dbname = "db_sd_41_02";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['delete_menu'])) {
    $id = $_POST['id'];

    // Delete the menu item from the database
    $sql = "DELETE FROM menu_items WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Menu item deleted successfully.";
        // Redirect back to menu.php after deletion
        header('Location: menu.php');
        exit;
    } else {
        echo "Error deleting menu item: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
