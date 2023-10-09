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
                <a class="navbar-brand" href="indexStaff.php">
                    <img src="images/logo.png" alt="Logo" style="width: 400px; height: 80px;">
                  </a>
                  
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                       <a class="nav-link" href="indexStaff.php">Home</a>
                    </li>
                    
                    <li class="nav-item">
                       <a class="nav-link" href="menu.php">Menu</a>
                    </li>
                   
                    <li class="nav-item">
                     <a class="nav-link" href="editProfile.html">Profile</a>
                     <li class="nav-item">
                        <a class="nav-link" href="Customer.html">Customer</a>
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
         <!-- banner section start --> 
         <main class="content">
				<div class="container-fluid p-0">

					<h1 class="h2 mb-3"><strong>Analytics</strong> Dashboard</h1>

					<div class="row">
						
						<!-- Add a div with the "card" class and white background -->
						<div class="card">
							<div class="card-body">
								<!-- Customer List Table -->
								<h3 class="card-title"><b>Customer List</b></h5>
								<table class="table table-bordered" >
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
                            $staffSql = "SELECT Username, Email, userType FROM user WHERE userType = 'customer'";
                            $staffResult = $conn->query($staffSql);

                            // Loop through the staff results and populate the table rows
                            if ($staffResult->num_rows > 0) {
                                while ($row = $staffResult->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["Username"] . "</td>";
                                    echo "<td>" . $row["Email"] . "</td>";
                                    echo "<td>" . $row["userType"] . "</td>";
                                    echo '<td>
                                    <a href="Customer.html" class="btn btn-primary">Edit</a>
                                            <form action="deleteFunctionStaff.php" method="POST">
                                            <input type="hidden" name="user_email" value="' . $row["Email"] . '">
                                            <button type="submit" name="delete_staff" class="btn btn-danger">Delete</button>
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

						<br><br><br>
						
						
						
						

						
				
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
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>