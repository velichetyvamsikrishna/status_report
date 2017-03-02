<?php
include("db.php");
$date=date("Y-m-d");
$month=date("m");
$year=date("Y");
$bug_info_table="buginfo_".$month."_".$year;
$query=mysqli_query($con,"select V_Id,COUNT(*) from $bug_info_table where date='$date' group by V_Id;");
$bugs_table="new_bugs_".$month."_".$year;
$log_bugs=mysqli_query($con,"select V_Id,COUNT(*) from $bugs_table where date='$date' group by V_Id;");
?>
<form name="tester_perf" method="POST" onsubmit="return status_perf();">
	<div class="container col-md-12">
	<table class="table table-bordered table-primay">
		<th>Select Tester</th><th>From</th><th>To</th><th></th>
		<tr><td><select class="form-control" name="tester">
		<option>All</option>
		<option value="v-shrenu@microsoft.com">Shiva Prasad Renukuntla</option>
		<option value="v-chaych@microsoft.com">Chaya Chitturi</option>
		<option value="v-hagowd@microsoft.com">Hari Krish Gowda</option>
		<option value="v-asj@microsoft.com">Ashwini Vinayak Joshi</option>
		<option value="v-thbopp@microsoft.com">Thiru Mallika Boppe</option>
		<option value="v-srgoll@microsoft.com">Sriteja Golla</option>
		<option value="v-kramv@microsoft.com">Ravi Kumar</option>
		<option value="v-baagir@microsoft.com">Baby Shalini</option>
		<option value="v-kousha@microsoft.com">Usha Padmini Komepella</option>
		<option value="v-jomadh@microsoft.com">Joshna Priyanka</option>
		<option value="v-ummoh@microsoft.com">Umar Mohammed</option>
		<option value="v-de@microsoft.com">Deepti</option>
		<option value="v-didug@microsoft.com">Divya Lakshmi</option>
		<option value="v-vave@microsoft.com">vAmSi KrIsHnA</option>
		</select></td>
		<td>
		<input type="date" class="form-control" name="search_from_date" >
		</td>
		<td><input type="date" class="form-control" required name="search_to_date" value="<?php echo $date;?>"></td>
		<td><input type="Submit" value="Go" class="btn btn-primary"></td>
		</tr>
	</table>
	</div>
</form>
<?php
echo "<div id='status_perf'><h3>Tester Status for ".$date."</h3>";
echo "<table class='table table-bordered'><caption>Tested Apps</caption>";
for($i=0;$i<mysqli_num_rows($query);$i++){
	$fet=mysqli_fetch_array($query);
	echo "<tr><td>$fet[0]</td><td>$fet[1]</td></tr>";
}
echo "</table>";
echo "<table class='table table-bordered'><caption>Bugs Logged</caption>";
for($i=0;$i<mysqli_num_rows($log_bugs);$i++){
	$fet=mysqli_fetch_array($log_bugs);
	echo "<tr><td>$fet[0]</td><td>$fet[1]</td></tr>";
}
echo "</table></div>";
?>