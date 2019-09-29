<?php
include_once(dirname(__FILE__) . "/../include/config.php");
include_once(INCLUDE_DIR . "/" . "htmlFunctions.php");
include_once(INCLUDE_DIR . "/" . "mitigate.php");
include_once(INCLUDE_DIR . "/" . "FYP_functions.php");

$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );#Used till the end


?>

<!DOCTYPE html>
<html>
<head>
	<title>Click Jacking Attack</title>
	<link type="text/css" href="clickJacking.css" rel="stylesheet" />
	<link type="text/css" href="style.css" rel="stylesheet" />
</head>
<body>
	<div id="wrapper" >
		<div class="fronter" >
		<h1>Click Jacking</h1>

		<p>
			Here we can demonstrate  a <em>Click Jacking</em> attack. With this, the user thinks they are  doing  one thing 
			but with some css trickery  we can fool the user into doing other operations.
		</p>

		<p>We are  going to get the user to delete  one of their stored cards, when they think they  are  opening a  safe link.</p>
		<div>

		<h2>Example with semi-transparent website</h2>
		<div class="relative front">
			<div class="clickJack trans" >
				<iframe id="window" src="../OpenDay/cards.php" ></iframe>
			</div>

			<p id="fakeLink" >Check out this hilarious picture of a cat - <a href="#">link</a></p>


		</div>

		<h2 class="second">Example with fully-transparent website</h2>
		<div class="relative">
			<div class="clickJack" >
				<iframe id="window" src="../OpenDay/cards.php" ></iframe>
			</div>

			<p id="fakeLink" >Check out this hilarious picture of a cat - <a href="#">link</a></p>


		</div>
	</body>
	</html>


