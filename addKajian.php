<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

	$kdMasjid	= $_POST['kdMasjid'];
	$kdKajian	= $_POST['kdKajian'];
	$tanggal	= $_POST['tanggal'];
	//$keterangan	= mysql_real_escape_string($_POST['keterangan']);
	$keterangan	= $_POST['keterangan'];
	$kdTombol	= $_POST['kdTombol'];
	
	require_once('dbConnect.php');
	if($kdKajian=='0'){
		$sql = "INSERT INTO kajian (kdKajian, kdMasjid, tanggal, keterangan, image, statusDelete) VALUES ('', '$kdMasjid', '$tanggal', '$keterangan', '', '0')";
		$val = "Diinput";
	}else{
		if($kdTombol=='delete'){
			$sql = "UPDATE kajian SET statusDelete = '1' WHERE kdKajian = '$kdKajian'";
			$val = "Didelete";
		}else{
			$sql = "UPDATE kajian SET tanggal = '$tanggal', keterangan = '$keterangan' WHERE kdKajian = '$kdKajian'";
			$val = "Diedit";
		}
	}
	
	mysqli_query($con, $sql);
	echo "Kajian Berhasil $val";
	
	/* if(mysqli_query($con, $sql)){
		echo "Kajian Berhasil $val";
	}else{
		echo "Kajian Gagal $val";
	} */
?>