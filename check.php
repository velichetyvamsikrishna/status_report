<?php
include("db.php");
$user=$_GET["user"];
$pwd=md5($_GET["pwd"]);
$user_type="";
$cookie_name = "vamsi";
$cookie_value = "";
$check_count=100;
$check=mysqli_query($con,"select * from users where u_id='$user' and pwd='$pwd';");
if(mysqli_num_rows($check)==1){
	$user_details=mysqli_fetch_array($check);
	$cookie_value=$user_details[0];
	$user_type=$user_details[3];
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	setcookie("user_type", $user_type, time() + (86400 * 30), "/"); // 86400 = 1 day
	$check_count=99;
}
if($check_count==99) {
	echo "<div id='nav_pins'>";
	$user_level=$user_type;
	if($user_level=="Admin"){
		include("admin_view.php");
	}
	else if($user_level=="Tester"){
		include("tester_view.php");
	}
	else if($user_level=="Client"){
		include("client_view.php");
	}
	echo "</div>";
	echo '<div class="container" id="body2">';
	if($user_level=="Tester" || $user_level=="Admin"){
		include("test_details.php");
	}
	else if($user_level=="Client"){
		include("view_test_results.php");
	}
	echo'</div>';
}
else {
   ?>
   <br/><br/><br/>
	<div class="container" style="width:35%" >
		<h2>Accessibility Daily Status Report</h2>
		<br/>
		<form name="form_log" method="POST" onsubmit="return check_user();">
			<div class="panel panel-default">
			  <div class="panel-heading">
				<h2 class="panel-title">Login</h2>
			  </div>
			  <div class="panel-body">
				<p style="color:red">Invalid Request</p>
				<input type="email" class="form-control" name="user" placeholder="Username" required>
				<br/>
				<input type="password" class="form-control" name="pwd" placeholder="Password" required>
				<br/>
				<input type="Submit" value="Let me in" class="btn btn-primary">
				<br/><br/>
				<a href="#">Forgot Password</a>
				<a id="ca" class="pull-right">Create Account</a>
			  </div>
			</div>
		</form>
		<br/><br/><br/>
		<footer class=".text-center" >
		  <p>&copy; Developed By Vamsi Krishna Velichety  </p>
		  <p>Email: v-vave@microsoft.com </p>
		</footer>
	</div>
	<br/>
   <?php  
}
?>