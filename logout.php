<?php
setcookie("vamsi", "", time() - (86400 * 32), "/");
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
				<input type="text" class="form-control" name="user" placeholder="Username" required>
				<br/>
				<input type="password" class="form-control" name="pwd" placeholder="Password" required>
				<br/>
				<input type="Submit" value="Let me in" class="btn btn-primary">
				<br/><br/>
				<a id="fp">Forgot Password</a>
				<a id="ca" class="pull-right">Create Account</a>
			  </div>
			</div>
		</form>
		<br/><br/><br/><br/><br/>
		<footer class=".text-center" >
		  <p>&copy; Developed By Vamsi Krishna Velichety  </p>
		  <p>Email: v-vave@microsoft.com </p>
		</footer>
	</div>
<br/>