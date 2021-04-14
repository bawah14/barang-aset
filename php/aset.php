<?php 

require_once '../config/db.php';
$db = new db(); 
if (isset($_POST['insert'])) {
	# code...
	foreach ($_POST as $key => $value) {
		if ($key!="insert") {
			$data[$key] = $value;
		}
	}
	$db->insert("aset",$data);
	$last_id = mysqli_insert_id($db->res);
	// Check if image file is a actual image or fake image
	if(isset($_FILES['foto_aset'])) {
	  $check = getimagesize($_FILES["foto_aset"]["tmp_name"]);
	  if($check !== false) {
	    $pesan =  "File is an image - " . $check["mime"] . ".";
	    $uploadOk = 1;
	    $target_dir = "uploads/";
		$target_file = str_replace(" ", "_", $target_dir .md5($last_id). basename($_FILES["foto_aset"]["name"]));
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$uploadOk = 1;
	  } else {
	    $pesan =  "File is not an image.";
	    $uploadOk = 0;
	  }

		// Check file size
		if ($_FILES["foto_aset"]["size"] > 500000) {
		  $pesan =  "Sorry, your file is too large.";
		  $uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		  $pesan =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		  $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		  $pesan =  "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		  if (move_uploaded_file($_FILES["foto_aset"]["tmp_name"], $target_file)) {
		    $pesan =  "The file ". htmlspecialchars( basename( $_FILES["foto_aset"]["name"])). " has been uploaded.";
		     
		  } else {
		    $pesan =  "Sorry, there was an error uploading your file.";
		  }
		}
	}
	$db->edit("aset","foto_aset",$target_file,"id_aset",$last_id);
	// print_r($_POST);
	// print_r($_FILES);
	

	header("Location: ../index.php?content=kelola_barang_aset&pesan=data berhasil di input".$last_id."&tempat=".$_POST['tempat_aset']);
}
if (isset($_POST['edit'])) {
	# code...
	// var_dump($_POST);
	foreach ($_POST as $key => $value) {
		# code...
		if ($key!="id" && $key!="edit") {
			# code...
			$db->edit("aset","$key",$value,"id_aset",$_POST['id']);
		}
	}
	if (isset($_FILES['foto_aset']) && $_FILES["foto_aset"]["name"] != "") {
		# code...
		
	    $target_dir = "uploads/";
		$target_file = str_replace(" ", "_", $target_dir .md5($_POST['id']). basename($_FILES["foto_aset"]["name"]));
		move_uploaded_file($_FILES["foto_aset"]["tmp_name"], $target_file);
		$db->edit("aset","foto_aset",$target_file,"id_aset",$_POST['id']);
		
	}
	header("Location: ../index.php?content=kelola_barang_aset&pesan=data berhasil di update"."&tempat=".$_POST['tempat_aset']);
}

if (isset($_GET['hapus'])) {
	# code...
	$db->delete('aset',"id_aset",$_GET['id']);
	header("Location: ../index.php?content=kelola_barang_aset&pesan=data berhasil haput"."&tempat=".$_GET['tempat_aset']);
}
?>