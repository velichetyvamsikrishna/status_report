
<form name="tested_app_details" id="test_results_update_area" method="POST" onsubmit="return insert_test_details();">
	<div class="container col-md-7">
	<table class="table table-default">
		<caption style="color:green;"> Enter the Data of Tested Applications</caption>
		<tr>
			<td>
				<select class="form-control" name="tested_tp">
				<option>Select Test Pass</option>
			
	<?php
	include("db.php");
	$date=date("Y-m-d");
	$old_tp=mysqli_query($con,"select * from previous_tp where date='$date';");
	$pre_tp=mysqli_query($con,"select * from current_tp where date='$date';");
	for($i=0;$i<mysqli_num_rows($old_tp);$i++){
		$temp_data=mysqli_fetch_array($old_tp);
		echo "<option>".$temp_data[1]."</option>";
	}
	for($i=0;$i<mysqli_num_rows($pre_tp);$i++){
		$temp_data2=mysqli_fetch_array($pre_tp);
		echo "<option>".$temp_data2[1]."</option>";
	}
	?>
			</select>
			</td>
			<td>
			<input class="form-control" type="number" min=0 required name="tested_apps_no" Placeholder="Enter the number of Tested Apps">
			</td>
		</tr>
	</table>
	</div>
	<br/>
	<div class="container-fluid col-md-12" id="app_data_area">
	</div>
	<br/>
	<div class="container col-md-7">
	<table class="table table-default">
		<caption style="color:red;"> Enter the Data of New Bugs Logged in this Test Pass</caption>
		<tr>
			<td><em><b>Bugs Logged Today</b></em>
			</td>
			<td>
				<input class="form-control" type="number" min=0 required name="new_bugs_no" Placeholder="Number of new bugs logged">
			</td>
		</tr>
	</table>
	</div>
	<br/>
	<div class="container col-md-11" id="new_bugs_area">
	</div>
	<div class="container col-md-12">
	<input type="Submit" value="Submit Bug Info" class="btn btn-primary">
	</div>
</form>