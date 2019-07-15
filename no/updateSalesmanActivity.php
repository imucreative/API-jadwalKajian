<?php 
 	if($_SERVER['REQUEST_METHOD']=='POST'){
		//Getting values 
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$salesFrom = $_POST['salesFrom'];
		$exhibition = $_POST['exhibition'];
		$modelType = $_POST['modelType'];
		$prospectActivity = $_POST['prospectActivity'];
		$remarks = $_POST['remarks'];
		$prospectStatus = $_POST['prospectStatus'];
		$salesProblem = $_POST['salesProblem'];
		
		//importing database connection script 
		require_once('dbConnect.php');
		
		//Creating sql query 
		$sql = "UPDATE salesman_activity SET 
			nama = '$nama', 
			address = '$address', 
			city = '$city',
			phone = '$phone',
			email = '$email',
			salesfrom = '$salesFrom',
			exhibition = '$exhibition',
			modeltype = '$modelType',
			prospectactivity = '$prospectActivity',
			remarks = '$remarks',
			prospectstatus = '$prospectStatus',
			salesproblem = '$salesProblem'
			WHERE id = $id;";
		
		//Updating database table 
		if(mysqli_query($con,$sql)){
			echo 'Salesman Activity Updated Successfully';
		}else{
			echo 'Could Not Update Salesman Activity, Please Contact Administrator';
		}
		
		//closing connection 
		mysqli_close($con);
	}
	
	//echo $_POST['salesProblem'];
?>