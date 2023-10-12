<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include your database connection code here
$servername = "localhost";
$username = "sd41";
$password = "sd41project";
$dbname = "db_sd_41_02";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if "action" is set and is equal to "edit"
if (isset($_GET["action"]) && $_GET["action"] === "edit") {
    // Check if "id" is set in the URL
    if (isset($_GET["id"])) {
        $menuId = $_GET["id"];

        // Query the database to fetch the menu item by ID
        $sql = "SELECT * FROM menu_items WHERE id = $menuId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Display a form for editing the menu item
            ?>

            <!DOCTYPE html>
            <html>
            <head>
                <title>Edit Menu Item</title>
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
        <div class="row">
            <div class="col-sm-12"><br><br><br><br>
                <h1 class="contact_taital">Edit Menu</h1>
                <div class="bulit_icon"><img src="images/menuimage.png"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <form method="POST" action="updateMenu.php">
            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
            <label for="name">Name:</label>
            <input type="text" class="mail_text" name="name" value="<?php echo $row["name"]; ?>"><br><br>
            <label for="price">Price:</label>
            <input type="text" class="mail_text" name="price" value="<?php echo $row["price"]; ?>" step="0.01">
            <br>
            <div class="text-center">
                <button style="background-color: #007bff; color: #fff; border: none; padding: 10px 20px; cursor: pointer; margin-top: 20px; margin-bottom: 3in;" onmouseover="this.style.backgroundColor='#0056b3'" onmouseout="this.style.backgroundColor='#007bff'" type="submit" name="update_menu">Update</button>
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
            </html>

            <?php
        } else {
            echo "Menu item not found.";
        }
    } else {
        echo "Menu ID is not provided.";
    }
} else {
    echo "Invalid action.";
}
?>