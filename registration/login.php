<?php
include "../customer/customer.php";//ni function supaya user =Type and validPasssword function (file ade dekat customer.php)

session_start(); // Start a session

if (isset($_POST['submit'])) {
    $conn = mysqli_connect('localhost', 'sd41', 'sd41project', 'db_sd_41_02');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $Email = $_POST['Email'];
    $password = $_POST['password'];

    // Check if both Email and password are empty
    if (empty($Email) && empty($password)) {
		echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
        echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Email & Password are required fields<br><br></b>";
        echo '</div>';
        echo '<br><br><br><a class="w3-text-blue" href="loginPage.html"><b>Try Again</b></a>';
    } else {
        // Check if Email is empty
        if (empty($Email)) {
		echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
        echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Email are required fields<br><br></b>";
        echo '</div>';
        echo '<br><br><br><a class="w3-text-blue" href="loginPage.html"><b>Try Again</b></a>';
        }
        // Check if password is empty
        else if (empty($password)) {
			echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
			echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Password are required fields<br><br></b>";
			echo '</div>';
			echo '<br><br><br><a class="w3-text-blue" href="loginPage.html"><b>Try Again</b></a>';	
        }
        // Validate the user's credentials if both fields are provided
        else {
            $isValidUser = validatePassword($Email, $password);

            if ($isValidUser) {
                $_SESSION['user_email'] = $Email;

                $userType = getUserType($Email); // ADMIN, Staff, or Customer
                if ($userType == 'Admin') {
                    header("location:../admin/indexAdmin.php"); // Redirect to admin page
                } elseif ($userType == 'Staff') {
                    header("location:../staff/indexStaff.php"); // Redirect to staff menu page
                } elseif ($userType == 'Customer') {
                    header("location:../customer/mainpage(customer)/indexCustomer.html"); // Redirect to customer page
                }
            } else {
                echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
                echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Wrong Email or Password !!!<br><br></b>";
                echo '</div>';
                echo '<br><br><br><a class="w3-text-blue" href="loginPage.html"><b>Try Again</b></a>';
            }
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
