<?php
include("db.php");
$date=date("Y-m-d");
$month=date("m");
$year=date("Y");
$bug_info_table="buginfo_".$month."_".$year;
$bugs_table="new_bugs_".$month."_".$year;
$lead_table="lead_table_".$month."_".$year;
$tp_summary="tp_summary_".$month."_".$year;
$indv_table="individual_test_data_".$month."_".$year;
$lead_table_sel=mysqli_query($con,"select * from $lead_table;");
$tp_summary_sel=mysqli_query($con,"select * from $tp_summary;");
$indv_table_sel=mysqli_query($con,"select * from $indv_table");
$bug_info_data=mysqli_query($con,"select * from $bug_info_table where date='$date';");
$bugs_table_data=mysqli_query($con,"select * from $bugs_table where date='$date';");
$tested_apps=0;
if($bug_info_data){
	$tested_apps=mysqli_num_rows($bug_info_data);
}
$new_bugs=0;
if($bugs_table_data){
	$new_bugs=mysqli_num_rows($bugs_table_data);
}
$sel_tps_3_m=mysqli_query($con,"select name from current_tp where date='$date' and env='Mobile';");
$sel_tps_3_d=mysqli_query($con,"select name from current_tp where date='$date' and env='Desktop';");
$sel_tps_4_m=mysqli_query($con,"select name from previous_tp where date='$date' and env='Mobile';");
$sel_tps_4_d=mysqli_query($con,"select name from previous_tp where date='$date' and env='Desktop';");
if($lead_table_sel){
	
}
else{
	mysqli_query($con,"create table $lead_table(env varchar(200),data text,date DATE,build text);");
}
if($indv_table_sel){
	
}
else{
	mysqli_query($con,"create table $indv_table(env varchar(200),tested_apps int(10),date DATE,build text,tp text,bugs int(10));");
}
if($tp_summary_sel){
	
}
else{
	mysqli_query($con,"create table $tp_summary(env varchar(200),date DATE,tp_name text,status varchar(200),s_date DATE,e_date DATE,apps_planned int(10),apps_completed int(10));");
}

function apps($bug_info_table,$tp,$con,$date){
	$apps=0;
	$temp=mysqli_query($con,"select count(*) from $bug_info_table where date='$date' and TestPass='$tp';");
	$fet=mysqli_fetch_array($temp);
	$apps=$fet[0];
	return $apps;
}
function bugs($bugs_table,$tp,$con,$date){
	$bugs=0;
	$temp=mysqli_query($con,"select count(*) from $bugs_table where date='$date' and TestPass='$tp';");
	$fet=mysqli_fetch_array($temp);
	$bugs=$fet[0];
	return $bugs;
}
?>
<div id="search_by_date_summary" class="container col-md-11">
	<h3>Consolidated Report on <?php echo $date;?></h3>
	<br/>
	<div class="panel panel-default" >
	  <div class="panel-body">
		<div class="col-md-7">
			<table class="table table-bordered table-primay">
			<tr><td><b>Total Tested Applications</b></td><td><?php echo "<b>".$tested_apps."</b>"; ?></td></tr>
			<tr><td><b>Number of Bugs Logged  </b></td><td><?php echo "<b>".$new_bugs."</b>"; ?></td></tr>
			</table>
		</div>
		<div class="col-md-12">
		<?php
		$sel_tps_1=mysqli_query($con,"select name from current_tp where date='$date';");
		$sel_tps_2=mysqli_query($con,"select name from previous_tp where date='$date';");
		if(mysqli_num_rows($sel_tps_3_m)>0){
			$env="Mobile";
			echo "<table class='table table-bordered'><caption >New Full Test Pass Mobile</caption>";
			echo "<tr><td><input required type=text class='form-control' name='current_mobile_lead' placeholder='Heading for the Mobile Test Pass' /></td>";
			echo "<td><input required type=text class='form-control' name='current_mobile_build' placeholder='Mobile Build' /></td></tr></table>";
			echo "<table class='table table-bordered'>";
			for($i=0;$i<mysqli_num_rows($sel_tps_3_m);$i++){
				$temp_fet=mysqli_fetch_array($sel_tps_3_m);
				$apps=apps($bug_info_table,$temp_fet[0],$con,$date);
				$bugs=bugs($bugs_table,$temp_fet[0],$con,$date);
				$temp_id_apps='c_m_a_'.$i;
				$temp_id_scenario='c_m_s_'.$i;
				$temp_id_bugs='c_m_b_'.$i;
				echo "<tr><td>Tested <input required type='number' id='$temp_id_apps' class='form-control' value='$apps'> applications on Windows </td><td><input required id='$temp_id_scenario' type='text' class='form-control' value='$temp_fet[0]'> Scenarios </td><td>and Logged<input required id='$temp_id_bugs' type='number' class='form-control' value='$bugs'> bugs</td></tr>";
			}
			echo "</table>";
		}
		if(mysqli_num_rows($sel_tps_3_d)>0){
			$env="Desktop";
			echo "<table class='table table-bordered'><caption >New Full Test Pass Desktop</caption>";
			echo "<tr><td><input required type=text class='form-control' name='current_desktop_lead' placeholder='Heading for the Mobile Test Pass' /></td>";
			echo "<td><input required type=text class='form-control' name='current_desktop_build' placeholder='Mobile Build' /></td></tr></table>";
			echo "<table class='table table-bordered'>";
			for($i=0;$i<mysqli_num_rows($sel_tps_3_d);$i++){
				$temp_fet=mysqli_fetch_array($sel_tps_3_d);
				$apps=apps($bug_info_table,$temp_fet[0],$con,$date);
				$bugs=bugs($bugs_table,$temp_fet[0],$con,$date);
				$temp_id_apps='c_d_a_'.$i;
				$temp_id_scenario='c_d_s_'.$i;
				$temp_id_bugs='c_d_b_'.$i;
				echo "<tr><td>Tested <input required type='number' id='$temp_id_apps' class='form-control' value='$apps'> applications on Windows </td><td><input required id='$temp_id_scenario' type='text' class='form-control' value='$temp_fet[0]'> Scenarios </td><td>and Logged<input required id='$temp_id_bugs' type='number' class='form-control' value='$bugs'> bugs</td></tr>";
			}
			echo "</table>";
		}
		if(mysqli_num_rows($sel_tps_4_m)>0){
			$env="Mobile";
			echo "<table class='table table-bordered'><caption >Old Full Test Pass Mobile</caption>";
			echo "<tr><td><input  required type=text class='form-control' name='old_mobile_lead' placeholder='Heading for the Mobile Test Pass' /></td>";
			echo "<td><input  required type=text class='form-control' name='old_mobile_build' placeholder='Mobile Build' /></td></tr></table>";
			echo "<table class='table table-bordered'>";
			for($i=0;$i<mysqli_num_rows($sel_tps_4_m);$i++){
				$temp_fet=mysqli_fetch_array($sel_tps_4_m);
				$apps=apps($bug_info_table,$temp_fet[0],$con,$date);
				$bugs=bugs($bugs_table,$temp_fet[0],$con,$date);
				$temp_id_apps='o_m_a_'.$i;
				$temp_id_scenario='o_m_s_'.$i;
				$temp_id_bugs='o_m_b_'.$i;
				echo "<tr><td>Tested <input required type='number' id='$temp_id_apps' class='form-control' value='$apps'> applications on Windows </td><td><input required id='$temp_id_scenario' type='text' class='form-control' value='$temp_fet[0]'> Scenarios </td><td>and Logged<input required id='$temp_id_bugs' type='number' class='form-control' value='$bugs'> bugs</td></tr>";
			}
			echo "</table>";
			
		}
		if(mysqli_num_rows($sel_tps_4_d)>0){
			$env="Desktop";
			echo "<table class='table table-bordered'><caption >Old Full Test Pass Desktop</caption>";
			echo "<tr><td><input  required type=text class='form-control' name='old_desktop_lead' placeholder='Heading for the Desktop Test Pass' /></td>";
			echo "<td><input  required type=text class='form-control' name='old_desktop_build' placeholder='Mobile Build' /></td></tr></table>";
			echo "<table class='table table-bordered'>";
			for($i=0;$i<mysqli_num_rows($sel_tps_4_d);$i++){
				$temp_fet=mysqli_fetch_array($sel_tps_4_d);
				$apps=apps($bug_info_table,$temp_fet[0],$con,$date);
				$bugs=bugs($bugs_table,$temp_fet[0],$con,$date);
				$temp_id_apps='o_d_a_'.$i;
				$temp_id_scenario='o_d_s_'.$i;
				$temp_id_bugs='o_d_b_'.$i;
				echo "<tr><td>Tested <input required type='number' id='$temp_id_apps' class='form-control' value='$apps'> applications on Windows </td><td><input required id='$temp_id_scenario' type='text' class='form-control' value='$temp_fet[0]'> Scenarios </td><td>and Logged<input required id='$temp_id_bugs' type='number' class='form-control' value='$bugs'> bugs</td></tr>";
			}
			echo "</table>";
		}
		echo "<input type='Submit' Value='Save Data' class='btn btn-primary'>";
		?>
		</div>
	  </div>
	</div>
</div>