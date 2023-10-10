<?php
// Check if the form is submitted
if (isset($_POST['update_menu'])) {
    // Assuming you have a database connection established
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

    // Get the form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Update the menu item in the database
    $updateSql = "UPDATE menu_items SET name='$name', price='$price' WHERE id='$id'";

    if ($conn->query($updateSql) === TRUE) {
        // If the update is successful, redirect back to the menu.php page
        header("Location: menu.php");
        exit();
    } else {
        echo "Error updating menu item: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // If the form is not submitted, redirect back to the menu.php page
    header("Location: menu.php");
    exit();
}
?>
