<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
require_once('dbConnect.php');

	$kdWilayah			= $_POST['kdWilayah'];
	$kdMasjid			= $_POST['kdMasjid'];
	$namaMasjid			= $_POST['namaMasjid'];
	$alamatMasjid		= $_POST['alamatMasjid'];
	$informasiMasjid	= $_POST['informasi'];
	$linkMaps			= $_POST['linkMaps'];
	if($linkMaps == '-'){
		$linkGoogleMaps = "http://www.google.com";
	}else{
		$linkGoogleMaps = $linkMaps;
	}
	//$latitudeMasjid	= $_POST['lat'];
	//$longtitudeMasjid	= $_POST['lng'];
	$kdTombol			= $_POST['kdTombol'];
	
	if($kdMasjid=='0'){
		$sql = "INSERT INTO masjid (kdMasjid, kdWilayah, namaMasjid, alamat, informasi, linkMaps, statusDelete) VALUES ('', '$kdWilayah', '$namaMasjid', '$alamatMasjid', '$informasiMasjid', '$linkGoogleMaps', '0')";
		$val = "Diinput";
	}else{
		if($kdTombol=='delete'){
			$sql = "UPDATE masjid SET statusDelete = '1' WHERE kdMasjid = '$kdMasjid'";
			$val = "Didelete";
		}else{
			$sql = "UPDATE masjid SET namaMasjid = '$namaMasjid', alamat = '$alamatMasjid', informasi = '$informasiMasjid', linkMaps = '$linkGoogleMaps' WHERE kdMasjid = '$kdMasjid'";
			$val = "Diedit";
		}
	}
	
	mysqli_query($con, $sql);
	echo "Masjid Berhasil $val";
?>