<?php
include("db.php");
$date=date("Y-m-d");
?>
<form name="import_data" method="POST" enctype="multipart/form-data" action="upload_file.php">
<div class="container col-md-8">
<table class="table table-bordered table-primay">
	<tr><td>Upload File</td>
	<td>
	<input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
	</td>
	<td>Date <?php echo $date;?></td>
	<td><input type="Submit" value="Upload Data" class="btn btn-primary"></td>
	</tr>
</table>
</div>
<div class="container col-md-10">
<ol>
<li>Upload the File in CSV Format Only</li>
<li>Columns should be in the order of ID, State, Work Item Type, Resolved Reason, Found In Environment, Custom String 6</li>
<li>Do not refresh or close the tab while the file gets uploading</li>
</ol>
</div>