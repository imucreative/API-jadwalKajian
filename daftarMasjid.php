<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
 	require_once('dbConnect.php');
	
	$kd_masjid	= $_POST['kdMasjid'];
	$sekarang	= date('Y-m-d');
	
	$result = array();
	if(empty($kd_masjid)){
		
		$kd_wilayah	= $_POST['kdWilayah'];
		//if($_POST['formInput']=='formInput'){
			$sql	= "SELECT * FROM masjid WHERE statusDelete='0' AND kdWilayah='$kd_wilayah' ORDER BY namaMasjid ASC";
		//}else{
			//$sql	= "SELECT * FROM masjid WHERE statusDelete='0' AND kdWilayah='$kd_wilayah' AND kdMasjid IN (SELECT kdMasjid FROM kajian WHERE statusDelete='0' AND tanggal='$sekarang')  ORDER BY namaMasjid ASC";
		//}
		$r		= mysqli_query($con, $sql);
		$count	= mysqli_num_rows($r);
		
		//creating a blank array 
		$nomor = 0;
		if($count>=1){
			while($row = mysqli_fetch_array($r)){
				$nomor++;
				//Pushing name and id in the blank array created 
				array_push($result,array(
					"nomor"			=> $nomor,
					"kdMasjid"		=> $row['kdMasjid'],
					"namaMasjid"	=> $row['namaMasjid'],
					"alamatMasjid"	=> $row['alamat'],
					"informasi"		=> $row['informasi'],
					"linkMaps"		=> $row['linkMaps']
					//"lat"			=> $row['latitude'],
					//"lng"			=> $row['longtitude']
				));
			}
		}else{
			array_push($result,array(
				"nomor"			=> '1',
				"kdMasjid"		=> '0',
				"namaMasjid"	=> 'Daftar Masjid & Kajian Belum Diinput',
				"alamatMasjid"	=> '',
				"informasi"		=> '',
				"linkMaps"		=> ''
				//"lat"			=> '',
				//"lng"			=> ''
			));
		}
	} else {
		
		$sql	= "SELECT * FROM masjid WHERE statusDelete='0' AND kdMasjid='$kd_masjid'";
		$r		= mysqli_query($con, $sql);
		$row	= mysqli_fetch_array($r);
		$kdMasjid			= $row['kdMasjid'];
		$namaMasjid			= $row['namaMasjid'];
		$alamatMasjid		= $row['alamat'];
		$informasi			= $row['informasi'];
		
		array_push($result,array(
			"nomor"				=> '',
			"kdMasjid"			=> $kdMasjid,
			"namaMasjid"		=> $namaMasjid,
			"alamatMasjid"		=> $alamatMasjid,
			"informasi"			=> $informasi,
			"linkMaps"			=> $row['linkMaps'],
			//"lat"				=> $row['latitude'],
			//"lng"				=> $row['longtitude'],
			"count"				=> ""
		));
			
		//echo $namaMasjid;
	}
	//Displaying the array in json format 
	echo json_encode(array('result'=>$result));
	mysqli_close($con);
?>