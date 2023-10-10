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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Password Recovery</h3></div>
                                    <div class="card-body">
                                        
                                        <form action="" method="POST">
                                            <div class="form-floating mb-3">
                                            <label for="inputEmail">Email address</label>
                                                <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" name="emailToSend"/>
                                                
                                            </div>
                                            <div class="small mb-3 text-muted">Enter your email address and we will send you an OTP to reset your password.</div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="loginPage.html">Return to login</a>
                                                <button class="btn btn-primary" type="submit" name="resetButton">Reset</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
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
if(isSet($_POST['resetButton'])){
	$otp=generateOTP();
	$_SESSION['emailToChangePass']=$_POST['emailToSend'];
	saveOTPinUser_otp($_SESSION['emailToChangePass'],$otp);
	$emailToSend=$_POST['emailToSend'];
	$message = "Hi, This is your OTP - ".$otp;
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	mail($emailToSend,"Reset Password OTP",$message,$headers);
	header("Location:enterOTPForgetPass.php");
}
?>
