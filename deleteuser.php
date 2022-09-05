<?php
$id=!empty($_GET['id'])?$_GET['id']:'';

if($id)
{
	$con=mysqli_connect('localhost','root','','municipality');
	if(!$con)
	{
		die("error in connection". mysqli_connect_error());
	}
	$sql = "delete from admins where id=$id";
	$result=mysqli_query($con,$sql);
	if($result)
	{
		header("location:viewadmin.php");
	}
	else
	{
		echo"error in delete".mysqli_error($con);
	}
	mysqli_close($con);
}
	?>