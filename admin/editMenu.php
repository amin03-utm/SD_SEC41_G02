<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

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
    // Fetch the menu item details from the database based on $id for editing
    // You can write SQL queries and retrieve the data here
    $sql = "SELECT * FROM menu_items WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $price = $row['price'];
        $image = $row['image'];
    } else {
        echo "Menu item not found.";
    }
} else {
    // This is for adding a new menu item
    $name = '';
    $price = '';
    $image = '';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $name = $_POST['name'];
   $price = $_POST['price'];

   // Handle image upload
   $target_dir = "uploads/";
   $target_file = $target_dir . basename($_FILES["image"]["name"]);
   $uploadOk = 1;
   $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

   // Check if image file is an actual image or fake image
   $check = getimagesize($_FILES["image"]["tmp_name"]);
   if ($check !== false) {
       $uploadOk = 1;
   } else {
       echo "File is not an image.";
       $uploadOk = 0;
   }

   // Check file size
   if ($_FILES["image"]["size"] > 500000) {
       echo "Sorry, your file is too large.";
       $uploadOk = 0;
   }

   // Allow certain file formats
   if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
       && $imageFileType != "gif") {
       echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
       $uploadOk = 0;
   }

   if ($uploadOk == 0) {
       echo "Sorry, your file was not uploaded.";
   } else {
       if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
           // File uploaded successfully, update or insert into the database
           if ($action == 'edit' && !empty($id)) {
               // Update the menu item in the database
               $sql = "UPDATE menu_items SET name = '$name', price = '$price', image = '$target_file' WHERE id = $id";
           } else {
               // Insert the new menu item into the database
               $sql = "INSERT INTO menu_items (name, price, image) VALUES ('$name', '$price', '$target_file')";
           }

           if ($conn->query($sql) === TRUE) {
               echo "Menu item saved successfully.";
           } else {
               echo "Error: " . $sql . "<br>" . $conn->error;
           }
       } else {
           echo "Sorry, there was an error uploading your file.";
       }
   }
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Basic meta tags, CSS, and other head content here -->
</head>
<body>
    <div class="header_section header_bg">
        <!-- Your header content here -->
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-sm-12"><br><br><br><br>
                <h1 class="contact_taital">Edit/Add Menu</h1>
                <div class="bulit_icon"><img src="images/menuimage.png"></div>
            </div>
        </div>
    </div>

    <div class="container">
        <form method="POST" action="saveMenu.php" enctype="multipart/form-data">
            <input type="hidden" name="action" value="<?php echo $action; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="text" class="mail_text" placeholder="Name" name="name" value="<?php echo $name; ?>">
            <input type="number" class="mail_text" placeholder="Price" name="price" value="<?php echo $price; ?>">
            <!-- Add a file input field for image uploads -->
            <input type="file" class="mail_text" name="image">
            <br>
            <div class="text-center">
                <button style="background-color: #007bff; color: #fff; border: none; padding: 10px 20px; cursor: pointer; margin-top: 20px; margin-bottom: 3in;" onmouseover="this.style.backgroundColor='#0056b3'" onmouseout="this.style.backgroundColor='#007bff'">UPDATE MENU</button>
            </div>
        </form>
        
    </div>
      <!-- contact section end -->
      <!-- footer section start -->
      <div class="footer_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="address_text">Address</h1>
                  <p class="footer_text">Madrasatul kiramah, Lot kedai no 3, Jalan Keramat, Kampung Datuk Keramat, 54000 Kuala Lumpur, Federal Territory of Kuala Lumpur </p>
                  <div class="location_text">
                     <ul>
                        <li>
                           <a href="#">
                           <i class="fa fa-phone" aria-hidden="true"></i><span class="padding_left_10">+6012-9336952</span>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <i class="fa fa-envelope" aria-hidden="true"></i><span class="padding_left_10">gulamomobakery@gmail.com</span>
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <div class="row">
               <div class="col-lg-6 col-sm-12">
                  <p class="copyright_text">2023 All Rights Reserved.</a></p>
               </div>
            </div>
         </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
</body>
