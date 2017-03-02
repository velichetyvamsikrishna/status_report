<?php
include("db.php");
$mobile=array("Mobile-TextScaling","Mobile-Narrator","Mobile-HighContrast","Mobile-Browser","Bluetooth-Keyboard");
$desktop=array("Desktop-TextScaling","Desktop-Speech","Desktop-Settings","Desktop-NVDA","Desktop-Narrator","Desktop-Keyboard","Desktop-JAWS","Desktop-HighContrast","Desktop-ColorContrast","Desktop-Browser","Tablet-Narrator");
$mobile_contains=array("TextScaling Test pass","Mobile-Narrator","Mobile-HighContrast","Browser-Mobile","Bluetooth");
$desktop_contains=array("Desktop-TextScaling","Speech","Settings-Desktop","NVDA","Desktop-Narrator","Keyboard","Desktop-JAWS","Desktop-HighContrast","Desktop-ColorContrast","Desktop-Browser","Tablet-Narrator");
$mobile_not_contains=array("na","na","na","na","na");
$desktop_not_contains=array("na","na","na","na","na","Bluetooth","na","na","na","na","na");
$totals_links_desk=mysqli_query($con,"select * from totals_links where Name='Desktop'");
$links_fet_desk=mysqli_fetch_array($totals_links_desk);
$link_desk_tot=$links_fet_desk[1];$link_desk_act=$links_fet_desk[2];$link_desk_fix=$links_fet_desk[3];$link_desk_wntf=$links_fet_desk[4];
$link_desk_ext=$links_fet_desk[5];$link_desk_dup=$links_fet_desk[6];$link_desk_notrep=$links_fet_desk[7];$link_desk_bydes=$links_fet_desk[8];
$totals_links_mob=mysqli_query($con,"select * from totals_links where Name='Mobile'");
$links_fet_mobile=mysqli_fetch_array($totals_links_mob);
$link_mob_tot=$links_fet_mobile[1];$link_mob_act=$links_fet_mobile[2];$link_mob_fix=$links_fet_mobile[3];$link_mob_wntf=$links_fet_mobile[4];
$link_mob_ext=$links_fet_mobile[5];$link_mob_dup=$links_fet_mobile[6];$link_mob_notrep=$links_fet_mobile[7];$link_mob_bydes=$links_fet_mobile[8];
?>
<table class="table table-bordered table-hover">
	<caption>On Mobile</caption>
	<thead>
	<th>Test Pass Name</th>
	<th>Total</th><th>Active</th><th>Fixed</th><th>Won't Fix</th><th>External</th><th>Duplicate</th><th>Not Repro</th><th>By Design</th>
	</thead>
	<tbody>
	<?php
		$total_mobile=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Found_Environment LIKE '%Mobile%';");
		$t_f_m=mysqli_fetch_array($total_mobile);
		$t_f_m_count=$t_f_m[0];
		$total_mobile_act=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Found_Environment LIKE '%Mobile%' and State = 'Active';");
		$t_f_m_act=mysqli_fetch_array($total_mobile_act);
		$t_f_m_count_act=$t_f_m_act[0];
		$total_mobile_fix=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Found_Environment LIKE '%Mobile%' and Resolved_Reason = 'Fixed';");
		$t_f_m_fix=mysqli_fetch_array($total_mobile_fix);
		$t_f_m_count_fix=$t_f_m_fix[0];
		$total_mobile_wont=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Found_Environment LIKE '%Mobile%' and Resolved_Reason = 'Won''t Fix';");
		$t_f_m_wont=mysqli_fetch_array($total_mobile_wont);
		$t_f_m_count_wont=$t_f_m_wont[0];
		$total_mobile_ext=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Found_Environment LIKE '%Mobile%' and Resolved_Reason = 'External';");
		$t_f_m_ext=mysqli_fetch_array($total_mobile_ext);
		$t_f_m_count_ext=$t_f_m_ext[0];
		$total_mobile_dup=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Found_Environment LIKE '%Mobile%' and Resolved_Reason = 'Duplicate';");
		$t_f_m_dup=mysqli_fetch_array($total_mobile_dup);
		$t_f_m_count_dup=$t_f_m_dup[0];
		$total_mobile_not=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Found_Environment LIKE '%Mobile%' and Resolved_Reason = 'Not Repro';");
		$t_f_m_not=mysqli_fetch_array($total_mobile_not);
		$t_f_m_count_not=$t_f_m_not[0];
		$total_mobile_bydes=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Found_Environment LIKE '%Mobile%' and Resolved_Reason = 'By Design';");
		$t_f_m_bydes=mysqli_fetch_array($total_mobile_bydes);
		$t_f_m_count_bydes=$t_f_m_bydes[0];
		for($i=0;$i<count($mobile);$i++){
			echo "<tr><td>$mobile[$i]</td>";
			$temp_data=mysqli_query($con,"SELECT * FROM bugs_data WHERE Custom_String LIKE '%$mobile_contains[$i]%';");
			if($temp_data){
				$sel_links=mysqli_query($con,"select * from links_report where Name = '$mobile[$i]';");
				$link_fetch=mysqli_fetch_array($sel_links);
				$link_total=$link_fetch[1];$link_active=$link_fetch[2];$link_fixed=$link_fetch[3];$link_wontfix=$link_fetch[4];$link_external=$link_fetch[5];
				$link_dup=$link_fetch[6];$link_notrep=$link_fetch[7];$link_bydesign=$link_fetch[8];
				$temp_total=mysqli_num_rows($temp_data);
				$temp_act_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$mobile_contains[$i]%' and State = 'Active';");
				$temp_fet_act=mysqli_fetch_array($temp_act_sel);
				$temp_act_count=$temp_fet_act[0];
				$temp_fix_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$mobile_contains[$i]%' and Resolved_Reason = 'Fixed';");
				$temp_fet_fix=mysqli_fetch_array($temp_fix_sel);
				$temp_fix_count=$temp_fet_fix[0];
				$temp_wont_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$mobile_contains[$i]%' and Resolved_Reason = 'Won''t Fix';");
				$temp_fet_wont=mysqli_fetch_array($temp_wont_sel);
				$temp_wont_count=$temp_fet_wont[0];
				$temp_ext_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$mobile_contains[$i]%' and Resolved_Reason = 'External';");
				$temp_fet_ext=mysqli_fetch_array($temp_ext_sel);
				$temp_ext_count=$temp_fet_ext[0];
				$temp_dup_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$mobile_contains[$i]%' and Resolved_Reason = 'Duplicate';");
				$temp_fet_dup=mysqli_fetch_array($temp_dup_sel);
				$temp_dup_count=$temp_fet_dup[0];
				$temp_not_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$mobile_contains[$i]%' and Resolved_Reason = 'Not Repro';");
				$temp_fet_not=mysqli_fetch_array($temp_not_sel);
				$temp_not_count=$temp_fet_not[0];
				$temp_bydes_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$mobile_contains[$i]%' and Resolved_Reason = 'By Design';");
				$temp_fet_bydes=mysqli_fetch_array($temp_bydes_sel);
				$temp_bydes_count=$temp_fet_bydes[0];
				
				echo "<td><a href='$link_total' target='_blank'>$temp_total</a></td><td><a href='$link_active' target='_blank'>$temp_act_count</a></td><td><a href='$link_fixed' target='_blank'>$temp_fix_count</a></td><td><a href='$link_wontfix' target='_blank'>$temp_wont_count</a></td><td><a href='$link_external' target='_blank'>$temp_ext_count</a></td><td><a href='$link_dup' target='_blank'>$temp_dup_count</a></td><td><a href='$link_notrep' target='_blank'>$temp_not_count</a></td><td><a href='$link_bydesign' target='_blank'>$temp_bydes_count</a></td></tr>";
			}
			else{
				echo "<td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td>";
			}
		}
		echo "<tr><td><b>Total<b></td><td><a href='$link_mob_tot' target='_blank'>$t_f_m_count</a></td><td><a href='$link_mob_act' target='_blank'>$t_f_m_count_act</a></td><td><a href='$link_mob_fix' target='_blank'>$t_f_m_count_fix</a></td><td><a href='$link_mob_wntf' target='_blank'>$t_f_m_count_wont</a></td><td><a href='$link_mob_ext' target='_blank'>$t_f_m_count_ext</a></td><td><a href='$link_mob_dup' target='_blank'>$t_f_m_count_dup</a></td><td><a href='$link_mob_notrep' target='_blank'>$t_f_m_count_not</a></td><td><a href='$link_mob_bydes' target='_blank'>$t_f_m_count_bydes</a></td></tr>";
		
	?>
	</tbody>
</table>
<table class="table table-bordered table-hover">
	<caption>On Desktop</caption>
	<thead>
	<th>Test Pass Name</th>
	<th>Total</th><th>Active</th><th>Fixed</th><th>Won't Fix</th><th>External</th><th>Duplicate</th><th>Not Repro</th><th>By Design</th>
	</thead>
	<tbody>
	<?php
		$total_desktop=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Found_Environment LIKE '%Desktop%';");
		$t_f_d=mysqli_fetch_array($total_desktop);
		$t_f_d_count=$t_f_d[0];
		$total_desktop_act=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Found_Environment LIKE '%Desktop%' and State = 'Active';");
		$t_f_d_act=mysqli_fetch_array($total_desktop_act);
		$t_f_d_count_act=$t_f_d_act[0];
		$total_desktop_fix=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Found_Environment LIKE '%Desktop%' and Resolved_Reason = 'Fixed';");
		$t_f_d_fix=mysqli_fetch_array($total_desktop_fix);
		$t_f_d_count_fix=$t_f_d_fix[0];
		$total_desktop_wont=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Found_Environment LIKE '%Desktop%' and Resolved_Reason = 'Won''t Fix';");
		$t_f_d_wont=mysqli_fetch_array($total_desktop_wont);
		$t_f_d_count_wont=$t_f_d_wont[0];
		$total_desktop_ext=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Found_Environment LIKE '%Desktop%' and Resolved_Reason = 'External';");
		$t_f_d_ext=mysqli_fetch_array($total_desktop_ext);
		$t_f_d_count_ext=$t_f_d_ext[0];
		$total_desktop_dup=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Found_Environment LIKE '%Desktop%' and Resolved_Reason = 'Duplicate';");
		$t_f_d_dup=mysqli_fetch_array($total_desktop_dup);
		$t_f_d_count_dup=$t_f_d_dup[0];
		$total_desktop_not=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Found_Environment LIKE '%Desktop%' and Resolved_Reason = 'Not Repro';");
		$t_f_d_not=mysqli_fetch_array($total_desktop_not);
		$t_f_d_count_not=$t_f_d_not[0];
		$total_desktop_bydes=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Found_Environment LIKE '%Desktop%' and Resolved_Reason = 'By Design';");
		$t_f_d_bydes=mysqli_fetch_array($total_desktop_bydes);
		$t_f_d_count_bydes=$t_f_d_bydes[0];
		for($i=0;$i<count($desktop);$i++){
			echo "<tr><td>$desktop[$i]</td>";
			
			if($temp_data){
				$sel_links=mysqli_query($con,"select * from links_report where Name = '$desktop[$i]';");
				$link_fetch=mysqli_fetch_array($sel_links);
				$link_total=$link_fetch[1];$link_active=$link_fetch[2];$link_fixed=$link_fetch[3];$link_wontfix=$link_fetch[4];$link_external=$link_fetch[5];
				$link_dup=$link_fetch[6];$link_notrep=$link_fetch[7];$link_bydesign=$link_fetch[8];
				
				if($desktop_not_contains[$i]=="na"){
					$temp_data=mysqli_query($con,"SELECT * FROM bugs_data WHERE Custom_String LIKE '%$desktop_contains[$i]%';");
					$temp_total=mysqli_num_rows($temp_data);
					$temp_act_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$desktop_contains[$i]%' and State = 'Active';");
					$temp_fet_act=mysqli_fetch_array($temp_act_sel);
					$temp_act_count=$temp_fet_act[0];
					$temp_fix_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$desktop_contains[$i]%' and Resolved_Reason = 'Fixed';");
					$temp_fet_fix=mysqli_fetch_array($temp_fix_sel);
					$temp_fix_count=$temp_fet_fix[0];
					$temp_wont_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$desktop_contains[$i]%' and Resolved_Reason = 'Won''t Fix';");
					$temp_fet_wont=mysqli_fetch_array($temp_wont_sel);
					$temp_wont_count=$temp_fet_wont[0];
					$temp_ext_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$desktop_contains[$i]%' and Resolved_Reason = 'External';");
					$temp_fet_ext=mysqli_fetch_array($temp_ext_sel);
					$temp_ext_count=$temp_fet_ext[0];
					$temp_dup_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$desktop_contains[$i]%' and Resolved_Reason = 'Duplicate';");
					$temp_fet_dup=mysqli_fetch_array($temp_dup_sel);
					$temp_dup_count=$temp_fet_dup[0];
					$temp_not_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$desktop_contains[$i]%' and Resolved_Reason = 'Not Repro';");
					$temp_fet_not=mysqli_fetch_array($temp_not_sel);
					$temp_not_count=$temp_fet_not[0];
					$temp_bydes_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$desktop_contains[$i]%' and Resolved_Reason = 'By Design';");
					$temp_fet_bydes=mysqli_fetch_array($temp_bydes_sel);
					$temp_bydes_count=$temp_fet_bydes[0];	
				}
				else{
					$temp_data=mysqli_query($con,"SELECT * FROM bugs_data WHERE Custom_String LIKE '%$desktop_contains[$i]%' and Custom_String NOT LIKE '%$desktop_not_contains[$i]%';");
					$temp_total=mysqli_num_rows($temp_data);
					$temp_act_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$desktop_contains[$i]%' and Custom_String NOT LIKE '%$desktop_not_contains[$i]%' and State = 'Active';");
					$temp_fet_act=mysqli_fetch_array($temp_act_sel);
					$temp_act_count=$temp_fet_act[0];
					$temp_fix_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$desktop_contains[$i]%' and Custom_String NOT LIKE '%$desktop_not_contains[$i]%' and Resolved_Reason = 'Fixed';");
					$temp_fet_fix=mysqli_fetch_array($temp_fix_sel);
					$temp_fix_count=$temp_fet_fix[0];
					$temp_wont_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$desktop_contains[$i]%' and Custom_String NOT LIKE '%$desktop_not_contains[$i]%' and Resolved_Reason = 'Won''t Fix';");
					$temp_fet_wont=mysqli_fetch_array($temp_wont_sel);
					$temp_wont_count=$temp_fet_wont[0];
					$temp_ext_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$desktop_contains[$i]%' and Custom_String NOT LIKE '%$desktop_not_contains[$i]%' and Resolved_Reason = 'External';");
					$temp_fet_ext=mysqli_fetch_array($temp_ext_sel);
					$temp_ext_count=$temp_fet_ext[0];
					$temp_dup_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$desktop_contains[$i]%' and Custom_String NOT LIKE '%$desktop_not_contains[$i]%' and Resolved_Reason = 'Duplicate';");
					$temp_fet_dup=mysqli_fetch_array($temp_dup_sel);
					$temp_dup_count=$temp_fet_dup[0];
					$temp_not_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$desktop_contains[$i]%' and Custom_String NOT LIKE '%$desktop_not_contains[$i]%' and Resolved_Reason = 'Not Repro';");
					$temp_fet_not=mysqli_fetch_array($temp_not_sel);
					$temp_not_count=$temp_fet_not[0];
					$temp_bydes_sel=mysqli_query($con,"SELECT COUNT(*) FROM bugs_data WHERE Custom_String LIKE '%$desktop_contains[$i]%' and Custom_String NOT LIKE '%$desktop_not_contains[$i]%' and Resolved_Reason = 'By Design';");
					$temp_fet_bydes=mysqli_fetch_array($temp_bydes_sel);
					$temp_bydes_count=$temp_fet_bydes[0];
				}
					
				echo "<td><a href='$link_total' target='_blank'>$temp_total</a></td><td><a href='$link_active' target='_blank'>$temp_act_count</a></td><td><a href='$link_fixed' target='_blank'>$temp_fix_count</a></td><td><a href='$link_wontfix' target='_blank'>$temp_wont_count</a></td><td><a href='$link_external' target='_blank'>$temp_ext_count</a></td><td><a href='$link_dup' target='_blank'>$temp_dup_count</a></td><td><a href='$link_notrep' target='_blank'>$temp_not_count</a></td><td><a href='$link_bydesign' target='_blank'>$temp_bydes_count</a></td></tr>";
			}
			else{
				echo "<td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td>";
			}
		}
		echo "<tr><td><b>Total<b></td><td><a href='$link_desk_tot' target='_blank'>$t_f_d_count</a></td><td><a href='$link_desk_act' target='_blank'>$t_f_d_count_act</a></td><td><a href='$link_desk_fix' target='_blank'>$t_f_d_count_fix</a></td><td><a href='$link_desk_wntf' target='_blank'>$t_f_d_count_wont</a></td><td><a href='$link_desk_ext' target='_blank'>$t_f_d_count_ext</a></td><td><a href='$link_desk_dup' target='_blank'>$t_f_d_count_dup</a></td><td><a href='$link_desk_notrep' target='_blank'>$t_f_d_count_not</a></td><td><a href='$link_desk_bydes' target='_blank'>$t_f_d_count_bydes</a></td></tr>";
		
	?>
	</tbody>
</table>

