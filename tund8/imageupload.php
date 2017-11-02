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
		<title>
			<?php echo $_SESSION["firstname"] ." " .$_SESSION["lastname"]; ?>
		</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<form action="upload.php" method="post" enctype="multipart/form-data">
			Select image to upload:
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Upload Image" name="submit">
		</form>

	</body>
</html>