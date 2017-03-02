<?php
include("db.php");
$date=date("Y-m-d");
?>
<form name="create_tp" method="POST" onsubmit="return create_testpass();">
	<div id="crtp" class="container" >
		<h3>Current Running Test Pass on <?php echo $date;?></h3>
		<br/>
		<div class="panel panel-default col-md-5" style="margin-right:25px;" >
		  <div class="panel-heading">
			<h2 class="panel-title">Mobile Test Pass</h2>
		  </div>
		  <div class="panel-body">
			<input type="text" class="form-control" name="crtp_mobile_build" placeholder="Mobile Build" required>
			<br/>
			<input type="number" min=0 class="form-control" name="crtp_mobile_count" placeholder="Total Number of Mobile Test Passes" required>
			<br/>
			<div id="crtp_mtp">
			</div>
		  </div>
		</div>
		<div class="panel panel-default col-md-6">
		  <div class="panel-heading">
			<h2 class="panel-title">Desktop Test Pass</h2>
		  </div>
		  <div class="panel-body">
			<input type="text" class="form-control" name="crtp_desktop_build" placeholder="Desktop Build" required>
			<br/>
			<input type="number" min=0 class="form-control" name="crtp_desktop_count" placeholder="Total Number of Desktop Test Passes" required>
			<br/>
			<div id="crtp_dtp">
			</div>
		  </div>
		</div>
	</div>
	<div id="prtp" class="container" >
		<h3>Previously(Old) Running Test Pass on <?php echo $date;?></h3>
		<br/>
		<div class="panel panel-default col-md-5" style="margin-right:25px;" >
		  <div class="panel-heading">
			<h2 class="panel-title">Mobile Test Pass</h2>
		  </div>
		  <div class="panel-body">
			<input type="text" class="form-control" name="prtp_mobile_build" placeholder="Mobile Build" required>
			<br/>
			<input type="number" min=0 class="form-control" name="prtp_mobile_count" placeholder="Total Number of Mobile Test Passes" value=0 required>
			<br/>
			<div id="prtp_mtp">
			</div>
		  </div>
		</div>
		<div class="panel panel-default col-md-6">
		  <div class="panel-heading">
			<h2 class="panel-title">Desktop Test Pass</h2>
		  </div>
		  <div class="panel-body">
			<input type="text" class="form-control" name="prtp_desktop_build" placeholder="Desktop Build" required>
			<br/>
			<input type="number" min=0 class="form-control" name="prtp_desktop_count" placeholder="Total Number of Desktop Test Passes" value=0 required>
			<br/>
			<div id="prtp_dtp">
			</div>
		  </div>
		</div>	
	</div>
	<br/>
	<div class="container">
		<input type="Submit" value="Create Test Passes " class="btn btn-primary">
	</div>
</form>
