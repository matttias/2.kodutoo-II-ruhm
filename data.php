<?php


$o_course = ""; //<---orienteerumis raja number

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
?>
<h1>DATA<h1>


<p>Tere tulemast <?=$_SESSION["firstName"];?> <?=$_SESSION["lastName"];?>!</p>
<p>Kasutajanimi: <?=$_SESSION["userName"];?></p>
<p>E-mail: <?=$_SESSION["userEmail"];?></p>
<p>Sugu: <?=$_SESSION["gender"];?></p>
<p>Loodud: <?=$_SESSION["created"];?></p>
<a href="?logout=1">Logi välja</a>  <br> <br>

<h3>Mis rada jooksid?</h3>
<!--<form method="POST"> <br> -->

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
			<input name="o_course" value="3" type="radio" checked> 4 <br>
		<?php }else { ?> <!--Tühikud peavad olema-->
			<input name="o_course" value="3" type="radio"> 4 <br>
		<?php } ?>
		
		
		<?php if($o_course == "5") { ?>
			<input name="o_course" value="3" type="radio" checked> 5 <br>
		<?php }else { ?> <!--Tühikud peavad olema-->
			<input name="o_course" value="3" type="radio"> 5 <br>
		<?php } ?>

