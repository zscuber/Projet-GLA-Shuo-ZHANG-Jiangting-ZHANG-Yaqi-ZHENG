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
	/*echo $count_json;
	if ($count_json==2){两条不一样
		echo "2";
	}
	else{只剩一条
		echo "same";
	}*/
	
	//$count_obj=count($data[0]);
	//$count_obj2=count($data[1]);

	$way=$_POST['way'];
	if ($count_json!=2&&$way=="2"){
		echo "<script>alert('You can not choose this one!');parent.location.href='/GLA/Vue/html/Search.php';</script>";
	}
	else if ($count_json!=2&&$way=="1"){
		$waychoose=$data;
		echo 1;
		$json_data = json_encode($waychoose);
		$url = '../trajet/'.$name.'trajetFinal.json';
		file_put_contents($url, $json_data);
		//print_r($waychoose);
	}
	if ($count_json==2&&$way=="1"){
		$waychoose=$data[0];
		echo 1;
		$json_data = json_encode($waychoose);
		$url = '../trajet/'.$name.'trajetFinal.json';
		file_put_contents($url, $json_data);
		//print_r($waychoose);
	}
	else if ($count_json==2&&$way=="2"){
		$waychoose=$data[1];
		echo 2;
		$json_data = json_encode($waychoose);
		$url = '../trajet/'.$name.'trajetFinal.json';
		file_put_contents($url, $json_data);
		//print_r($waychoose);
	}
	if ($way!=""){
	echo "<script>parent.location.href='/GLA/Vue/html/Navigation.php';</script>";
	}
	else {
		echo "<script>alert('You have to choose one route!');parent.location.href='/GLA/Vue/html/Search.php';</script>";
	}

?>