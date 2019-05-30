<?php
	session_start();
	if(!isset($_SESSION['user'])){
		echo "<script>alert('You have to login!');parent.location.href='/GLA/Vue/index.html';</script>";
	}

	$user=$_SESSION['user'];

	$url = '../user/'.$user.'.json';

	$json_string = file_get_contents($url);
	
	$data = json_decode($json_string, true);
	
	$company = $data['company'];

	if($company !="none"){
		$_SESSION['pickAddress'] = $company;
	echo "<script>parent.location.href='/GLA/Vue/html/AccueilCon.php';</script>";
	}
	else{
	echo "<script>alert('Do you want to add a company address?');parent.location.href='/GLA/Vue/html/Setting.php';</script>";
	}	
?>
