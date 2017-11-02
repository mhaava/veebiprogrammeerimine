<?php
//et pääseks ligi sessioonile funktsioonidele
require("functions.php");
$notice = "";

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

	if(isset($_POST["ideaButton"])) {
		if(isset($_POST["idea"]) and !empty($_POST["idea"])){
			//echo $_POST["ideaColor"];
			$notice = saveIdea($_POST["idea"], $_POST["ideaColor"]);
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" ></meta>
		<title>head mõtted</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<?php?>
		<p><a href="?logout=1">Logi välja!</a></p>
		<p><a href="main.php">Avaleht</a></p>
		<hr>
		<h1>Lisa oma hea mõte</h1>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<label>Hea mõte: </label>
			<input name="idea" type="text">
			<br>
			<label>Mõttega seonduv värv: </label>
			<input name="ideaColor" type="color">
			<br>
			<input name="ideaButton" type="submit" value="Salvesta mõte!">
			<span><?php echo $notice; ?></span>
		
		</form>
		<hr>
		<div style="width: 40%; border: 1px solid red;">
			<?php echo listIdeas(); ?>
		</div>
		
		
	</body>
</html>