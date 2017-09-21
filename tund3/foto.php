<?php
//http://greeny.cs.tlu.ee/~haavmihk/veebiprogrammeerimine/esimene.php
	//uhsdiaudahhd
	$myName = "Mihkel";
	$myFamilyName = "Haava";
	
	$picDir = "../../pics/";
	$picFiles = [];
	
	$picFileTypes = ["jpg", "jpeg", "png", "gif"];
	
	$allFiles = array_slice(scandir($picDir), 2);
	//foreach töötab aint tableiga
	foreach ($allFiles as $file){	
	$fileType = pathinfo($file, PATHINFO_EXTENSION);
		if (in_array($fileType, $picFileTypes) == true) {
			array_push($picFiles, $file);
		}
	}
	//var_dump($allFiles);
	//$picFiles = array_slice($allFiles, 2);
	//var_dump($picFiles);
	$picFileCount = count($picFiles);
	echo $picFileCount;
	$picNumber = mt_rand(0, $picFileCount - 1);
	$picFile = $picFiles[$picNumber]
	//mt_rand -parem, kiirem
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" ></meta>
		<title>Mihkel Haava</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<h1><?php echo $myName ." " .$myFamilyName; ?></h1>
		<img src="<?php echo $picDir .$picFile ?>" alt="Tallinna ülikool">

		
		
	</body>
</html>