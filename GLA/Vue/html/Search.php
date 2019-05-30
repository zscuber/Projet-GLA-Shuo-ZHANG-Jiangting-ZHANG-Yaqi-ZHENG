<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="../css/Search.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Search</title>
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
	
	$url = '../../Controleur/trajet/'.$name.'trajet.json';

	$json_string = file_get_contents($url);
	
	$data = json_decode($json_string, true);
	$count_json = count($data);
	
	
	?>

<div class="bienvenue" id="bienvenue">Choose your way</div>

<div class="mainpage" id="mainpage"> 
	<form action="/GLA/Controleur/php/Search.php" method="POST">
	<p>These are the ways for you: </p>

	<input type="radio" name="way" value="1" />Way<?php $i=1;echo $i;?>:
	<?php 
	if ($count_json==2){
		$count_obj=count($data[0]);
		//echo $count_obj;
	$distance=$data[0][$count_obj-1]['distance'];
	$temps=$data[0][$count_obj-1]['temps'];
	//$temps=ceil($temps);
	$temps=number_format($temps,1);
	echo "Distance : ".$distance." km, Time : ".$temps." h";}
	else{
		$count_obj=count($data);
		//echo $count_obj;
		$distance=$data[$count_obj-1]['distance'];
		//echo $distance;}
		$temps=$data[$count_obj-1]['temps'];
		//$temps=ceil($temps);
		$temps=number_format($temps,1);
		echo "Distance : ".$distance." km, Time : ".$temps." h";}
	?>
	<br></br>
	<input type="radio" name="way" value="2" />Way<?php $i=2;echo $i;?>:
	<?php
	if ($count_json==2){
		$count_obj=count($data[1]);
		//echo $count_obj;
	$distance=$data[1][$count_obj-1]["distance"];
	$temps=$data[1][$count_obj-1]["temps"];
	//$temps=ceil($temps);
	$temps=number_format($temps,1);
	echo "Distance : ".$distance." km, Time : ".$temps." h";}
	else{
		echo "Sorry,we can just find one way.";
	}
	?>

	<p></p><button class="sb" type="submit">Select</button>
	</form>


	<div class="sign" id="sign">
	<button class="sb2">Back</button>
	</div>
</div>
</body>
<script src='../../Controleur/js/Search.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
</html>
