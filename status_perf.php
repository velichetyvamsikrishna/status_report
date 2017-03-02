<?php
include("db.php");
$user=$_GET["user"];
$from_d=$_GET["fro"];
$to_d=$_GET["s_to"];
if($from_d==null and $user=="All"){
	$year=explode('-', $to_d)[0];
	$month=explode('-', $to_d)[1];
	$bug_info_table="buginfo_".$month."_".$year;
	$query=mysqli_query($con,"select V_Id,COUNT(*) from $bug_info_table where date='$to_d' group by V_Id;");
	$bugs_table="new_bugs_".$month."_".$year;
	$log_bugs=mysqli_query($con,"select V_Id,COUNT(*) from $bugs_table where date='$to_d' group by V_Id;");
	echo "<div id='status_perf'><h3>Tester Status for ".$to_d."</h3>";
	echo "<table class='table table-bordered'><caption>Apps Details</caption>";
	for($i=0;$i<mysqli_num_rows($query);$i++){
		$fet=mysqli_fetch_array($query);
		echo "<tr><td>$fet[0]</td><td>$fet[1]</td></tr>";
	}
	echo "</table>";
	echo "<table class='table table-bordered'><caption>Bugs Details</caption>";
	for($i=0;$i<mysqli_num_rows($log_bugs);$i++){
		$fet=mysqli_fetch_array($log_bugs);
		echo "<tr><td>$fet[0]</td><td>$fet[1]</td></tr>";
	}
	echo "</table></div>";	
}
else if($from_d!=null and $user=="All"){
	$year1=explode('-', $from_d)[0];
	$month1=explode('-', $from_d)[1];
	$year2=explode('-', $to_d)[0];
	$month2=explode('-', $to_d)[1];
	if($year1==$year2 and $month1!=$month2){
		for($j=$month1;$j<=$month2;$j++){
			if($j==$month1){
				$date1=$from_d;
				$date2=$year1."-".$j."-31";
			}
			else if($j==$month2){
				$date1=$year1."-".$j."-01";
				$date2=$to_d;
			}
			else{
				$date1=$year1."-".$j."-01";
				$date2=$year1."-".$j."-31";
			}
			$bug_info_table="buginfo_".$j."_".$year1;
			$query=mysqli_query($con,"select V_Id,COUNT(*) from $bug_info_table where date between '$date1'and '$date2' group by V_Id;");
			$bugs_table="new_bugs_".$j."_".$year1;
			$log_bugs=mysqli_query($con,"select V_Id,COUNT(*) from $bugs_table where date between '$date1'and '$date2' group by V_Id;");
			echo "<div id='status_perf'><h3>Tester Status of month ".$j." ".$year1."</h3>";
			echo "<table class='table table-bordered'><caption>Apps Details</caption>";
			for($i=0;$i<mysqli_num_rows($query);$i++){
				$fet=mysqli_fetch_array($query);
				echo "<tr><td>$fet[0]</td><td>$fet[1]</td></tr>";
			}
			echo "</table>";
			echo "<table class='table table-bordered'><caption>Bugs Details</caption>";
			for($i=0;$i<mysqli_num_rows($log_bugs);$i++){
				$fet=mysqli_fetch_array($log_bugs);
				echo "<tr><td>$fet[0]</td><td>$fet[1]</td></tr>";
			}
			echo "</table></div>";
		}
	}
	else if($year1==$year2 and $month1==$month2){
			$bug_info_table="buginfo_".$month1."_".$year1;
			$query=mysqli_query($con,"select V_Id,COUNT(*) from $bug_info_table where date between '$from_d'and '$to_d' group by V_Id;");
			$bugs_table="new_bugs_".$month1."_".$year1;
			$log_bugs=mysqli_query($con,"select V_Id,COUNT(*) from $bugs_table where date between '$from_d'and '$to_d' group by V_Id;");
			echo "<div id='status_perf'><h3>Tester Status of between ".$from_d." to ".$to_d."</h3>";
			echo "<table class='table table-bordered'><caption>Apps Details</caption>";
			for($i=0;$i<mysqli_num_rows($query);$i++){
				$fet=mysqli_fetch_array($query);
				echo "<tr><td>$fet[0]</td><td>$fet[1]</td></tr>";
			}
			echo "</table>";
			echo "<table class='table table-bordered'><caption>Bugs Details</caption>";
			for($i=0;$i<mysqli_num_rows($log_bugs);$i++){
				$fet=mysqli_fetch_array($log_bugs);
				echo "<tr><td>$fet[0]</td><td>$fet[1]</td></tr>";
			}
			echo "</table></div>";
	}
	else if($year1!=$year2){
		for($k=$year1;$k<=$year2;$k++){
			$x=99;
			$y=100;
			if($k!=$year1){
				$x=01;
			}
			else{
				$x=$month1;
			}
			if($k==$year2){
				$y=$month2;
			}
			else{
				$y=12;
			}
			for($j=$x;$j<=$y;$j++){
				if($j<=9){
					$mn="0".$j;
				}
				else{
					$mn=$j;
				}
				if($k==$year1 and $j==$month1){
					$date1=$from_d;
					$date2=$year1."-".$mn."-31";
				}
				else if($k==$year2 and $j==$month2){
					$date1=$year2."-".$mn."-01";
					$date2=$to_d;
				}
				else{
					$date1=$k."-".$mn."-01";
					$date2=$k."-".$mn."-31";
				}
				$bug_info_table="buginfo_".$mn."_".$year1;
				$query=mysqli_query($con,"select V_Id,COUNT(*) from $bug_info_table where date between '$date1'and '$date2' group by V_Id;");
				$bugs_table="new_bugs_".$mn."_".$year1;
				$log_bugs=mysqli_query($con,"select V_Id,COUNT(*) from $bugs_table where date between '$date1'and '$date2' group by V_Id;");
				echo "<div id='status_perf'><h3>Tester Status of month ".$mn." ".$k."</h3>";
				echo "<table class='table table-bordered'><caption>Apps Details</caption>";
				for($i=0;$i<mysqli_num_rows($query);$i++){
					$fet=mysqli_fetch_array($query);
					echo "<tr><td>$fet[0]</td><td>$fet[1]</td></tr>";
				}
				echo "</table>";
				echo "<table class='table table-bordered'><caption>Bugs Details</caption>";
				for($i=0;$i<mysqli_num_rows($log_bugs);$i++){
					$fet=mysqli_fetch_array($log_bugs);
					echo "<tr><td>$fet[0]</td><td>$fet[1]</td></tr>";
				}
				echo "</table></div>";
			}
		}
	}
}
else if($from_d==null and $user!="All"){
	$year=explode('-', $to_d)[0];
	$month=explode('-', $to_d)[1];
	$bug_info_table="buginfo_".$month."_".$year;
	$query=mysqli_query($con,"select V_Id,COUNT(*) from $bug_info_table where date='$to_d' and V_Id='$user';");
	$bugs_table="new_bugs_".$month."_".$year;
	$log_bugs=mysqli_query($con,"select V_Id,COUNT(*) from $bugs_table where date='$to_d' and V_Id='$user';");
	echo "<div id='status_perf'><h3>Tester Status for ".$to_d."</h3>";
	echo "<table class='table table-bordered'><caption>Apps Details</caption>";
	for($i=0;$i<mysqli_num_rows($query);$i++){
		$fet=mysqli_fetch_array($query);
		echo "<tr><td>$user</td><td>$fet[1]</td></tr>";
	}
	echo "</table>";
	echo "<table class='table table-bordered'><caption>Bugs Details</caption>";
	for($i=0;$i<mysqli_num_rows($log_bugs);$i++){
		$fet=mysqli_fetch_array($log_bugs);
		echo "<tr><td>$user</td><td>$fet[1]</td></tr>";
	}
	echo "</table></div>";
}
else if($from_d!=null and $user!="All"){
	$year1=explode('-', $from_d)[0];
	$month1=explode('-', $from_d)[1];
	$year2=explode('-', $to_d)[0];
	$month2=explode('-', $to_d)[1];
	if($year1==$year2 and $month1!=$month2){
		for($j=$month1;$j<=$month2;$j++){
			if($j<=9 && $j!=$month1){
				$mn="0".$j;
			}
			else{
				$mn=$j;
			}
			if($j==$month1){
				$date1=$from_d;
				$date2=$year1."-".$mn."-31";
			}
			else if($j==$month2){
				$date1=$year1."-".$mn."-01";
				$date2=$to_d;
			}
			else{
				$date1=$year1."-".$mn."-01";
				$date2=$year1."-".$mn."-31";
			}
			$bug_info_table="buginfo_".$mn."_".$year1;
			$query=mysqli_query($con,"select V_Id,COUNT(*) from $bug_info_table where V_Id='$user' and date between '$date1'and '$date2';");
			$bugs_table="new_bugs_".$mn."_".$year1;
			$log_bugs=mysqli_query($con,"select V_Id,COUNT(*) from $bugs_table where V_Id='$user' and date between '$date1'and '$date2';");
			echo "<div id='status_perf'><h3>Tester Status of month ".$mn." ".$year1."</h3>";
			echo "<table class='table table-bordered'><caption>Apps Details</caption>";
			for($i=0;$i<mysqli_num_rows($query);$i++){
				$fet=mysqli_fetch_array($query);
				echo "<tr><td>$user</td><td>$fet[1]</td></tr>";
			}
			echo "</table>";
			echo "<table class='table table-bordered'><caption>Bugs Details</caption>";
			for($i=0;$i<mysqli_num_rows($log_bugs);$i++){
				$fet=mysqli_fetch_array($log_bugs);
				echo "<tr><td>$user</td><td>$fet[1]</td></tr>";
			}
			echo "</table></div>";
		}
	}
	else if($year1==$year2 and $month1==$month2){
			$bug_info_table="buginfo_".$month1."_".$year1;
			$query=mysqli_query($con,"select V_Id,COUNT(*) from $bug_info_table where V_Id='$user' and date between '$from_d'and '$to_d';");
			$bugs_table="new_bugs_".$month1."_".$year1;
			$log_bugs=mysqli_query($con,"select V_Id,COUNT(*) from $bugs_table where V_Id='$user' and date between '$from_d'and '$to_d';");
			echo "<div id='status_perf'><h3>Tester Status of between ".$from_d." to ".$to_d."</h3>";
			echo "<table class='table table-bordered'><caption>Apps Details</caption>";
			for($i=0;$i<mysqli_num_rows($query);$i++){
				$fet=mysqli_fetch_array($query);
				echo "<tr><td>$user</td><td>$fet[1]</td></tr>";
			}
			echo "</table>";
			echo "<table class='table table-bordered'><caption>Bugs Details</caption>";
			for($i=0;$i<mysqli_num_rows($log_bugs);$i++){
				$fet=mysqli_fetch_array($log_bugs);
				echo "<tr><td>$user</td><td>$fet[1]</td></tr>";
			}
			echo "</table></div>";
	}
	else if($year1!=$year2){
		for($k=$year1;$k<=$year2;$k++){
			$x=99;
			$y=100;
			if($k!=$year1){
				$x=01;
			}
			else{
				$x=$month1;
			}
			if($k==$year2){
				$y=$month2;
			}
			else{
				$y=12;
			}
			for($j=$x;$j<=$y;$j++){
				if($j<=9){
					$mn="0".$j;
				}
				else{
					$mn=$j;
				}
				if($k==$year1 and $j==$month1){
					$date1=$from_d;
					$date2=$year1."-".$mn."-31";
				}
				else if($k==$year2 and $j==$month2){
					$date1=$year2."-".$mn."-01";
					$date2=$to_d;
				}
				else{
					$date1=$k."-".$mn."-01";
					$date2=$k."-".$mn."-31";
				}
				$bug_info_table="buginfo_".$mn."_".$year1;
				$query=mysqli_query($con,"select V_Id,COUNT(*) from $bug_info_table where V_Id='$user' and date between '$date1'and '$date2';");
				$bugs_table="new_bugs_".$mn."_".$year1;
				$log_bugs=mysqli_query($con,"select V_Id,COUNT(*) from $bugs_table where V_Id='$user' and date between '$date1'and '$date2';");
				echo "<div id='status_perf'><h3>Tester Status of month ".$mn." ".$k."</h3>";
				echo "<table class='table table-bordered'><caption>Apps Details</caption>";
				for($i=0;$i<mysqli_num_rows($query);$i++){
					$fet=mysqli_fetch_array($query);
					echo "<tr><td>$user</td><td>$fet[1]</td></tr>";
				}
				echo "</table>";
				echo "<table class='table table-bordered'><caption>Bugs Details</caption>";
				for($i=0;$i<mysqli_num_rows($log_bugs);$i++){
					$fet=mysqli_fetch_array($log_bugs);
					echo "<tr><td>$user</td><td>$fet[1]</td></tr>";
				}
				echo "</table></div>";
			}
		}
	}
}
?>