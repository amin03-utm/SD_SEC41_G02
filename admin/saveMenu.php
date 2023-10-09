<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$action = isset($_POST['action']) ? $_POST['action'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : '';

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

if ($action == 'edit' && !empty($id)) {
    // Handle editing of an existing menu item
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageFileName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imagePath = "uploads/" . $imageFileName; // Specify your upload directory

        // Move the uploaded image to the desired directory
        if (move_uploaded_file($imageTmpName, $imagePath)) {
            // Successfully moved the image
        } else {
            // Error handling for image upload failure
            echo "bad";
        }
    }

    // Update the menu item in the database
    $sql = "UPDATE menu_items SET name = '$name', price = '$price', image = '$imagePath' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Successfully updated the menu item
        echo json_encode(['status' => 'success', 'message' => 'Menu item updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating menu item: ' . $conn->error]);
    }
} else {
    // Handle adding a new menu item
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Handle image upload for new menu item
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageFileName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imagePath = "uploads/" . $imageFileName; // Specify your upload directory

        // Move the uploaded image to the desired directory
        if (move_uploaded_file($imageTmpName, $imagePath)) {
            // Successfully moved the image
        } else {
            // Error handling for image upload failure
            echo "bad";
        }
    }

    // Insert the new menu item into the database using the correct table name
    $sql = "INSERT INTO menu_items (name, price, image) VALUES ('$name', '$price', '$imagePath')";

    if ($conn->query($sql) === TRUE) {
        // Successfully added the new menu item
        echo json_encode(['status' => 'success', 'message' => 'New menu item added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error adding menu item: ' . $conn->error]);
    }
}

// Close the database connection
$conn->close();
?>
