<?php

function addNewCustomer()
{
$con=mysqli_connect("localhost","sd41","sd41project","db_sd_41_02");
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

function validatePassword($Email,$password)
{
    $con=mysqli_connect("localhost","sd41","sd41project","db_sd_41_02");
if(!$con)
	{
	echo  mysqli_connect_error(); 
	exit;
	}
$sql= "SELECT * FROM user where Email = '".$Email ."' and password ='".$password."'";
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


function getUserType($Email)
{
$con=mysqli_connect("localhost","sd41","sd41project","db_sd_41_02");
if(!$con)
	{
	echo  mysqli_connect_error(); 
	exit;
	}
$sql= "SELECT * FROM user where Email = '".$Email ."'";
$result = mysqli_query($con,$sql); 
$count = mysqli_num_rows($result); //check how many matching record - should be 1 if correct
if($count == 1){
	$row = mysqli_fetch_assoc($result); //dia bagitau satu row semua info
	$userType = $row['userType'];
	return $userType;
	}
 }

?>