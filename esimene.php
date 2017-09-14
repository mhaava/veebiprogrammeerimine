<?php
	//uhsdiaudahhd
	$myName = "Mihkel";
	$myFamilyName = "Haava";
	
	//hindan päeva osa
	$hourNow = date("H");
	$partOfDay = "";
	if ($hourNow < 8) {
		$partOfDay = "Varajane hommik";		
	}
	if ($hourNow >= 8 and $hourNow < 16) {
		$partOfDay = "Koolipäev";
	}
	if ($hourNow > 16) {
		$partOfDay = "Vabaaeg";
	}
//	echo $partOfDay;
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" ></meta>
		<title>Mihkel Haava</title>
	</head>
	<body>
		<h1><?php echo $myName ." " .$myFamilyName; ?></h1>
		<p>See veebileht on loodud õppetöö raames ning ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
		<h4>Ma ei oska siia midagi kirjutada</h4>
		<?php
			echo "<p>Algas php õppimine</p>";
			echo "<p>Täna on ";
			echo date("d.m.Y") .", kell oli lehe avamise hetkel " . date("H:i:s");
			echo " Hetkel on</p>".$partOfDay;
		?>
	</body>
</html>