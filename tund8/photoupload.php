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

	$notice = "";
	

	//Algab foto laadimise osa
	$target_dir = "../../pics/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	//Kas on pildi failitüüp
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			$notice .= "Fail on pilt - " . $check["mime"] . ". ";
			$uploadOk = 1;
		} else {
			$notice .= "See pole pildifail. ";
			$uploadOk = 0;
		}
	}
	
	//Kas selline pilt on juba üles laetud
	if (file_exists($target_file)) {
		$notice .= "Kahjuks on selle nimega pilt juba olemas. ";
		$uploadOk = 0;
	}
	//Piirame faili suuruse
	if ($_FILES["fileToUpload"]["size"] > 2000000) {
		$notice .= "Pilt on liiga suur! ";
		$uploadOk = 0;
	}
	
	//Piirame failitüüpe
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		$notice .= "Vabandust, vaid JPG, JPEG, PNG ja GIF failid on lubatud! ";
		$uploadOk = 0;
	}
	
	//Kas saab laadida?
	if ($uploadOk == 0) {
		$notice .= "Vabandust, pilti ei laetud üles! ";
	//Kui saab üles laadida
	} else {		
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			$notice .= "Fail ". basename( $_FILES["fileToUpload"]["name"]). " laeti üles! ";
		} else {
			$notice .= "Vabandust, üleslaadimisel tekkis tõrge! ";
		}
	}


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
		<p><a href="?logout=1">Logi välja!</a></p>
		<p><a href="main.php">Pealehele</a></p>
		<form action="photoupload.php" method="post" enctype="multipart/form-data">
			Select image to upload:
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Upload Image" name="submit">
		</form>

	</body>
</html>