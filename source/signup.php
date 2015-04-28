<?php
include_once("../include/config.php");
include_once(INCLUDE_DIR . "/" . "htmlFunctions.php");
include_once(INCLUDE_DIR . "/" . "mitigate.php");
include_once(INCLUDE_DIR . "/" . "FYP_functions.php");

$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );#Used till the end

httpsAndSessionFix($mysqli);
outputHeader(true, $mysqli);
?>

<div id="signup">
	<form action="register.php" method="post" class="form-signup" role="form" >
		<h2 class="form-signup-heading">Not signed up?</h2>
		<input type="fname" class="form-control" placeholder="Name" required>
		<input type="sname" class="form-control" placeholder="Surname" required>
		<input type="email" class="form-control" placeholder="Email address" required>
		<input type="pass" class="form-control" placeholder="Password" required>

		<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
	</form>
</div>




<?php
outputFooter(false);
$mysqli->close();
?>