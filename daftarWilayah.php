<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
 	require_once('dbConnect.php');
	
	$versi		= $_POST['versi'];
	$sekarang	= date("Y-m-d");
	$sql	= "SELECT * FROM wilayah WHERE statusDelete='0' ORDER BY namaWilayah ASC";
	
	$r		= mysqli_query($con, $sql);
	$count	= mysqli_num_rows($r);
	
	//creating a blank array
	$result = array();
	$nomor = 0;
	if($count>=1){
		if($versi == $versiSekarang){
			while($row = mysqli_fetch_array($r)){
				$sql2	= "SELECT * FROM masjid WHERE statusDelete='0' AND kdWilayah='$row[kdWilayah]' AND kdMasjid IN (SELECT kdMasjid FROM kajian WHERE statusDelete='0' AND tanggal='$sekarang')";
				$r2		= mysqli_query($con, $sql2);
				$count2	= mysqli_num_rows($r2);
				
				$nomor++;
				//Pushing name and id in the blank array created 
				array_push($result,array(
					"nomor"			=> $nomor,
					"kdWilayah"		=> $row['kdWilayah'],
					"namaWilayah"	=> $row['namaWilayah'],
					"count"			=> $count2
				));
			}
		}else{
			array_push($result,array(
				"nomor"			=> '1',
				"kdWilayah"		=> '0',
				"namaWilayah"	=> 'Aplikasi Harus Update!!!',
				"count"			=> '-'
			));
		}
	}else{
		array_push($result,array(
			"nomor"			=> '1',
			"kdWilayah"		=> '0',
			"namaWilayah"	=> 'Data Wilayah Kajian Belum Diinput',
			"count"			=> '0'
		));
	}
	
	//Displaying the array in json format 
	echo json_encode(array('result'=>$result));
	mysqli_close($con);
?>