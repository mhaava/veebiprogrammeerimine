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
	<table border="1" style="border: 1px solid black; border-collapse: collapse">
	<tr style="background-color:red;">
		<th>eesnimi</th><th>perekonnanimi</th><th>e-posti aadress</th>
	</tr>
		<?php echo seeUsers(); ?>
	</table>
		<p><a href="?logout=1">Logi välja!</a></p>
		<p><a href="main.php">Avaleht</a></p>
		
		

		
		
	</body>
</html>