<?php
$loginEmail = "";
if ( isset($_POST["loginEmail"])) {
	$loginEmail = $_POST["loginEmail"];
}
?>

<?php
$signupFirstName = "";
$signupFamilyName = "";
$signupEmail = "";
$maleChecked = "";
$femaleChecked = "";
if ( isset($_POST["signupFirstName"])) {
	$signupFirstName = $_POST["signupFirstName"];
}
if ( isset($_POST["signupFamilyName"])) {
	$signupFamilyName = $_POST["signupFamilyName"];
}
if ( isset($_POST["signupEmail"])) {
	$signupEmail = $_POST["signupEmail"];
}
if ( isset($_POST["gender"])) {
	if ($_POST["gender"] == "1") {
		$maleChecked = "checked";
	}
	if ($_POST["gender"] == "2") {
		$femaleChecked = "checked";
	}
}

?>


<!DOCTYPE HTML>
<html>
<head>
	<title>
	</title>
</head>

<body>
<h1>LOGI SISSE</h1>
	<form method="POST">
	
		<label>Email: </label>
		<input name="loginEmail" type="email" value="<?php echo $loginEmail; ?>"><br>
		<label>Password: </label>
		<input name="loginPassword" type="password"><br>
		<input type="submit" value="Login">
		
	</form>
<h1>REGISTREERI</h1>
	<form method="POST">
	
		<label>First name: </label>
		<input name="signupFirstName" type="text" value="<?php echo $signupFirstName; ?>"><br>
		<label>Family name: </label>
		<input name="signupFamilyName" type="text" value="<?php echo $signupFamilyName; ?>"><br>
		<label>Male: </label>
		<input type="radio" name="gender" value="1" <?php echo $maleChecked; ?>>
		<label>Female: </label>
		<input type="radio" name="gender" value="2" <?php echo $femaleChecked; ?>><br>
		<label>Email: </label>
		<input name="signupEmail" type="email" value="<?php echo $signupEmail; ?>"><br>
		<label>Password: </label>
		<input name="signupPassword" type="password"><br>
		<input type="submit" value="Sign up">
		
	</form>
</body>
</html>
