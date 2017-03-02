
<?php
include("db.php");
$date=date("Y-m-d");
$month=date("m");
$year=date("Y");
$vid=$_COOKIE["vamsi"];
$bug_info_table="buginfo_".$month."_".$year;
$bugs_table="new_bugs_".$month."_".$year;
$apps_details=mysqli_query($con,"select * from $bug_info_table where V_Id='$vid' and date='$date';");
$tested_apps=0;
if($apps_details){
	$tested_apps=mysqli_num_rows($apps_details);
}
else{
	$tested_apps=0;
}
$bugs_details=mysqli_query($con,"select * from $bugs_table  where V_Id='$vid' and date='$date';");
$new_bugs=0;
if($bugs_details){
	$new_bugs=mysqli_num_rows($bugs_details);
}
?>
<form name="modify_app_test_results" id="test_results_modify_area" method="POST" onsubmit="return modify_test_results();">
<div class="container col-md-11">
	<h3>View/Modify TEST RESULTS for <?php echo $date;?></h3>
	<br/>
	<div class="panel panel-default" >
	  <div class="panel-body">
		<div class="col-md-7">
			<table class="table table-bordered">
			<tr><td><b>Number of Applications Tested : </b></td><td><?php echo "<input type='number' name='tested_apps_no_m' readonly style='border:0px' value=".$tested_apps." />"; ?></td></tr>
			</table>
		</div>
		<div class="col-md-11">
		<?php
		if($tested_apps>0){
			?>
			<h4 style="color:red;">For Bugs change only bugs numbers but not the text Existing/New Bugs</h4>
			<?php
			for($i=0;$i<$tested_apps;$i++){
				$ap_testpass="t_app_testpass".$i;
				$ap_name="t_app_name".$i;
				$ap_status="t_status".$i;
				$ap_buginfo="t_bugs".$i;
				$ap_version="t_version".$i;
				$data_fet=mysqli_fetch_array($apps_details);
				$t_testpass=$data_fet[1];
				$t_appname=$data_fet[2];
				$t_status=$data_fet[3];
				$t_version=$data_fet[5];
				$t_buginfo=$data_fet[4];
				echo "<table class='table table-bordered'><tr><td>Test Pass</td><td><input type='text' class='form-control' required id='$ap_testpass' value='$t_testpass' ></td></tr>";
				echo "<tr><td>Application Name</td><td><input type='text' class='form-control' required id='$ap_name' value='$t_appname' ></td></tr>";
				echo "<tr><td>App Version</td><td><input type='text' class='form-control' required id='$ap_version' value='$t_version' ></td></tr>";
				echo "<tr><td>Status</td><td><input type='text' class='form-control' required id='$ap_status' value='$t_status' ></td></tr>";
				echo "<tr><td>Bugs </td><td><textarea rows=2 cols=50 class='form-control' required id='$ap_buginfo' >$t_buginfo</textarea></td></tr></table>";
			}
		}
		?>
		</div>
		<div class="col-md-7">
			<table class="table table-bordered">
			<tr><td><b>Number of Bugs Logged : </b></td><td><?php echo "<input type='number' name='new_bugs_no_m' readonly style='border:0px' value=".$new_bugs." />"; ?></td></tr>
			</table>
		</div>
		<div class="col-md-12">
		<?php
		if($new_bugs>0){
		?>
			<table class="table table-bordered table-hover">
				<thead>
				  <tr>
					<th>Bug Test Pass</th>
					<th>Bug ID</th>
					<th>Title</th>
					<th>Assigned To</th>
				  </tr>
				</thead>
				<tbody>
		<?php
			for($i=0;$i<$new_bugs;$i++){
				$bug_id="t_bug_id".$i;
				$bug_title="t_bug_title".$i;
				$assigned_to="t_bug_assigned_to".$i;
				$bug_tp="t_bug_tp".$i;
				$data_fet_bugs=mysqli_fetch_array($bugs_details);
				$t_btp=$data_fet_bugs[1];
				$t_bid=$data_fet_bugs[2];
				$t_title=$data_fet_bugs[3];
				$t_assign2=$data_fet_bugs[4];
				echo "<tr><td><input type='text' class='form-control' required id='$bug_tp' value='$t_btp' ></td><td><input type='number' class='form-control' required id='$bug_id' value='$t_bid' ></td><td><textarea rows=3 cols=40 class='form-control' required id='$bug_title' >$t_title</textarea></td><td><input type='text' class='form-control' required id='$assigned_to' value='$t_assign2' ></td></tr>";
			}
				echo "</tbody></table>";
		}
		?>
		</div>
		<div class="col-md-12">
			<input type="Submit" value="Update Test Results" class="btn btn-primary">
		</div>
	  </div>
	</div>
</div>
</form>