<?php 
	//Getting the requested id
	$id = $_GET['id'];
	//echo $id;
	
	//Importing database
	require_once('dbConnect.php');
	
	//Creating sql query with where clause to get an specific employee
	$sql = "SELECT * FROM salesman_activity WHERE id=$id";
	
	//getting result 
	$r = mysqli_query($con,$sql);
	
	//pushing result to an array 
	$result = array();
	$row = mysqli_fetch_array($r);
	array_push($result,array(
			"id"				=> $row['id'],
			"nama"				=> $row['nama'],
			"address"			=> $row['address'],
			"city"				=> $row['city'],
			"phone"				=> $row['phone'],
			"email"				=> $row['email'],
			"salesFrom"			=> $row['salesfrom'],
			"exhibition"		=> $row['exhibition'],
			"model"				=> $row['modeltype'],
			"prospectActivity"	=> $row['prospectactivity'],
			"remarks"			=> $row['remarks'],
			"prospectStatus"	=> $row['prospectstatus'],
			"salesProblem"		=> $row['salesproblem']
		));

	//displaying in json format 
	echo json_encode(array('result'=>$result));
	
	mysqli_close($con);
	
?>