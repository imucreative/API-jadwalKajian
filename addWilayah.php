<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

	$namaWilayah	= $_POST['namaWilayah'];
	$kdWilayah		= $_POST['kdWilayah'];
	$kdTombol		= $_POST['kdTombol'];
		
	require_once('dbConnect.php');
	if($kdWilayah=='0'){
		$sql = "INSERT INTO wilayah (namaWilayah) VALUES ('$namaWilayah')";
		$val = "Diinput";
	}else{
		if($kdTombol=='delete'){
			$sql = "UPDATE wilayah SET statusDelete = '1' WHERE kdWilayah = '$kdWilayah'";
			$val = "Didelete";
		}else{
			$sql = "UPDATE wilayah SET namaWilayah = '$namaWilayah' WHERE kdWilayah = '$kdWilayah'";
			$val = "Diedit";
		}
	}
	
	
	if(mysqli_query($con, $sql)){
		echo "Wilayah Berhasil $val";
	}else{
		echo "Wilayah Gagal $val";
	}
?>