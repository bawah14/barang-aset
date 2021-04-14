<?php
session_start();
if (isset($_GET['auth'])) {
 	# code...
	if (isset($_SESSION['name'])) {
		# code...
		header("Location: ../index.php?pesan=Anda Sudah Login");
	}else{
		if ($_GET['name'] == "pangan" && md5($_GET['password']) =="333c94c626650d7d15db8c5a1ec1c6fa" ) {
			# code...
			$_SESSION['name'] = $_GET['name'];
			header("Location: ../index.php");
		}else{
			header("Location: ../dist/losgin.php?pesan=Login Gagal");
		}
	} 
}
?>