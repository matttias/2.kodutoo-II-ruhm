<?php

//see vail peab olema kõigil lehtedel, kus tahan kasutada session muutujat


session_start();

//************
//***Signup***
//************


function signUp($signupUsername, $password, $signupEmail, $signupFirstName, $signupLastName, $signupGender) {
	//echo $serverUsername;
	//Ühendus
	$database = "if16_mattbleh_2";

		$mysqli = new mysqli ($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

		// mysqli rida
		$stmt = $mysqli->prepare("INSERT INTO project_user (username, password, email, firstname, lastname, gender) VALUES (?, ?, ?, ?, ?, ?)");
		echo $mysqli->error;
		// stringina üks täht iga muutuja kohta (?), mis t𼰠t
		// string - s
		// integer - i
		// float (double) - d
		// küsimärgid asendada muutujaga
		$stmt->bind_param("ssssss",$signupUsername, $password, $signupEmail, $signupFirstName, $signupLastName, $signupGender);
		
		//täida käu
		if($stmt->execute()) {
			echo "Salvestamine õnnestus";
			
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		//panen Ühenduse kinni
		$stmt->close();
		$mysqli->close();
	}


function login($loginEmail, $loginPassword) {
	
	$error = "";
	$password = $loginPassword;
	$email = $loginEmail;
	
	$database = "if16_mattbleh_2";
		$mysqli = new mysqli ($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("
		SELECT id, username, password, email, firstname, lastname, gender, created
		FROM project_user
		WHERE email = ?");
		
		echo $mysqli->error;
		
		//asendan küsimärgi
		$stmt->bind_param("s", $email);
		
		//määrna väärtused muutujasse
		$stmt->bind_result($id, $usernameFromDB, $passwordFromDB,  $emailFromDB, $firstnameFromDB, $lastnameFromDB, $genderFromDB, $created);
		$stmt->execute();
		
		//andmed tulid andmebaasist või mitte
		//on tõene kui on vähemalt üks vastus
		
		if($stmt->fetch()){
			//oli sellise meiliga kasutaja
			//password millega kasutaja tahab sisse logida
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromDB) {
				echo "Kasutaja logis sisse ".$id;
				
			$_SESSION["userId"] = $id;
			$_SESSION["userEmail"] = $emailFromDB;
			$_SESSION["userName"] = $usernameFromDB;
			$_SESSION["firstName"] = $firstnameFromDB;
			$_SESSION["lastName"] = $lastnameFromDB;
			$_SESSION["gender"] = $genderFromDB;
			$_SESSION["created"] = $created;
			header("Location: data.php");
			exit();
			
			} else {
				$error = "Vale parool";
			}
			//määran sessiooni muutujad
			
			
			//header("Location: login.php");
			
		} else {
			//ei ole sellist kasutajat selle meiliga
			$error = "Ei ole sellist e-maili";
		}
	
		return $error;
	}
	
function cleanInput($input) {
	// " tere tulemast " <--
	$input = trim($input);
	// "tere tulemast" <-- peale eelmist rida
	
	// " tere \\tulemast " <--
	$input = stripslashes($input);
	// "tere tulemast"

	// "<"
	$input = htmlspecialchars($input);
	// "&lt"
	
	return $input;
}

	
	
	
	
?>