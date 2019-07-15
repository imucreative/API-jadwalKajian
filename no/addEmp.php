<?php
	$idSales			= $_POST['id'];
	$nama				= $_POST['nama'];
	$address			= $_POST['address'];
	$city				= $_POST['city'];
	$phone				= $_POST['phone'];
	$email				= $_POST['email'];
	$salesFrom			= $_POST['salesFrom'];
	$exhibition			= $_POST['exhibition'];
	$modelType			= $_POST['modelType'];
	$prospectActivity	= $_POST['prospectActivity'];
	$remarks			= $_POST['remarks'];
	$prospectStatus		= $_POST['prospectStatus'];
	$salesProblem		= $_POST['salesProblem'];
		
	require_once('dbConnect.php');
	$sql = "INSERT INTO salesman_activity (id, idUser, nama, address, city, phone, email, salesfrom, exhibition, modeltype, prospectactivity, remarks, prospectstatus, salesproblem) VALUES ('', '$idSales', '$nama','$address','$city', '$phone', '$email', '$salesFrom', '$exhibition', '$modelType', '$prospectActivity', '$remarks', '$prospectStatus', '$salesProblem')";
	
	
	
	if(mysqli_query($con, $sql)){
		echo "Salesman Activity Berhasil Diinput";
	}else{
		echo 'Could Not Input Salesman Activity, Please Contact Administrator';
	}
?>