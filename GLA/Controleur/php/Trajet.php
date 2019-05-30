<?php
	$name="";
session_start();
	if(!isset($_SESSION['user'])){
		$name="visitor";
	}
	else{
		$user=$_SESSION['user'];
		$name=$user;
		echo $user;
	}
	
	
$xml = new DOMDocument();
$xml->load('../../Controleur/reseau.xml');//recuperer info de la carte
$ville1=$xml->getElementsByTagName('ville');
$route1=$xml->getElementsByTagName('route');
function trajetSA($depart,$destination,$villenonpass,$route,$radar){//algo:Aetoile	
	global $xml;
	global $ville1;
	global $route1;
	$untrajet=array();
	$trajet=array();
	$maintenant=$depart;//la ville ou on est.
	$nb=0;
	$vite=0;
	
    $g=0;//点与起点的路程距离:sum(distance d'un troncon)
	$h=0;//点与重点的直线距离:la distance entre la ville maintenante et la destination 
	$f=$g+$h;//权重:on utilise cette confiance pour chosir la ville prochaine
	$t=0.0;
	$des_x=0.0;
	$des_y=0.0;
	$flagout=true;
	foreach($ville1 as $vi){
		if ($vi->getElementsByTagName("nom")[0]->nodeValue==$destination){//找终点城市的xy坐标	
			$des_x=$vi->getElementsByTagName("coordonnees")[0]->getElementsByTagName("latitude")[0]->nodeValue;
			$des_y=$vi->getElementsByTagName("coordonnees")[0]->getElementsByTagName("longitude")[0]->nodeValue;//la position de la destination
			}
		}
	$flage=true;$start=array();	
	while($flage){
	foreach($route1 as $rout){	
	foreach($rout->getElementsByTagName("troncon") as $tron){// on dois retirer tous les troncons qui a assoiciation avec la ville maintenant dans array de start.
		if($tron->getElementsByTagName("ville1")[0]->nodeValue==$maintenant){//如果找到一个troncon的一个头和当下城市相同
			$fl=true;
			foreach($ville1 as $vi){///找到另一段的城市
				$v=$tron->getElementsByTagName("ville2")[0]->nodeValue;
				$r=$tron->getElementsByTagName("radar")[0]->nodeValue;
				if ($vi->getElementsByTagName("nom")[0]->nodeValue==$v){//找到后计算权重等
					if($villenonpass!='') {if($v==$villenonpass) $fl=false;}
					if($radar!='') {if($r=="oui") $fl=false;}
					if ($depart==$v ) $fl=false;
					if($trajet!=[]){
					foreach($trajet as $tar){
						if($tar[0]==$v) $fl=false;
					}}
					if ($fl==true){
					$nbensuite=$nb+1;
					$viteensuite=$vite+$tron->getElementsByTagName("vitesse")[0]->nodeValue;
					$gensuite=$g+$tron->getElementsByTagName("longueur")[0]->nodeValue;//6是这个troncon的长度
					$tensuite=$gensuite/($viteensuite/$nbensuite);
					$main_x=$vi->getElementsByTagName("coordonnees")[0]->getElementsByTagName("latitude")[0]->nodeValue;
					$main_y=$vi->getElementsByTagName("coordonnees")[0]->getElementsByTagName("longitude")[0]->nodeValue;
					$h=sqrt(pow($main_x-$des_x,2)+pow($main_y-$des_y,2))*100;
					$f=$gensuite+$h;
					if($route!=''){
						if ($rout->getElementsByTagName("type")[0]->nodeValue!=$route) $f+=200;
					}
					}
				}
			}
			if($fl){
				$start_tron=array($v,$tron,$gensuite,$h,$f,$maintenant,$nbensuite,$viteensuite,$tensuite);
				array_push($start,$start_tron);}
			else continue;
		}
		else if($tron->getElementsByTagName("ville2")[0]->nodeValue==$maintenant){
			$fl=true;
			foreach($ville1 as $vi){///找到另一段的城市
				$v=$tron->getElementsByTagName("ville1")[0]->nodeValue;
				$r=$tron->getElementsByTagName("radar")[0]->nodeValue;
				if ($vi->getElementsByTagName("nom")[0]->nodeValue==$v){//找到后计算权重等
					if($villenonpass!='') {if($v==$villenonpass) $fl=false;}
					if($radar!='') {if($r=="oui") $fl=false;}
					if ($depart==$v ) $fl=false;
					if($trajet!=[]){
					foreach($trajet as $tar){
						if($tar[0]==$v) $fl=false;
					}}
					if ($fl==true){
					$nbensuite=$nb+1;
					$viteensuite=$vite+$tron->getElementsByTagName("vitesse")[0]->nodeValue;
					$gensuite=$tron->getElementsByTagName("longueur")[0]->nodeValue+$g;//6是这个troncon的长度
					$tensuite=$gensuite/($viteensuite/$nbensuite);
					$main_x=$vi->getElementsByTagName("coordonnees")[0]->getElementsByTagName("latitude")[0]->nodeValue;
					$main_y=$vi->getElementsByTagName("coordonnees")[0]->getElementsByTagName("longitude")[0]->nodeValue;
					$h=sqrt(pow($main_x-$des_x,2)+pow($main_y-$des_y,2))*100;
					$f=$gensuite+$h;
					if($route!=''){
						if ($rout->getElementsByTagName("type")[0]->nodeValue!=$route) $f+=200;
					}
					}
				}
			}
			if($fl){
				$start_tron=array($v,$tron,$gensuite,$h,$f,$maintenant,$nbensuite,$viteensuite,$tensuite);
				array_push($start,$start_tron);}
			else continue;
		}
	}
	}
	$j=0;
	foreach($start as $choix){//apres on ajoute les troncons vouvels ,il faut quitter les villes on a deja passe dans start(c-a-d:la ville maintenant)                         
		//所有这个城市的信息都要删除，因为这个城市最短路径已经被找到并且丢到trajet里了。
		if($choix[0]==$maintenant) {array_splice($start,$j,1);$j--;}
		$j++;
	}
	//si start est ville, on n'a pas trouve aucun trajet entre depart et destination , on envoie les info.
	if ($start==[]){echo "desole! il n'y a pas de trajet entre ces deux villes!</br>";$flage=false;$flagout=false;}
	/*结束情况一：如果所有的开始数组里的所有城市都被走完了，说明没有匹配的路径通到目的地，所以flage变成结束的标志*/
	else{
		$index=0;
		$long=50000000;
		$i=0;
		foreach($start as $choix){//il nous faut choisir la niuvelle ville comme ville maintenant selon la confiance de f,on choisir le moins.
			if($choix[4]<$long) {$long=$choix[4];$index=$i;}
			$i++;
			//echo "每个路：".$choix[0]." f ".$choix[4]." </br>";
		}
		echo "每次最小路段".$start[$index][5]."->".$start[$index][0]."</br>";
		array_push($trajet,$start[$index]);
		$nb=$start[$index][6];$vite=$start[$index][7];
		$g=$start[$index][2];//记录上一记录的走过的路程距离。mais faut que notter les distance de passe de depart a maintenant 
		$maintenant=$start[$index][0];//改变当下城市
		//si maintnant est deja la destination cest a dire on a trouve un trajet deja
		if ($maintenant==$destination) {$flage=false;echo "fini!</br>";}//结束情况2：当前的城市已经是destination：quand la derniere villes est destination,on finis.
		}
	}
	$t=$trajet;//整理一下有用的troncon信息到untrajet里面。
	if($flagout){//on retirer tous les utiles sur le vrai trajet dans l'array de trajet 
		$n=count($t)-1;
		array_unshift($untrajet,$t[$n]);
		$villeA=$t[$n][5];
		array_splice($t,$n,1);
		$n=count($t)-1;
		while($n>=0){
			if($t[$n][0]==$villeA){
				array_unshift($untrajet,$t[$n]);$villeA=$t[$n][5];array_splice($t,$n,1);
			}
			if($villeA==$depart) break;
			$n--;
		}
	}
	echo "这个trajet的troncon数量有：".count($untrajet)."</br>";
	return $untrajet;// on l'envoie.
}
function trajetRapide($depart,$destination,$villenonpass,$route,$radar){//algo:Aetoile	
	global $xml;
	global $ville1;
	global $route1;
	$untrajet=array();
	$trajet=array();
	$maintenant=$depart;//la ville ou on est.
    $vitesse1=0;//点与起点的速度:sum(vitesse d'un troncon)
	$nb=0;
	$g=0;//点与起点的距离:sum(distance d'un troncon)
	$t=0.0;//总体时间:on utilise cette confiance（temps total） pour chosir la ville prochaine
	$flagout=true;
	$flage=true;$start=array();	
	while($flage){
	foreach($route1 as $rout){	
	foreach($rout->getElementsByTagName("troncon") as $tron){// on dois retirer tous les troncons qui a assoiciation avec la ville maintenant dans array de start.
		if($tron->getElementsByTagName("ville1")[0]->nodeValue==$maintenant){//如果找到一个troncon的一个头和当下城市相同
			$fl=true;
			foreach($ville1 as $vi){///找到另一段的城市
				$v=$tron->getElementsByTagName("ville2")[0]->nodeValue;
				$r=$tron->getElementsByTagName("radar")[0]->nodeValue;
				if ($vi->getElementsByTagName("nom")[0]->nodeValue==$v){//找到后计算权重等
					if($villenonpass!='') {if($v==$villenonpass) $fl=false;}
					if($radar!='') {if($r=="oui") $fl=false;}
					if ($depart==$v ) $fl=false;
					if($trajet!=[]){
					foreach($trajet as $tar){
						if($tar[0]==$v) $fl=false;
					}}
					if ($fl==true){
					$vensuite=$vitesse1+$tron->getElementsByTagName("vitesse")[0]->nodeValue;//6是这个troncon的vitesse
					$nbensuite=$nb+1;
					$gensuite=$g+$tron->getElementsByTagName("longueur")[0]->nodeValue;//6是这个troncon的longueur
					$t=$gensuite/($vensuite/$nbensuite);
					if($route!=''){
						if ($rout->getElementsByTagName("type")[0]->nodeValue!=$route) $t+=200;
					}
					}
				}
			}
			if($fl){
				$start_tron=array($v,$tron,$vensuite,$gensuite,$t,$maintenant,$nbensuite);
				array_push($start,$start_tron);}
			else continue;
		}
		else if($tron->getElementsByTagName("ville2")[0]->nodeValue==$maintenant){
			$fl=true;
			foreach($ville1 as $vi){///找到另一段的城市
				$v=$tron->getElementsByTagName("ville1")[0]->nodeValue;
				$r=$tron->getElementsByTagName("radar")[0]->nodeValue;
				if ($vi->getElementsByTagName("nom")[0]->nodeValue==$v){//找到后计算权重等
					if($villenonpass!='') {if($v==$villenonpass) $fl=false;}
					if($radar!='') {if($r=="oui") $fl=false;}
					if ($depart==$v ) $fl=false;
					if($trajet!=[]){
					foreach($trajet as $tar){
						if($tar[0]==$v) $fl=false;
					}}
					if ($fl==true){
					$vensuite=$vitesse1+$tron->getElementsByTagName("vitesse")[0]->nodeValue;//6是这个troncon的vitesse
					$nbensuite=$nb+1;
					$gensuite=$g+$tron->getElementsByTagName("longueur")[0]->nodeValue;//6是这个troncon的longueur
					$t=$gensuite/($vensuite/$nbensuite);
					if($route!=''){
						if ($rout->getElementsByTagName("type")[0]->nodeValue!=$route) $t+=200;
					}
					}
				}
			}
			if($fl){
				$start_tron=array($v,$tron,$vensuite,$gensuite,$t,$maintenant,$nbensuite);
				array_push($start,$start_tron);}
			else continue;
		}
	}
	}
	$j=0;
	foreach($start as $choix){//apres on ajoute les troncons vouvels ,il faut quitter les villes on a deja passe dans start(c-a-d:la ville maintenant)                         
		//所有这个城市的信息都要删除，因为这个城市最短路径已经被找到并且丢到trajet里了。
		if($choix[0]==$maintenant) {array_splice($start,$j,1);$j--;}
		$j++;
	}
	//si start est ville, on n'a pas trouve aucun trajet entre depart et destination , on envoie les info.
	if ($start==[]){echo "desole! il n'y a pas de trajet entre ces deux villes!</br>";$flage=false;$flagout=false;}
	/*结束情况一：如果所有的开始数组里的所有城市都被走完了，说明没有匹配的路径通到目的地，所以flage变成结束的标志*/
	else{
		$index=0;
		$long=50000000;
		$i=0;
		foreach($start as $choix){//il nous faut choisir la niuvelle ville comme ville maintenant selon la confiance de f,on choisir le moins.
			if($choix[4]<$long) {$long=$choix[4];$index=$i;}
			$i++;
		}
		echo "每次最小路段".$start[$index][5]."->".$start[$index][0]."</br>";
		array_push($trajet,$start[$index]);
		$vitesse1=$start[$index][2];//记录上一记录的走过的vitesse。mais faut que notter les distance de passe de depart a maintenant 
		$g=$start[$index][3];
		$nb=$start[$index][6];
		$maintenant=$start[$index][0];//改变当下城市
		//si maintnant est deja la destination cest a dire on a trouve un trajet deja
		if ($maintenant==$destination) {$flage=false;echo "fini!</br>";}//结束情况2：当前的城市已经是destination：quand la derniere villes est destination,on finis.
		}
	}
	$t=$trajet;//整理一下有用的troncon信息到untrajet里面。
	if($flagout){//on retirer tous les utiles sur le vrai trajet dans l'array de trajet 
		$n=count($t)-1;
		array_unshift($untrajet,$t[$n]);
		$villeA=$t[$n][5];
		array_splice($t,$n,1);
		$n=count($t)-1;
		while($n>=0){
			if($t[$n][0]==$villeA){
				array_unshift($untrajet,$t[$n]);$villeA=$t[$n][5];array_splice($t,$n,1);
			}
			if($villeA==$depart) break;
			$n--;
		}
	}
	echo "这个trajet的troncon数量有：".count($untrajet)."</br>";
	//print_r($untrajet);
	return $untrajet;// on l'envoie.
}
function trajetS($depart,$destination,$villepass,$villenonpass,$route,$radar){//请调用这个！ radar意思就是说 用户希望走没有雷达的路。
	$trajets=array();
	$a=array();
	$a5=array();
	if($villepass!='') {
		$a1=trajetSA($depart,$villepass,$villenonpass,$route,$radar);
		$a2=trajetSA($villepass,$destination,$villenonpass,$route,$radar);
		$a2[count($a2)-1][2]+=$a1[count($a1)-1][2];
		$a2[count($a2)-1][8]+=$a1[count($a1)-1][8];
		$a=array_merge($a1,$a2);
		echo "这个复合etoile的trajet的troncon数量有：".count($a)."</br>";
		//print_r($a);
		$a3=trajetRapide($depart,$villepass,$villenonpass,$route,$radar);
		$a4=trajetRapide($villepass,$destination,$villenonpass,$route,$radar);
		$a4[count($a4)-1][3]+=$a3[count($a3)-1][3];
		$a4[count($a4)-1][4]+=$a3[count($a3)-1][4];
		$a5=array_merge($a3,$a4);
		echo "这个复合rapide的trajet的troncon数量有：".count($a)."</br>";
	}
	else{
	$a=trajetSA($depart,$destination,$villenonpass,$route,$radar);
	$a5=trajetRapide($depart,$destination,$villenonpass,$route,$radar);}
	echo "distance et temps du premier trajet:".$a[count($a)-1][2]." ".$a[count($a)-1][8]."</br>";
	echo "distance et temps du deuxieme trajet:".$a5[count($a5)-1][3]." ".$a5[count($a5)-1][4]."</br>";
	array_push($trajets,$a,$a5);
	echo "nb trajet : ".count($trajets)."</br>";
	return $trajets;
}
	$depart = $_POST["depart"];
	$destination=$_POST["destination"];
	$villepass=$_POST["villepass"];
	$villenonpass=$_POST["villenonpass"];
	//echo $depart,$destination,$villepass,$villenonpass;
	if( $_POST ) 
	{ 
	$route=$_POST['select']; 
	} 
	$radar=$_POST['radar'];


	//echo $i;
	if($depart==""||$destination==""){
		echo "<script>alert('You need to input one city!');parent.location.href='/GLA/Vue/html/AccueilCon.php';</script>";
	}
//echo "<script>alert('We have noticed your choice!');parent.location.href='/GLA/Vue/html/Search.html';</script>";
	//echo $depart,$destination,$villepass,$villenonpass,$route,$radar;
	$v1 ="";
	$v2 ="";
	$distance=0;
	$temps=0.0;
//echo $depart,$destination,$villepass,$villenonpass,$route,$radar;
	$arr=trajetS($depart,$destination,$villepass,$villenonpass,$route,$radar);//这里是用来调用函数的
	$i=0;
	$trajettotal=array();
	foreach($arr as $t){
		$a=array();
		array_push($a, count($t));
		if($i==0){
			foreach($t as $tronconnn){
				$array = [
					'depart' => $tronconnn[5],
					'destination' => $tronconnn[0],
					'touristique' => $tronconnn[1]->getElementsByTagName('touristique')[0]->nodeValue,
					'distance' => $tronconnn[2],
					'temps' => $tronconnn[8]
				];	
			array_push($a,$array);
			}
			//distance et temps
			$array2=[
				'distance' => $t[count($t)-1][2],
				'temps' => $t[count($t)-1][8]
			];
			array_push($a,$array2);
			//array_push($a,$t[count($t)-1][2],$t[count($t)-1][8]);
		}
		else {
			foreach($t as $tronconnn){
				$array = [
					'depart' => $tronconnn[5],
					'destination' => $tronconnn[0],
					'touristique' => $tronconnn[1]->getElementsByTagName('touristique')[0]->nodeValue,
					'distance' => $tronconnn[3],
					'temps' => $tronconnn[4]
				];
			array_push($a,$array);
			}
			//distance et temps
			$array2=[
				'distance' => $t[count($t)-1][3],
				'temps' => $t[count($t)-1][4]
			];
			array_push($a,$array2);
			//array_push($a,$t[count($t)-1][3],$t[count($t)-1][4]);
		}
	array_push($trajettotal,$a);
	//print_r($a);
	//print_r($trajettotal);
	//echo "下一个！</br>";
	$i++;
	}
	$json_data = json_encode($trajettotal);
	$url = '../trajet/'.$name.'trajet.json';
	file_put_contents($url, $json_data);

	$json_string = file_get_contents($url);
	
	$data = json_decode($json_string, true);
	$count_json = count($data);
	//$count_obj=count($data[0]);
	//$count_obj2=count($data[1]);
	//$nbt=$data[0][0];
	//echo $count_obj;
	//$a=array();
	$way1=$data[0];
	$way2=$data[1];
    $flag="true";
	if ($way1==$way2){//一样的时候flag是true
		$flag="true";
		$waysame=$data[0];
		$json_data = json_encode($waysame);
		$url = '../trajet/'.$name.'trajet.json';
		file_put_contents($url, $json_data);
	}
	else{//不一样的时候flag是flase
		$flag="false";
	}
	if(file_put_contents($url, $json_data)){
		 echo "<script>parent.location.href='/GLA/Vue/html/Search.php';</script>";
	}
	else{
		//echo $nom,$password;
		echo "<script>alert('Failed!');parent.location.href='/GLA/Vue/html/AccueilCon.php';</script>";
	}	
	

	
	//echo $depart,$destination,$villepass,$villenonpass,$route,$radar;


?>