<?php
include("db.php");
ini_set('max_execution_time', 300);
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.<br/>";
    $uploadOk = 0;
}

// Allow csv file format only
if($imageFileType != "csv") {
    echo "Sorry, only CSV format is allowed.<br/>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.<br/>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.<br/>";
    }
}
// Appending data to mysql table
if ($uploadOk == 1) {
		$file_name="E:/xampp/htdocs/SR/uploads/".basename( $_FILES["fileToUpload"]["name"]);
		//echo $file_name;
		mysqli_query($con,"truncate bugs_data");
		$sql_st="LOAD DATA LOCAL INFILE '$file_name' INTO TABLE bugs_data FIELDS TERMINATED BY ',' LINES TERMINATED BY '\r\n'";
		mysqli_query($con,$sql_st) or die(mysqli_error($con));
		echo "<br/><br/><a href='index.php'>Back To Home</a><br/>";
}
?> 