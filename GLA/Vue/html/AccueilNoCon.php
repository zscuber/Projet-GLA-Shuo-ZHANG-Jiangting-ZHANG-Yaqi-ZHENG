<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="../css/AccueilNoCon.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Acceuil</title>
</head>
<body>
	

<div class="bienvenue" id="bienvenue">Find your way</div>
<div class="mainpage" id="mainpage"> 
	
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
	<input type="text" name="destination" class="search" id="js-groupId2"></input>
	<input type="hidden" id="groupId2">
        <ul id="groupid2"> 
        </ul>
    </div> 

	<div class="conditionpage" id="conditionpage">
	<p>Pass city(option): </p><input type="text" name="villepass" class="condition1"></input>
	<p>Not pass city(option): </p><input type="text" name="villenonpass" class="condition1"></input>
	<p>Road type:</p>
	<select>
	<option value=""></option>
	<option value="nationale">nationale</option>
	<option value="autoroute">autoroute</option>
	<option value="nationale">nationale</option>
	<option value="departementale">departementale</option>
	</select>
	
	<p></p><input type="checkbox" class="condition2">No radar</input>
	<!-- <p></p><input type="checkbox" class="condition">Fastest</input>
	<p></p><input type="checkbox" class="condition">Eco</input> -->
	
	</div>
	<p></p><button value="Search" class="sb">Search</button>
	</form>
	<div class="sign" id="sign">
	<button class="sb2">Back</button>
	</div>
</div>

</body>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='/GLA/Controleur/js/AccueilNoCon.js'></script>
</html>
