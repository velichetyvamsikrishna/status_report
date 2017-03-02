<?php
include("db.php");
$date=$_GET["search_date"];
$sel_tps_3=mysqli_query($con,"select name from current_tp where date='$date';");
$sel_tps_4=mysqli_query($con,"select name from previous_tp where date='$date';");
echo "<select class='form-control' name='search_tp'><option>Select Test Pass</option>";
if($sel_tps_3){
	for($k=0;$k<mysqli_num_rows($sel_tps_3);$k++){
		$search_tp_data=mysqli_fetch_array($sel_tps_3);
		echo "<option>".$search_tp_data[0]."</option>";
	}
}
if($sel_tps_4){
	for($k=0;$k<mysqli_num_rows($sel_tps_4);$k++){
		$search_tp_data=mysqli_fetch_array($sel_tps_4);
		echo "<option>".$search_tp_data[0]."</option>";
	}
}
echo "</select>";
?>