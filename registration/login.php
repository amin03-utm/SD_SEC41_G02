<?php
include "../customer/customer.php";//ni function supaya user =Type and validPasssword function (file ade dekat customer.php)

session_start(); // Start a session

if (isset($_POST['submit'])) {
    $conn = mysqli_connect('localhost', 'web41', 'ddwd2703web', 'db_sd_41_02');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $Email = $_POST['Email'];
    $password = $_POST['password'];

    $isValidUser = validatePassword($Email,$password);

if($isValidUser)
	{
	$userType = getUserType($Email); //ADMIN
	if($userType =='Admin')
		header("location:../admin/indexAdmin.html"); // redirect to admin page
	else if($userType =='Staff')
		header("location:../staff/indexStaff.html"); // redirect to staff menu page
    else if($userType =='Customer')
		header("location:../customer/mainpage(customer)/indexCustomer.html"); // tryii lu bende ni bawa ke menu
	}
else {
	echo'<div class="w3-center w3-container" style="width:400px; margin:auto">';
	echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Wrong User Id or Password !!!<br><br></b>";
	echo'</div>';
	echo '<br><br><br><a class="w3-text-blue" href="../mainMenu.php"><b>Try Again</b></a>';
	}

    // Close the database connection
    mysqli_close($conn);
}

?>