<?php
	session_start();
	if(!isset($_SESSION['user'])){
		echo "<script>alert('You have to login!');parent.location.href='/GLA/Vue/index.html';</script>";
	}

	$home = $_POST["home"];
	$company = $_POST["company"];
	$usual = $_POST["usual"];

	$user=$_SESSION['user'];

	$url1 = '../user/'.$user.'.json';

	$json_string = file_get_contents($url1);
	
	$data = json_decode($json_string, true);
	
	$psd = $data['password'];
	$email = $data['email'];
	$url2 = '../user/'.$email.'.json';


	$array = [
	'user' => $user,
	'password' => $psd,
	'email' => $email,
	'home' => $home,
	'company' => $company,
	'usual' => $usual
	];

	$json_data = json_encode($array);

	if(file_exists($url1)){
		if(file_put_contents($url1, $json_data) && file_put_contents($url2, $json_data) ){
	echo "<script>alert('Modify success!');parent.location.href='/GLA/Vue/html/Setting.php';</script>";
	}
		else{
		//echo $nom,$password;
	echo "<script>alert('Modify Failed!');parent.location.href='/GLA/Vue/html/Setting.php';</script>Setting.php";
	}	
	}
?>
