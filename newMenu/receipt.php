<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
         .receipt {
            background-color: #fff;
            border: 2px solid #000;
            border-radius: 10px;
            padding: 20px;
            margin: 20px; /* Added margin to create more spacing */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
            width: 400px;
            margin: 0 auto;
        }

        .receipt-details {
            margin-top: 20px;
        }

        .receipt-total {
            margin-top: 20px;
            font-weight: bold;
        }

        /*.receipt-button {
            text-align: center;
        }*/

        .back-button {
            background-color: #008CBA;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            text-decoration: none; /* Remove underlining for a button link */
            /*display: inline-block;*/
            margin-left: 20px;
            margin-right: 20px;
        }

        .btn-success {
            background-color: #800080; /* Purple color */
            color: #fff;
            padding: 10px 20px;
            border: none;
            margin-right: 20px;
            text-decoration: none; /* Remove underlining for a button link */
            margin-left: 20px;
        }

        body {
            background: pink; /* Set the website background to pink */
        }

        .logo {
            text-align: center;
            background: pink;
            padding: 7px;
        }
        
        .print-button-hidden {
            display: none;
        }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="receipt">
                <img src="images/gulamomo2.0.png" alt="Logo" style="width: 300px; height: 70px; margin-left: 5px;">
               

            <?php
            session_start();

            // Check if the user is authenticated (replace with your authentication logic)
            if (isset($_SESSION["user_email"])) {
                // Replace with your database connection code
                $servername = "localhost";
                $username = "sd41";
                $password = "sd41project";
                $dbname = "db_sd_41_02";

                
                // Generate a unique invoice number
                $invoiceNumber = "INV" . date("YmdHis");
                
                // Create a database connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                
                // Check the connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $user_email = $_SESSION["user_email"];
                
                // Fetch user's username based on email from the "user" table
                $usernameQuery = "SELECT Username FROM user WHERE Email = '$user_email'";
                $usernameResult = $conn->query($usernameQuery);
                
                
                if ($usernameResult->num_rows > 0) {
                    $row = $usernameResult->fetch_assoc();
                    $user_username = $row["Username"];
                }
                echo "<div class='receipt-title' style='font-size: 36px;'><b>Receipt</b></div>";
                echo "<br>";
                echo "<b>Invoice Number: $invoiceNumber</b>";
                echo "<hr>";
                echo "<p>User Name: $user_username</p>"; // Display the user's username
                echo "<p>User Email: $user_email</p>"; // Display the user's email
                    
                // Fetch cart items from the database
                $sql = "SELECT * FROM cart_items WHERE user_email = '$user_email'";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    echo "<div class='receipt-details'>";
                    echo "<table class='table'>";
                    echo "<thead><tr><th>Item Name</th><th>Item Price</th><th>Created At</th></tr></thead>";
                    $totalPrice = 0;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["item_name"] . "</td>";
                        echo "<td>" . $row["item_price"] . "</td>";
                        echo "<td>" . $row["created_at"] . "</td>";
                        echo "</tr>";
                        $totalPrice += $row["item_price"];
                    }
                    echo "</table>";
                    
                    echo "<div class='receipt-total'>Total Price : RM " . number_format($totalPrice, 2) . "</div>";
                    echo "</div>";
                    
                    echo "<br>";
                    echo "<div class='receipt-button'>";
                    echo "<br>";

                    // Add a "Back to Menu" button that redirects to menuCustomer.php
                echo "<br>";
                echo "<div class='receipt-button'>";
                echo "<button class='btn btn-success' id='printButton'>Print Receipt</button>";
                // Add a "Back to Menu" button that redirects to menuCustomer.php
                echo "<a href='menuCustomer.php' class='btn back-button'>Back to Menu</a>";
                echo "</div>";
            } else {
                // Handle unauthenticated access (e.g., redirect to a login page)
                echo "Please make a purchase first.";
               
            }
                
                // Close the database connection
                $conn->close();
            } else {
                // Handle unauthenticated access (e.g., redirect to a login page)
                echo "Please make a purchase first.";
            }
            ?>
        </div>
    </div>

    <!-- Include Bootstrap JavaScript (optional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
         function showPrintButton() {
            document.getElementById("printButton").classList.remove("print-button-hidden");
        }
        // Add an event listener to the "Print Receipt" button
        document.getElementById("printButton").addEventListener("click", function () {
            // Hide the button before printing
            document.getElementById("printButton").style.display = "none";
            // Use the browser's print function to print the content
            window.print();
            // Show the button again after printing
            document.getElementById("printButton").style.display = "block";
            // Show the button again after printing
            showPrintButton();

        });
    </script>
</body>
</html>
