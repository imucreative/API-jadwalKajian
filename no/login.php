<?php
	mysql_connect("localhost","root","");
	mysql_select_db("employee");

	$username	= $_GET["username"];
	$password	= $_GET["password"];

	$query		= "SELECT * FROM users WHERE username='$username' AND password='$password'";

	$hasil		= mysql_query($query);
	if (mysql_num_rows($hasil) > 0) {
		$response = array();
		$response["login"] = array();
		while ($data = mysql_fetch_array($hasil)){
			$h['id']		= $data['id'];
			$h['nama']		= $data['name'];
			$h['username']	= $data['username'];
			$h['email']		= $data['email'];
			$h['password']	= $data['password'];
			$h['ckd_coy']	= $data['ckd_coy'];

			array_push($response["login"], $h);
		}
		
		$response["success"] = "1";
		echo json_encode($response);
	} else {
		$response["success"] = "0";
		$response["message"] = "Tidak ada data";
		echo json_encode($response);
	}
?>