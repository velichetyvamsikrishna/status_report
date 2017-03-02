<?php
include("db.php");
$date=$_GET["search_date"];
$search_tp=$_GET["search_tp"];
$time = strtotime($date);
$month=date("m",$time);
$year=date("Y",$time);
$vid=$_COOKIE["vamsi"];
$bug_info_table="buginfo_".$month."_".$year;
$bugs_table="new_bugs_".$month."_".$year;
$check=100;
if($search_tp=="Select Test Pass"){
	$bug_info_data=mysqli_query($con,"select * from $bug_info_table where date='$date';");
	$bugs_table_data=mysqli_query($con,"select * from $bugs_table where date='$date';");
	$check=99;
}
else{
	$bug_info_data=mysqli_query($con,"select * from $bug_info_table where date='$date' and TestPass='$search_tp' order by AppName ASC;");
	$bugs_table_data=mysqli_query($con,"select * from $bugs_table where date='$date' and TestPass='$search_tp';");
}
$tested_apps=0;
if($bug_info_data){
	$tested_apps=mysqli_num_rows($bug_info_data);
}
$new_bugs=0;
if($bugs_table_data){
	$new_bugs=mysqli_num_rows($bugs_table_data);
}
?>
	<h3>TEST RESULTS FOR <?php echo $date;?></h3>
	<br/>
	<div class="panel panel-default" >
	  <div class="panel-body">
		<div class="col-md-7">
			<table class="table table-bordered table-primay">
			<tr><td><b>Total Tested Applications</b></td><td><?php echo "<b>".$tested_apps."</b>"; ?></td></tr>
			</table>
		</div>
		<div class="col-md-12">
		<?php
		if($tested_apps>0){
			if($check==99){
				$sel_tps_1=mysqli_query($con,"select name from current_tp where date='$date';");
				$sel_tps_2=mysqli_query($con,"select name from previous_tp where date='$date';");
				if($sel_tps_1){
					for($i=0;$i<mysqli_num_rows($sel_tps_1);$i++){
						$cur_tp_data=mysqli_fetch_array($sel_tps_1);
						$tp_value_1=$cur_tp_data[0];
						$temp_tp_data=mysqli_query($con,"select * from $bug_info_table where date='$date' and TestPass='$tp_value_1' order by AppName ASC;");
						if(mysqli_num_rows($temp_tp_data)>0){
							?>
							<table class="table table-bordered">
								<caption> <?php echo $tp_value_1;?> </caption>
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
							for($j=0;$j<mysqli_num_rows($temp_tp_data);$j++){
								$temp_ap_fet=mysqli_fetch_array($temp_tp_data);
								echo "<tr><td>$temp_ap_fet[2]</td><td>$temp_ap_fet[5]</td><td>$temp_ap_fet[3]</td><td>$temp_ap_fet[4]</td></tr>";
							}	
							echo "</tbody></table>";
						}
						else{
							echo "<h4>No entries were found on ".$tp_value_1."</h4><br/>";
						}					
					}
				}
				if($sel_tps_2){
					for($i=0;$i<mysqli_num_rows($sel_tps_2);$i++){
						$previous_tp_data=mysqli_fetch_array($sel_tps_2);
						$tp_value_2=$previous_tp_data[0];
						$temp_tp_data=mysqli_query($con,"select * from $bug_info_table where date='$date' and TestPass='$tp_value_2' order by AppName ASC;");
						if(mysqli_num_rows($temp_tp_data)>0){
							?>
							<table class="table table-bordered">
								<caption> <?php echo $tp_value_2;?> </caption>
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
							for($j=0;$j<mysqli_num_rows($temp_tp_data);$j++){
								$temp_ap_fet=mysqli_fetch_array($temp_tp_data);
								echo "<tr><td>$temp_ap_fet[2]</td><td>$temp_ap_fet[5]</td><td>$temp_ap_fet[3]</td><td>$temp_ap_fet[4]</td></tr>";
							}	
							echo "</tbody></table>";
						}
						else{
							echo "<h4>No entries were found on ".$tp_value_2."</h4><br/>";
						}
					}
				}	
			}
			else{
				?>
				<table class="table table-bordered">
					<caption> <?php echo $search_tp;?> </caption>
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
				for($i=0;$i<mysqli_num_rows($bug_info_data);$i++){	
					$temp_ap_fet=mysqli_fetch_array($bug_info_data);
					echo "<tr><td>$temp_ap_fet[2]</td><td>$temp_ap_fet[5]</td><td>$temp_ap_fet[3]</td><td>$temp_ap_fet[4]</td></tr>";				
				}
				echo "</tbody></table>";				
			}
			
		}
		else{
			echo "<h4>No apps were tested on ".$date."</h4><br/>";
		}
		?>
		</div>
		<div class="col-md-7">
			<table class="table table-bordered">
			<tr><td><b>Number of Bugs Logged  </b></td><td><?php echo "<b>".$new_bugs."</b>"; ?></td></tr>
			</table>
		</div>
		<div class="col-md-12">
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
				$temp_bugs_list=mysqli_fetch_array($bugs_table_data);
				echo "<tr><td><a href='https://microsoft.visualstudio.com/DefaultCollection/OSGS/_workitems#_a=edit&id=$temp_bugs_list[2]' target='_blank' >$temp_bugs_list[2]</a></td><td>$temp_bugs_list[3]</td><td>$temp_bugs_list[4]</td></tr>";
			}
				echo "</tbody></table>";
		}
		else{
			echo "<h4>No bugs were logged on ".$date."</h4><br/>";
		}
		?>
		</div>
	  </div>
	</div>
