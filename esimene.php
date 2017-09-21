

<?php
//http://greeny.cs.tlu.ee/~haavmihk/veebiprogrammeerimine/esimene.php
	//uhsdiaudahhd
	$myName = "Mihkel";
	$myFamilyName = "Haava";
	//massiiv
	$monthNamesEt = ["Jaanuar", "Veebruar", "Märts", "Aprill", "Mai", "Juuni", "Juuli", "August", "September", "Oktoober", "November", "Detsember"];
	//var_dump($monthNamesEt);
	//echo $monthNamesEt[8];
	$monthNow = $monthNamesEt[date("n")-1];//n- kuu nr ilma 0-ita
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

//Vanusega tegelemine
//var_dump($_POST);
//echo $_POST["birthYear"];
$myBirthYear;
$ageNotice = "";
if ( isset($_POST["birthYear"]) ){
	$myBirthYear = $_POST["birthYear"];
	$myAge = date("Y") - $_POST["birthYear"];
	$ageNotice = "<p>Te olete umbkaudu <b>" .$myAge ."</b> aastat vana.</p>";
	
	$ageNotice .= "<p>Olete elanud järgnevatel aastatel: </p> <ul>";
	for ($i = $myBirthYear; $i <= date("Y"); $i ++){
		$ageNotice .= "<li>" .$i ."</li>";
	
	}
	$ageNotice .= "</ul>";
	}
	
/*	for ($i= 0; $i > 0; $i ++) {
		echo "ha";
	}*/
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
		<p>See veebileht on loodud õppetöö raames ning ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
		<h4>Ma ei oska siia midagi kirjutada</h4>
		<?php
			echo "<p>Algas php õppimine</p>";
			echo "<p>Täna on ";
			echo date("d. "). $monthNow. date(" Y") .", kell oli lehe avamise hetkel " . date("H:i:s");
			echo " Hetkel on ".$partOfDay .".</p>";
		?>
		<h2>Natuke vanusest</h2>
		<form method="POST">
			<label><b>Teie sünniaasta: </b></label>
			<input name="birthYear" id="birthYear" type="number" value="<?php echo $myBirthYear; ?>" min="1900" max="2017">
			<input name="submitBirthYear" type="submit" value="Sisesta">
		</form>
		<?php
			if ($ageNotice != "") {
				echo $ageNotice;
			}
		?>
	</body>
</html>