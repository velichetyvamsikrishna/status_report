<?php
include("db.php");
$user_id=$_GET["user_id"];
$sel=mysqli_query($con,"select * from approve_users where u_id='$user_id';");
if(mysqli_num_rows($sel)==0){
	echo "Invalid User Request";
}
else{
	$fet=mysqli_fetch_array($sel);
	echo $fet[1];
}
?>