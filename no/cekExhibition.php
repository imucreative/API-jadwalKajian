<?php
 	require_once('dbConnect.php');
	$sql	= "SELECT * FROM kota";
	$r		= mysqli_query($con,$sql);
	
	//creating a blank array 
	$result = array();
	
	while($row = mysqli_fetch_array($r)){
		//Pushing name and id in the blank array created 
		array_push($result,array(
			"id"=>$row['id'],
			"nama"=>$row['nama']
		));
	}
	
	//Displaying the array in json format 
	echo json_encode(array('result'=>$result));
	mysqli_close($con);
?>