<?php
session_start();
include "processOTP.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gulamomo Bakery Forgot Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5))></style>
    </head>
    <body class="bg-primary">

    <section class="vh-100 bg-image"
  style="background-image: url('https://images.hdqwalls.com/download/chocolate-dessert-pastry-cake-5k-yw-2560x1440.jpg');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">


        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">One-Time Password</h3></div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="form-floating mb-3">
                                            <label for="inputEmail">Enter Your OTP</label>
                                                <input class="form-control" id="newPassword" type="text" placeholder="otp" name="otpEntered"/>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" type="submit" name="otpButton">ENTER</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>

<?php
if(isSet($_POST['otpButton'])){
	if($_POST['otpEntered']==validateOTP($_SESSION['emailToChangePass'])){
		deleteUsedOTP($_SESSION['emailToChangePass']);
		header("Location:changePassword.php");
	}
}
?>