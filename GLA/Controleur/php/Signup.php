<?php

$nom = $_POST["login"];
$password = $_POST["password"];
$email = $_POST["email"];
$home ="none";
$company ="none";
$usual ="none";


$array = [
	'user' => $nom,
	'password' => $password,
	'email' => $email,
	'home' => $home,
	'company' => $company,
	'usual' => $usual
];

$json_data = json_encode($array);

$url1 = '../user/'.$nom.'.json';
$url2 = '../user/'.$email.'.json';
if(file_exists($url1)){
	echo "<script>alert('User is exist !');parent.location.href='/GLA/Vue/html/Signup.html';</script>";
}
else if(file_exists($url2)){
	echo "<script>alert('E-mail is exist !');parent.location.href='/GLA/Vue/html/Signup.html';</script>";
}

else{
	if(file_put_contents($url1, $json_data) && file_put_contents($url2, $json_data) ){
	echo "<script>alert('Create account success!');parent.location.href='/GLA/Vue/index.html';</script>";
	}
	else{
		//echo $nom,$password;
	echo "<script>alert('Create account Failed!');parent.location.href='/GLA/Vue/html/Signup.html';</script>";
	}	
}


?>
