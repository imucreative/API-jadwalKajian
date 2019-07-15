<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
 	require_once('dbConnect.php');
	
	$password		= $_POST['password'];
	$versi			= $_POST['versi'];
	$sql			= "SELECT * FROM users WHERE statusDelete='0' AND password='$password'";

	$r		= mysqli_query($con, $sql);
	$count	= mysqli_num_rows($r);
	
	//creating a blank array
	$login_result = FALSE;
	$result = array();
	$result['login'] = array();
	if($count>=1){
		if($versi == $versiSekarang){
			$row = mysqli_fetch_array($r);
			$login_result = TRUE;
			$get['kdUsers']	= $row['kdUsers'];
			$get['nama']	= $row['nama'];
			
			array_push($result['login'],$get);
			$result['success']="1";
			$result['message']="Login Success";
		}else{
			$result['success']="0";
			$result['message']="Aplikasi Harus Update!!!";
		}
	}else{
		$result['success']="0";
		$result['message']="User Not Found";
	}
	
	//Displaying the array in json format 
	echo json_encode($result);
	mysqli_close($con);
?>