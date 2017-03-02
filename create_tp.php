<?php
include("db.php");
$date=date("Y-m-d");
$cr_mobile=$_GET["cr_mobile"];
$cr_desktop=$_GET["cr_desktop"];
$pr_mobile=$_GET["pr_mobile"];
$pr_desktop=$_GET["pr_desktop"];
$cr_mobile_b=$_GET["cr_mobile_b"];
$cr_desktop_b=$_GET["cr_desktop_b"];
$pr_mobile_b=$_GET["pr_mobile_b"];
$pr_desktop_b=$_GET["pr_desktop_b"];
?>
<div id="crtp" class="container" >
	<h3>Created Below Test Passes for <?php echo $date;?></h3>
	<br/>
	<div class="panel panel-default col-md-5" style="margin-right:25px;" >
	  <div class="panel-heading">
		<h2 class="panel-title">Current Test Pass TP'S</h2>
	  </div>
	  <div class="panel-body">
		<ol>
		<?php
			echo "<li>Mobile Build $cr_mobile_b</li>";
			for($i=0;$i<$cr_mobile;$i++){
				$temp="crtp_m".$i;
				$val=$_GET["$temp"];
				mysqli_query($con,"insert into current_tp values('$date','$val','Mobile','$cr_mobile_b');");
				echo "<li>".$val."</li>";
			}
			echo "<li>Desktop Build $cr_desktop_b</li>";
			for($i=0;$i<$cr_desktop;$i++){
				$temp="crtp_d".$i;
				$val=$_GET["$temp"];
				mysqli_query($con,"insert into current_tp values('$date','$val','Desktop','$cr_desktop_b');");
				echo "<li>".$val."</li>";
			}
		?>
		</ol>
	  </div>
	</div>
	<div class="panel panel-default col-md-6">
	  <div class="panel-heading">
		<h2 class="panel-title">Previous Test Pass TP'S</h2>
	  </div>
	  <div class="panel-body">
		<ol>
		<?php
			echo "<li>Mobile Build $pr_mobile_b</li>";
			for($i=0;$i<$pr_mobile;$i++){
				$temp="prtp_m".$i;
				$val=$_GET["$temp"];
				mysqli_query($con,"insert into previous_tp values('$date','$val','Mobile','$pr_mobile_b');");
				echo "<li>".$val."</li>";
			}
			echo "<li>Desktop Build $pr_desktop_b</li>";
			for($i=0;$i<$pr_desktop;$i++){
				$temp="prtp_d".$i;
				$val=$_GET["$temp"];
				mysqli_query($con,"insert into previous_tp values('$date','$val','Desktop','$pr_desktop_b');");
				echo "<li>".$val."</li>";
			}
		?>
		</ol>
	  </div>
	</div>
</div>