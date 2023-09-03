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

?>