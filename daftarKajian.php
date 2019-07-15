<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
 	require_once('dbConnect.php');
	require_once('library.php');
	
	$kd_kajian		= $_POST['kdKajian'];
	$kd_masjid		= $_POST['kdMasjid'];
	$pilihTanggal	= $_POST['tanggal'];
	$sekarang		= date('Y-m-d');
	$server_ip 		= gethostbyname(gethostname());
	
	if(empty($pilihTanggal)){
		$setTanggal	= $sekarang;
	} else {
		$setTanggal	= $pilihTanggal;
	}
	
	if(empty($kd_masjid)){
		$setKdMasjid	= "";
	} else {
		$setKdMasjid	= " AND kdMasjid='$kd_masjid'";
	}
	
	$sql	= "SELECT * FROM kajian WHERE statusDelete='0' AND tanggal='$setTanggal' $setKdMasjid";
	$r		= mysqli_query($con, $sql);
	$count	= mysqli_num_rows($r);
	
	//creating a blank array 
	$result = array();
	if(empty($kd_kajian)){
		$nomor = 0;
		if($count>=1){
			while($row = mysqli_fetch_array($r)){
				$nomor++;
				if(empty($row['image'])){
					$img	= "notfound.jpg";
				}else{
					$img	= $row['image'];
				}
				//Pushing name and id in the blank array created 
				array_push($result,array(
					"nomor"			=> $nomor,
					"kdKajian"		=> $row['kdKajian'],
					"tanggal"		=> Indonesia2Tgl($row['tanggal']),
					"keterangan"	=> $row['keterangan'],
					"image"			=> "http://f15-preview.awardspace.net/jadwalkajian.mywebcommunity.org/uploads/$img"
				));
			}
		}else{
			array_push($result,array(
				"nomor"			=> '1',
				"kdKajian"		=> '0',
				"tanggal"		=> Indonesia2Tgl($setTanggal),
				"keterangan"	=> 'Kajian Hari Ini Belum Diinput',
				"image"			=> ''
			));
		}
	}else{
		$sql	= "SELECT * FROM kajian WHERE statusDelete='0' AND kdKajian='$kd_kajian'";
		$r		= mysqli_query($con, $sql);
		$row	= mysqli_fetch_array($r);
		$kdKajian	= $row['kdKajian'];
		$tanggal	= $row['tanggal'];
		$keterangan	= $row['keterangan'];
		
		array_push($result,array(
			"nomor"			=> '',
			"kdKajian"		=> $kdKajian,
			"tanggal"		=> $tanggal,
			"keterangan"	=> $keterangan
		));
		
		//echo $namaMasjid;
	}
	
	//Displaying the array in json format 
	echo json_encode(array('result'=>$result));
	mysqli_close($con);
?>