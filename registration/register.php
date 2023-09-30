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
    $termsChecked = $_POST['termsChecked'];

    if (empty($password)) {
        echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
        echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Password are required fields<br><br></b>";
        echo '</div>';
        echo '<br><br><br><a class="w3-text-blue" href="register.html"><b>Try Again</b></a>';
    } elseif (empty($Username)) {
        echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
        echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Name are required fields<br><br></b>";
        echo '</div>';
        echo '<br><br><br><a class="w3-text-blue" href="register.html"><b>Try Again</b></a>';
    } elseif (empty($Email)) {
        echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
        echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Email are required fields<br><br></b>";
        echo '</div>';
        echo '<br><br><br><a class="w3-text-blue" href="register.html"><b>Try Again</b></a>';
    } elseif (!$termsChecked) {
        // Display an error message for the terms of service
        echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
        echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>You must accept the terms of service to register.<br><br></b>";
        echo '</div>';
        echo '<br><br><br><a class="w3-text-blue" href="register.html"><b>Try Again</b></a>';
    } elseif ($password == $Cpassword) {
        $sql = "INSERT INTO user (Username, Email, Password, userType) VALUES ('$Username', '$Email', '$password','$userType')";
        if (mysqli_query($conn, $sql)) {
            header('Location: loginPage.html');
            echo "Registration successful.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
        echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Password does not match!!!<br><br></b>";
        echo '</div>';
        echo '<br><br><br><a class="w3-text-blue" href="register.html"><b>Try Again</b></a>';
    }
    

    // Close the database connection
    mysqli_close($conn);
}
?>
