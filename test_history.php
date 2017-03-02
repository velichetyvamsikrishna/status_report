<?php
include("db.php");
$app=$_GET["app_name"];
$plt=$_GET["platform"];
$sce=$_GET["scenario"];
$date=date("Y-m-d");
$month=date("m");
$year=date("Y");
$check_count_d=99;
$check_count_m=99;
$fcheck_d=100;
$fcheck_m=100;

function get_build($con,$tp,$dt){
	$sel_1=mysqli_query($con,"select build from current_tp where name='$tp' and date='$dt';");
	$sel_2=mysqli_query($con,"select build from previous_tp where name='$tp' and date='$dt';");
	if(mysqli_num_rows($sel_1)>0){
		$b=mysqli_fetch_array($sel_1);
		$build=$b[0];
		if($build==NULL){
			$build="Not Available";
		}
	}
	else if(mysqli_num_rows($sel_2)>0){		
		$b=mysqli_fetch_array($sel_2);
		$build=$b[0];
		if($build==NULL){
			$build="Not Available";
		}
	}
	else{
		$build="Not Available";
	}
	return $build;
}

if($plt=="Select" && $sce=="Select"){
	echo "<table class='table table-bordered'><caption> Test History on Desktop </caption><thead><th>TestPass</th><th>Build</th><th>Version</th><th>Date</th><th>Status</th><th>Bugs</th></thead>";
	for($i=$month;$i>0;$i--){
		$bug_info_table="buginfo_".$i."_".$year;
		$sel=mysqli_query($con,"select TestPass,Version,date,Status,Bugs from $bug_info_table where AppName like '%$app%' and TestPass like '%Desktop%' order by date DESC");
		if($sel){
			if(mysqli_num_rows($sel)>0){
				$check_count_d=100;
				for($j=0;$j<mysqli_num_rows($sel);$j++){
					$fet=mysqli_fetch_array($sel);
					$build=get_build($con,$fet[0],$fet[2]);
					echo "<tr><td>$fet[0]</td><td>$build</td><td>$fet[1]</td><td>$fet[2]</td><td>$fet[3]</td><td>$fet[4]</td></tr>";
				}
				break;
			}
		}	
	}
	if($check_count_d==99){
		for($i=12;$i>0;$i--){
			$y_1=date("Y")-1;
			$bug_info_table="buginfo_".$i."_".$y_1;
			$sel=mysqli_query($con,"select TestPass,Version,date,Status,Bugs from $bug_info_table where AppName like '%$app%' and TestPass like '%Desktop%' order by date DESC");
			if($sel){
				if(mysqli_num_rows($sel)>0){
					$fcheck_d=99;
					for($j=0;$j<mysqli_num_rows($sel);$j++){
						$fet=mysqli_fetch_array($sel);
						$build=get_build($con,$fet[0],$fet[2]);
						echo "<tr><td>$fet[0]</td><td>$build</td><td>$fet[1]</td><td>$fet[2]</td><td>$fet[3]</td><td>$fet[4]</td></tr>";
					}
					break;
				}
			}	
		}
		if($fcheck_d==100){
			echo "<tr><td colspan=6>Sorry no results found for this app on Desktop</td></tr>";
		}
	}
	echo "</table>";
	echo "<table class='table table-bordered'><caption> Test History on Mobile </caption><thead><th>TestPass</th><th>Build</th><th>Version</th><th>Date</th><th>Status</th><th>Bugs</th></thead>";
	for($i=$month;$i>0;$i--){
		$bug_info_table="buginfo_".$i."_".$year;
		$sel1=mysqli_query($con,"select TestPass,Version,date,Status,Bugs from $bug_info_table where AppName like '%$app%' and TestPass like '%Mobile%' order by date DESC");
		if($sel1){
			if(mysqli_num_rows($sel1)>0){
				$check_count_m=100;
				for($j=0;$j<mysqli_num_rows($sel1);$j++){
					$fet1=mysqli_fetch_array($sel1);
					$build=get_build($con,$fet1[0],$fet1[2]);
					echo "<tr><td>$fet1[0]</td><td>$build</td><td>$fet1[1]</td><td>$fet1[2]</td><td>$fet1[3]</td><td>$fet1[4]</td></tr>";
				}
				break;
			}	
		}
	}
	if($check_count_m==99){
		for($i=12;$i>0;$i--){
			$y_1=date("Y")-1;
			$bug_info_table="buginfo_".$i."_".$y_1;
			$sel1=mysqli_query($con,"select TestPass,Version,date,Status,Bugs from $bug_info_table where AppName like '%$app%' and TestPass like '%Mobile%' order by date DESC");
			if($sel1){
				if(mysqli_num_rows($sel1)>0){
					$fcheck_m=99;
					for($j=0;$j<mysqli_num_rows($sel1);$j++){
						$fet1=mysqli_fetch_array($sel1);
						$build=get_build($con,$fet1[0],$fet1[2]);
						echo "<tr><td>$fet1[0]</td><td>$build</td><td>$fet1[1]</td><td>$fet1[2]</td><td>$fet1[3]</td><td>$fet1[4]</td></tr>";
					}
					break;
				}	
			}
		}
		if($fcheck_m==100){
			echo "<tr><td colspan=6>Sorry no results found for this app on Mobile</td></tr>";
		}
	}
	echo "</table>";	
}
else if($plt=="Select" && $sce!="Select"){
	echo "<table class='table table-bordered'><caption> Test History on Desktop </caption><thead><th>TestPass</th><th>Build</th><th>Version</th><th>Date</th><th>Status</th><th>Bugs</th></thead>";
	for($i=$month;$i>0;$i--){
		$bug_info_table="buginfo_".$i."_".$year;
		$sel=mysqli_query($con,"select TestPass,Version,date,Status,Bugs from $bug_info_table where AppName like '%$app%' and TestPass like '%Desktop%' and TestPass LIKE '%$sce%' order by date DESC");
		if($sel){
			if(mysqli_num_rows($sel)>0){
				$check_count_d=100;
				for($j=0;$j<mysqli_num_rows($sel);$j++){
					$fet=mysqli_fetch_array($sel);
					$build=get_build($con,$fet[0],$fet[2]);
					echo "<tr><td>$fet[0]</td><td>$build</td><td>$fet[1]</td><td>$fet[2]</td><td>$fet[3]</td><td>$fet[4]</td></tr>";
				}
				break;
			}
		}	
	}
	if($check_count_d==99){
		for($i=12;$i>0;$i--){
			$y_1=date("Y")-1;
			$bug_info_table="buginfo_".$i."_".$y_1;
			$sel=mysqli_query($con,"select TestPass,Version,date,Status,Bugs from $bug_info_table where AppName like '%$app%' and TestPass like '%Desktop%' and TestPass LIKE '%$sce%' order by date DESC");
			if($sel){
				if(mysqli_num_rows($sel)>0){
					$fcheck_d=99;
					for($j=0;$j<mysqli_num_rows($sel);$j++){
						$fet=mysqli_fetch_array($sel);
						$build=get_build($con,$fet[0],$fet[2]);
						echo "<tr><td>$fet[0]</td><td>$build</td><td>$fet[1]</td><td>$fet[2]</td><td>$fet[3]</td><td>$fet[4]</td></tr>";
					}
					break;
				}
			}	
		}
		if($fcheck_d==100){
			echo "<tr><td colspan=6>Sorry no results found for this app on Desktop</td></tr>";
		}
	}
	echo "</table>";
	echo "<table class='table table-bordered'><caption> Test History on Mobile </caption><thead><th>TestPass</th><th>Build</th><th>Version</th><th>Date</th><th>Status</th><th>Bugs</th></thead>";
	for($i=$month;$i>0;$i--){
		$bug_info_table="buginfo_".$i."_".$year;
		$sel1=mysqli_query($con,"select TestPass,Version,date,Status,Bugs from $bug_info_table where AppName like '%$app%' and TestPass like '%Mobile%' and TestPass LIKE '%$sce%' order by date DESC");
		if($sel1){
			if(mysqli_num_rows($sel1)>0){
				$check_count_m=100;
				for($j=0;$j<mysqli_num_rows($sel1);$j++){
					$fet1=mysqli_fetch_array($sel1);
					$build=get_build($con,$fet1[0],$fet1[2]);
					echo "<tr><td>$fet1[0]</td><td>$build</td><td>$fet1[1]</td><td>$fet1[2]</td><td>$fet1[3]</td><td>$fet1[4]</td></tr>";
				}
				break;
			}	
		}
	}
	if($check_count_m==99){
		for($i=12;$i>0;$i--){
			$y_1=date("Y")-1;
			$bug_info_table="buginfo_".$i."_".$y_1;
			$sel1=mysqli_query($con,"select TestPass,Version,date,Status,Bugs from $bug_info_table where AppName like '%$app%' and TestPass like '%Mobile%' and TestPass LIKE '%$sce%' order by date DESC");
			if($sel1){
				if(mysqli_num_rows($sel1)>0){
					$fcheck_m=99;
					for($j=0;$j<mysqli_num_rows($sel1);$j++){
						$fet1=mysqli_fetch_array($sel1);
						$build=get_build($con,$fet1[0],$fet1[2]);
						echo "<tr><td>$fet1[0]</td><td>$build</td><td>$fet1[1]</td><td>$fet1[2]</td><td>$fet1[3]</td><td>$fet1[4]</td></tr>";
					}
					break;
				}	
			}
		}
		if($fcheck_m==100){
			echo "<tr><td colspan=6>Sorry no results found for this app on Mobile</td></tr>";
		}
	}
	echo "</table>";
}
else if($plt!="Select" && $sce=="Select"){
	echo "<table class='table table-bordered'><caption> Test History on $plt </caption><thead><th>TestPass</th><th>Build</th><th>Version</th><th>Date</th><th>Status</th><th>Bugs</th></thead>";
	for($i=$month;$i>0;$i--){
		$bug_info_table="buginfo_".$i."_".$year;
		$sel=mysqli_query($con,"select TestPass,Version,date,Status,Bugs from $bug_info_table where AppName like '%$app%' and TestPass like '%$plt%' order by date DESC");
		if($sel){
			if(mysqli_num_rows($sel)>0){
				$check_count_d=100;
				for($j=0;$j<mysqli_num_rows($sel);$j++){
					$fet=mysqli_fetch_array($sel);
					$build=get_build($con,$fet[0],$fet[2]);
					echo "<tr><td>$fet[0]</td><td>$build</td><td>$fet[1]</td><td>$fet[2]</td><td>$fet[3]</td><td>$fet[4]</td></tr>";
				}
				break;
			}
		}	
	}
	if($check_count_d==99){
		for($i=12;$i>0;$i--){
			$y_1=date("Y")-1;
			$bug_info_table="buginfo_".$i."_".$y_1;
			$sel=mysqli_query($con,"select TestPass,Version,date,Status,Bugs from $bug_info_table where AppName like '%$app%' and TestPass like '%$plt%' order by date DESC");
			if($sel){
				if(mysqli_num_rows($sel)>0){
					$fcheck_d=99;
					for($j=0;$j<mysqli_num_rows($sel);$j++){
						$fet=mysqli_fetch_array($sel);
						$build=get_build($con,$fet[0],$fet[2]);
						echo "<tr><td>$fet[0]</td><td>$build</td><td>$fet[1]</td><td>$fet[2]</td><td>$fet[3]</td><td>$fet[4]</td></tr>";
					}
					break;
				}
			}	
		}
		if($fcheck_d==100){
			echo "<tr><td colspan=6>Sorry no results found for this app on $plt</td></tr>";
		}
	}
	echo "</table>";
}
else{
	echo "<table class='table table-bordered'><caption> Test History on $plt in $sce</caption><thead><th>TestPass</th><th>Build</th><th>Version</th><th>Date</th><th>Status</th><th>Bugs</th></thead>";
	for($i=$month;$i>0;$i--){
		$bug_info_table="buginfo_".$i."_".$year;
		$sel=mysqli_query($con,"select TestPass,Version,date,Status,Bugs from $bug_info_table where AppName like '%$app%' and TestPass like '%$plt%' and TestPass LIKE '%$sce%' order by date DESC");
		if($sel){
			if(mysqli_num_rows($sel)>0){
				$check_count_d=100;
				for($j=0;$j<mysqli_num_rows($sel);$j++){
					$fet=mysqli_fetch_array($sel);
					$build=get_build($con,$fet[0],$fet[2]);
					echo "<tr><td>$fet[0]</td><td>$build</td><td>$fet[1]</td><td>$fet[2]</td><td>$fet[3]</td><td>$fet[4]</td></tr>";
				}
				break;
			}
		}	
	}
	if($check_count_d==99){
		for($i=12;$i>0;$i--){
			$y_1=date("Y")-1;
			$bug_info_table="buginfo_".$i."_".$y_1;
			$sel=mysqli_query($con,"select TestPass,Version,date,Status,Bugs from $bug_info_table where AppName like '%$app%' and TestPass like '%$plt%' and TestPass LIKE '%$sce%' order by date DESC");
			if($sel){
				if(mysqli_num_rows($sel)>0){
					$fcheck_d=99;
					for($j=0;$j<mysqli_num_rows($sel);$j++){
						$fet=mysqli_fetch_array($sel);
						$build=get_build($con,$fet[0],$fet[2]);
						echo "<tr><td>$fet[0]</td><td>$build</td><td>$fet[1]</td><td>$fet[2]</td><td>$fet[3]</td><td>$fet[4]</td></tr>";
					}
					break;
				}
			}	
		}
		if($fcheck_d==100){
			echo "<tr><td colspan=6>Sorry no results found for this app on $plt in $sce</td></tr>";
		}
	}
	echo "</table>";
}
?>