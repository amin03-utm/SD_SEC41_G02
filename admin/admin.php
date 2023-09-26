<?php

function addNewAdmin()
{
$con=mysqli_connect("localhost","sd41","sd41project","db_sd_41_02");
if(!$con)
{
echo "Error".mysqli_connect_error();
}else
{
$AdminID=$_POST['AdminID'];
$Username=$_POST['Username'];
$Password=$_POST['Password'];
$Role=$_POST['Role'];
$sql="INSERT INTO admin(AdminID,Username,Password,Role)
VALUES('$AdminID', '$Username', '$Password', '$Role')";
echo $sql;
mysqli_query($con,$sql);
}
}

?>