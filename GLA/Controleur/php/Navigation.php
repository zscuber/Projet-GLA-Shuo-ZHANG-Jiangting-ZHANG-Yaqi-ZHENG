<?php
session_start();
	if(!isset($_SESSION['user'])){
		echo "<script>alert('You have to login!');parent.location.href='/GLA/Vue/index.html';</script>";
	}
	$user = $_SESSION['user'];
	
	$url = '../../Controleur/trajet/'.$user.'trajet.json';

	$json_string = file_get_contents($url);
	
	$data = json_decode($json_string, true);
	$count_json = count($data);
	$count_obj=count($data[0]);


?>