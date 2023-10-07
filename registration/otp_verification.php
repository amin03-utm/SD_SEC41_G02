<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification OTP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Email Verification OTP</div>
                    <div class="card-body">
                        <?php
                        error_reporting(E_ALL);
                        ini_set('display_errors', '1');
                        // Check if the email parameter is provided
                        if (isset($_GET['email'])) {
                            $email = $_GET['email'];
                            if (isset($_POST['verify'])) {
                                $user_otp = $_POST['otp'];

                                // Retrieve the OTP from the database
                                $conn = mysqli_connect('localhost', 'sd41', 'sd41project', 'db_sd_41_02');
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                $sql = "SELECT code FROM verification_codes WHERE email = '$email'";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $stored_otp = $row['code'];

                                    if ($user_otp == $stored_otp) {
                                        // OTP is correct, update user status as verified
                                        $update_sql = "UPDATE user SET verified = 1 WHERE Email = '$email'";
                                        if (mysqli_query($conn, $update_sql)) {
                                            // Redirect to loginPage.html
                                            header('Location: loginPage.html');
                                            exit(); // Make sure to exit to prevent further execution
                                        } else {
                                            echo "Error updating user status: " . mysqli_error($conn);
                                        }
                                    } else {
                                        echo '<div class="alert alert-danger">Invalid OTP. Please try again.</div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-danger">Email not found in verification records.</div>';
                                }

                                mysqli_close($conn);
                            }
                        } else {
                            echo '<div class="alert alert-danger">Email address not provided.</div>';
                        }
                        ?>
                        <form method="POST">
                            <div class="form-group">
                                <label for="otp">Enter OTP:</label>
                                <input type="text" class="form-control" name="otp" required>
                            </div>
                            <button type="submit" name="verify" class="btn btn-primary">Verify OTP</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
