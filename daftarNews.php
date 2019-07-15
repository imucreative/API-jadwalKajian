<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
 	require_once('dbConnect.php');
	require_once('library.php');
	
	$offset			= $_GET['page'];
	$kd_news		= $_POST['kdNews'];
	//$kd_news		= "1";
	$server_ip 		= gethostbyname(gethostname());
	
	if(empty($kd_news)){
		
		$sql	= "SELECT * FROM news WHERE statusDelete='0'";
		$r		= mysqli_query($con, $sql);
		$count	= mysqli_num_rows($r);
		//creating a blank array 
		$result = array();
		$nomor	= 0;
		
		if($count>=1){
			while($row = mysqli_fetch_array($r)){
				$nomor++;
				
				$string		= substr(strip_tags($row['isiNews']), 0, 200);
				if(empty($row['gambarNews'])){
					$img	= "notfound.jpg";
				}else{
					$img	= $row['gambarNews'];
				}
				//Pushing name and id in the blank array created 
				array_push($result,array(
					"nomor"			=> $nomor,
					"kdNews"		=> $row['kdNews'],
					"tglNews"		=> Indonesia2Tgl($row['tglNews']),
					"judulNews"		=> $row['judulNews'],
					"isiNews"		=> str_replace("`","'",$string."..."),
					"gambarNews"	=> "http://f15-preview.awardspace.net/jadwalkajian.mywebcommunity.org/news/$img"
				));
			}
		}else{
			array_push($result,array(
				"nomor"			=> '1',
				"kdNews"		=> '0',
				"tglNews"		=> '',
				"judulNews"		=> 'News',
				"isiNews"		=> 'News Belum Diinput',
				"gambarNews"	=> ''
			));
		}
		
	}else{
		
		$result		= array();
		$sql2		= "SELECT * FROM news WHERE statusDelete='0' AND kdNews='$kd_news'";
		$r2			= mysqli_query($con, $sql2);
		$row2		= mysqli_fetch_array($r2);
		$kdNews		= $row2['kdNews'];
		$tglNews	= $row2['tglNews'];
		$judul		= $row2['judulNews'];
		$isi		= $row2['isiNews'];
		
		$string		= strip_tags($isi);
		//addslashes(htmlspecialchars($isi))
		
		if(empty($row2['gambarNews'])){
			$img	= "notfound.jpg";
		}else{
			$img	= $row2['gambarNews'];
		}
				
		array_push($result,array(
			"nomor"			=> '1',
			"kdNews"		=> $kdNews,
			"tglNews"		=> $tglNews,
			"judulNews"		=> $judul,
			"isiNews"		=> str_replace("`","'",$string),
			"gambarNews"	=> "http://f15-preview.awardspace.net/jadwalkajian.mywebcommunity.org/news/$img"
		));
		
		//echo $namaMasjid;
		
	}
	
	//Displaying the array in json format 
	echo json_encode(array('result'=>$result));
	mysqli_close($con);
?>