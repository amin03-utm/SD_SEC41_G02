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
        echo '<p class="success-message">Menu item updated successfully.</p>';
        
        // Redirect to menu.php after success
        header("Location: menu.php");
        exit(); // Make sure to exit after redirection
    } else {
        echo '<p class="error-message">Error updating menu item: ' . $conn->error . '</p>';
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
        echo '<p class="success-message">New menu item added successfully.</p>';
        
        // Redirect to menu.php after success
        header("Location: menu.php");
        exit(); // Make sure to exit after redirection
    } else {
        echo '<p class="error-message">Error adding menu item: ' . $conn->error . '</p>';
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Save Menu Item</title>
    <!-- Basic meta tags, CSS, and other head content here -->
    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Gulamomo bakery</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- font css -->
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    
    
</head>
<body>
    <div class
