<?php 
if(isset($_FILES["image"]) && $_POST['save']){	
	$con = mysqli_connect("localhost","root","","ecomproject");
	$file_name = basename($_FILES["image"]["name"]);
	$file_size = $_FILES["image"]["size"];
	$file_tmp = $_FILES["image"]["tmp_name"];
	$file_type = $_FILES["image"]["type"];
	$name = $_POST['name'];
	$price = $_POST['price'];
	$desc = $_POST['desc'];
	$target = "upload/".$file_name;
	$fetch = "select * from dashboard";
	$data = mysqli_query($con,$fetch);
	$result = mysqli_fetch_assoc($data);
		if ($result['name']!=$name && $result['description']!=$desc && $result['product']!=$target) {
	move_uploaded_file($file_tmp,$target);
	$compress = imagecreatefromjpeg($target);
	imagejpeg($compress,$target,60);
	imagedestroy($compress);
	
	$sql = "INSERT INTO `dashboard`(`name`, `description`, `product`, `price`) VALUES ('$name','$desc','$target','$price')";
	if(mysqli_query($con,$sql)){
      echo "successfully uploaded and compressed <a href='index.php'>Home</a>";
	}
	}else{
		echo "<p class=' container text-center alert alert-dark alert-dismissible fade show' role='alert'>This data is already exist, please enter another diffarent data.<button type='button' class='close' data-dismiss='alert' area-label='close'><span area-hidden='true'>&times;</span></button></p>";
	}
	}else{
    
    }

?>