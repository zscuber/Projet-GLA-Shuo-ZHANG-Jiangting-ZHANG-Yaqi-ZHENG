<?php
	$dbconn = mysqli_connect("localhost","root","","projet_GLA")or die("erreur deconnexion");
	$xml = simplexml_load_file("reseau2.xml");
	$nom = "";
	$type = "";
	$touristique="";
	$latitude=0.0;
	$longitude=0.0;
	foreach ($xml->children() as $child){
		$i = 0 ;
		if ($child->getName()=="ville"){
			foreach ($child->children() as $kid){
				if($i==0){
					$nom = $kid ;
					$i++ ;
				}else if($i==1){
					$type = $kid ;
					$i++;
				}else if($i==2){
					$touristique =$kid;
					$i++;
				}else if($i==3){
					$j = 0 ;
					foreach ($kid->children() as $k){
						if($j==0){$latitude=$k;$j++;}
						else{$longitude=$k;$j=0;}
					}	
					$i=0;
				}	
			}
			$sql1 = "insert into VILLE(nom,type,touristique,latitude,longitude) values('$nom','$type','$touristique',$latitude,$longitude )" ;
			mysqli_query($dbconn,$sql1);
		}
		
		else if($child->getName()=="route"){
			$i=0;
			$nom = "";
			$type = "";
			foreach ($child->children() as $kid){
				if($i==0){
					$nom = $kid ;//echo "<script>alert('$nom');</script>";
					$i++ ;
				}else if($i==1){
					$type = $kid ;//echo "<script>alert('$type');</script>";
					$i++;
				}else if($kid->getName()=="troncon"){
					$j = 0 ;
					$depart="";
					$destination="";
					$vitesse=0;
					$touristique="";
					$radar="";
					$payant="";
					$longueur=0;
					foreach ($kid->children() as $k){
						if($j==0){$depart=$k;$j++;}
						else if($j==1){$destination=$k;$j++;}
						else if($j==2){$vitesse=$k;$j++;}
						else if($j==3){$touristique=$k;$j++;}
						else if($j==4){$radar=$k;$j++;}
						else if($j==5){$payant=$k;$j++;}
						else {$longueur=$k;$j=0;}
					}
					echo"$depart";
					echo"$destination";
					echo"$vitesse";
					echo"$touristique";
					echo"$radar";
					echo"$payant";
					echo"$longueur";
					//$dbconn = mysqli_connect("localhost","root","","projet_GLA")or die("erreur deconnexion");
					$sql3 = "insert into TRONCON(depart,destination,vitesse,touristique,radar,payant,longueur) values('$depart','$destination',$vitesse,'$touristique','$radar','$payant',$longueur)" ;
					mysqli_query($dbconn,$sql3);
					echo"hhhhhhhhh</br>";
					echo"$depart";
					echo"$destination";
					echo"$vitesse";
					echo"$touristique";
					echo"$radar";
					echo"$payant";
					echo"$longueur";
				}
			}
			
			if ($nom!="" or $nom!=null){
				//$dbconn = mysqli_connect("localhost","root","","projet_GLA")or die("erreur deconnexion");
				$sql2 = "insert into ROUTE(nom,type) values('$nom','$type')" ;
				mysqli_query($dbconn,$sql2);
			}	
		}
	}
?>