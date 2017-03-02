<?php
include("db.php");
$user=$_GET["user"];
$pwd=md5($_GET["pwd"]);
$hint=$_GET["hint"];
$u_type=$_GET["u_type"];
$check=mysqli_query($con,"select * from users where u_id='$user';");
$check2=mysqli_query($con,"select * from approve_users where u_id='$user';");
if(mysqli_num_rows($check)==0){
	if(mysqli_num_rows($check2)==0){
		echo "<h3>$user is not authorised user. Please contact Administrator.</h3>";
		echo '<a href="index.php">Back to Home</a>';
	}
	else{
		mysqli_query($con,"insert into users values('$user','$pwd','$hint','$u_type');");
		echo "<h3>Account has been created successfully. Thank you.</h3><br/>";
		echo '<a href="index.php">Click Here to Login</a>';
	}
}
else{
	echo "<h3>Sorry, User already exists</h3>";
	echo '<a href="index.php">Click Here to Login</a>';
}
?>