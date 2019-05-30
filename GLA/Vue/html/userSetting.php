<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="../css/userSetting.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Setting</title>
</head>
<body>
	<?php
	session_start();
	if(!isset($_SESSION['user'])){
		echo "<script>alert('You have to login!');parent.location.href='/GLA/Vue/index.html';</script>";
	}
	$user = $_SESSION['user'];
	
	$url = '../../Controleur/user/'.$user.'.json';
	$json_string = file_get_contents($url);
	
	$data = json_decode($json_string, true);

	$psd = $data['password'];
	$email = $data['email'];
	?>

<div class="bienvenue" id="bienvenue">UserSetting</div>

<div class="mainpage" id="mainpage"> 
	<p>Do you want to modify your password?</p>
	<form action="../../Controleur/php/userSetting.php" method="POST">
	<p>Your old password: </p><input type="text" name="pwd" class="login"></input>
	<p>Your new password: </p><input type="password" name="pwd1" class="login"></input>
	<p>Verify your new password: </p><input type="password" name="pwd2" class="login"></input>
	<p>Modify your email: </p><input type="text" name="mail1" class="login"></input>
	<!--<p>Your email: </p><input type="text" name="email" class="login" value=<?php
	//echo $email; ?> disabled="disabled";></input>
	<p></p><button class="sb" type="button">Modify</button>-->
	<button class="sb" type="submit">Comfirm</button>
	</form>
	<div class="sign" id="sign">
	<button class="sb2">Back</button>
	</div>
</div>

<script src='../../Controleur/js/userSetting.js'></script>
</body>
</html>