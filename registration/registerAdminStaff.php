<?php
if (isset($_POST['submit'])) {
    $conn = mysqli_connect('localhost', 'sd41', 'sd41project', 'db_sd_41_02');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $Username = $_POST['Username'];
    $Email = $_POST['Email'];
    $password = $_POST['password'];
    $Cpassword = $_POST['Cpassword'];
    $userType = $_POST['userType'];
    $secretCode = $_POST['secretCode'];
    $userCode = $_POST['userCode'];
    $termsChecked = isset($_POST['termsChecked']) && $_POST['termsChecked'] === 'on';

    $adminSecretCode = '38567'; // Change this to your desired admin secret code
    $staffSecretCode = '12221'; // Change this to your desired staff secret code


    if (empty($password)) {
        echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
        echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Password are required fields<br><br></b>";
        echo '</div>';
        echo '<br><br><br><a class="w3-text-blue" href="registerAdminStaff.html"><b>Try Again</b></a>';
    } elseif (empty($Username)) {
        echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
        echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Name are required fields<br><br></b>";
        echo '</div>';
        echo '<br><br><br><a class="w3-text-blue" href="registerAdminStaff.html"><b>Try Again</b></a>';
    } elseif (empty($Email)) {
        echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
        echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Email are required fields<br><br></b>";
        echo '</div>';
        echo '<br><br><br><a class="w3-text-blue" href="registerAdminStaff.html"><b>Try Again</b></a>';
    } elseif (!$termsChecked) {
        // Display an error message for the terms of service
        echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
        echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>You must accept the terms of service to register.<br><br></b>";
        echo '</div>';
        echo '<br><br><br><a class="w3-text-blue" href="registerAdminStaff.html"><b>Try Again</b></a>';
    } elseif ($password == $Cpassword) {
        if (empty($userCode)) {
            // Display an error message for the missing secret code
            echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
            echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Secret Code is a required field.<br><br></b>";
            echo '</div>';
            echo '<br><br><br><a class="w3-text-blue" href="registerAdminStaff.html"><b>Try Again</b></a>';
        // Check if the provided code is correct based on user type
        } else if ($userType == 'Admin' && $userCode == $adminSecretCode) {
            // Code is correct for admin, proceed with admin registration
            $sql = "INSERT INTO user (Username, Email, Password, userType) VALUES ('$Username', '$Email', '$password', '$userType')";
            if (mysqli_query($conn, $sql)) {
                header('Location: loginPage.html');
                echo "Admin registration successful.";
            } else {
                echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
                echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Error registering admin user.<br><br></b>";
                echo '</div>';
                echo '<br><br><br><a class="w3-text-blue" href="registerAdminStaff.html"><b>Try Again</b></a>';
            }
        } elseif ($userType == 'Staff' && $userCode == $staffSecretCode) {
            // Code is correct for staff, proceed with staff registration
            $sql = "INSERT INTO user (Username, Email, Password, userType) VALUES ('$Username', '$Email', '$password', '$userType')";
            if (mysqli_query($conn, $sql)) {
                header('Location: loginPage.html');
                echo "Staff registration successful.";
            } else {
                echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
                echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Error registering staff user.<br><br></b>";
                echo '</div>';
                echo '<br><br><br><a class="w3-text-blue" href="registerAdminStaff.html"><b>Try Again</b></a>';
            }
        } else {
            // Incorrect secret code, display an error message
            echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
            echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Incorrect Secret Code.<br><br></b>";
            echo '</div>';
            echo '<br><br><br><a class="w3-text-blue" href="registerAdminStaff.html"><b>Try Again</b></a>';
        }
    } else {
        echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
        echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Password does not match!!!<br><br></b>";
        echo '</div>';
        echo '<br><br><br><a class="w3-text-blue" href="registerAdminStaff.html"><b>Try Again</b></a>';
    }
    
    // Close the database connection
    mysqli_close($conn);
}
?>