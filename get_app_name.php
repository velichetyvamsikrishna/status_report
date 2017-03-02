<?php
include("db.php");
$app_id=$_GET["app_id"];
$sel_app=mysqli_query($con,"select name from apps_data where id='$app_id';");
if(mysqli_num_rows($sel_app)==1){
	$temp_var = mysqli_fetch_array($sel_app);
	echo $temp_var[0];
}
else{
	echo "<p style='color:red'>Invalid App ID</p>";
}
?>