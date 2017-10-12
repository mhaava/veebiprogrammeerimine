<?php	//sisestuse kontrollimine
	function test_input($data){
		$data = trim($data); //eemaldab lõpust tühiku, tab vms
		$data = stripslashes($data); // eemaldab "\"
		$data = htmlspecialchars($data); // eemaldab keelatud märgid
		return $data;
	}

	
/*	$x = 8;
	$y = 5;
	echo "Esimene summa on: " .($x + $y);
	addValues();
	
	function addValues() {
		echo "Teine summa on: " .($GLOBALS["x"] + $GLOBALS["y"]);
		$a = 4;
		$b = 1;
		echo "Kolmas summa on: " .($a + $b);
	}
	echo "Neljas summa on: " .($a + $b);*/
	
	//UUE kasutaja LSIAMINE
	
	$database = "if17_haavmihk";
	
	//ALUSTAME SESSIOONI
	session_start();
	
	//logimise functsioon
	function signIn($email, $password) {
		$notice = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, firstname, lastname, email, password FROM vpusers WHERE email = ?");
		$stmt->bind_param("s", $email);
		$stmt->bind_result($id, $firstnameFromDb, $lastnameFromDb, $emailFromDb, $passwordFromDb);
		$stmt->execute();
		
		//kontrollime kasutajat
		if($stmt->fetch()) {
			$hash = hash("sha512", $password);
			if($hash == $passwordFromDb){
				$notice = "Kõik korras! Logisime sisse!";
				
				//salvestame sesssiooni muutujaid
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				$_SESSION["firstname"] = $firstnameFromDb;
				$_SESSION["lastname"] = $lastnameFromDb;
				//Kasutajate nägemise functsioon
					//kasutajate tabel
					function seeUsers() {
						$stmt = $mysqli->prepare("SELECT id, firstname, lastname, email FROM vpusers");	
						while($stmt->fetch()){
							echo "ello";
						}
					}
				
				//liigume pealehele
				header("Location: main.php");
				exit();
			} else {
				$notice = "Sisestasite vale salasõna!";
			}
		} else {
			$notice = "Sellist kasutajat (" .$email .") ei ole!";
		}
		return $notice;
	}
	
	function signUp($signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword) {
	//Ühendus serveriga
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		//Käsk serverile
		$stmt = $mysqli->prepare("INSERT INTO vpusers (firstname, lastname, birthday, gender, email, password) VALUES (?, ?, ?, ?, ?, ?)");
		echo $mysqli->error;
		
		//s - string ehk text
		//i - intreger ehk täisarv
		//d - decimal ehk murdarv
		$stmt->bind_param("sssiss", $signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword);
		//$stmt->execute();
		if($stmt->execute()) {
			echo "Õnnestus!";
		} else {
			echo "Tekkis viga: " .$stmt->error;
		}
	}	
?>