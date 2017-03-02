<?php
include("db.php");
$date=date("Y-m-d");
$month=date("m");
$year=date("Y");
$tested_apps=$_GET["tested_apps_no_m"];
$new_bugs=$_GET["new_bugs_no_m"];
$vid=$_COOKIE["vamsi"];
$bug_info_table="buginfo_".$month."_".$year;
$bugs_table="new_bugs_".$month."_".$year;
?>
<div class="container col-md-10">
	<h3>Updated the TEST RESULTS for <?php echo $date;?></h3>
	<br/>
	<div class="panel panel-default" >
	  <div class="panel-body">
		<div class="col-md-7">
			<table class="table table-bordered">
			<tr><td><b>Number of Applications Tested : </b></td><td><?php echo "<input type='number' readonly style='border:0px' value=".$tested_apps." />"; ?></td></tr>
			</table>
		</div>
		<div class="col-md-10">
		<?php
		if($tested_apps>0){
			?>
			<?php
			mysqli_query($con,"DELETE FROM $bug_info_table WHERE V_Id='$vid' AND date='$date';");
			for($i=0;$i<$tested_apps;$i++){
				$ap_testpass="t_app_testpass".$i;
				$ap_name="t_app_name".$i;
				$ap_status="t_status".$i;
				$ap_buginfo="t_bugs".$i;
				$ap_version="t_version".$i;
				$ap_tp_val=$_GET["$ap_testpass"];
				$ap_name_val=$_GET["$ap_name"];
				$ap_status_val=$_GET["$ap_status"];
				$ap_buginfo_val=$_GET["$ap_buginfo"];
				$ap_version_val=$_GET["$ap_version"];
				mysqli_query($con,"insert into $bug_info_table values('$vid','$ap_tp_val','$ap_name_val','$ap_status_val','$ap_buginfo_val','$ap_version_val','$date');");
				echo "<table class='table table-bordered'><tr><td>Test Pass</td><td>$ap_tp_val</td></tr>";
				echo "<tr><td>Application Name</td><td>$ap_name_val</td></tr>";
				echo "<tr><td>App Version</td><td>$ap_version_val</td></tr>";
				echo "<tr><td>Status</td><td>$ap_status_val</td></tr>";
				echo "<tr><td>Bugs </td><td>$ap_buginfo_val</td></tr></table>";
			}
		}
		?>
		</div>
		<div class="col-md-7">
			<table class="table table-bordered">
			<tr><td><b>Number of Bugs Logged : </b></td><td><?php echo "<input type='number' readonly style='border:0px' value=".$new_bugs." />"; ?></td></tr>
			</table>
		</div>
		<div class="col-md-11">
		<?php
		if($new_bugs>0){
		?>
			<table class="table table-bordered table-hover">
				<thead>
				  <tr>
					<th>Bug ID</th>
					<th>Title</th>
					<th>Assigned To</th>
				  </tr>
				</thead>
				<tbody>
		<?php
			mysqli_query($con,"DELETE FROM $bugs_table WHERE V_Id='$vid' AND date='$date';");
			for($i=0;$i<$new_bugs;$i++){
				$bug_tp="t_bug_tp".$i;
				$bug_tp_val=$_GET["$bug_tp"];
				$bug_id="t_bug_id".$i;
				$bug_id_val=$_GET["$bug_id"];
				$bug_title="t_bug_title".$i;
				$bug_title_val=$_GET["$bug_title"];
				$assigned_to="t_bug_assigned_to".$i;
				$assigned_to_val=$_GET["$assigned_to"];
				mysqli_query($con,"insert into $bugs_table values('$vid','$bug_tp_val','$bug_id_val','$bug_title_val','$assigned_to_val','$date');");
				echo "<tr><td>$bug_tp_val</td><td>$bug_id_val</td><td>$bug_title_val</td><td>$assigned_to_val</td></tr>";
			}
				echo "</tbody></table>";
		}
		?>
		</div>
	  </div>
	</div>
</div>