<?php
function generateOTP(){
	$otp=rand(100000,999999);
	return $otp;
}

function sendOTPToRegisterEmail(){
	$otp=generateOTP();
	$emailToSend=$_POST['email'];
	$message = "Hi, This is your OTP - ".$otp;
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	mail($emailToSend,"Account Registration on Gulamomo online ordering",$message,$headers);
	
	$con=mysqli_connect("localhost","sd41","sd41project","db_sd_41_02");
	$sql = "insert into user_otp(email,otp) values('$emailToSend','$otp')";
	mysqli_query($con,$sql);
}

function deleteUsedOTP($email){
	$con=mysqli_connect("localhost","sd41","sd41project","db_sd_41_02");
	$sql= "DELETE FROM user_otp where email = '".$email."'";
	mysqli_query($con,$sql);
}

function validateOTP($email){
	$con=mysqli_connect("localhost","sd41","sd41project","db_sd_41_02");
	$sql= "SELECT * FROM user_otp where email = '".$email."'";
	$result=mysqli_query($con,$sql);
	$count=mysqli_num_rows($result);
	if($count == 1){
		$row = mysqli_fetch_assoc($result);
		$otp=$row['OTP'];
		return $otp;
		}
}

function saveOTPinUser_otp($emailToSend,$otp){
	$con=mysqli_connect("localhost","sd41","sd41project","db_sd_41_02");
	$sql = "insert into user_otp(email,otp) values('$emailToSend','$otp')";
	mysqli_query($con,$sql);
}
	
?>