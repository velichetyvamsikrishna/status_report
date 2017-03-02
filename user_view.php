<?php
$user_level=$_COOKIE["user_type"];
if($user_level=="Admin"){
	include("admin_view.php");
}
else if($user_level=="Tester"){
	include("tester_view.php");
}
else if($user_level=="Client"){
	include("client_view.php");
}
?>