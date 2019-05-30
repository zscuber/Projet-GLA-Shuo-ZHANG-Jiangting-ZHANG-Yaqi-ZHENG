<?php
$nom = $_POST["login"];
$mail = $_POST["mail"];
$pwd1 = $_POST["pwd1"];
$pwd2=$_POST["pwd2"];

$url = '../user/'.$nom.'.json';
//echo $url;

if(file_exists($url)){
	session_start();
	$json_string = file_get_contents($url);
	
	$data = json_decode($json_string, true);
	$psd = $data['password'];
	$email = $data['email'];
	$home = $data['home'];
	$company = $data['company'];
	$usual = $data['usual'];
	$url2 = '../user/'.$email.'.json';

	$array = [
	'user' => $nom,
	'password' => $pwd1,
	'email' => $email,
	'home' => $home,
	'company' => $company,
	'usual' => $usual
	];
	$json_data = json_encode($array);
	if ($email!=$mail){
		echo "<script>alert('Your email is not correctly.');parent.location.href='/GLA/Vue/html/OublierMDP.html';</script>";
	}
	else if ($pwd1!=$pwd2){
		echo "<script>alert('please verify your new password.');parent.location.href='/GLA/Vue/html/OublierMDP.html';</script>";
	}
	else if ($pwd1==""&&$pwd2==""){
		echo "<script>alert('please input your new password.');parent.location.href='/GLA/Vue/html/OublierMDP.html';</script>";
	}
	else if (file_exists($url)){
		if(file_put_contents($url, $json_data)&& file_put_contents($url2, $json_data)){
				echo "<script>alert('Modify success!');parent.location.href='/GLA/Vue/index.html';</script>";
		}
		else{
			echo "<script>alert('Modify Failed!');parent.location.href='/GLA/Vue/html/OublierMDP.html';</script>OublierMDP.html";	
		}
	}

	//echo "1";
}
else{
	echo "<script>alert('User does not exist!');parent.location.href='/GLA/Vue/index.html';</script>";

}

	


?>