<?php
include_once(dirname(__FILE__) . "/include/config.php");
include_once(INCLUDE_DIR . "/" . "htmlFunctions.php");
include_once(INCLUDE_DIR . "/" . "mitigate.php");
include_once(INCLUDE_DIR . "/" . "FYP_functions.php");

$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );#Used till the end

httpsAndSessionFix($mysqli);
outputHeader(false, $mysqli);
?>

<div id="signup">
	<form action="register.php" method="post" class="form-signup" role="form" >
		<h2 class="form-signup-heading">Not signed up?</h2>
		<input name="fname" type="text" class="form-control" placeholder="Name" required>
		<input name="sname" type="text" class="form-control" placeholder="Surname" required>
		<input name="email" type="text" class="form-control" placeholder="Email address" required>
		<input name="pass" type="password" class="form-control" placeholder="Password" required>

		<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
	</form>
</div>




<?php
outputFooter(false);
$mysqli->close();
?>