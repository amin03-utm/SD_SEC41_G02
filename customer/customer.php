<?php

function addNewCustomer()
{
$con=mysqli_connect("localhost","web41","ddwd2703web","db_sd_41_02");
if(!$con)
{
echo "Error".mysqli_connect_error();
}else
{
$Username=$_POST['Username'];
$Password=$_POST['Password'];
$Role=$_POST['Role'];
$Email=$_POST['Email'];
$OrderDetail=$_POST['OderDetail'];
$Quantity=$_POST['Quantity'];
$TotalPrice=$_POST['TotalPrice'];
$PaymentMethod=$_POST['PaymentMethod'];
$sql="INSERT INTO Customer (Username, Password , Role , Email , OrderDetail , Quantity , TotalPrice ,PaymentMethod)
VALUES('$Username', '$Password', '$Role', '$Email','$OrderDetail', '$Quantity','$TotalPrice','$PaymentMethod')";
echo $sql;
mysqli_query($con,$sql);
}
}

function validatePassword($Email,$Password)
{
    $con=mysqli_connect("localhost","web41","ddwd2703web","db_sd_41_02");
if(!$con)
	{
	echo  mysqli_connect_error(); 
	exit;
	}
$sql= "SELECT * FROM customer where Username = '".$Email ."' and Password ='".$Password."'";
$result = mysqli_query($con,$sql);
$count = mysqli_num_rows($result); //check how many matching record - should be 1 if correct
if($count == 1){
	return true;//username and password is valid
}
else
	{
	return false; //invalid password
	}
	}


function getUserType($UserId)
{
$con=mysqli_connect("localhost","web41","ddwd2703web","db_sd_41_02");
if(!$con)
	{
	echo  mysqli_connect_error(); 
	exit;
	}
$sql= "SELECT * FROM customer where UserId = '".$UserId ."'";
$result = mysqli_query($con,$sql); 
$count = mysqli_num_rows($result); //check how many matching record - should be 1 if correct
if($count == 1){
	$row = mysqli_fetch_assoc($result); //dia bagitau satu row semua info
	$userType = $row['userType'];
	return $userType;
	}
 }

?>