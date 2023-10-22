<!DOCTYPE html>
<html>
   <head>
      <!-- basic -->
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
      <div class="header_section">
         <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="indexAdmin.php">
                    <img src="images/logo.png" alt="Logo" style="width: 400px; height: 80px;">
                  </a>
                  
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                       <a class="nav-link" href="indexAdmin.php">Home</a>
                    </li>
                    
                    <li class="nav-item">
                       <a class="nav-link" href="../newMenu/menu.php">Menu</a>
                    </li>
                   
                    <li class="nav-item">
                     <a class="nav-link" href="editProfile.html">Profile</a>
                     <li class="nav-item">
                        <a class="nav-link" href="Customer.html">Customer</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="editStaff.html">Staff</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="Staff.html">Add Staff</a>
                     </li>
                  </li>

                 </ul>

                 <!--log out-->
                 <form class="form-inline my-2 my-lg-0">
                  <div class="login_bt">
                      <ul style="display: flex; list-style-type: none; padding: 0;">
                          <li style="margin-right: 1px; font-size: 5px;"><a href="logout.php"><span class="user_icon"><i class="fa fa-user" aria-hidden="true"></i></span>Logout</a></li>
                          
                      </ul>
                  </div>
              </form>

              
              
               
                  
               </div>
            </nav>
         </div>
    <div class="header_section">
        <div class="container-fluid">
            <!-- Your Navigation Bar Content Here -->
        </div>
    </div>
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h2 mb-3"><strong>Analytics</strong> Dashboard</h1>

            <div class="card">
    <div class="card-body">
        <h3 class="card-title"><b>Graph</b></h3>

        <?php
// Database connection setup (you need to replace these values with your own)
$servername = "localhost";
$username = "sd41";
$password = "sd41project";
$dbname = "db_sd_41_02";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Retrieve data and count all user types
    $sql = "SELECT userType, COUNT(*) as count FROM user WHERE userType IN ('Staff', 'Customer') GROUP BY userType";
    $result = $conn->query($sql);

    $userTypes = [];
    $userCounts = [];
    $backgroundColors = []; // Array for bar background colors
    $borderColors = [];     // Array for bar border colors
    
    // Define an array of colors (you can customize these colors)
    $colors = ["rgba(75, 192, 192, 0.2)", "rgba(255, 99, 132, 0.2)", "rgba(255, 206, 86, 0.2)", "rgba(54, 162, 235, 0.2)"];

    $colorIndex = 0; // Initialize the color index
    
    while ($row = $result->fetch()) {
        $userTypes[] = $row['userType'];
        $userCounts[] = $row['count'];
        
        // Assign background and border colors based on the color array
        $backgroundColors[] = $colors[$colorIndex];
        $borderColors[] = str_replace("0.2", "1", $colors[$colorIndex]);
        
        $colorIndex = ($colorIndex + 1) % count($colors); // Cycle through colors
    }
    
    // Close the database connection
    $conn = null;
} catch(PDOException $e) {
    echo "Database Connection failed: " . $e->getMessage();
}

// Include the Chart.js library
echo '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';

// Create a bar chart using Chart.js
echo '<div style="width: 50%; margin: 0 auto;">';
echo '<canvas id="userChart"></canvas>';
echo '</div>';

// JavaScript to create the chart with different colors for each userType and legend box colors
echo '<script>
    var ctx = document.getElementById("userChart").getContext("2d");
    var userChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: ' . json_encode($userTypes) . ',
            datasets: [{
                label: "User Types",
                data: ' . json_encode($userCounts) . ',
                backgroundColor: ' . json_encode($backgroundColors) . ',
                borderColor: ' . json_encode($borderColors) . ',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            legend: {
                labels: {
                    boxWidth: 15, // Adjust the box width for the legend
                }
            }
        }
    });
</script>';
?>
    </div>
            </div>


            <!-- Customer List Table -->
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"><b>Customer List</b></h3>
                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Assuming you have a database connection established
                            // and a query to fetch customer data from your database
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

                            // Query to fetch customer data from the database
                            $customerSql = "SELECT Username, Email, userType FROM user WHERE userType = 'customer'";
                            $customerResult = $conn->query($customerSql);

                            // Loop through the customer results and populate the table rows
                            if ($customerResult->num_rows > 0) {
                                while ($row = $customerResult->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["Username"] . "</td>";
                                    echo "<td>" . $row["Email"] . "</td>";
                                    echo "<td>" . $row["userType"] . "</td>";
                                    echo '<td>
    <div class="btn-group-vertical">
        <a href="../newMenu/menuViewAdmin.php?user_email=' . $row["Email"] . '" class="btn btn-success mb-2">View Menu</a>
        <a href="Customer.html" class="btn btn-primary mb-2">Edit</a>
    </div>
    <form action="deleteFunctionAdmin.php" method="POST">
        <input type="hidden" name="user_email" value="' . $row["Email"] . '">
        <button type="submit" name="delete_staff" class="btn btn-danger">Delete</button>
    </form>
</td>';
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No customer data available</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Spacing between tables -->
            <br><br><br>

            <!-- Staff List Table -->
            <!-- Staff List Table -->
<div class="card">
    <div class="card-body">
        <h3 class="card-title"><b>Staff List</b></h3>
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Assuming you have a database connection established
                // and a query to fetch staff data from your database
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

                // Query to fetch staff data from the database
                $staffSql = "SELECT Username, Email, userType FROM user WHERE userType = 'staff'";
                $staffResult = $conn->query($staffSql);

                // Loop through the staff results and populate the table rows
                if ($staffResult->num_rows > 0) {
                    while ($row = $staffResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Username"] . "</td>";
                        echo "<td>" . $row["Email"] . "</td>";
                        echo "<td>" . $row["userType"] . "</td>";
                        echo '<td>
    <a href="editStaff.html" class="btn btn-primary" style="margin-top: 10px;">Edit</a>
    <form action="deleteFunctionAdmin.php" method="POST">
        <input type="hidden" name="user_email" value="' . $row["Email"] . '">
        <button type="submit" name="delete_staff" class="btn btn-danger" style="margin-top: 10px;">Delete</button>
    </form>
</td>';

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No staff data available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


            <!-- blog section end -->
      <!-- contact section start -->
     
      <!-- contact section end -->
      <!-- footer section start -->
      <div class="footer_section layout_padding">
        <div class="container">
           <div class="row">
              <div class="col-md-12">
                 <h1 class="address_text">Contact Us</h1>
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
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>

</body>
</html>
