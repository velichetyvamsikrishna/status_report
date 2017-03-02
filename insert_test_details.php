<?php
include("db.php");
$date=date("Y-m-d");
$month=date("m");
$year=date("Y");
$test_pass=$_GET["test_pass"];
$tested_apps=$_GET["tested_apps_no"];
$new_bugs=$_GET["new_bugs_no"];
$vid=$_COOKIE["vamsi"];
$bug_info_table="buginfo_".$month."_".$year;
$bugs_table="new_bugs_".$month."_".$year;
if(!(mysqli_query($con,"select * from $bug_info_table;"))){
	mysqli_query($con,"create table $bug_info_table(V_Id varchar(200),TestPass text,AppName text,Status varchar(100),Bugs text,Version varchar(100),date DATE);");
}
if(!(mysqli_query($con,"select * from $bugs_table;"))){
	mysqli_query($con,"create table $bugs_table(V_Id varchar(200),TestPass text,Bug_Id int(25),bug_title text,assigned_to varchar(1000),date DATE);");
}
function get_app($app_id,$con) {
	$sel_app=mysqli_query($con,"select name from apps_data where id='$app_id';");
	if(mysqli_num_rows($sel_app)==1){
		$temp_var = mysqli_fetch_array($sel_app);
		return $temp_var[0];
	}
	else{
		return "Invalid App ID";
	}
}

?>
<div class="container col-md-10">
	<h3>Thank you TEST RESULTS are updated for <?php echo $date;?></h3>
	<br/>
	<div class="panel panel-default" >
	  <div class="panel-body">
		<div class="col-md-7">
			<table class="table table-default">
			<tr><td><b>Test Pass</b></td><td><?php echo "<b>".$test_pass."</b>"; ?></td></tr>
			<tr><td>Tested Applications</td><td><?php echo "<b>".$tested_apps."</b>"; ?></td></tr>
			</table>
		</div>
		<div class="col-md-12">
		<?php
		if($tested_apps>0){
			?>
			<table class="table table-bordered">
				<thead>
				  <tr>
					<th>Application Name</th>
					<th>Version</th>
					<th>Status</th>
					<th>Bug Information</th>
				  </tr>
				</thead>
				<tbody>
			<?php
			for($i=0;$i<$tested_apps;$i++){
				$ap_id="app_id".$i;
				$ap_status="status".$i;
				$ap_ex="ex_bugs".$i;
				$ap_new="new_bugs".$i;
				$ap_version="version".$i;
				$ap_id_val=$_GET["$ap_id"];
				$ap_status_val=$_GET["$ap_status"];
				$ap_ex_val=$_GET["$ap_ex"];
				$ap_new_val=$_GET["$ap_new"];
				$ap_version_val=$_GET["$ap_version"];
				$app_name=get_app($ap_id_val,$con);
				$bug_info="";
				if($ap_status_val=="Pass"){
					$bug_info="NA";
					echo "<tr class='success'>";
				}
				else{
					echo "<tr class='danger'>";
					if($ap_ex_val!="" && $ap_new_val!=""){
						$bug_info="Existing Bugs :".$ap_ex_val." New Bugs :".$ap_new_val;
					}
					else if($ap_ex_val!="" && $ap_new_val==""){
						$bug_info="Existing Bugs :".$ap_ex_val;
					}
					else if($ap_ex_val=="" && $ap_new_val!=""){
						$bug_info="New Bugs :".$ap_new_val;
					}
					else{
						$bug_info="NA";
					}
				}
				mysqli_query($con,"insert into $bug_info_table values('$vid','$test_pass','$app_name','$ap_status_val','$bug_info','$ap_version_val','$date');");
				echo "<td>$app_name</td><td>$ap_version_val</td><td>$ap_status_val</td><td>$bug_info</td></tr>";
			}
			echo "</tbody></table>";
		}
		?>
		</div>
		<div class="col-md-7">
			<table class="table table-default">
			<tr><td><b>Number of Bugs Logged : </b></td><td><?php echo "<b>".$new_bugs."</b>"; ?></td></tr>
			</table>
		</div>
		<div class="col-md-10">
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
			for($i=0;$i<$new_bugs;$i++){
				$bug_id="bug_id".$i;
				$bug_id_val=$_GET["$bug_id"];
				$bug_title="bug_title".$i;
				$bug_title_val=$_GET["$bug_title"];
				$assigned_to="bug_assigned_to".$i;
				$assigned_to_val=$_GET["$assigned_to"];
				mysqli_query($con,"insert into $bugs_table values('$vid','$test_pass','$bug_id_val','$bug_title_val','$assigned_to_val','$date');");
				echo "<tr><td>$bug_id_val</td><td>$bug_title_val</td><td>$assigned_to_val</td></tr>";
			}
				echo "</tbody></table>";
		}
		?>
		</div>
	  </div>
	</div>
</div>