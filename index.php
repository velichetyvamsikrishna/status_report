<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Accessibility Daily status report" />
<meta name="author" content="Vamsi Krishna Velichety" />
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<title>Daily Status Report</title>
<script>
function check_user(){	
	var user=form_log.user.value;
	var pwd=form_log.pwd.value;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("body").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "check.php?user="+user+"&pwd="+pwd, true);
	xmlhttp.send();
	return false;
}
function create_user(){	
	var user=form_cre.user.value;
	var pwd=form_cre.pwd.value;
	var rpwd=form_cre.rpwd.value;
	var hint=form_cre.hint.value;
	var u_type=form_cre.u_type.value;
	if(pwd!=rpwd){
		alert("Make sure that both passwords should match");
		form_cre.rpwd.focus();
		return false;
	}
	if(u_type=="Select Account Type"){
		alert("Please select Account type");
		form_cre.u_type.focus();
		return false;
	}
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("account_form").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "create_user.php?user="+user+"&pwd="+pwd+"&hint="+hint+"&u_type="+u_type, true);
	xmlhttp.send();
	return false;
}
function log_out(){	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("body").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "logout.php", true);
	xmlhttp.send();
}

function get_admin_permissions(val){	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("admin_level").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "admin_level.php?user_id="+val, true);
	xmlhttp.send();
}
</script>
<script>
$.noConflict();
jQuery(document).ready(function($){
	$(document).delegate("#ca", "click", function(){
		var txt='<h2>Accessibility Daily Status Report</h2>'+
			'<br/>'+
			'<form name="form_cre" method="POST" onsubmit="return create_user();">'+
				'<div class="panel panel-default">'+
				  '<div class="panel-heading">'+
					'<h2 class="panel-title">Create Account</h2>'+
				  '</div>'+
				  '<div class="panel-body">'+
					'<input type="email" onKeyup="get_admin_permissions(this.value)" class="form-control" name="user" placeholder="Username" required>'+
					'<br/>'+
					'<input type="password" class="form-control" name="pwd" placeholder="Password" required>'+
					'<br/>'+
					'<input type="password" class="form-control" name="rpwd" placeholder="Re-Enter Password" required>'+
					'<br/>'+
					'<input type="text" class="form-control" name="hint" placeholder="Hint to Reset Password" required>'+
					'<br/>'+
					'<select class="form-control" name="u_type"><option id="admin_level">Select Account Type</option>'+
					'</select>'+
					'<br/>'+
					'<input type="Submit" value="Sign Up" class="btn btn-primary">'+
					'<br/><br/>'+
					'<a href="index.php">Click Here to Login</a>'+
				  '</div>'+
				'</div>'+
			'</form>';
		$("#account_form").html(txt);
	});
});
</script>

<script type="text/javascript">
jQuery(document).ready(function($){
	$(document).delegate('input[name="crtp_mobile_count"]', "change keydown keyup keypress", function(){
		var val1=$('input[name="crtp_mobile_count"]').val();
		var txt="";
		for(i=0;i<val1;i++){
			var temp='crtp_m'+i;
			txt=txt+'<input type="text" class="form-control" placeholder="Enter the name of the Test Pass" required id='+temp+'><br/>';
		}
		$("#crtp_mtp").html(txt);
	});
	$(document).delegate('input[name="crtp_desktop_count"]', "change keydown keyup keypress", function(){
		var val2=$('input[name="crtp_desktop_count"]').val();
		var txt="";
		for(i=0;i<val2;i++){
			var temp='crtp_d'+i;
			txt=txt+'<input type="text" class="form-control" placeholder="Enter the name of the Test Pass" required id='+temp+ '><br/>';
		}
		$("#crtp_dtp").html(txt);
	});
	$(document).delegate('input[name="prtp_mobile_count"]', "change keydown keyup keypress", function(){
		var val3=$('input[name="prtp_mobile_count"]').val();
		var txt="";
		for(i=0;i<val3;i++){
			var temp='prtp_m'+i;
			txt=txt+'<input type="text" class="form-control" placeholder="Enter the name of the Test Pass" required id='+temp+ '><br/>';
		}
		$("#prtp_mtp").html(txt);
	});
	$(document).delegate('input[name="prtp_desktop_count"]', "change keydown keyup keypress", function(){
		var val4=$('input[name="prtp_desktop_count"]').val();
		var txt="";
		for(i=0;i<val4;i++){
			var temp='prtp_d'+i;
			txt=txt+'<input type="text" class="form-control" placeholder="Enter the name of the Test Pass" required id='+temp+ '><br/>';
		}
		$("#prtp_dtp").html(txt);
	});
});
</script>
<script>
function create_testpass(){	
	var cr_mobile=create_tp.crtp_mobile_count.value;
	var cr_desktop=create_tp.crtp_desktop_count.value;
	var pr_mobile=create_tp.prtp_mobile_count.value;
	var pr_desktop=create_tp.prtp_desktop_count.value;
	var cr_mobile_b=create_tp.crtp_mobile_build.value;
	var cr_desktop_b=create_tp.crtp_desktop_build.value;
	var pr_mobile_b=create_tp.prtp_mobile_build.value;
	var pr_desktop_b=create_tp.prtp_desktop_build.value;
	var temp_txt="";
	for(i=0;i<cr_mobile;i++){
			var temp='crtp_m'+i;
			var temp_val=document.getElementById(temp).value;
			temp_txt=temp_txt+"&"+temp+"="+temp_val;
		}
	for(i=0;i<cr_desktop;i++){
			var temp='crtp_d'+i;
			var temp_val=document.getElementById(temp).value;
			temp_txt=temp_txt+"&"+temp+"="+temp_val;
		}
	for(i=0;i<pr_mobile;i++){
			var temp='prtp_m'+i;
			var temp_val=document.getElementById(temp).value;
			temp_txt=temp_txt+"&"+temp+"="+temp_val;
		}
	for(i=0;i<pr_desktop;i++){
			var temp='prtp_d'+i;
			var temp_val=document.getElementById(temp).value;
			temp_txt=temp_txt+"&"+temp+"="+temp_val;
		}
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("body2").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "create_tp.php?cr_mobile="+cr_mobile+"&cr_desktop="+cr_desktop+"&pr_mobile="+pr_mobile+"&pr_desktop="+pr_desktop+"&cr_mobile_b="+cr_mobile_b+"&cr_desktop_b="+cr_desktop_b+"&pr_mobile_b="+pr_mobile_b+"&pr_desktop_b="+pr_desktop_b+temp_txt, true);
	xmlhttp.send();
	return false;
}

function add_tps(){	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("body2").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "work_allocator.php", true);
	xmlhttp.send();
	return false;
}

function submit_test_results(){	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("body2").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "test_details.php", true);
	xmlhttp.send();
	return false;
}

function view_test_results(){	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("body2").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "view_test_results.php", true);
	xmlhttp.send();
	return false;
}
function upload_vso_data(){	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("body2").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "upload_form.php", true);
	xmlhttp.send();
	return false;
}
function view_bugs_table(){	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("body2").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "bugs_data.php", true);
	xmlhttp.send();
	return false;
}
function reporter(){	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("body2").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "reporter.php", true);
	xmlhttp.send();
	return false;
}
function tester_status(){	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("body2").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "tester_done.php", true);
	xmlhttp.send();
	return false;
}
</script>

<script>
jQuery(document).ready(function($){
	$(document).delegate('input[name="tested_apps_no"]', "change keydown keyup keypress", function(){
		var val_no=$('input[name="tested_apps_no"]').val();
		var txt="";
		for(i=0;i<val_no;i++){
			var ap_id="app_id"+i;
			var ap_name_id="app_name_"+i;
			var ap_status="status"+i;
			var ap_ex="ex_bugs"+i;
			var ap_new="new_bugs"+i;
			var ap_version="version"+i;
			txt=txt+'<div class="panel panel-default col-md-3" >'+
				  '<div class="panel-body">'+
					'<input type="number" min="0" class="form-control" id="'+ ap_id +'" placeholder="App ID" required onKeyup="return get_app_name(this.value,this.name)" name="'+ ap_name_id +'">'+
					'<br/>'+
					'<div id="'+ ap_name_id +'"></div>'+
					'<br/>'+
					'<p><b>Select Status</b></p>'+
					'<select class="form-control" required id="'+ ap_status +'"><option></option><option>Pass</option>'+
					'<option>Fail</option>'+
					'</select>'+
					'<br/>'+
					'<input type="text" class="form-control" placeholder="Enter the App version" required id="'+ ap_version +'">'+
					'<br/>'+
					'<textarea class="form-control" rows="3" cols="50" placeholder="Existing Bugs (Enter Bug numbers separated by comma)" id="'+ ap_ex +'"></textarea>'+
					'<br/>'+
					'<textarea class="form-control" rows="2" cols="50" placeholder="New Bugs (Enter Bug numbers separated by comma)" id="'+ ap_new +'"></textarea>'+
					'<br/>'+
				  '</div>'+
				'</div>';
		}
		$("#app_data_area").html(txt);
	});
	
	$(document).delegate('input[name="new_bugs_no"]', "change keydown keyup keypress", function(){
		var val_no=$('input[name="new_bugs_no"]').val();
		var txt="";
		for(i=0;i<val_no;i++){
			var bug_id="bug_id"+i;
			var bug_title="bug_title"+i;
			var assigned_to="bug_assigned_to"+i;
			txt=txt+'<div class="panel panel-default" >'+
				  '<div class="panel-body">'+
					'<div class="col-md-2" ><input type="number" min="0" class="form-control" placeholder="Bug ID" required id="'+ bug_id +'"></div>'+
					'<div class="col-md-8" ><textarea class="form-control" required rows="1" cols="350" placeholder="Enter the title of Bug" id="'+ bug_title +'"></textarea></div>'+
					'<div class="col-md-2" ><input type="text" class="form-control" placeholder="Assigned To" required id="'+ assigned_to +'"></div>'+
				  '</div>'+
				'</div>';
		}
		$("#new_bugs_area").html(txt);
	});
});

function get_app_name(val,val2){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById(val2).innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "get_app_name.php?app_id="+val, true);
	xmlhttp.send();
	return false;
}

function insert_test_details(){	
	var tested_apps=tested_app_details.tested_apps_no.value;
	var new_bugs=tested_app_details.new_bugs_no.value;
	var test_pass=tested_app_details.tested_tp.value;
	if(test_pass=="Select Test Pass"){
		alert("Please select Test pass");
		tested_app_details.tested_tp.focus();
		return false;
	}
	var txt="";
	txt=txt+"test_pass="+test_pass;
	txt=txt+"&tested_apps_no="+tested_apps+"&new_bugs_no="+new_bugs;
	for(i=0;i<tested_apps;i++){
		var ap_id="app_id"+i;
		var ap_status="status"+i;
		var ap_ex="ex_bugs"+i;
		var ap_new="new_bugs"+i;
		var ap_version="version"+i;
		var ap_id_val=document.getElementById(ap_id).value;
		var ap_status_val=document.getElementById(ap_status).value;
		var ap_ex_val=document.getElementById(ap_ex).value;
		var ap_new_val=document.getElementById(ap_new).value;
		var ap_version_val=document.getElementById(ap_version).value;
		txt=txt+"&"+ap_id+"="+ap_id_val+"&"+ap_status+"="+ap_status_val+"&"+ap_ex+"="+ap_ex_val+"&"+ap_new+"="+ap_new_val+"&"+ap_version+"="+ap_version_val;
	}
	for(i=0;i<new_bugs;i++){
		var bug_id="bug_id"+i;
		var bug_id_val=document.getElementById(bug_id).value;
		var bug_title="bug_title"+i;
		var bug_title_val=document.getElementById(bug_title).value;
		var assigned_to="bug_assigned_to"+i;
		var assigned_to_val=document.getElementById(assigned_to).value;
		txt=txt+"&"+bug_id+"="+bug_id_val+"&"+bug_title+"="+bug_title_val+"&"+assigned_to+"="+assigned_to_val;
	}
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("test_results_update_area").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "insert_test_details.php?"+txt, true);
	xmlhttp.send();
	return false;
}
</script>

<script>
function modify_update_test_results(){	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("body2").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "modify_test_results.php", true);
	xmlhttp.send();
	return false;
}
function modify_test_results(){	
	var tested_apps=modify_app_test_results.tested_apps_no_m.value;
	var new_bugs=modify_app_test_results.new_bugs_no_m.value;
	var txt="";
	txt=txt+"&tested_apps_no_m="+tested_apps+"&new_bugs_no_m="+new_bugs;
	for(i=0;i<tested_apps;i++){
		var ap_testpass="t_app_testpass"+i;
		var ap_name="t_app_name"+i;
		var ap_status="t_status"+i;
		var ap_buginfo="t_bugs"+i;
		var ap_version="t_version"+i;
		var ap_tp_val=document.getElementById(ap_testpass).value;
		var ap_name_val=document.getElementById(ap_name).value;
		var ap_status_val=document.getElementById(ap_status).value;
		var ap_buginfo_val=document.getElementById(ap_buginfo).value;
		var ap_version_val=document.getElementById(ap_version).value;
		txt=txt+"&"+ap_testpass+"="+ap_tp_val+"&"+ap_name+"="+ap_name_val+"&"+ap_status+"="+ap_status_val+"&"+ap_buginfo+"="+ap_buginfo_val+"&"+ap_version+"="+ap_version_val;
	}
	for(i=0;i<new_bugs;i++){
		var bug_tp="t_bug_tp"+i;
		var bug_tp_val=document.getElementById(bug_tp).value;;
		var bug_id="t_bug_id"+i;
		var bug_id_val=document.getElementById(bug_id).value;
		var bug_title="t_bug_title"+i;
		var bug_title_val=document.getElementById(bug_title).value;
		var assigned_to="t_bug_assigned_to"+i;
		var assigned_to_val=document.getElementById(assigned_to).value;
		txt=txt+"&"+bug_tp+"="+bug_tp_val+"&"+bug_id+"="+bug_id_val+"&"+bug_title+"="+bug_title_val+"&"+assigned_to+"="+assigned_to_val;
	}
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("test_results_modify_area").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "update_test_details.php?"+txt, true);
	xmlhttp.send();
	return false;
}

function get_search_tp(val){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("search_tp_id").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "get_search_tp.php?search_date="+val, true);
	xmlhttp.send();
	return false;
}

function search_by_tp_date(){
	var search_date=search_form.search_date.value;
	var search_tp=search_form.search_tp.value;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("search_by_date_tp").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "search_by_tp_date.php?search_date="+search_date+"&search_tp="+search_tp, true);
	xmlhttp.send();
	return false;
}

function by_app(){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("body2").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "by_app.php", true);
	xmlhttp.send();
	return false;
}
function app_last_test(app){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("body2").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "app_last_test.php?app="+app, true);
	xmlhttp.send();
	return false;
}

function test_history(){
	var app=document.getElementById("app_name_x").value;
	var plt=document.getElementById("platform").value;
	var sce=document.getElementById("scenario").value;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("test_history").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "test_history.php?app_name="+app+"&platform="+plt+"&scenario="+sce, true);
	xmlhttp.send();
	return false;
}

function status_perf(){	
	var user=tester_perf.tester.value;
	var fro=tester_perf.search_from_date.value;
	var s_to=tester_perf.search_to_date.value;
	if(fro>s_to){
		alert("From Date should not be greater !");
		tester_perf.search_from_date.focus();
		return false;
	}
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("status_perf").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET", "status_perf.php?user="+user+"&fro="+fro+"&s_to="+s_to, true);
	xmlhttp.send();
	return false;
}
</script>

</head>

<body id="body" 
<?php
$user_level="";
if(isset($_COOKIE["vamsi"])){
	$user_level=$_COOKIE["user_type"];
	if($user_level=="Admin"){
		echo "onload='submit_test_results()'";
	}
	else if($user_level=="Tester"){
		echo "onload='submit_test_results()'";
	}
	else if($user_level=="Client"){
		echo "onload='view_test_results()'";
	}
}
?> >
<div id="nav_pins">
<?php
if(isset($_COOKIE["vamsi"])){
	include("user_view.php");
}
?>
</div>
<div class="container" id="body2">
<?php
if(!isset($_COOKIE["vamsi"])){
	?>
	<br/><br/><br/>
	<div id="account_form" class="container" style="width:35%" >
		<h2>Accessibility Daily Status Report</h2>
		<br/>
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h2 class="panel-title">Login</h2>
		  </div>
		  <div class="panel-body">
			<form name="form_log" method="POST" onsubmit="return check_user();">
				<input type="email" class="form-control" name="user" placeholder="Username" required>
				<br/>
				<input type="password" class="form-control" name="pwd" placeholder="Password" required>
				<br/>
				<input type="Submit" value="Let me in" class="btn btn-primary">
				<br/><br/>
			</form>
			<a id="fp">Forgot Password</a>
			<a id="ca" class="pull-right">Create Account</a>
		  </div>
		</div>
		<br/><br/><br/><br/><br/>
		<footer class=".text-center" >
		  <p>&copy; Developed By Vamsi Krishna Velichety  </p>
		  <p>Email: v-vave@microsoft.com </p>
		</footer>
	</div>
	<br/>
	<?php
}
?>

</div>

</body>
</html>
