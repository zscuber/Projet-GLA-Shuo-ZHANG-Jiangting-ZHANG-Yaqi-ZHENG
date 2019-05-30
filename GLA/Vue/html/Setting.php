<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="../css/Setting.css" rel="stylesheet" />
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
	
	$home = $data['home'];
	$company = $data['company'];
	$usual = $data['usual'];
	?>

<div class="bienvenue" id="bienvenue">Setting</div>
	
<div class="mainpage" id="mainpage"> 
	<form action="../../Controleur/php/Setting.php" method="POST">
	<p>Home address: </p>
	<div class="Companies">
	<input type="text" name="home" class="login" id="js-groupId" value=<?php
	echo $home; ?> ></input>
	<input type="hidden" id="groupId">
        <ul id="groupid"> 
        </ul>
    </div>                
	
	<p>Company address: </p>
	<div class="Companies2">
	<input type="text" name="company" class="login" id="js-groupId2" value=<?php
	echo $company; ?>></input>
	<input type="hidden" id="groupId2">
        <ul id="groupid2"> 
        </ul>
    </div>                
	
	<p>Usual address: </p>
	<div class="Companies3">
	<input type="text" name="usual" class="login" id="js-groupId3" value=<?php
	echo $usual; ?>></input>
	<input type="hidden" id="groupId3">
        <ul id="groupid3"> 
        </ul>
    </div>     
	
	<p></p><button class="sb" type="button">Modify</button>
	<button class="sb" type="submit">Comfirm</button>
	</form>
	<div class="sign" id="sign">
	<button class="sb2">Back</button>
	</div>
</div>

</body>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='../../Controleur/js/Setting.js'></script>
</html>
