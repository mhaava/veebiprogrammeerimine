<?php
//et pääseks ligi sessioonile funktsioonidele
require("functions.php");


//kui pole sisseloginud, liigume login lehele
if(!isset($_SESSION["userId"])){
	
	header("Location: login.php");
	exit();
}

if(isset($_GET["logout"])){
	session_destroy();
	header("Location: login.php");
	exit();
}

//http://greeny.cs.tlu.ee/~haavmihk/veebiprogrammeerimine/esimene.php
	//uhsdiaudahhd

	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" ></meta>
		<title>Kasutajad</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<?php seeUsers(); ?>
		<p><a href="?logout=1">Logi välja!</a></p>
		<p><a href="main.php">Avaleht</a></p>
		<h1><?php echo $myName ." " .$myFamilyName; ?></h1>
		

		
		
	</body>
</html>