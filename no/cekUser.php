<?php 
	$username = $_GET['username'];
	
	$sql = "SELECT * FROM users WHERE email='$username'";
	
	require_once('dbConnect.php');
		
	$result = mysqli_query($con,$sql);
		
	$check = mysqli_fetch_array($result);
		
	$r = array();
	array_push($r,array(
		"id"		=> $check['id'],
		"name"		=> $check['name'],
		"email"		=> $check['email']
	));
	echo json_encode(array('result'=>$r));
	
	mysqli_close($con);