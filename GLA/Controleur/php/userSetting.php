<?php
	session_start();
	if(!isset($_SESSION['user'])){
		echo "<script>alert('You have to login!');parent.location.href='/GLA/Vue/index.html';</script>";
	}

	$pwd = $_POST["pwd"];
	$pwd1 = $_POST["pwd1"];
	$pwd2=$_POST["pwd2"];
	$mail1 = $_POST["mail1"];

	$user=$_SESSION['user'];

	$url1 = '../user/'.$user.'.json';

	$json_string = file_get_contents($url1);
	
	$data = json_decode($json_string, true);

	$psd = $data['password'];
	$email = $data['email'];
	$home = $data['home'];
	$company = $data['company'];
	$usual = $data['usual'];
	$url2 = '../user/'.$email.'.json';
	unlink($url2);
	//只改密码
	if($mail1==""){
	$array = [
	'user' => $user,
	'password' => $pwd1,
	'email' => $email,
	'home' => $home,
	'company' => $company,
	'usual' => $usual
	];
	$email2=$email;
	$url3='../user/'.$email2.'.json';	
	}
	//只改邮箱
	else if ($pwd1==""&&$pwd2==""){
	$array = [
	'user' => $user,
	'password' => $psd,
	'email' => $mail1,
	'home' => $home,
	'company' => $company,
	'usual' => $usual
	];
	$url3='../user/'.$mail1.'.json';	
	}
	//密码邮箱都改
	else{
	$array = [
	'user' => $user,
	'password' => $pwd1,
	'email' => $mail1,
	'home' => $home,
	'company' => $company,
	'usual' => $usual
	];
	$url3='../user/'.$mail1.'.json';	
	}
	$json_data = json_encode($array);
	if ($psd!=$pwd){
		echo "<script>alert('Your old password is not correctly.');parent.location.href='/GLA/Vue/html/userSetting.php';</script>";
	}
	else if ($pwd1!=$pwd2){
		echo "<script>alert('please verify your new password.');parent.location.href='/GLA/Vue/html/userSetting.php';</script>";
	}
	else if(file_exists($url1)){

		if(file_put_contents($url1, $json_data)&& file_put_contents($url3, $json_data) ){
				echo "<script>alert('Modify success!');parent.location.href='/GLA/Vue/html/AccueilCon.php';</script>";
		}
		else{
		echo "<script>alert('Modify Failed!');parent.location.href='/GLA/Vue/html/userSetting.php';</script>userSetting.php";	
	}
	}

		//echo $json_data;
	//}
	//else{
	//	echo "<script>alert('Modify Failed!');parent.location.href='/GLA/Vue/html/';</script>Setting.php";
	//}

?>