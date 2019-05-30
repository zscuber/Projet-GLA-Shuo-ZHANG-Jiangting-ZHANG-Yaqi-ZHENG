<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="../css/Navigation.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Navigation</title>
</head>
<body>
	<?php
	session_start();
	$name="";
	if(!isset($_SESSION['user'])){
		$name="visitor";	
	}
	else{
		$user = $_SESSION['user'];
		$name = $user;
	}
	
	$url = '../../Controleur/trajet/'.$name.'trajetFinal.json';

	$json_string = file_get_contents($url);
	
	$data = json_decode($json_string, true);
	
	$count_json = count($data);
	$a=array();
	$i=0;
	$nbt=$data[0];
	?>
	<div class="bienvenue" id="bienvenue">Navigation</div>
	<div class="mainpage" id="mainpage"> 
		<p class="user" id="user">
		<?php
		echo $name;?>
		</p>

		<p></p>
	
	<p id="titre">You are now in ville: </p><p for="depart" class="search" name="depart" id="info"></p>
	<p id="titre">Your next ville is: </p><p for="destination" class="search" name="destination" id="info"></p>
	<p id="titre">Is this a tourist ville?</p><p for="touristique" class="search" name="touristique" id="info"></p>
	<br></br>
	<button class="sb" id="arrived" type="submit">Arrived</button>
		<div class="sign" id="sign">
	<button class="sb2">Back</button>
	</div>
</body>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='/GLA/Controleur/js/Navigation.js'></script>
</html>