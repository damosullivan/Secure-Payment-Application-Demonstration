<?php
include_once("../include/config.php");
include_once(INCLUDE_DIR . "/" . "htmlFunctions.php");
include_once(INCLUDE_DIR . "/" . "mitigate.php");
include_once(INCLUDE_DIR . "/" . "FYP_functions.php");

$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );#Used till the end

$password = 'password';


if ( isset($_GET['source']) && isset($_GET['values']) ) {
	$source = $_GET['source'];
	$values = $_GET['values'];

	$sql = "INSERT INTO `FYP`.`get_Table` (`source`, `values`, `when`) VALUES ('".$source."', '".$values."', now() );";
	$result = $mysqli->query($sql);
	
	header( 'Location: XSS.php' ) ;
}



?>

<!DOCTYPE html>
<html>
<head>
	<title>CSRF Attack</title>
	<link type="text/css" href="style.css" rel="stylesheet" />



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	



</head>
<body>
	<div id="wrapper" >


		<h1>CSRF Attack</h1>

		<h2>Misleading Links</h2>

		<p>One of the simplest and most  effective ways of carrying out a CSRF attack is to hide  the url behind an link  that  a  user might click.
			If you know the user is logged in, and that the website uses 'Get' requests to carry out actions,
			then you can link the user to directly execute these requests. They won't know it is done, until it is too late.</p>

			<p>We are going to get the user to pay me.</p>

			<p><pre><?php echo htmlentities('<a href="http://localhost/FYP/OpenDay/payment.php?email=damo@damo.com&amp;amount=100&amp;comment=thanks for your money, honey" >www.website.com</a>'); ?></pre></p>


			<p><a href="http://localhost/FYP/OpenDay/payment.php?email=damo@damo.com&amp;amount=100&amp;comment=thanks for your money, honey" >www.website.com</a></p>

			<h2>Mitigate</h2>
			<p>To defend against this  type of atack, we use a <strong>CSRF Token</strong>, which is unique per user, and form.</p>


		</div>
	</body>
	</html>
