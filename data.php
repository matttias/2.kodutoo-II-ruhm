<?php

require("../../config.php");


$o_course = ""; //<---orienteerumis raja number
$distance = "";
$duration = "";
$maxSpeed = "";
$avgSpeed = "";
$o_courseError = "";
$distanceError = "";
$durationError = "";
$maxSpeedError = "";
$avgSpeedError = "";


require("functions.php");
//kui ei ole kasutaja id'd
if (!isset($_SESSION["userId"])){
	//suunan sisselogimise lehele
	header("Location: login.php");	
	exit();
}

//kui on ?logout aadressireal siis login välja
if (isset($_GET["logout"])) {
	session_destroy();
	header("Location: login.php");
	exit();
}


if(isset($_POST["distance"])){
	//jah on olemas
	//kas on tühi
	if(empty($_POST["distance"])){
		$distanceError = "See väli on kohustuslik";	
	} else {
		//email on olemas
		$distance = $_POST["distance"];
	}
}

if(isset($_POST["duration"])){
	//jah on olemas
	//kas on tühi
	if(empty($_POST["duration"])){
		$durationError = "See väli on kohustuslik";	
	} else {
		//email on olemas
		$duration = $_POST["duration"];
	}
}

if(isset($_POST["maxSpeed"])){
	//jah on olemas
	//kas on tühi
	if(empty($_POST["maxSpeed"])){
		$maxSpeedError = "See väli on kohustuslik";	
	} else {
		//email on olemas
		$maxSpeed = $_POST["maxSpeed"];
	}
}

if(isset($_POST["avgSpeed"])){
	//jah on olemas
	//kas on tühi
	if(empty($_POST["avgSpeed"])){
		$avgSpeedError = "See väli on kohustuslik";	
	} else {
		//email on olemas
		$avgSpeed = $_POST["avgSpeed"];
	}
}

if( isset( $_POST["o_course"] ) ){
	if(empty( $_POST["o_course"] ) ){
		$o_courseError = "See väli on kohustuslik";
	}else{
		$o_course = $_POST["o_course"];
		}
} 
if (isset($_POST["o_course"]) && isset($_POST["distance"]) && isset($_POST["duration"]) && isset($_POST["maxSpeed"])&& isset($_POST["avgSpeed"]) &&
	!empty($_POST["o_course"]) && !empty($_POST["distance"]) && !empty($_POST["duration"]) && !empty($_POST["maxSpeed"]) && !empty($_POST["avgSpeed"]))
	{
		run($_SESSION["userName"], $o_course, $distance, $duration, $maxSpeed, $avgSpeed);
	}

$runData = getRun();


?>
<h1>DATA<h1>
	
<p>Tere tulemast <?=$_SESSION["firstName"];?> <?=$_SESSION["lastName"];?>!</p>
<p>Kasutajanimi: <a href="user.php"><?=$_SESSION["userName"];?></a></p>
<p>E-mail: <?=$_SESSION["userEmail"];?></p>
<p>Sugu: <?=$_SESSION["gender"];?></p>
<p>Loodud: <?=$_SESSION["created"];?></p>
<a href="?logout=1">Logi välja</a>  <br> <br>

	<h1>Sisesta enda jooksu andmed:</h1>

<h3>Rada number</h3>
<form method="POST"> <br>

		<?php if($o_course == "1") { ?>
			<input name="o_course" value="1" type="radio" checked> 1 <br>
		<?php }else { ?> <!--Tühikud peavad olema-->
			<input name="o_course" value="1" type="radio"> 1 <br>
		<?php } ?>	
		
		
		<?php if($o_course == "2") { ?>
			<input name="o_course" value="2" type="radio" checked> 2 <br>
		<?php }else { ?> <!--Tühikud peavad olema-->
			<input name="o_course" value="2" type="radio"> 2 <br>
		<?php } ?>
		
		
		<?php if($o_course == "3") { ?>
			<input name="o_course" value="3" type="radio" checked> 3 <br>
		<?php }else { ?> <!--Tühikud peavad olema-->
			<input name="o_course" value="3" type="radio"> 3 <br>
		<?php } ?>
		
		
		<?php if($o_course == "4") { ?>
			<input name="o_course" value="4" type="radio" checked> 4 <br>
		<?php }else { ?> <!--Tühikud peavad olema-->
			<input name="o_course" value="4" type="radio"> 4 <br>
		<?php } ?>
		
		
		<?php if($o_course == "5") { ?>
			<input name="o_course" value="5" type="radio" checked> 5 <br>
		<?php }else { ?> <!--Tühikud peavad olema-->
			<input name="o_course" value="5" type="radio"> 5 <br>
		<?php } ?>
		
		<?=$distanceError; ?> <br>

<h3>Raja pikkus?</h3>

	<input name="distance" placeholder="Pikkus" type="text"> <?=$distanceError; ?> <br><br>
	
<h3>Läbimise kestvus?</h3>
	
	<input name="duration" placeholder="Kestvus" type="text"> <?=$durationError; ?> <br><br>

<h3>Läbimise suurim kiirus?</h3>
	
	<input name="maxSpeed" placeholder="Max kiirus" type="text"> <?=$maxSpeedError; ?> <br><br>

<h3>Läbimise keskmine kiirus?</h3>

	<input name="avgSpeed" placeholder="Avg kiirus" type="text"> <?=$avgSpeedError; ?> <br><br>

<input type="submit" value="Sisesta">



</form>



<?php
	
	$html = "<table>";
	$html .="<tr>";
		$html .= "<th>username</th>";
		$html .= "<th>o_course</th>";
		$html .= "<th>distance</th>";
		$html .= "<th>duration</th>";
		$html .= "<th>maxspeed</th>";
		$html .= "<th>avgspeed</th>";
		$html .= "<th>date</th>";
	$html .="</tr>";
	
	foreach($runData as $c) {
	
	$html .="<tr>";
		$html .= "<td>".$c->userName."</td>";
		$html .= "<td>".$c->o_course."</td>";
		$html .= "<td>".$c->distance."</td>";
		$html .= "<td>".$c->duration."</td>";
		$html .= "<td>".$c->maxSpeed."</td>";
		$html .= "<td>".$c->avgSpeed."</td>";
		$html .= "<td>".$c->date."</td>";
	$html .="</tr>";
	
	}
$html .="</table>";
echo $html;

?>

</body>
</html>


<br>
<br>
<br>