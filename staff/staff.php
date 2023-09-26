<?php

function addNewStaff()
{
$con=mysqli_connect("localhost","sd41","sd41project","db_sd_41_02");
if(!$con)
{
echo "Error".mysqli_connect_error();
}else
{
$StaffID=$_POST['StaffID'];
$Username=$_POST['Username'];
$Password=$_POST['Password'];
$Role=$_POST['Role'];
$sql="INSERT INTO staff(StaffID,Username,Password,Role)
VALUES('$StaffID', '$Username', '$Password', '$Role')";
echo $sql;
mysqli_query($con,$sql);
}
}

?>