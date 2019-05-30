<?php
	session_start();
	if(!isset($_SESSION['user'])){
		echo "<script>parent.location.href='/GLA/Vue/html/AccueilNoCon.php';</script>";
	}
	// else{
	// 	echo "<script>parent.location.href='/GLA/Vue/html/AccueilCon.php';</script>";
	// }

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="../css/AccueilCon.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Acceuil</title>
</head>
<body>
	

<div class="bienvenue" id="bienvenue">Find your way</div>
<div class="mainpage" id="mainpage"> 
	<p class="user">
	<?php
	echo $_SESSION['user'];?>
	</p>
	<form action="/GLA/Controleur/php/Trajet.php" method="POST">
	<p>Where are you: </p>
	
	<div class="Companies">
	<input type="text" name="depart" class="search" id="js-groupId" ></input>
	<input type="hidden" id="groupId">
        <ul id="groupid"> 
        </ul>
    </div> 

	<p>Where do you want to go: </p>
	
	<div class="Companies2">
	<input type="text" name="destination" class="search" id="js-groupId2" value=
	<?php 
	if(isset($_SESSION['pickAddress'])){
		echo $_SESSION['pickAddress'];
		unset($_SESSION['pickAddress']);
	}
	else{
		echo "";
	}
	?>></input>
	<input type="hidden" id="groupId2">
        <ul id="groupid2"> 
        </ul>
    </div> 

	
	<div class="option" id="option">
	<button class="boption" type="button" >Go home</button>
	<button class="boption" type="button" >To company</button>
	<button class="boption" type="button" >Usual</button>
	<button class="boption" id="setting" type="button" >Setting</button>
	</div>

	<div class="conditionpage" id="conditionpage">
	<p>Pass city(option): </p><input type="text" name="villepass" class="condition1"></input>
	<p>Not pass city(option): </p><input type="text" name="villenonpass" class="condition1"></input>
	<p>Road type:</p>
	<select>
	<option value=""></option>
	<option value="nationale">nationale</option>
	<option value="autoroute">autoroute</option>
	<option value="departementale">departementale</option>
	</select>
	
	<p></p><input type="checkbox" class="condition2">No radar</input>
	</div>

	<p></p><button value="Search" class="sb" type="submit">Search</button>
	</form>
	<div class="sign" id="sign">
	<button class="sb2" id="logout" type="button">Log out</button>
	<button class="sb2" id="userSetting" type="button">UserSet</button>
	</div>
</div>

</body>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='/GLA/Controleur/js/AccueilCon.js'></script>
</html>
