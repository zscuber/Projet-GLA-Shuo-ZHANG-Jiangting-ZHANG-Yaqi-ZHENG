<?php
	session_start();
	if(!isset($_SESSION['user'])){
		echo "<script>alert('You have to login!');parent.location.href='/GLA/Vue/index.html';</script>";
	}

	$user=$_SESSION['user'];

	$url = '../user/'.$user.'.json';

	$json_string = file_get_contents($url);
	
	$data = json_decode($json_string, true);
	
	$usual = $data['usual'];

	if($usual !="none"){
		$_SESSION['pickAddress'] = $usual;
	echo "<script>parent.location.href='/GLA/Vue/html/AccueilCon.php';</script>";
	}
	else{
	echo "<script>alert('Do you want to add an usual address?');parent.location.href='/GLA/Vue/html/Setting.php';</script>";
	}	
?>
