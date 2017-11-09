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

	

	//Algab foto laadimise osa
	$target_dir = "../../pics/";
	$target_file = "";
	$uploadOk = 1;
	$maxWidth = 600;
	$maxHeight = 400;
	$marginHor = 10;
	$marginVer = 10;
	
	
	//Kas Vajutati laadimise nuppu
	if(isset($_POST["submit"])) {
		// kas fail on valitud
		if(!empty($_FILES["fileToUpload"]["name"])) {
			
			//fikseerin faili nime
			$imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));
			//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$target_file = $target_dir . pathinfo(basename($_FILES["fileToUpload"]["name"]))["filename"] ."_" .(microtime(1) * 10000) ."." .$imageFileType;
			
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$notice .= "Fail on pilt - " . $check["mime"] . ". ";
				$uploadOk = 1;
			} else {
				$notice .= "See pole pildifail. ";
				$uploadOk = 0;
			}
			
			
				//Kas selline pilt on juba üles laetud
			if (file_exists($target_file)) {
				$notice .= "Kahjuks on selle nimega pilt juba olemas. ";
				$uploadOk = 0;
			}
			//Piirame faili suuruse
			if ($_FILES["fileToUpload"]["size"] > 1000000) {
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
				//see läheb viimaseks kui vajadus
				/*if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$notice .= "Fail ". basename( $_FILES["fileToUpload"]["name"]). " laeti üles! ";
				} else {
					$notice .= "Vabandust, üleslaadimisel tekkis tõrge! ";
				}*/
				
				//sültuvalt filei tüübist loon objekti
				if ($imageFileType == "jpg" or $imageFileType == "jpeg") {
					$myTempImage = imagecreatefromjpeg($_FILES["fileToUpload"]["tmp_name"]);
				}
				if ($imageFileType == "png") {
					$myTempImage = imagecreatefrompng($_FILES["fileToUpload"]["tmp_name"]);
				}
				if ($imageFileType == "gif") {
					$myTempImage = imagecreatefromgif($_FILES["fileToUpload"]["tmp_name"]);
				}
				//suuruse muutmine
				//teeme kindlaks praeguse suuruse
				$imageWidth = imagesx($myTempImage);
				$imageHeight = imagesy($myTempImage);
				//arvutan suuruse suhte
				if ($imageWidth > $imageHeight) {
					$sizeRatio = $imageWidth / $maxWidth;
				} else {
					$sizeRatio = $imageHeight / $maxHeight;
				}
				// tekitame uue, sobiva suurusega pikslikogumi
				$myImage = resizeImage($myTempImage, $imageWidth, $imageHeight, round($imageWidth/$sizeRatio), round($imageHeight/$sizeRatio));
				
				
				
				//lisan vesimärgi
				$stamp = imagecreatefrompng("../../graphics/hmv_logo.png");
				$stampWidth = imagesx($stamp);
				$stampHeight = imagesy($stamp);
				$stampX = imagesx($myImage) - $stampWidth - $marginHor;
				$stampY = imagesy($myImage) - $stampHeight - $marginVer;
				imagecopy($myImage, $stamp, $stampX, $stampY, 0, 0, $stampWidth, $stampHeight);
				
				//lisan ka teksti vesimärgina
				$textToImage = "Heade mõtete veeb";
				// määrata värvv
				//imagecolorallocate
				$textColor = imagecolorallocatealpha($myImage, 255, 255, 255, 60); // alpha 0-127
				// mis pildile, suurus, nurk vastupäeva, x, y, värv, font, tekst
				imagettftext($myImage, 20, -45, 10, 25, $textColor,"../../fonts/ARIAL.TTF", $textToImage);
				
				
				
				// salvestame pildi 
				if($imageFileType == "jpg" or $imageFileType == "jpeg") {
					if (imagejpeg($myImage, $target_file, 90)) {
						$notice .= "Fail ". basename( $_FILES["fileToUpload"]["name"]). " laeti üles! ";
					} else {
						$notice .= "Vabandust, üleslaadimisel tekkis tõrge! ";
					}
				}
				if($imageFileType == "png") {
					if (imagejpeg($myImage, $target_file, 5)) {
						$notice .= "Fail ". basename( $_FILES["fileToUpload"]["name"]). " laeti üles! ";
					} else {
						$notice .= "Vabandust, üleslaadimisel tekkis tõrge! ";
					}
				}
				if($imageFileType == "gif") {
					if (imagejpeg($myImage, $target_file)) {
						$notice .= "Fail ". basename( $_FILES["fileToUpload"]["name"]). " laeti üles! ";
					} else {
						$notice .= "Vabandust, üleslaadimisel tekkis tõrge! ";
					}
				}

				// vabastan mälu
				imagedestroy($myTempImage);
				imagedestroy($myImage);
				imagedestroy($stamp);
			}//saab salvestada loppeb
			
		} else {
			$notice .= "Palun valige kõigepealt pildi fail!";
		}
		
	} //if submit loppeb
	
	function resizeImage($image, $origW, $origH, $w, $h) {
		$newImage = imagecreatetruecolor($w, $h);
		//kuhu, kust, kuhu koordinaatidele x ja y, kust koordinaatidelt x ja y, kui laialt uude kohta, kui kõrgelt uude kohta, kui laialt võtta, kui kõrgelt võtta
		imagecopyresampled($newImage, $image, 0, 0, 0 ,0 ,$w, $h, $origW, $origH);
		return $newImage;
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