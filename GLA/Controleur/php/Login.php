<?php

$nom = $_POST["login"];
$password = $_POST["password"];

$url = '../user/'.$nom.'.json';

if(file_exists($url)){
	$json_string = file_get_contents($url);
	$data = json_decode($json_string, true);
	
	$psd = $data['password'];
	$user = $data['user'];
	
	if($psd == $password){
		session_start();
		$_SESSION['user']=$user;
	echo "<script>parent.location.href='/GLA/Vue/html/AccueilCon.php';</script>";

	}
	else{
		echo "<script>alert('Password incorrect!');parent.location.href='/GLA/Vue/index.html';</script>";
	}
}
else{
	
	echo "<script>alert('User does not exist!');parent.location.href='/GLA/Vue/index.html';</script>";
}	

?>
