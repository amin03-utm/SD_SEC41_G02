<?php
if (isset($_POST['submit'])) {
    // Establish a database connection
    $conn = mysqli_connect('localhost', 'sd41', 'sd41project', 'db_sd_41_02');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve user input
    $Username = $_POST['Username'];
    $Email = $_POST['Email'];
    $password = $_POST['password'];
    $Cpassword = $_POST['Cpassword'];
    $userType = $_POST['userType'];
    $termsChecked = isset($_POST['termsChecked']) && $_POST['termsChecked'] === 'on';

    // Check for required fields and validate email
    if (empty($Username) || empty($Email) || empty($password) || empty($Cpassword)) {
        echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
        echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>All fields are required<br><br></b>";
        echo '</div>';
        echo '<br><br><br><a class="w3-text-blue" href="register.html"><b>Try Again</b></a>';
    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
        echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Invalid email format<br><br></b>";
        echo '</div>';
        echo '<br><br><br><a class="w3-text-blue" href="register.html"><b>Try Again</b></a>';
    } elseif ($password !== $Cpassword) {
        echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
        echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>Passwords do not match<br><br></b>";
        echo '</div>';
        echo '<br><br><br><a class="w3-text-blue" href="register.html"><b>Try Again</b></a>';
    } elseif (!$termsChecked) {
        echo '<div class="w3-center w3-container" style="width:400px; margin:auto">';
        echo "<center><br><br><div class='w3-center w3-container w3-red w3-margin w3-padding'><b><br>You must accept the terms of service to register.<br><br></b>";
        echo '</div>';
        echo '<br><br><br><a class="w3-text-blue" href="register.html"><b>Try Again</b></a>';
    } else {
        // Generate a random verification code (OTP)
        $verification_code = generateRandomOTP();

        // Insert user data into the database
        $sql = "INSERT INTO user (Username, Email, Password, userType) VALUES ('$Username', '$Email', '$password','$userType')";
        
        if (mysqli_query($conn, $sql)) {
            // Store the verification code in the verification_codes table
            $verification_sql = "INSERT INTO verification_codes (email, code) VALUES ('$Email', '$verification_code')";
            if (mysqli_query($conn, $verification_sql)) {
                // Send the verification email with OTP
                sendVerificationEmail($Email, $verification_code);

                // Redirect to the OTP verification page
                header('Location: otp_verification.php?email=' . urlencode($Email));
                exit();
            } else {
                echo "Error storing verification code: " . mysqli_error($conn);
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
}

// Function to generate a random OTP (6 characters)
function generateRandomOTP() {
    return rand(100000, 999999);
}

// Function to send the verification email with OTP
function sendVerificationEmail($to, $verification_code) {
    $subject = 'Email Verification OTP';
    $message = "Your OTP for email verification is: $verification_code";
    $headers = 'From: your_email@example.com' . "\r\n" .
        'Reply-To: your_email@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    if (mail($to, $subject, $message, $headers)) {
        echo 'Registration successful. Please check your email to verify your account.';
    } else {
        echo 'Email sending failed. Please try again.';
    }
}
?>
