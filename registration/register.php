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

    if ($password == $Cpassword) {
        $sql = "INSERT INTO user (Username, Email, Password, userType) VALUES ('$Username', '$Email', '$password','$userType')";
        if (mysqli_query($conn, $sql)) {
            header('Location: loginPage.html');
            echo "Registration successful.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo 'Password does not match!';
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
